<?php
@include 'conexion.php';

session_start();

$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>sobre nosotros</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'encabezado.php'; ?>
<section class="about">
   <div class="row">
      <div class="box">
         <img src="images/about-img-1.png" alt="">
         <h3>¿por que elegirnos?</h3>
         <p>Porque combinamos comodidad, confianza y atención personalizada para brindarte una experiencia de compra única y satisfactoria, siempre pensando en tus necesidades.</p>
         <a href="contactos.php" class="btn">contáctanos</a>
      </div>
      <div class="box">
         <img src="images/about-img-2.png" alt="">
         <h3>¿que ofrecemos?</h3>
         <p>Ofrecemos una amplia variedad de productos de calidad, precios competitivos, entregas rápidas y un servicio al cliente dedicado, todo diseñado para facilitar tus compras desde la comodidad de tu hogar.</p>
         <a href="comercio.php" class="btn">nuestra tienda</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">opiniones de clientes</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>"Excelente experiencia de compra. Los productos llegaron rápido y en perfectas condiciones. Definitivamente volvere a comprar."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>luis melo</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>"Me encanta la variedad que tienen. Encontré exactamente lo que buscaba a un precio justo. El proceso fue rápido y fácil."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>carmen rojas</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>"Todo estuvo muy bien, aunque me gustaría que ofrecieran más opciones de pago. Aun así, los recomiendo."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Leo camacho</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>"El servicio al cliente es excepcional. Tuvieron mucha paciencia y resolvieron todas mis dudas antes de hacer la compra."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Lucia cuya</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>"El producto era justo como lo describieron. Aunque tardó un poco más de lo esperado, valió la pena la espera."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>carlos Perez</h3>
      </div>
      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>"Esta tienda virtual es mi favorita. Siempre cumplen con lo prometido y tienen ofertas increíbles. Muy recomendados."</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Micaela Diaz</h3>
      </div>
   </div>
</section>
<?php include 'pagina.php'; ?>

<script src="js/script.js"></script>

</body>
</html>