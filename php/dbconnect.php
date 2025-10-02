<?php


// ===============================================
// CONFIGURACIÓN E INICIO DE CONEXIÓN A LA BASE DE DATOS
// ===============================================
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'practicaecommerce'; // <<-- ¡Asegúrate de que este sea el nombre correcto de tu DB!

// Habilitar el reporte de errores para manejar excepciones de MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Conectar a la base de datos
    $conn = new mysqli($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    $conn->set_charset('utf8mb4'); // Establecer el charset
} catch (\mysqli_sql_exception $e) {
    // Terminar la ejecución si la conexión falla
    // En producción, solo muestra un mensaje genérico.
    die("Error de conexión a la base de datos: " . $e->getMessage());
}