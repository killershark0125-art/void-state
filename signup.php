<?php

include "db.php";

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$plainPassword = $_POST['password'];

/* ================= USERNAME CHECK ================= */

if(!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)){
echo "Username must be 3-20 characters long.";
exit();
}

/* ================= EMAIL CHECK ================= */

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "Invalid email address.";
exit();
}

/* ================= PASSWORD CHECK ================= */

if(
    strlen($plainPassword) < 8 ||
    !preg_match('/[A-Z]/', $plainPassword) ||
    !preg_match('/[a-z]/', $plainPassword) ||
    !preg_match('/[0-9]/', $plainPassword)
){
echo "Password must contain uppercase, lowercase and a number.";
exit();
}

/* ================= CHECK USERNAME ================= */

$checkUsername =
mysqli_query(
    $conn,
    "SELECT id FROM users WHERE username='$username'"
);

if(mysqli_num_rows($checkUsername) > 0){
echo "Username already exists.";
exit();
}

/* ================= CHECK EMAIL ================= */

$checkEmail =
mysqli_query(
    $conn,
    "SELECT id FROM users WHERE email='$email'"
);

$allowedDomains = [
"gmail.com",
"outlook.com",
"hotmail.com",
"yahoo.com"
];

$domain = strtolower(substr(strrchr($email, "@"), 1));

if(!in_array($domain, $allowedDomains)){
echo "Email already exists.";
exit();
}


/* ================= HASH PASSWORD ================= */

$password =
password_hash(
    $plainPassword,
    PASSWORD_DEFAULT
);

/* ================= INSERT USER ================= */

$sql =
"INSERT INTO users
(username,email,password)

VALUES

('$username','$email','$password')";

if(mysqli_query($conn, $sql)){

    header("Location: LoginPage.php?success=accountcreated");
    exit();

}else{

echo "Something went wrong.";
exit();

}

?>
