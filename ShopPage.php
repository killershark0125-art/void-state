<!DOCTYPE html>

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
<title>Shop - VOID STATE</title>

<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
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
        <img src="images/void stare logo navbar.png" alt="Urban Wear Logo">
    </a>

    <!-- BURGER BUTTON -->
    <button class="burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- NAV LINKS -->
    <nav class="nav-links" id="navLinks">

        <a href="index.php">Home</a>

        <!-- DROPDOWN -->
        <div class="dropdown">

            <a href="#">
                Collections <span class="arrow">›</span>
            </a>

            <div class="dropdown-menu">
                <a href="ShopPage.php?type=new">New Drops</a>
                <a href="ShopPage.php?type=men">Men</a>
                <a href="ShopPage.php?type=women">Women</a>
                <a href="ShopPage.php?type=unisex">Unisex</a>
                <a href="ShopPage.php?type=sale">Sale</a>
            </div>

        </div>

        <a href="ShopPage.php" class="active">Shop</a>
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

<!-- SHOP -->
<section class="shop-page">

    <!-- TOP BAR -->
    <div class="shop-topbar">
        <div class="filters">
            <select id="filterCategory">
                <option value="all">All</option>
                <option value="jacket">Jacket</option>
                <option value="hoodie">Hoodies</option>
                <option value="shirt">Shirts</option>
                <option value="pants">Pants</option>
            </select>

            <select id="filterPrice">
                <option value="all">All Prices</option>
                <option value="low">Below 2000</option>
                <option value="mid">2000-4000</option>
                <option value="high">4000+</option>
            </select>
        </div>

        <h2>SHOP</h2>

        <div class="sort">
            <select id="sortPrice">
                <option value="default">Sort</option>
                <option value="low">Low → High</option>
                <option value="high">High → Low</option>
            </select>
        </div>
    </div>

    <!-- PRODUCTS -->
   <div class="shop-grid" id="productGrid">

 <?php

include "db.php";

/* Default */

$sql = "SELECT * FROM products";

/* Collection Filters */

if(isset($_GET['type'])){

$type = $_GET['type'];

switch($type){

case "new":

$sql = "

SELECT *

FROM products

WHERE created_at >= DATE_SUB(NOW(), INTERVAL 14 DAY)

ORDER BY created_at DESC

";

break;

case "men":

$sql = "

SELECT *

FROM products

WHERE LOWER(type)='men'

";

break;

case "women":

$sql = "

SELECT *

FROM products

WHERE LOWER(type)='women'

";

break;

case "unisex":

$sql = "

SELECT *

FROM products

WHERE LOWER(type)='unisex'

";

break;

case "sale":

$sql = "

SELECT *

FROM products

WHERE LOWER(type)='sale'

";

break;

}

}

$result = mysqli_query($conn,$sql);


while($row = mysqli_fetch_assoc($result)) {

?>

<div 
class="product"

data-price="<?php echo $row['price']; ?>"

data-category="<?php echo strtolower($row['category']); ?>"

data-type="<?php echo strtolower($row['type']); ?>"
>

<a href="ProductPage.php?id=<?php echo $row['id']; ?>" class="product-link">

<div class="img-container">

<?php

$productAge =
(time() - strtotime($row['created_at'])) / 86400;

if($productAge <= 14){

?>

<div class="tag">

NEW

</div>

<?php } ?>

<img
src="<?php echo $row['image1']; ?>"
class="front"
>

<img
src="<?php echo $row['image2']; ?>"
class="back"
>

</div>

<h4>
<?php echo $row['name']; ?>
</h4>

<p>
Rs.<?php echo $row['price']; ?>
</p>

</a>

</div>

<?php } ?>
</div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-container">
        
        <!-- Left: Logo + Tagline -->
        <div class="footer-col">
            <a href="index.php" class="footer-logo">
    <img src="images/void stare logo navbar.png" alt="Void State Logo">
</a>
            <p class="tagline">Somewhere between chaos and control.</p>
        </div>

        <!-- Middle: Quick Links -->
        <div class="footer-col">
            <h4>SHOP</h4>
            <ul>
            <li><a href="ShopPage.php">New Drops</a></li>
            <li><a href="ShopPage.php">Most Wanted</a></li>
            <li><a href="ShopPage.php">Collections</a></li>
            <li><a href="ShopPage.php">All Products</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>EXPLORE</h4>
            <ul>
                <li><a href="AboutPage.php">Our Story</a></li>
                <li><a href="ShopPage.php">Shop</a></li>
            </ul>
        </div>

        <!-- Right: Contact + Social -->
        <div class="footer-col">
            <h4>CONTACT</h4>
            <ul>
                <li><a href="#">Email Us</a></li>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">TikTok</a></li>
            </ul>
            
            <div class="social-icons">
                <a href="#">IG</a>
                <a href="#">TT</a>
                <a href="#">X</a>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom">
        <p>&copy; 2026 VOID STATE. All Rights Reserved.</p>
        <div class="legal-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Shipping</a>
        </div>
    </div>
</footer>

<script src="webproject.js"></script>
</body>
</html>