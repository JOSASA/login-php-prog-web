<?php
session_start();
require_once 'dbconnect.php'; // aquí tienes tu conexión $conn

// 1. Validar que se recibieron datos del formulario
if (!isset($_POST['username'], $_POST['password'])) {
    header('Location: ../index.php?error=datos_faltantes');
    exit(); 
}

// 2. Preparar consulta segura (evita inyección SQL)
if ($stmt = $conn->prepare('SELECT id, password FROM usuarios WHERE email = ? OR nombre = ?')) {
    // 🔑 IMPORTANTE: permitimos login con email o username
    $stmt->bind_param('ss', $_POST['email'], $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    // 3. Validar si existe el usuario
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password_from_db);
        $stmt->fetch();

        // 4. Verificar contraseña (usando password_hash y password_verify)
        if (password_verify($_POST['password'], $hashed_password_from_db)) {
            
            // ✅ Login correcto → crear sesión segura
            session_regenerate_id(true); 
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $_POST['username'];

            // ==============================
            // 🔒 OPCIÓN "RECORDARME" (cookies seguras)
            // ==============================
            if (isset($_POST['rememberme'])) {
                // a. Crear un token aleatorio y seguro
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
            // ==============================

            header('Location: ../index.php');
            exit();
        } else {
            // ❌ Contraseña incorrecta
            header('Location: ../index.php?error=credenciales');
            exit();
        }
    } else {
        // ❌ Usuario no encontrado
        header('Location: ../index.php?error=credenciales');
        exit();
    }
    $stmt->close();
}
?>
