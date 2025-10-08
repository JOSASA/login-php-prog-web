<?php
// src/controllers/ProductController.php

/**
 * Obtiene productos de la BD, ahora con opciones de filtrado y ordenación.
 *
 * @param mysqli $conn La conexión a la base de datos.
 * @param string|null $categoria La categoría por la que filtrar.
 * @param string $orden El criterio para ordenar los productos.
 * @return mysqli_result|false El resultado de la consulta.
 */
function get_all_products($conn, $categoria = null, $orden = 'newest') {
    // 1. Empezamos con la consulta base
    $sql = "SELECT id, nombre, precio, imagen FROM productos";

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

/**
 * Obtiene todas las categorías únicas de la base de datos.
 * Esto es para construir el menú de la barra lateral dinámicamente.
 *
 * @param mysqli $conn La conexión a la base de datos.
 * @return array Un array con los nombres de las categorías.
 */
function get_all_categories($conn) {
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

/**
 * Obtiene un producto por su ID 
 */
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