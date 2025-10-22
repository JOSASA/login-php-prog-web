<div class="main-content">
    <h1>Dashboard</h1>
    <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['name']); ?>.</p>
    <div class="stat-cards">
        <div class="card">
            <h3>Usuarios Totales</h3>
            <p><?php echo $stats['total_users']; ?></p>
        </div>
        <div class="card">
            <h3>Productos Totales</h3>
            <p><?php echo $stats['total_products']; ?></p>
        </div>
        <div class="card">
            <h3>Pedidos Totales</h3>
            <p><?php echo $stats['total_orders']; ?></p>
        </div>
        <div class="card">
            <h3>Pedidos Pendientes</h3>
            <p><?php echo $stats['pending_orders']; ?></p>
        </div>
    </div>
</div>