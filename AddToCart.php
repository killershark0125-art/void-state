<?php

session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){

    header("Location: LoginPage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$product_id = intval($_POST['product_id']);

$size = $_POST['size'];

/* CHECK IF ALREADY EXISTS */

$check = mysqli_query(
$conn,
"SELECT * FROM cart
WHERE user_id='$user_id'
AND product_id='$product_id'
AND size='$size'"
);

if(mysqli_num_rows($check) > 0){

    mysqli_query(
    $conn,
    "UPDATE cart
    SET quantity = quantity + 1
    WHERE user_id='$user_id'
    AND product_id='$product_id'
    AND size='$size'"
    );

}else{

    mysqli_query(
    $conn,
    "INSERT INTO cart
    (user_id, product_id, quantity, size)

    VALUES

    ('$user_id','$product_id','1','$size')"
    );
}

header("Location: CartPage.php");
exit();

?>