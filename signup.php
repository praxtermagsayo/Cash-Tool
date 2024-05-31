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
    
    <section class="page" id="signup-page">
        <div id="container">
            <h1 id="header-text">REGISTER</h1>
            <form action="php/signup.php" method = "post" id="form-container">
                <input id="login-input" name = "username" type="text" placeholder="Username">
                <input type="password" name = "password" id="login-input" placeholder="Password">
                <input type="password" name = "cpassword" id="login-input" placeholder="Confirm Password">
                <button id="button-submit" name = "submit" value = "signup" type="submit">REGISTER</button>
            </form>
            <p id="login-btn">Already have an account? <a href="login.php" id="login-link">Login here</a></p>
        </div>
    </section>
</body>
</html>
