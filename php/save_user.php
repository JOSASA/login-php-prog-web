<?php
// Configuración de la base de datos
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'practicaecommerce';

// Conectar a la base de datos
$conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Validar que los campos existen
if (isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['phone'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email    = trim($_POST['email']);
    $phone    = trim($_POST['phone']);

    // Verificar que no estén vacíos
    if (empty($username) || empty($password) || empty($email) || empty($phone)) {
        die("Por favor, completa todos los campos.");
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT); 

    // Preparar la consulta para evitar inyección SQL
    $stmt = $conn->prepare("INSERT INTO accounts (username, password_hash, email, phone) 
    VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $passwordHash, $email, $phone);

    if ($stmt->execute()) {
        header('Location: ../login.php');
    } else {
        echo "❌ Error al registrar: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Datos no recibidos correctamente.";
}

$conn->close();
?>
