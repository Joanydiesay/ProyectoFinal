<?php
@include 'conexion.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php'); // Redirigir al inicio de sesión si no hay una sesión activa
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?"); // Preparar la consulta para eliminar un mensaje
   $delete_message->execute([$delete_id]); // Ejecutar la consulta con el ID del mensaje
   header('location:admin_contactos.php'); // Recargar la página después de eliminar
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Mensajes</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   <?php include 'admin_lider.php'; // Incluir la cabecera del panel de administración ?>

   <section class="messages">
      <h1 class="title">Mensajes</h1>
      <div class="box-container">
         <?php
         $select_message = $conn->prepare("SELECT * FROM `message`"); // Seleccionar todos los mensajes
         $select_message->execute();
         if($select_message->rowCount() > 0){
            while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){ // Recorrer y mostrar cada mensaje
         ?>
         <div class="box">
            <p> ID de usuario: <span><?= $fetch_message['user_id']; ?></span> </p>
            <p> Nombre: <span><?= $fetch_message['name']; ?></span> </p>
            <p> Numero: <span><?= $fetch_message['number']; ?></span> </p>
            <p> Correo electronico: <span><?= $fetch_message['email']; ?></span> </p>
            <p> Mensaje: <span><?= $fetch_message['message']; ?></span> </p>
            <a href="admin_contactos.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('¿Eliminar este mensaje?');" class="delete-btn">Eliminar</a>
         </div>
         <?php
            }
         }else{
            echo '<p class="empty">¡No tienes mensajes!</p>';
         }
         ?>
      </div>
   </section>
   <script src="js/script.js"></script>
</body>
</html>