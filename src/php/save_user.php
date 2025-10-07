<?php
session_start();
require_once 'dbconnect.php'; // conexión con $conn

// Validar que los campos existen
if (isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['phone'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);

    // 1. Verificar que no estén vacíos
    if (empty($username) || empty($password) || empty($email) || empty($phone)) {
        die("❌ Por favor, completa todos los campos.");
    }

    // 2. Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ El email no es válido.");
    }

    // 3. Validar longitud mínima de contraseña
    if (strlen($password) < 6) {
        die("❌ La contraseña debe tener al menos 6 caracteres.");
    }

    // 4. Encriptar contraseña con password_hash
    $passwordHash = password_hash($password, PASSWORD_DEFAULT); 

    // 5. Verificar si ya existe el usuario o email
    $check_stmt = $conn->prepare("SELECT id FROM usuarios WHERE nombre = ? OR email = ?");
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        die("❌ El usuario o el email ya están registrados.");
    }
    $check_stmt->close();

    // 6. Insertar usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, password, email, telefono) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("❌ Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $passwordHash, $email, $phone);

    if ($stmt->execute()) {
        // ✅ Registro exitoso → redirigir al login
        header('Location: ../login.php?success=1');
        exit();
    } else {
        echo "❌ Error al registrar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Datos no recibidos correctamente.";
}

$conn->close();
?>
