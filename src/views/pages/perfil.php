<?php include './php/perfil.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include './layouts/head.php'; ?>
    <link rel="stylesheet" href="css/perfil.css">
    <title>Mi Perfil - eBrainrot</title>
</head>
<body>
    <?php include './layouts/header.php'; ?>

    <main class="page-content">
        <div class="container">
            <h1 class="page-title">Mi Cuenta</h1>

            <div class="profile-layout">
                <aside class="profile-sidebar">
                    <nav class="profile-nav">
                        <a href="perfil.php" class="active"><i class="fa fa-user"></i> Mi Perfil</a>
                        <a href="pedidos.php"><i class="fa fa-box"></i> Mis Pedidos</a>
                        <a href="cambiar_password.php"><i class="fa fa-lock"></i> Cambiar Contraseña</a>
                        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </nav>
                </aside>

                <section class="profile-content">
                    <h2>Información Personal</h2>
                    

                    <div class="profile-details">
                        <div class="detail-item">
                            <strong>Nombre de Usuario:</strong>
                            <span><?= htmlspecialchars($user['nombre']) ?></span>
                        </div>
                        <div class="detail-item">
                            <strong>Correo Electrónico:</strong>
                            <span><?= htmlspecialchars($user['email']) ?></span>
                        </div>
                        <div class="detail-item">
                            <strong>Teléfono:</strong>
                            <span><?= htmlspecialchars($user['telefono']) ?></span>
                        </div>
                        <div class="detail-item">
                            <strong>Miembro desde:</strong>
                            <span><?= date("d F, Y", strtotime($user['creado_en'])) ?></span>
                        </div>
                    </div>
                    
                    <a href="editar_perfil.php" class="btn-primary" style="margin-top: 20px;">Editar Perfil</a>
                </section>
            </div>
        </div>
    </main>

    <?php include './layouts/footer.php'; ?> 
</body>
</html>