<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sign Up - VOID STATE</title>

<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">

</head>

<script>

function togglePassword(){

    let password =
    document.getElementById("SignupPassword");

    let toggle =
    document.querySelector(".toggle-password");

    if(password.type === "password"){

        password.type = "text";
        toggle.innerHTML = "Hide";

    }else{

        password.type = "password";
        toggle.innerHTML = "Show";

    }

}

</script>

<body>

<section class="signup-container">

    <div class="signup-box">

        <h2 class="glitch-title">JOIN VOID STATE</h2>
        <?php if(isset($_GET['error'])): ?>

<div class="form-error">

<?php

switch($_GET['error']){

case "invalidusername":
echo "Username must be 3-20 characters and contain only letters, numbers and underscores.";
break;

case "invalidemail":
echo "Please enter a valid email address.";
break;

case "weakpassword":
echo "Password must contain an uppercase letter, lowercase letter, number and be at least 8 characters long.";
break;

case "usernametaken":
echo "Username already exists.";
break;

case "emailtaken":
echo "Email already exists.";
break;

case "servererror":
echo "Something went wrong. Please try again.";
break;

}

?>

</div>

<?php endif; ?>

<div
id="signupError"
class="form-error"
style="display:none;">
</div>

        <form id="signupForm">

 <input
type="text"
name="username"
placeholder="Username"
minlength="3"
maxlength="20"
required>

<input
type="email"
name="email"
placeholder="Email"
required
pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
title="Enter a valid email address"
>

<div class="password-wrapper">

<input
type="password"
name="password"
id="SignupPassword"
placeholder="Password"
required>

<span class="toggle-password"
onclick="togglePassword()">
show
</span>

</div>
            <button type="submit">
                CREATE ACCOUNT
            </button>

        </form>

        <div class="extra-links">

            Already have an account?

            <a href="LoginPage.php">
                Login
            </a>

        </div>

    </div>

</section>

<script src="webproject.js"></script>

</body>
</html>