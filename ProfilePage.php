<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: LoginPage.php");
    exit();
}

include "db.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile - VOID STATE</title>

<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">
<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/void stare logo favicon.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/void stare logo favicon.png">
</head>

<body>
<section class="profile-page">

    <div class="profile-card">

        <!-- PROFILE IMAGE -->

<div class="profile-image-wrapper">

<form
action="UpdateProfile.php"
method="POST"
enctype="multipart/form-data"
id="avatarForm">

<?php if(!empty($user['profile_image'])): ?>

<img
src="<?php echo $user['profile_image']; ?>"
class="profile-image">

<?php else: ?>

<img
src="images/default-user.png"
class="profile-image">

<?php endif; ?>

<input
type="file"
name="profile_image"
id="profileUpload"
accept="image/*"
hidden
onchange="document.getElementById('avatarForm').submit();">

<button
type="button"
class="edit-avatar-btn"
onclick="document.getElementById('profileUpload').click();">

✎

</button>

</form>

</div>

<a href="index.php" class="back-btn">
⬅
</a>
        <!-- USER INFO -->

        <h1>
            <?php echo $user['username']; ?>
        </h1>

        <p class="profile-email">
            <?php echo $user['email']; ?>
        </p>

        <div class="profile-info">

            <div class="info-box">
                <h3>Full Name</h3>

                <p>
                   <?php echo $user['full_name'] ?? 'Not Set'; ?>
                </p>
            </div>

            <div class="info-box">
                <h3>Phone</h3>

                <p>
                    <?php echo $user['phone'] ?? 'Not Set'; ?>
                </p>
            </div>

            <div class="info-box">
                <h3>Address</h3>

                <p>
                    <?php echo $user['address'] ?? 'Not Set';  ?>
                </p>
            </div>

            <div class="info-box">
                <h3>Role</h3>

                <p>
                    <?php echo $user['role']; ?>
                </p>
            </div>

        </div>

        <!-- BUTTONS -->

        <div class="profile-buttons">

            <a href="EditProfile.php" class="edit-profile-btn">
                Edit Profile
            </a>

            <a href="logout.php" class="logout-profile-btn">
                Logout
            </a>
             <a href="MyOrders.php" class="orders-btn">
                My Orders
            </a>
        </div>

    </div>

</section>

</body>
</html>