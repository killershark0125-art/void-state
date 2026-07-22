

<?php

include "db.php";

$newDrops = mysqli_query(

$conn,

"SELECT *

FROM products

ORDER BY created_at DESC

LIMIT 3"

);

$bestsellers = mysqli_query(

$conn,

"SELECT *

FROM products

ORDER BY sales_count DESC

LIMIT 6"

);

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
    <title>VOID STATE</title>
    <link rel="stylesheet" href="webproject.css">
    <link rel="stylesheet" href="mobile.css">
        <!-- Google Font -->
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

<?php if(
isset($_SESSION['role'])
&&
$_SESSION['role'] == 'admin'
): ?>

<a href="AdminPanel.php">Admin Panel</a>

<?php endif; ?>

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

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-content">
            <h1>VOID STATE</h1>
            <p>Somewhere between chaos and control, that’s where we exist.</p>
            <a href="ShopPage.php">
    <button class="shop-btn">Shop Now</button>
</a>
        </div>
    </section>

    <!-- NEW DROPS SECTION -->
<div class="products">

<?php while($product = mysqli_fetch_assoc($newDrops)): ?>

<a
href="ProductPage.php?id=<?php echo $product['id']; ?>"
class="product-link">

<div class="card">

<?php

$productAge =
(time() - strtotime($product['created_at'])) / 86400;

if($productAge <= 14):

?>

<div class="tag">
NEW
</div>

<?php endif; ?>

<div class="image-box">

<img
src="<?php echo $product['image1']; ?>"
alt="<?php echo $product['name']; ?>">

</div>

<h3>

<?php echo $product['name']; ?>

</h3>

<p>

<?php echo substr($product['description'],0,50); ?>...

</p>

<span>

Rs. <?php echo $product['price']; ?>

</span>

</div>

</a>

<?php endwhile; ?>

</div>

<!-- MOST WANTED SECTION -->
<section class="most-wanted">
    <h2>MOST WANTED</h2>
    
    <div class="products-grid">

<?php while($product = mysqli_fetch_assoc($bestsellers)): ?>

<div class="card">

<?php if($product['sales_count'] > 0): ?>

<div class="tag">
BEST SELLER
</div>

<?php endif; ?>

<a
href="ProductPage.php?id=<?php echo $product['id']; ?>"
class="product-link">

<div class="image-box">

<img
src="<?php echo $product['image1']; ?>"
alt="<?php echo $product['name']; ?>"
>

</div>

<h3>
<?php echo $product['name']; ?>
</h3>

<p>
<?php echo substr($product['description'],0,50); ?>...
</p>

<span>
Rs. <?php echo $product['price']; ?>
</span>

</a>

</div>

<?php endwhile; ?>

</div>

<!-- FEATURED COLLECTIONS SECTION -->
<section class="featured-collections">
    <div class="section-header">
        <h2>OUR WORLD</h2>
        <p class="subtext">Find your signature look from our main drops</p>
    </div>

    <div class="collections-grid">
        <!-- Collection 1 -->
        <div class="collection-card">
            <img src="images/teesbackground.jpg" alt="T-Shirts">
            <div class="overlay">
                <h3>T-SHIRTS &amp; TOPS</h3>
                <a href="ShopPage.php?category=shirt" class="explore-btn">
    Explore →
</a>
            </div>
        </div>

        <!-- Collection 2 -->
        <div class="collection-card">
            <img src="images/hoddiesbackground.jpg" alt="Hoodies">
            <div class="overlay">
                <h3>HOODIES &amp; SWEATSHIRTS</h3>
                <a href="ShopPage.php?category=hoodie" class="explore-btn">
    Explore →
</a>
            </div>
        </div>

        <!-- Collection 3 -->
        <div class="collection-card">
            <img src="images/pantsbackground.jpg" alt="Pants">
            <div class="overlay">
                <h3>PANTS &amp; BOTTOMS</h3>
                <a href="ShopPage.php?category=pants" class="explore-btn">
    Explore →
</a>
            </div>
        </div>

        <!-- Collection 4 -->
        <div class="collection-card">
            <img src="images/limitededition.jpg" alt="Limited">
            <div class="overlay">
                <h3>LIMITED EDITIONS</h3>
                <a href="ShopPage.php?category=jacket" class="explore-btn">
    Explore →
</a>
            </div>
        </div>
    </div>
</section>

<!-- OUR STORY SECTION -->
<section class="our-story">
    <div class="story-container">
        
        <!-- Text Side -->
        <div class="story-text">
            <h2>VOID STATE</h2>
            
            <p class="main-text">
                We exist somewhere between chaos and control.<br>
                Where darkness meets discipline.<br>
                Where raw expression finds its form.
            </p>
            
            <p class="sanctuary-text">
                VOID STATE is a sanctuary for those who refuse to be ordinary.
            </p>
            
            <a href="AboutPage.php" class="story-btn">Learn Our Story</a>
        </div>

        <!-- Image Side -->
        <div class="story-image">
            <img src="images/download (1).jpg" alt="Our Story">
        </div>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="contact">
    <div class="contact-container">
        <h2>GET IN TOUCH</h2>
        
        <form class="contact-form">
           <div class="form-group">
    <input type="text" required>
    <label>NAME</label>
</div>

<div class="form-group">
    <input type="email" required>
    <label>EMAIL</label>
</div>

<div class="form-group">
    <textarea required></textarea>
    <label>MESSAGE</label>
</div>
            
            <button type="submit" class="send-btn">SEND MESSAGE</button>
        </form>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-container">
        
        <!-- Left: Logo + Tagline -->
        <div class="footer-col">
            <a href="#" class="footer-logo">
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