<?php

session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: LoginPage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($result);

$profile_image = $user['profile_image'] ?? '';

if(!empty($_FILES['profile_image']['name'])){

    $filename = time() . "_" . $_FILES['profile_image']['name'];

    $target = "uploads/profile/" . $filename;

    move_uploaded_file(
        $_FILES['profile_image']['tmp_name'],
        $target
    );

    $profile_image = $target;
}

if(
isset($_POST['updateProfile'])
||
!empty($_FILES['profile_image']['name'])
){

$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($result);

$full_name = $_POST['full_name'] ?? $user['full_name'];
$email      = $_POST['email'] ?? $user['email'];
$phone      = $_POST['phone'] ?? $user['phone'];
$address    = $_POST['address'] ?? $user['address'];

    $sql = "UPDATE users SET

full_name='$full_name',
email='$email',
phone='$phone',
address='$address',
profile_image='$profile_image'

WHERE id='$user_id'";

    if(mysqli_query($conn, $sql)){

        $_SESSION['email'] = $email;

header("Location: ProfilePage.php", true, 303);
exit();

    }else{

        echo "Failed to update profile";

    }

}else{

    header("Location: ProfilePage.php");
    exit();

}

?>