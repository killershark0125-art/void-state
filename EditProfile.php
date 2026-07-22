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

/* ================= UPDATE PROFILE ================= */

if(isset($_POST['updateProfile'])){

    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE users SET

    full_name='$full_name',
    email='$email',
    phone='$phone',
    address='$address'

    WHERE id='$user_id'";

 if(mysqli_query($conn, $sql)){

    $_SESSION['email'] = $email;

    $success = "Profile Updated Successfully";

}else{

    $error = "Something went wrong";

}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Edit Profile - VOID STATE</title>

<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/void stare logo favicon.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/void stare logo favicon.png">
</head>

<body>

<section class="edit-profile-page">

<div class="edit-profile-container">

<h1>Edit Profile</h1>

<?php if(isset($success)): ?>

<p class="success-msg">
    <?php echo $success; ?>
</p>

<?php endif; ?>

<?php if(isset($error)): ?>

<p class="error-msg">
    <?php echo $error; ?>
</p>

<?php endif; ?>

<form
action="UpdateProfile.php"
method="POST"
enctype="multipart/form-data"
class="edit-profile-form">

<div class="profile-image-upload">

    <img
    src="<?php echo $user['profile_image'] ?? 'images/default-avatar.png'; ?>"
    class="profile-preview">

    <input
    type="file"
    name="profile_image"
    accept="image/*">

</div>

<input
type="text"
name="full_name"
placeholder="Full Name"
value="<?php echo $user['full_name'] ?? ''; ?>"
required
>

<input
type="email"
name="email"
placeholder="Email"
value="<?php echo $user['email'] ?? ''; ?>"
required
>

<input
type="text"
name="phone"
placeholder="Phone"
value="<?php echo $user['phone'] ?? ''; ?>"
>

<textarea
name="address"
placeholder="Address"
rows="4"
><?php echo $user['address'] ?? ''; ?></textarea>

<button type="submit" name="updateProfile" class="save-profile-btn">
Save Changes
</button>

</form>

<a href="ProfilePage.php" class="back-btn">
Back To Profile
</a>

</div>

</section>

</body>
</html>