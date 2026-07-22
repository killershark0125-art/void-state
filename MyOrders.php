<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: LoginPage.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['user_id'];

$result = mysqli_query(

$conn,

"SELECT orders.*, products.image1

FROM orders

LEFT JOIN products
ON orders.product_id = products.id

WHERE orders.user_id='$user_id'

ORDER BY orders.created_at DESC"

);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">
</head>
<body>
    <h1>My Orders</h1>
    <a href="ProfilePage.php" class="back-btn">
← Back To Profile
</a>
    <?php

if(mysqli_num_rows($result) == 0){

    echo "<h2 class='empty-orders'>You haven't placed any orders yet.</h2>";

}

?>

<?php while($order = mysqli_fetch_assoc($result)): ?>

<div class="order-card">

<img
src="<?php echo $order['image1']; ?>"
class="order-image">

<div>

<h3>
<?php echo $order['product_name']; ?>
</h3>

<p>
Price: Rs. <?php echo $order['price']; ?>
</p>

<p>
Qty: <?php echo $order['quantity']; ?>
</p>

<p>
Size: <?php echo $order['size']; ?>
</p>

<p>
Payment:
<?php echo $order['payment_method']; ?>
</p>

<p>

Status:

<span class="status-<?php echo strtolower($order['status']); ?>">

<?php echo $order['status']; ?>

</span>

</p>

<p>
Ordered:
<?php echo $order['created_at']; ?>
</p>

</div>

</div>

<?php endwhile; ?>
</body>
</html>