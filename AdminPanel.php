<?php
session_start();

if(
!isset($_SESSION['role'])
||
$_SESSION['role'] != 'admin'
){
    header("Location: index.php");
    exit();
}

include "db.php";

/* ================= ADD PRODUCT ================= */

if(isset($_POST['addProduct'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $type = $_POST['type'];
    $description = $_POST['description'];

    // IMAGE 1
    $image1 = "uploads/" . $_FILES['image1']['name'];
    move_uploaded_file($_FILES['image1']['tmp_name'], $image1);

    // IMAGE 2
    $image2 = "uploads/" . $_FILES['image2']['name'];
    move_uploaded_file($_FILES['image2']['tmp_name'], $image2);

    $sql = "INSERT INTO products
    (name, price, category, type, image1, image2, description)

    VALUES

    ('$name','$price','$category','$type','$image1','$image2','$description')";

    mysqli_query($conn, $sql);

    header("Location: AdminPanel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Panel</title>
 <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/void stare logo favicon.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/void stare logo favicon.png">
<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">
</head>
<body>

<section class="admin-panel">

<h1>VOID STATE ADMIN PANEL</h1>

<!-- ================= ADD PRODUCT FORM ================= -->

<form
class="admin-form"
method="POST"
enctype="multipart/form-data"
>

<input
type="text"
name="name"
placeholder="Product Name"
required
>

<input
type="number"
name="price"
placeholder="Price"
required
>

<select name="category" required>

<option value="">Select Category</option>

<option value="shirt">Shirt</option>
<option value="hoodie">Hoodie</option>
<option value="pants">Pants</option>
<option value="jacket">Jacket</option>

</select>

<select name="type" required>

<option value="">Select Type</option>

<option value="men">Men</option>
<option value="women">Women</option>
<option value="unisex">Unisex</option>

</select>

<textarea
name="description"
placeholder="Description"
required
></textarea>

<input
type="file"
name="image1"
required
>

<input
type="file"
name="image2"
required
>

<button type="submit" name="addProduct">
ADD PRODUCT
</button>

</form>

<!-- ================= SHOW PRODUCTS ================= -->

<div class="admin-products">

<?php

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");

while($row = mysqli_fetch_assoc($result)){

?>

<div class="admin-card">

<img src="<?php echo $row['image1']; ?>">

<h3>
<?php echo $row['name']; ?>
</h3>

<p>
Rs.<?php echo $row['price']; ?>
</p>

<p>
<?php echo $row['category']; ?>
</p>

<a
href="deleteProduct.php?id=<?php echo $row['id']; ?>"
class="delete-btn"
>
Delete
</a>

</div>

<?php } ?>

</div>
<a href="AdminOrders.php" class="admin-btn">
Manage Orders
</a>
</section>

<a href="logout.php" class="logout-btn">
Logout
</a>

</body>
</html>