<?php

session_start();

include "db.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    exit("Access Denied");
}

$order_id = $_POST['order_id'];

$status = $_POST['status'];

mysqli_query(

$conn,

"UPDATE orders

SET status='$status'

WHERE id='$order_id'"

);

header("Location: AdminOrders.php");

exit();

?>