<?php
session_start();
require './php/dbconnect.php';

// --- VERIFICACIONES DE SEGURIDAD ---
/*
// 1. Si el usuario no ha iniciado sesión, redirigirlo al login.
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php?error=Debes iniciar sesión para comprar');
    exit();
}

// 2. Si el carrito está vacío, redirigirlo a la tienda.
if (empty($_SESSION['carrito'])) {
    header('Location: shop.php');
    exit();
}
*/
// --- OBTENCIÓN DE DATOS ---

// Cargar datos del usuario para pre-rellenar el formulario
$usuario_id = $_SESSION['usuario_id'];
$stmt = $conn->prepare("SELECT nombre, email, direccion, telefono FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado_usuario = $stmt->get_result();
$usuario = $resultado_usuario->fetch_assoc();
$stmt->close();

// Dividir el nombre completo en nombre y apellido (si existe)
$nombre_completo = explode(' ', $usuario['nombre'] ?? '', 2);
$nombre = $nombre_completo[0];
$apellido = $nombre_completo[1] ?? '';


// --- CÁLCULOS DEL RESUMEN DE COMPRA ---

$subtotal = 0;
foreach ($_SESSION['carrito'] as $item) {
    $subtotal += $item['precio'] * $item['cantidad'];
}
$envio = 150.00; // Puedes hacerlo más complejo (ej. gratis si subtotal > 1000)
$descuento = 0.00; // Lógica para cupones podría ir aquí
$total = $subtotal + $envio - $descuento;

?>
<!DOCTYPE html>
<html lang="es">
    link
<?php include './layouts/head.php'; ?>
<body>
    <?php include './layouts/header.php'; ?>
    <form method="POST" action="procesar_pedido.php">
        <div class="container">
            <div class="informacion_facturacion">
                <h2>Información de facturación</h2>
                <div class="informacion-facturacion-inputs">
                    <div>
                        <label>Nombre(s)</label>
                        <input type="text" name="nombre" placeholder="Nombre" value="<?= htmlspecialchars($nombre) ?>" required>
                    </div>
                    <div>
                        <label>Apellido(s)</label>
                        <input type="text" name="apellido" placeholder="Apellido" value="<?= htmlspecialchars($apellido) ?>" required>
                    </div>
                </div>
                <div class="informacion-facturacion-inputs" style="grid-template-columns: 1fr;">
                    <div>
                        <label>Dirección de Envío</label>
                        <input type="text" name="direccion" value="<?= htmlspecialchars($usuario['direccion'] ?? '') ?>" required>
                    </div>
                </div>
                <div class="informacion-facturacion-inputs">
                    <div>
                        <label>Correo Electrónico</label>
                        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" required>
                    </div>
                    <div>
                        <label>Número De Teléfono</label>
                        <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono'] ?? '') ?>" required>
                    </div>
                </div>
                
                <h2>Métodos de pago</h2>
                <div class="metodos_pago">
                    <div class="card">
                        <label><input type="radio" name="metodo_pago" value="paypal" checked> PayPal</label>
                    </div>
                    <div class="card">
                        <label><input type="radio" name="metodo_pago" value="tarjeta"> Débito/Crédito</label>
                    </div>
                </div>
                
                <h2>Información Adicional</h2>
                <label>Notas del pedido <span>(opcional)</span></label>
                <textarea name="notas"></textarea>
            </div>

            <div class="resumen-compra">
                <h2>Resumen de compra</h2>
                <div class="summary-container">
                    <p>Subtotal</p> 
                    <span>$<?= number_format($subtotal, 2) ?></span>
                </div>
                <div class="summary-container">
                    <p>Descuento</p>
                    <span>-$<?= number_format($descuento, 2) ?></span>
                </div>
                <div class="summary-container">
                    <p>Envío</p>
                    <span>$<?= number_format($envio, 2) ?></span>
                </div>
                <div class="summary-container total-row">
                    <p>Total</p>
                    <span>$<?= number_format($total, 2) ?></span>
                </div>

                <input type="hidden" name="total_final" value="<?= $total ?>">

                <button type="submit" class="payment-button">Realizar el pedido</button>
            </div>
        </div>
    </form>
    
    </body>
</html>