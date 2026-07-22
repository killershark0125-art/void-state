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

<title>Search Results - VOID STATE</title>

<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">

<link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/void stare logo favicon.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/void stare logo favicon.png">

</head>

<body>

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

<?php

include "db.php";

$query = $_GET['q'] ?? '';

$sql = "SELECT * FROM products
WHERE
name LIKE '%$query%'
OR
category LIKE '%$query%'
OR
type LIKE '%$query%'";

$result = mysqli_query($conn, $sql);

?>

<!-- ================= SEARCH PAGE ================= -->

<section class="search-page">

    <!-- SEARCH BAR -->
    <div class="search-bar-page">

        <input 
            type="text"
            id="searchInputPage"
            placeholder="Search products..."
            value="<?php echo $query; ?>"
        >

        <button onclick="searchAgain()">
            Search
        </button>

    </div>

    <h2>Search Results</h2>

    <p id="searchQuery">
        Results for:
        "<?php echo $query; ?>"
    </p>

    <!-- PRODUCTS -->
    <div class="shop-grid">

<?php

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

<div class="product">

<a href="ProductPage.php?id=<?php echo $row['id']; ?>" class="product-link">

<div class="img-container">

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

<?php

    }

}else{

    echo "<p>No products found 😔</p>";

}

?>

    </div>

</section>

<!-- ================= SEARCH SCRIPT ================= -->

<script>

function searchAgain(){

    const query =
    document.getElementById("searchInputPage").value;

    if(query.trim() !== ""){

        window.location.href =
        `SearchPage.php?q=${encodeURIComponent(query)}`;

    }

}

</script>

<script src="webproject.js"></script>

</body>
</html>