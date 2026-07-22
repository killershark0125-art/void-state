<?php

session_start();
include "db.php";

$email = trim($_POST['email']);
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){

    $user=mysqli_fetch_assoc($result);

    if(password_verify($password,$user['password'])){

        $_SESSION['user_id']=$user['id'];
        $_SESSION['role']=$user['role'];
        $_SESSION['email']=$user['email'];

        echo "success";

    }else{

        echo "Invalid email or password.";

    }

}else{

    echo "Invalid email or password.";

}