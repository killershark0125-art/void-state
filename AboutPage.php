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
<title>About - VOID STATE</title>

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

        <a href="ShopPage.php">Shop</a>
        <a href="AboutPage.php" class="active">About</a>
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


<!-- HERO -->
<section class="about-hero">
    <h1>VOID STATE</h1>
    <p>Somewhere between chaos and control.</p>
</section>

<!-- STORY -->
<section class="about-section">
    <div class="about-container">

        <div class="about-text">
            <h2>OUR STORY</h2>
            <p>
                VOID STATE was never meant to follow trends.  
                It was built for those who exist outside the ordinary.
            </p>

            <p>
                Inspired by chaos, darkness, and raw expression,  
                every piece reflects individuality and controlled rebellion.
            </p>

            <p>
                This isn’t just clothing.  
                It’s identity. It’s presence. It’s energy.
            </p>
        </div>

        <div class="about-image">
            <img src="images/download (1).jpg" alt="Brand Image">
        </div>

    </div>
</section>

<!-- PHILOSOPHY -->
<section class="about-section dark">
    <div class="about-container reverse">

        <div class="about-text">
            <h2>OUR PHILOSOPHY</h2>
            <p>
                We design for those who don’t need validation.  
                For those who move different.
            </p>

            <p>
                Minimal but loud.  
                Dark but expressive.  
                Simple but unforgettable.
            </p>

            <p>
                VOID STATE isn’t worn.  
                It’s felt.
            </p>
        </div>

        <div class="about-image">
            <img src="images/bjstory.jpg">
        </div>

    </div>
</section>

<!-- CTA -->
<section class="about-cta">
    <h2>ENTER THE VOID</h2>
    <a href="ShopPage.php" class="shop-btn">EXPLORE COLLECTION</a>
</section>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-col">
            <img src="images/void stare logo navbar.png">
            <p>Somewhere between chaos and control.</p>
        </div>

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
                <li><a href="ContactPage.php">Contact</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>CONTACT</h4>
            <ul>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">Email</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 VOID STATE</p>
    </div>
</footer>

<script src="webproject.js"></script>
</body>
</html>