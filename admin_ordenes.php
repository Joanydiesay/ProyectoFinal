<?php
@include 'conexion.php';

session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php'); // Redirigir al inicio de sesión si no hay sesión activa
};

if(isset($_POST['update_order'])){
   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?"); // Actualizar el estado del pago
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = '¡El estado del pago ha sido actualizado!';
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?"); // Eliminar un pedido
   $delete_orders->execute([$delete_id]);
   header('location:admin_ordenes.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pedidos</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   <?php include 'admin_lider.php'; ?>

   <section class="placed-orders">
      <h1 class="title">Pedidos realizados</h1>
      <div class="box-container">
         <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`"); // Seleccionar todos los pedidos
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ // Recorrer y mostrar cada pedido
         ?>
         <div class="box">
            <p> ID de usuario: <span><?= $fetch_orders['user_id']; ?></span> </p>
            <p> Realizado el: <span><?= $fetch_orders['placed_on']; ?></span> </p>
            <p> Nombre: <span><?= $fetch_orders['name']; ?></span> </p>
            <p> Correo: <span><?= $fetch_orders['email']; ?></span> </p>
            <p> Numero: <span><?= $fetch_orders['number']; ?></span> </p>
            <p> Direccion: <span><?= $fetch_orders['address']; ?></span> </p>
            <p> Productos totales: <span><?= $fetch_orders['total_products']; ?></span> </p>
            <p> Precio total: <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
            <p> Método de pago: <span><?= $fetch_orders['method']; ?></span> </p>
            <form action="" method="POST">
               <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
               <select name="update_payment" class="drop-down">
                  <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
                  <option value="pendiente">pendiente</option>
                  <option value="completado">completado</option>
               </select>
               <div class="flex-btn">
                  <input type="submit" name="update_order" class="option-btn" value="Actualizar">
                  <a href="admin_ordenes.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('¿Eliminar este pedido?');">Eliminar</a>
               </div>
            </form>
         </div>
         <?php
         }
         }else{
            echo '<p class="empty">¡No se han realizado pedidos!</p>';
         }
         ?>
      </div>
   </section>
   <script src="js/script.js"></script>
</body>
</html>