<?php
    session_start();

    include("php/connection.php");
    if(isset($_SESSION['username'])){
        header("Location: home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jolly+Lodger&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="img/CS.png">
    <link rel="stylesheet" href="css/index.css">
    <title>Cash Tool</title>
</head>
<body>

    <section class="page" id="login-page">
        <div id="container">
            <h1 id="header-text">LOGIN</h1>
            <form action="php/login.php" method="post"  id="form-container">
                <input id="login-input" type="text" name="username" placeholder="Username" required>
                <input type="password" id="login-input" name="password" placeholder="Password" required>
                <a id="fpass-link">Forget password?</a>
                <button id="button-submit" type="submit" name = "submit" value="Login">LOGIN</button>
            </form>
            <p id="register-btn">Don't have an account? <a href="signup.php" id="register-link">Register here</a></p>
        </div>
    </section>

    <section class="page" id="fpass" style="display: none;">
        <div id="container">
            <h1 id="header-text">Forgetful?</h1>
            <form action="php/fpass.php" method="post" id="form-container">
                <input type="text" id="login-input" name="username" placeholder="Username">
                <input type="password" id="login-input" name="npassword" placeholder="New Password">
                <input type="password" id="login-input" name="cpassword" placeholder="Confirm Password">
                <button id="button-submit" name="submit" type="submit" value="changepass">CONFIRM</button>
            </form>
            <p id="login-btn">Remembered your password? <a id="login-link">Login here</a></p>
        </div>
    </section>
    
    <script src="js/login.js"></script>
</body>
</html>
