<?php

session_start();

if(
!isset($_SESSION['role'])
||
$_SESSION['role'] != 'admin'
){
    exit("Access Denied");
}

include "db.php";

$result = mysqli_query(

$conn,

"SELECT *

FROM orders

ORDER BY created_at DESC"

);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Order</title>
<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">
</head>
<body>

<h1 class="admin-orders-title">
Customer Orders
</h1>
    <table>

<tr>

<th>ID</th>
<th>User</th>
<th>Product</th>
<th>Price</th>
<th>Payment</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>

</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['user_id']; ?></td>

<td><?php echo $row['product_name']; ?></td>

<td><?php echo $row['price']; ?></td>

<td><?php echo $row['payment_method']; ?></td>

<td>
<?php echo $row['status']; ?>
</td>

<td>

<form action="UpdateOrderStatus.php" method="POST">

<input
type="hidden"
name="order_id"
value="<?php echo $row['id']; ?>">

<select name="status">

<option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option value="Processing" <?php if($row['status']=="Processing") echo "selected"; ?>>
Processing
</option>

<option value="Shipped" <?php if($row['status']=="Shipped") echo "selected"; ?>>
Shipped
</option>

<option value="Delivered" <?php if($row['status']=="Delivered") echo "selected"; ?>>
Delivered
</option>

<option value="Cancelled" <?php if($row['status']=="Cancelled") echo "selected"; ?>>
Cancelled
</option>

</select>

<button type="submit">
Update
</button>

</form>

</td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php endwhile; ?>

</table>
</body>
</html>