<?php
// Incluye el archivo de conexión a la base de datos
@include 'conexion.php';

// Inicia la sesión si no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si la sesión contiene el ID del usuario
if (!isset($_SESSION['user_id'])) {
    // Redirige a la página de inicio de sesión si no hay usuario
    header('location:login.php');
    exit;
}

// Obtén el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<header class="header">

    <div class="flex">

        <a href="admin_pag.php" class="logo">Tienda Urbango<span>.</span></a>

        <nav class="navbar">
            <a href="inicio.php">inicio</a>
            <a href="comercio.php">tienda</a>
            <a href="ordenes.php">ordenes</a>
            <a href="sobre_nosotros.php">sobre nosotros</a>
            <a href="contactos.php">contacto</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <a href="buscar_pag.php" class="fas fa-search"></a>
            <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
            ?>
            <a href="lista_de_deseos.php"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
            <a href="carrito.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
        </div>

        <div class="profile">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
            <p><?= $fetch_profile['name']; ?></p>
            <a href="user_perfil_actualizar.php" class="btn">actualizar perfil</a>
            <a href="cerrar_sesion.php" class="delete-btn">cerrar sesion</a>
            <div class="flex-btn">
                <a href="login.php" class="option-btn">iniciar sesion</a>
                <a href="registrar.php" class="option-btn">registrarse</a>
            </div>
        </div>

    </div>
    
</header>