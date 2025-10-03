
<?php
require_once './php/dbconnect.php';

// Si el usuario NO tiene una sesión activa...
if (!isset($_SESSION['loggedin'])) {
    
    // ...pero SÍ tiene las cookies de "recordarme"...
    if (isset($_COOKIE['remember_me_id']) && isset($_COOKIE['remember_me_token'])) {
        
        // ...entonces validamos esas cookies con la base de datos.
        $cookie_id = $_COOKIE['remember_me_id'];
        $cookie_token = $_COOKIE['remember_me_token'];

        $stmt = $conn->prepare('SELECT id, nombre FROM usuarios WHERE id = ? AND remember_me_token = ? AND token_expiry > NOW()');
        $stmt->bind_param('is', $cookie_id, $cookie_token);
        $stmt->execute();
        $stmt->store_result();

        // Si se encuentra una coincidencia válida y no expirada...
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $nombre);
            $stmt->fetch();

            // ...¡iniciamos la sesión automáticamente! ✅
            session_regenerate_id(true);
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $nombre;
        }
    }
}