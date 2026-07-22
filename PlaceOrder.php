<?php

session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: LoginPage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment_method = $_POST['payment_method'];

/* GET CART ITEMS */

$cart_query = mysqli_query(

$conn,

"SELECT

cart.*,
products.name,
products.price

FROM cart

JOIN products
ON cart.product_id = products.id

WHERE cart.user_id='$user_id'"

);

/* INSERT ORDERS */

while($item = mysqli_fetch_assoc($cart_query)){

$product_name = $item['name'];

$price = $item['price'];

$size = $item['size'];

$quantity = $item['quantity'];

$product_id = $item['product_id'];

mysqli_query(

$conn,

"INSERT INTO orders
(
user_id,
product_id,
product_name,
price,
size,
quantity,
address,
phone,
status,
payment_method
)

VALUES
(
'$user_id',
'$product_id',
'$product_name',
'$price',
'$size',
'$quantity',
'$address',
'$phone',
'Pending',
'$payment_method'
)"
);
/* UPDATE SALES COUNT */

mysqli_query(

$conn,

"UPDATE products

SET sales_count = sales_count + $quantity

WHERE id='{$item['product_id']}'"

);

}

/* CLEAR CART */

mysqli_query(

$conn,

"DELETE FROM cart
WHERE user_id='$user_id'"

);

/* SUCCESS */

header("Location: OrderSuccess.php");
exit();

?>