<?php
@include 'conexion.php';
session_start();
if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_pag.php'); // Cambiado el nombre del archivo

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:inicio.php'); // Cambiado el nombre del archivo

      }else{
         $message[] = '¡No se encontro el usuario!';
      }

   }else{
      $message[] = '¡Correo electronico o contraseña incorrectos!';
   }

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Iniciar Sesion</title>

   <!-- enlace de font awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- enlace del archivo CSS personalizado -->
   <link rel="stylesheet" href="css/components.css">

</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<section class="form-container">

   <form action="" method="POST">
      <h3>Inicia sesion ahora</h3>
      <input type="email" name="email" class="box" placeholder="Ingresa tu correo electronico" required>
      <input type="password" name="pass" class="box" placeholder="Ingresa tu contraseña" required>
      <input type="submit" value="Iniciar sesion" class="btn" name="submit">
      <p>¿No tienes una cuenta? <a href="registrar.php">Registrate ahora</a></p>
   </form>
</section>

</body>
</html>