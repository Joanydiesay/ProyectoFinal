<?php

require_once 'conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = '¡Mensaje ya enviado!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = '¡Mensaje enviado exitosamente!';

   }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contacto</title>

   <!-- enlace CDN font awesome  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- enlace archivo css personalizado  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'encabezado.php'; ?>

<section class="contact">

   <h1 class="title">ponte en contacto</h1>

   <form action="" method="POST">
      <input type="text" name="name" class="box" required placeholder="ingresa tu nombre">
      <input type="email" name="email" class="box" required placeholder="ingresa tu correo electronico">
      <input type="number" name="number" min="0" class="box" required placeholder="ingresa tu numero">
      <textarea name="msg" class="box" required placeholder="ingresa tu mensaje" cols="30" rows="10"></textarea>
      <input type="submit" value="enviar mensaje" class="btn" name="send">
   </form>

</section>

<?php include 'pagina.php'; ?>

<script src="js/script.js"></script>

</body>
</html>