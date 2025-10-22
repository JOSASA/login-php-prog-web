<?php


/**


 */
function get_all_products($conn, $categoria = null, $orden = 'newest') {
    // 1. Empezamos con la consulta base
    $sql = "SELECT id, nombre,categoria,descripcion, precio,stock, imagen FROM productos";

    // 2. Añadimos el filtro de categoría si se proporciona
    // Se usa una consulta preparada para evitar inyección SQL con el valor de la categoría.
    if ($categoria !== null && $categoria !== '') {
        $sql .= " WHERE categoria = ?";
    }

    // 3. Añadimos el criterio de ordenación
    switch ($orden) {
        case 'price_asc':
            $sql .= " ORDER BY precio ASC";
            break;
        case 'price_desc':
            $sql .= " ORDER BY precio DESC";
            break;
        case 'name_asc':
            $sql .= " ORDER BY nombre ASC";
            break;
        default: // 'newest' o cualquier otro caso
            $sql .= " ORDER BY id DESC";
            break;
    }

    // 4. Preparamos y ejecutamos la consulta
    $stmt = $conn->prepare($sql);

    // Si había una categoría, enlazamos el parámetro
    if ($categoria !== null && $categoria !== '') {
        $stmt->bind_param("s", $categoria);
    }
    
    $stmt->execute();
    return $stmt->get_result();
}
function get_product_by_id($conn, $id) {
    //
    if (!is_numeric($id)) {
        return null;
    }
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows === 1) {
        return $resultado->fetch_assoc();
    } else {
        return null;
    }
}


// ... (tus funciones existentes como get_all_products)

/**
 * Obtiene todas las categorías para el dropdown del formulario.
 */
function get_all_categories($conn)
{
    $categories = [];
    $result = $conn->query("SELECT id_categoria, nombre FROM categorias ORDER BY nombre");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}


/**
 * Maneja la creación de un nuevo producto, incluyendo la subida de imagen.
 */
function handle_create_product($conn)
{
    // --- 1. Definir Rutas ---
    
    // Ruta del sistema de archivos donde se guardará la imagen (desde index.php)
    // Usamos '..' para subir un nivel desde 'public'
    define('UPLOAD_DIR', '../public/assets/img/componentes/');
    
    // Ruta que se guardará en la BBDD (accesible desde la web)
    define('DB_IMG_PATH', 'assets/img/componentes/');

    $redirect_error = 'Location: ' . BASE_URL . 'index.php?route=admin_create_product&error=';
    $redirect_success = 'Location: ' . BASE_URL . 'index.php?route=admin_products&status=created';

    // --- 2. Validar Datos POST ---
    $nombre = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $precio = floatval($_POST['precio'] ?? 0);
    $stock = intval($_POST['stock'] ?? 0);
    $id_categoria = intval($_POST['id_categoria'] ?? 0);

    if (empty($nombre) || $precio <= 0 || $stock < 0 || $id_categoria <= 0) {
        header($redirect_error . 'datos_invalidos');
        exit;
    }
    
    // --- 3. Validar Archivo Subido ---
    if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== 0) {
        header($redirect_error . 'error_archivo');
        exit;
    }

    $file = $_FILES['imagen'];
    $file_size = $file['size'];
    $file_tmp_name = $file['tmp_name'];
    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed_exts = ['jpg', 'jpeg', 'png'];

    if (!in_array($file_ext, $allowed_exts)) {
        header($redirect_error . 'tipo_invalido');
        exit;
    }

    if ($file_size > 2000000) { // Límite de 2MB
        header($redirect_error . 'tamano_excedido');
        exit;
    }

    // --- 4. Mover Archivo ---
    
    // Generar un nombre único para evitar sobreescribir archivos
    $file_name_new = uniqid('', true) . '.' . $file_ext;
    $target_path = UPLOAD_DIR . $file_name_new;

    if (move_uploaded_file($file_tmp_name, $target_path)) {
        
        // --- 5. Insertar en BBDD ---
        
        // Obtenemos el nombre de la categoría para el campo 'categoria' (varchar)
        // (Esto asume que tu BBDD lo necesita. Si no, puedes quitarlo)
        $stmt_cat = $conn->prepare("SELECT nombre FROM categorias WHERE id_categoria = ?");
        $stmt_cat->bind_param('i', $id_categoria);
        $stmt_cat->execute();
        $categoria_nombre = $stmt_cat->get_result()->fetch_assoc()['nombre'] ?? 'Desconocida';
        $stmt_cat->close();
        
        $db_path = DB_IMG_PATH . $file_name_new;

        $sql = "INSERT INTO productos (nombre, categoria, descripcion, precio, stock, imagen, id_categoria) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssdisi",
            $nombre,
            $categoria_nombre, // El campo varchar
            $descripcion,
            $precio,
            $stock,
            $db_path,          // La ruta de la imagen para la BBDD
            $id_categoria      // El ID de la categoría
        );

        if ($stmt->execute()) {
            header($redirect_success);
        } else {
            // Si la BBDD falla, borra el archivo subido para no dejar basura
            unlink($target_path); 
            header($redirect_error . 'db_error');
        }
        $stmt->close();

    } else {
        header($redirect_error . 'error_moviendo_archivo');
    }
    exit;
}

function get_all_categories2($conn) {
    $categorias = [];
    $sql = "SELECT DISTINCT categoria FROM productos ORDER BY categoria ASC";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $categorias[] = $fila['categoria'];
        }
    }
    return $categorias;
}

