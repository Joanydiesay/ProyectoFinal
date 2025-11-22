<?php

include 'conexion.php';
$conn = getConexion(); 


if (!isset($admin_id)) {
    die("Error: No se ha definido el ID del administrador.");
}

// Mensajes de alerta
if (isset($message)) {
    foreach ($message as $msg) { 
        echo '
        <div class="message">
           <span>' . htmlspecialchars($msg) . '</span>
           <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<header class="header">
   <div class="flex">
      <a href="admin_pag.php" class="logo">Panel<span>Admin</span></a>
      <nav class="navbar">
         <a href="admin_pag.php">Inicio</a>
         <a href="admin_productos.php">Productos</a>
         <a href="admin_ordenes.php">Pedidos</a>
         <a href="admin_usuarios.php">Usuarios</a>
         <a href="admin_contactos.php">Mensajes</a>
         <a href="consulta_productos.php">Tabla de Productos</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php

$select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
         $select_profile->execute([$admin_id]);

         if ($fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC)) {
             echo '<img src="uploaded_img/' . htmlspecialchars($fetch_profile['image']) . '" alt="Imagen de perfil">';
             echo '<p>' . htmlspecialchars($fetch_profile['name']) . '</p>';
         } else {
             echo '<p>Error: No se encontraron los datos del perfil.</p>';
         }
         ?>
         <a href="admin_actualizar_perfil.php" class="btn">Actualizar perfil</a>
         <a href="cerrar_sesion.php" class="delete-btn">Cerrar sesin</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">Iniciar sesion</a>
            <a href="registrar.php" class="option-btn">Registrarse</a>
         </div>
      </div>
   </div>
</header>
