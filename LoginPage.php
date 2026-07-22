<!DOCTYPE html>
<html>
<head>
<title>Login</title>



<link rel="stylesheet" href="webproject.css">
<link rel="stylesheet" href="mobile.css">
  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="images/void stare logo favicon.png">
<link rel="icon" type="image/png" sizes="16x16" href="images/void stare logo favicon.png">
</head>

<script>

function togglePassword(){

    let password =
    document.getElementById("loginPassword");

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

    <!-- ================= LOADER ================= -->

<div class="loader-wrapper" id="loader">

    <div class="loader-logo">

        <!-- ROTATING RING -->
        <img src="images/ring.png" class="loader-ring">

        <!-- CENTER LOGO -->
        <img src="images/void-monogram.png" class="loader-center">

    </div>

</div>

<div class="login-container">
    <div class="login-box">
        <h2>Login</h2>

<form id="loginForm">

<div
id="loginError"
class="form-error"
style="display:none;">
</div>

<input
type="email"
name="email"
placeholder="Email"
required>

<div class="password-wrapper">

<input
type="password"
name="password"
id="loginPassword"
placeholder="Password"
required>

<span
class="toggle-password"
onclick="togglePassword()">
Show
</span>

</div>

<button type="submit">
LOGIN
</button>

</form>

        <div class="extra-links">
            <p>Don't have an account? <a href="SignupPage.php">Sign up</a></p>
        </div>
    </div>
</div>
<script>

document.getElementById("loginForm").addEventListener("submit", function(e){

    e.preventDefault();

    let formData = new FormData(this);

    fetch("login.php",{

        method:"POST",

        body:formData

    })

    .then(response=>response.text())

    .then(data=>{

        if(data.trim() === "success"){

            window.location="index.php";

        }else{

           let errorBox = document.getElementById("loginError");

if(data === "success"){

    window.location = "index.php";

}else{

    errorBox.style.display = "block";
    errorBox.innerHTML = data;

}

        }

    });

});
</script>
<script src="webproject.js"></script>
</body>
</html>