
<?php

include "db.php";

$id = intval($_GET['id']);

$sql = "SELECT * FROM products WHERE id=$id";

$result = mysqli_query($conn, $sql);

$product = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<?php
session_start();
?>

<?php

include "db.php";

$user = null;

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE id='$user_id'"
    );

    $user = mysqli_fetch_assoc($result);
}
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Product</title>

<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">
  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/void stare logo favicon.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/void stare logo favicon.png">
</head>

<body>




    <!-- ================= LOADER ================= -->

<div class="loader-wrapper" id="loader">

    <div class="loader-logo">

        <!-- ROTATING RING -->
        <img src="images/ring.png" class="loader-ring">

        <!-- CENTER LOGO -->
        <img src="images/void-monogram.png" class="loader-center">

    </div>

</div>
 <!-- ================= NAVBAR ================= -->
   <header class="navbar">

    <!-- LOGO -->
    <a href="index.php" class="logo">
        <img src="images/void stare logo navbar.png" alt="VOID STATE Logo">
    </a>

    <!-- BURGER BUTTON -->
    <button class="burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- NAV LINKS -->
    <nav class="nav-links" id="navLinks">

        <a href="index.php" class="active">Home</a>

<div class="dropdown">

    <button class="dropdown-toggle">
        Collections <span class="arrow">›</span>
    </button>
            <div class="dropdown-menu">
                <a href="ShopPage.php?type=new">New Drops</a>
                <a href="ShopPage.php?type=men">Men</a>
                <a href="ShopPage.php?type=women">Women</a>
                <a href="ShopPage.php?type=unisex">Unisex</a>
                <a href="ShopPage.php?type=sale">Sale</a>
            </div>

</div>

        <a href="ShopPage.php">Shop</a>
        <a href="AboutPage.php">About</a>
        <a href="ContactPage.php">Contact</a>

    </nav>

    <!-- RIGHT SIDE ICONS -->
    <div class="nav-icons">

        <!-- SEARCH ICON -->
        <button class="icon-btn search-btn" id="searchToggle">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="23"
                 height="23"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2.5"
                 viewBox="0 0 24 24">

                <circle cx="11" cy="11" r="8"></circle>

                <line x1="21"
                      y1="21"
                      x2="16.65"
                      y2="16.65">
                </line>

            </svg>

        </button>

        <!-- SEARCH BOX -->
        <div class="search-box" id="searchBox">

            <input type="text"
                   id="searchInput"
                   placeholder="Search products...">

        </div>

  <!-- USER / PROFILE -->

<?php if(isset($_SESSION['user_id'])): ?>

<a href="ProfilePage.php" class="profile-nav-link">

<img
src="<?php echo !empty($user['profile_image']) ? $user['profile_image'] : 'images/default-user.png'; ?>"
class="navbar-avatar"
alt="Profile">

</a>

<?php else: ?>

<a href="LoginPage.php" class="icon-btn user-btn">

<svg xmlns="http://www.w3.org/2000/svg"
     width="23"
     height="23"
     fill="none"
     stroke="currentColor"
     stroke-width="2"
     viewBox="0 0 24 24">

    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
    <circle cx="12" cy="7" r="4"></circle>

</svg>

</a>

<?php endif; ?>

        <!-- CART -->
        <a href="CartPage.php" class="icon-btn cart-btn">

            <svg xmlns="http://www.w3.org/2000/svg"
                 width="23"
                 height="23"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 viewBox="0 0 24 24">

                <path d="M6 2L3 7v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V7l-3-5z"></path>

                <path d="M3 7h18"></path>

                <path d="M16 11v6"></path>

                <path d="M8 11v6"></path>

            </svg>

        </a>

    </div>


</header>

<section class="product-page">

<!-- LEFT -->
<div class="product-gallery">

<img
src="<?php echo $product['image1']; ?>"
class="main-image"
id="mainImage"
>

<div class="thumbnail-row">

<img
src="<?php echo $product['image1']; ?>"
onclick="changeImage(this)"
>

<img
src="<?php echo $product['image2']; ?>"
onclick="changeImage(this)"
>

</div>

</div>

<!-- RIGHT -->
<div class="product-info">

<h1 id="productName">
<?php echo $product['name']; ?>
</h1>

<p class="product-price" id="productPrice">
Rs.<?php echo $product['price']; ?>
</p>

<p class="product-description">
<?php echo $product['description']; ?>
</p>

<div class="sizes">

<button type="button" onclick="selectSize('S')">S</button>

<button type="button" onclick="selectSize('M')">M</button>

<button type="button" onclick="selectSize('L')">L</button>

<button type="button" onclick="selectSize('XL')">XL</button>

</div>

<form action="AddToCart.php" method="POST">

<input
type="hidden"
name="product_id"
value="<?php echo $product['id']; ?>"
>

<input
type="hidden"
name="size"
id="selectedSize"
value="M"
>

<button
type="submit"
class="add-to-cart-btn">
Add To Cart
</button>

</form>

</div>

</section>
<script src="webproject.js"></script>
<?php

if(!$product){

echo "Product not found";
exit;

}

?>
<script>
    function changeImage(img) {

document.getElementById("mainImage").src = img.src;

}
</script>
<script>

function selectSize(size){

document.getElementById("selectedSize").value = size;

}

</script>
</body>
</html>