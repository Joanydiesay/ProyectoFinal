<?php
// Inicia sesión y verifica si el administrador está conectado
@include 'conexion.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit;
}

// Consulta para obtener productos junto con sus categorías
$sql = "SELECT 
            name AS nombre_producto, 
            price AS precio, 
            category AS categoria, 
            details AS descripcion 
        FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Productos</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <?php include 'admin_lider.php'; ?>
    <h2>Tabla de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre del Producto</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)) : ?>
                <?php foreach ($productos as $producto) : ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                        <td>$<?= htmlspecialchars($producto['precio']) ?></td>
                        <td><?= htmlspecialchars($producto['categoria']) ?></td>
                        <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="empty">No se encontraron productos</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
