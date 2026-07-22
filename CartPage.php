<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: LoginPage.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['user_id'];

$sql = "

SELECT

cart.id AS cart_id,
cart.quantity,
cart.size,

products.id,
products.name,
products.price,
products.image1

FROM cart

JOIN products
ON cart.product_id = products.id

WHERE cart.user_id = '$user_id'

";

$result = mysqli_query($conn,$sql);

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cart</title>
<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">
  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/void stare logo favicon.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/void stare logo favicon.png">
</head>

<body>

    <!-- ================= LOADER ================= -->

<div class="loader-wrapper" id="loader">

    <div class="loader-logo">

        <!-- ROTATING RING -->
        <img src="images/ring.png" class="loader-ring">

        <!-- CENTER LOGO -->
        <img src="images/void-monogram.png" class="loader-center">

    </div>

</div>
<section class="cart-page">

<h2>Your Cart 🛒</h2>

<?php while($item = mysqli_fetch_assoc($result)): ?>

<?php

$subtotal =
$item['price'] * $item['quantity'];

$total += $subtotal;

?>

<div class="cart-item">

<img
src="<?php echo $item['image1']; ?>"
class="cart-image"
>

<div class="cart-details">

<h3>
<?php echo $item['name']; ?>
</h3>

<p>
Size:
<?php echo $item['size']; ?>
</p>

<p>
Quantity:
<?php echo $item['quantity']; ?>
</p>

<p>
Rs.<?php echo $subtotal; ?>
</p>

<a
href="RemoveCart.php?id=<?php echo $item['cart_id']; ?>"
class="remove-btn"
>
Remove
</a>

</div>

</div>

<?php endwhile; ?>

<div class="cart-summary">

<h3>
Total: Rs.<?php echo $total; ?>
</h3>

<a href="CheckoutPage.php" class="checkout-btn">
Proceed To Checkout
</a>

</div>

</section>

<script src="webproject.js"></script>
</body>
</head>