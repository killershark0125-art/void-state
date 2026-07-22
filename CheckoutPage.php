<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: LoginPage.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['user_id'];

$total = 0;

$cart_query = mysqli_query(

$conn,

"SELECT

cart.*,
products.name,
products.price,
products.image1

FROM cart

JOIN products
ON cart.product_id = products.id

WHERE cart.user_id='$user_id'"

);

?>

<!DOCTYPE html>
<html>
<head>

<title>Checkout</title>

<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">

</head>
<body>

<section class="checkout-page">

<div class="checkout-container">

<h1>Checkout</h1>

<div class="checkout-products">

<?php

if(mysqli_num_rows($cart_query) == 0){

    echo "<h2>Your cart is empty.</h2>";
    exit();

}

?>

<?php while($item = mysqli_fetch_assoc($cart_query)): ?>

<?php

$subtotal =
$item['price'] * $item['quantity'];

$total += $subtotal;

?>

<div class="checkout-product-card">

<img
src="<?php echo $item['image1']; ?>"
class="checkout-product-image"
>

<div>

<h3>
<?php echo $item['name']; ?>
</h3>

<p>
Size: <?php echo $item['size']; ?>
</p>

<p>
Qty: <?php echo $item['quantity']; ?>
</p>

<p>
Rs. <?php echo $subtotal; ?>
</p>

</div>

</div>

<?php endwhile; ?>

<h2 class="checkout-total">
Total: Rs. <?php echo $total; ?>
</h2>

</div>

<form action="PlaceOrder.php" method="POST">

<input
type="text"
name="full_name"
placeholder="Full Name"
value="<?php echo $user['full_name'] ?? ''; ?>"
required
>

<input
type="text"
name="phone"
placeholder="Phone Number"
value="<?php echo $user['Phone_Number'] ?? ''; ?>"
required
>

<textarea
name="address"
placeholder="Shipping Address"
value="<?php echo $user['Shipping_Address'] ?? ''; ?>"
rows="5"
required
></textarea>

<label>Payment Method</label>

<select name="payment_method" required>

<option value="">Select Payment Method</option>

<option value="Cash On Delivery">
Cash On Delivery
</option>

<option value="Bank Transfer">
Bank Transfer
</option>

</select>

<div class="bank-details">

<h3>Bank Transfer Details</h3>

<p>Bank: HBL</p>

<p>Account Title: VOID STATE</p>

<p>Account Number: 123456789</p>

</div>

<button
type="submit"
class="checkout-btn"
>
Place Order
</button>

</form>

</div>

</section>

</body>
</html>