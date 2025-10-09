<?php
// src/controllers/AuthController.php

/**
 * Procesa el formulario de inicio de sesión.
 * La lógica es la de tu 'autentication.php'.
 */
function handle_login($conn)
{
    if (!isset($_POST['username'], $_POST['password'])) {
        header('Location: '.BASE_URL.'index.php?route=login&error=datos_faltantes');
        exit();
    }

    // Preparamos la consulta para seleccionar al usuario.
    if ($stmt = $conn->prepare('SELECT id, password, username, nombre FROM usuarios WHERE email = ? OR username = ?')) {
        $stmt->bind_param('ss', $_POST['username'], $_POST['username']);
        $stmt->execute();
        
        // ✨ CAMBIO PRINCIPAL AQUÍ ✨
        // En lugar de bind_result/fetch, obtenemos el resultado como un objeto.
        $resultado = $stmt->get_result();

        // Verificamos si se encontró exactamente una fila.
        if ($resultado->num_rows === 1) {
            
            // Convertimos la fila en un array asociativo.
            $user = $resultado->fetch_assoc();

            // Ahora usamos el array $user para acceder a los datos.
            if (password_verify($_POST['password'], $user['password'])) {
                
                // ¡Login correcto!
                session_regenerate_id(true);
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = !empty($user['nombre']) ? $user['nombre'] : $user['username'];
// Si el campo 'nombre' no está vacío, úsalo; si no, usa el 'username' como respaldo.
                require_once '../src/controllers/CartController.php';
                sync_cart_from_db_on_login($conn, $user['id']);

                if (isset($_POST['rememberme'])) {
                $token = bin2hex(random_bytes(32)); 
                $expiry_time = time() + (86400 * 30); // 30 días
                $expiry_date = date('Y-m-d H:i:s', $expiry_time);

                // b. Guardar token en la base de datos
                $update_stmt = $conn->prepare('UPDATE usuarios SET remember_me_token = ?, token_expiry = ? WHERE id = ?');
                $update_stmt->bind_param('ssi', $token, $expiry_date, $id);
                $update_stmt->execute();
                $update_stmt->close();

                // c. Guardar cookies en navegador (solo id + token, nunca la contraseña)
                setcookie('remember_me_id', $id, $expiry_time, '/', '', false, true); 
                setcookie('remember_me_token', $token, $expiry_time, '/', '', false, true);
                }

                header('Location: '.BASE_URL.'index.php?route=home');
                exit();
            }
        }
    }
    
    // Si algo falla (usuario no encontrado o contraseña incorrecta).
    header('Location: '.BASE_URL.'index.php?route=login&error=credenciales');
    exit();
}

/**
 * Procesa el formulario de registro de nuevos usuarios.
 * La lógica es la de tu 'save_user.php'.
 */
function handle_register($conn)
{
     if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['phone'])) {
        header('Location: ' . BASE_URL . 'index.php?route=register&error=datos_faltantes');
        exit();
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // TODO: Añadir validación para ver si el email o username ya existen.

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (username, password, email, telefono) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $passwordHash, $email, $phone);

    if ($stmt->execute()) {
        header('Location: ' . BASE_URL . 'index.php?route=login&status=register_success');
    } else {
        header('Location: ' . BASE_URL . 'index.php?route=register&error=register_failed');
    }
    $stmt->close();
    exit();
}

/**
 * Cierra la sesión del usuario.
 * La lógica es la de tu 'logout.php'.
 */
function handle_logout()
{
    $_SESSION = array();
    session_destroy();

    if (isset($_COOKIE['remember_me_id'])) {
        setcookie('remember_me_id', '', time() - 3600, '/');
    }
    if (isset($_COOKIE['remember_me_token'])) {
        setcookie('remember_me_token', '', time() - 3600, '/');
    }

    header('Location: ' . BASE_URL . 'index.php');
    exit();
}

/**
 * Obtiene los detalles de un usuario para la página de perfil.
 * La lógica es la de tu 'perfil.php' (la parte de arriba).
 */
function get_user_details($conn, $id)
{
    $stmt = $conn->prepare("SELECT username, nombre, apellido, email, telefono, creado_en FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
}
function handle_update_user($conn)
{
    if (!isset($_SESSION['id'])) {
        header('Location: index.php?route=login');
        exit();
    }

    $id = $_SESSION['id'];
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');

    if (!$nombre || !$email) {
        header('Location: index.php?route=edit_profile&error=datos_faltantes');
        exit();
    }

    // Validar si el correo ya existe
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
    $stmt->bind_param("si", $email, $id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        header('Location: index.php?route=edit_profile&error=email_existente');
        exit();
    }
    $stmt->close();

    $stmt = $conn->prepare("UPDATE usuarios 
                            SET nombre=?, apellido=?, email=?, telefono=?, direccion=? 
                            WHERE id=?");
    $stmt->bind_param("sssssi", $nombre, $apellido, $email, $telefono, $direccion, $id);

    if ($stmt->execute()) {
        header('Location: index.php?route=profile&status=actualizado');
    } else {
        header('Location: index.php?route=edit_profile&error=fallo');
    }
    $stmt->close();
    exit();
}

/**
 * Elimina la cuenta del usuario.
 */
function handle_delete_user($conn)
{
    if (!isset($_SESSION['id'])) {
        header('Location: index.php?route=login');
        exit();
    }

    $id = $_SESSION['id'];
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        session_destroy();
        header('Location: index.php?status=cuenta_eliminada');
    } else {
        header('Location: index.php?route=profile&error=eliminar');
    }
    $stmt->close();
    exit();
}