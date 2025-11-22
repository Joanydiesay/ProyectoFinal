<?php

@include 'conexion.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:conexion.php');
   exit();
}

if(isset($_POST['add_to_wishlist'])){

   $pid = filter_var($_POST['pid'], FILTER_SANITIZE_STRING);
   $p_name = filter_var($_POST['p_name'], FILTER_SANITIZE_STRING);
   $p_price = filter_var($_POST['p_price'], FILTER_SANITIZE_STRING);
   $p_image = filter_var($_POST['p_image'], FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = '¡ya agregado a la lista de deseos!';
   } elseif($check_cart_numbers->rowCount() > 0){
      $message[] = '¡ya agregado al carrito!';
   } else {
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = '¡agregado a la lista de deseos!';
   }
}

if(isset($_POST['add_to_cart'])){

   $pid = filter_var($_POST['pid'], FILTER_SANITIZE_STRING);
   $p_name = filter_var($_POST['p_name'], FILTER_SANITIZE_STRING);
   $p_price = filter_var($_POST['p_price'], FILTER_SANITIZE_STRING);
   $p_image = filter_var($_POST['p_image'], FILTER_SANITIZE_STRING);
   $p_qty = filter_var($_POST['p_qty'], FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = '¡ya agregado al carrito!';
   } else {
      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = '¡agregado al carrito!';
   }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>categoria</title>

   <!-- enlace de font awesome cdn -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- enlace a archivo CSS personalizado -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'encabezado.php'; ?>

<section class="products">

   <h1 class="title">categoriass de productos</h1>

   <div class="box-container">

   <?php
      // Verificar si el parámetro "category" está definido
      if (isset($_GET['category'])) {
         $category_name = filter_var($_GET['category'], FILTER_SANITIZE_STRING);
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
         $select_products->execute([$category_name]);

         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
      <a href="vista_pag.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="agregar a la lista de deseos" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="agregar al carrito" class="btn" name="add_to_cart">
   </form>
   <?php
            }
         } else {
            echo '<p class="empty">¡no hay productos disponibles!</p>';
         }
      } else {
         echo '<p class="empty">Categoría no especificada</p>';
      }
   ?>

   </div>

</section>
<?php include 'pagina.php'; ?>
<script src="js/script.js"></script>

</body>
</html>