    <?php
    session_start();

    //credenciales de acceso a la base datos

    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'practicaecommerce';

    // conexion a la base de datos

    $conexion = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    if (mysqli_connect_error()) {

        // si se encuentra error en la conexión

        exit('Fallo en la conexión de MySQL:' . mysqli_connect_error());
    }

    if (!isset($_POST['username'], $_POST['password'])) {
    header('Location: ../index.php');
    exit(); // Añadido para detener la ejecución después de la redirección
}
    // Se valida si se ha enviado información, con la función isset()
    if (!isset($_POST['username'], $_POST['password'])) {

        // si no hay datos muestra error y re direccionar

        header('Location: ../index.php');
    }

    // evitar inyección sql

    if ($stmt = $conexion->prepare('SELECT id_account,password_hash FROM accounts WHERE username = ?')) {

        // parámetros de enlace de la cadena s

        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
    }


    // acá se valida si lo ingresado coincide con la base de datos

    $stmt->store_result();
if ($stmt->num_rows > 0) {
    // NOTA: El campo en la DB es 'password_hash' (lo cambiaste a 'password' en tu código)
    // Usaremos 'password_hash' en el código para mayor claridad.
    $stmt->bind_result($id, $hashed_password_from_db);
    $stmt->fetch();

    // 🚨 CAMBIO CRÍTICO: Usa password_verify() para contraseñas cifradas
    // Si tu campo 'password_hash' tiene contraseñas cifradas con password_hash()
     if (password_verify($_POST['password'], $hashed_password_from_db)) { 
    
    // Si usas el método de comparación directa (NO RECOMENDADO):
    if ($_POST['password'] === $hashed_password_from_db) {
        // La conexión es exitosa, se crea la sesión
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;

        // ===============================================
        // 💡 LÓGICA DE COOKIE "RECORDARME"
        // ===============================================
        if (isset($_POST['rememberme'])) {
            // a. Generar un token único y seguro (ej. 32 bytes)
            $token = bin2hex(random_bytes(32)); 
            
            // b. Definir la expiración de la cookie (ej. 30 días)
            $expiry_time = time() + (86400 * 30); // 86400 segundos = 1 día
            $expiry_date = date('Y-m-d H:i:s', $expiry_time);

            // c. Almacenar el token y la expiración en la base de datos
            $update_stmt = $conexion->prepare('UPDATE accounts SET remember_me_token = ?, token_expiry = ? WHERE id_account = ?');
            $update_stmt->bind_param('ssi', $token, $expiry_date, $id);
            $update_stmt->execute();
            $update_stmt->close();

            // d. Crear la cookie en el navegador del usuario
            // La cookie solo contiene el ID del usuario y el token
            setcookie('remember_me_id', $id, $expiry_time, '/');
            setcookie('remember_me_token', $token, $expiry_time, '/');
        }
        // ===============================================

        header('Location: ../index.php');
        exit(); 
    } else {
        // Contraseña incorrecta
        header('Location: ../index.php?error=credenciales');
        exit();
    }
} else {
    // Usuario incorrecto (no encontrado)
    header('Location: ../index.php?error=credenciales');
    exit();
}
$stmt->close();
}
?>

    