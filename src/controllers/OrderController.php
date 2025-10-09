<?php
function handle_place_order($conn) {
    // 1️⃣ Verificaciones de seguridad
    if (!isset($_SESSION['loggedin']) || empty($_SESSION['carrito'])) {
        header('Location: ' . BASE_URL . 'index.php?route=shop');
        exit();
    }

    // 2️⃣ Recolección de datos del formulario
    $usuario_id = $_SESSION['id'];

    // Datos personales
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $nombre_completo = $nombre . ' ' . $apellido;
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $telefono = trim($_POST['telefono']);

    // Dirección de envío
    $calle = trim($_POST['calle']);
    $numero = trim($_POST['numero']);
    $colonia = trim($_POST['colonia']);
    $ciudad = trim($_POST['ciudad']);
    $estado = trim($_POST['estado']);
    $codigo_postal = trim($_POST['codigo_postal']);
    $referencias = trim($_POST['referencias']);

    // Método de pago y notas (si existen)
    $metodo_pago = $_POST['metodo_pago'] ?? 'no especificado';
    $notas = trim($_POST['notas'] ?? '');

    // 3️⃣ Recalcular el total en el servidor (¡nunca confíes en el cliente!)
    $subtotal = 0;
    foreach ($_SESSION['carrito'] as $item) {
        $subtotal += $item['precio'] * $item['cantidad'];
    }

    $costo_envio = 150.00;
    $total_seguro = $subtotal + $costo_envio;

    // 4️⃣ Iniciar transacción
    $conn->begin_transaction();
    try {
        // Insertar en tabla 'pedidos'
        $stmt_pedido = $conn->prepare("
            INSERT INTO pedidos (
                usuario_id, nombre_completo, email, telefono, 
                calle, numero, colonia, ciudad, estado, codigo_postal, referencias,
                total, metodo_pago, notas
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt_pedido->bind_param(
            "issssssssssdds",
            $usuario_id,
            $nombre_completo,
            $email,
            $telefono,
            $calle,
            $numero,
            $colonia,
            $ciudad,
            $estado,
            $codigo_postal,
            $referencias,
            $total_seguro,
            $metodo_pago,
            $notas
        );
        $stmt_pedido->execute();
        $pedido_id = $conn->insert_id;
        $stmt_pedido->close();

        // Insertar cada producto en 'pedido_detalles'
        $stmt_detalle = $conn->prepare("
            INSERT INTO pedido_detalles 
            (pedido_id, producto_id, nombre_producto, cantidad, precio_unitario)
            VALUES (?, ?, ?, ?, ?)
        ");

        foreach ($_SESSION['carrito'] as $id_producto => $item) {
            $stmt_detalle->bind_param(
                "iisid",
                $pedido_id,
                $id_producto,
                $item['nombre'],
                $item['cantidad'],
                $item['precio']
            );
            $stmt_detalle->execute();
        }
        $stmt_detalle->close();

        // Confirmar todo
        $conn->commit();
        
        
    
    } catch (Exception $e) {
        // Si algo falla, revertir todo
        $conn->rollback();
        $_SESSION['flash_message'] = [
            'type' => 'error',
            'message' => 'Hubo un error al procesar tu pedido. Intenta de nuevo.'
        ];
        header('Location: ' . BASE_URL . 'index.php?route=checkout');
        exit();
    }

    // 5️⃣ Limpieza de carrito y redirección final
    $_SESSION['carrito'] = [];
    $conn->query("DELETE FROM carrito WHERE usuario_id = $usuario_id");

    $_SESSION['flash_message'] = [
        'type' => 'success',
        'message' => '¡Tu pedido #' . $pedido_id . ' ha sido realizado con éxito!'
    ];

    header('Location: ' . BASE_URL . 'index.php?route=cart');
    exit();
}
?>
