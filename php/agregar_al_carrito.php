<?php
session_start();
// ===============================================
// FIN DE LA CONEXIÓN
// ===============================================
// Inicia la sesión para obtener el identificador único del visitante (id_sesion)
require_once 'dbconnect.php';


// Incluye el archivo de conexión a la base de datos (con mysqli)


// 1. Identificación del Carrito
// Usamos el ID de la sesión como identificador del carrito para usuarios no logueados.
$id= session_id();
// Si el usuario está logueado, podrías usar su ID de usuario en lugar del ID de sesión.
// Si tuvieras un sistema de login, usarías $id_usuario = $_SESSION['user_id'] ?? null;
// Por ahora, solo usamos id_sesion.

// 2. Obtener datos del formulario
// Asumimos que el formulario de la tienda solo envía el ID del producto y la cantidad (por defecto 1).
$id_producto = $_POST['id'] ?? null;
$cantidad    = (int)($_POST['cantidad'] ?? 1); 

// 3. Validación inicial
if (!$id_producto || $cantidad <= 0) {
    header('Location: ../shop.php?error=datos_invalidos');
    exit;
}

// Habilitar la gestión de transacciones
// Aunque esta es una operación simple, es buena práctica mantenerla.
$conn->begin_transaction(); 

try {
    // A. CONSULTA: Verificar si el producto ya existe en el carrito
    $stmt = $conn->prepare("SELECT cantidad FROM carritos WHERE id_sesion = ? AND id_producto = ?");
    $stmt->bind_param("si", $id_sesion, $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    $stmt->close();

    if ($item) {
        // B. ACTUALIZAR: Si ya existe, suma la nueva cantidad
        $nueva_cantidad = $item['cantidad'] + $cantidad;
        
        $stmt = $conn->prepare("UPDATE carritos SET cantidad = ? WHERE id_sesion = ? AND id_producto = ?");
        $stmt->bind_param("isi", $nueva_cantidad, $id_sesion, $id_producto);
        $stmt->execute();
        $stmt->close();
        
    } else {
        // C. INSERTAR: Si no existe, agrégalo como un nuevo ítem
        $stmt = $conn->prepare("INSERT INTO carritos (id_sesion, id_producto, cantidad) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $id_sesion, $id_producto, $cantidad);
        $stmt->execute();
        $stmt->close();
    }
    
    // Si todo salió bien, confirma la transacción
    $conn->commit();
    
    // Redirige de vuelta a la tienda o al carrito con mensaje de éxito
    header('Location: ../shop.php?msg=producto_agregado');
    exit;

} catch (\mysqli_sql_exception $e) {
    // Si algo falla, revierte las operaciones
    $conn->rollback();
    
    // Redirige con un error
    // En producción, es mejor registrar el error completo y mostrar solo un mensaje genérico.
    error_log("Error al agregar al carrito: " . $e->getMessage()); 
    header('Location: ../shop.php?error=db_fail');
    exit;
}
?>