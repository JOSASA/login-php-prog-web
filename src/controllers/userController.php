<?php

/**
 * Obtiene una lista de todos los usuarios para el panel de administración.
 * Es "limpio" porque solo selecciona las columnas necesarias y 
 * NUNCA expone datos sensibles como la contraseña.
 *
 * @param object $conn La conexión a la base de datos.
 * @return array Un array de usuarios, o un array vacío si no hay ninguno.
 */
function get_all_users($conn)
{
    // 1. Inicializa un array vacío para guardar los usuarios.
    $users = [];
    
    // 2. Define la consulta SQL.
    // Selecciona solo las columnas que mostrarás en el panel.
    // ¡NUNCA INCLUYAS la columna 'password' o 'remember_me_token'!
    $sql = "SELECT id, username, nombre, apellido, email, telefono, rol, creado_en 
            FROM usuarios 
            ORDER BY id ASC";

    // 3. Ejecuta la consulta
    $result = $conn->query($sql);

    // 4. Procesa los resultados
    if ($result && $result->num_rows > 0) {
        // Recorre cada fila y la añade a nuestro array de usuarios
        while($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    
    // 5. Devuelve el array (estará vacío si no se encontraron usuarios)
    return $users;
}
function get_all_orders_admin($conn)
{
    $orders = [];
    
    // Seleccionamos los datos principales del pedido.
    // Ordenamos por fecha descendente para ver los más nuevos primero.
    $sql = "SELECT id, usuario_id, nombre_completo, email, total, fecha_pedido, state 
            FROM pedidos 
            ORDER BY fecha_pedido DESC";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }
    
    return $orders;
}

// Aquí puedes añadir más funciones de usuario en el futuro
// (ej. get_user_by_id_admin, update_user_role, etc.)