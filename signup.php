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
            <?php
                session_start();

                include('php/connection.php');
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $cpassword = $_POST['cpassword'];

                    $verify_query = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email' ");

                    if(mysqli_num_rows($verify_query) != 0){
                        echo "
                            <div class='message'>
                                <h3>This email is already used</h3>
                            </div>
                        ";
                        echo "
                            <a href='javascript:self.history.back()'><button id='button-submit'>GO BACK</button></a>
                        ";
                    }else {
                        if($password == $cpassword){
                            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_query($conn, "INSERT INTO users(username, email, password) VALUES('$username','$email','$encrypted_password') ") or die('ERROR OCCURED');

                            echo "
                                <div class='message'>
                                    <p>Account Created!</p>
                                </div>
                            ";
                        }else {
                            echo "
                                <div class='message'>
                                    <p>Password do not match</p>
                                </div>
                                <a href='javascript:self.history.back()'></button id='button-submit'>BACK</button></a>
                                <script>
                                    alert('PASSWORD')
                                </script>
                                ";
                        }
                                
                    }

                } else{
            ?>
            <form action="" method = "post" id="form-container">
                <input id="login-input" name = "username" type="text" placeholder="Username">
                <input id="login-input" type="email" name="email" placeholder="Email" required>
                <input type="password" name = "password" id="login-input" placeholder="Password">
                <input type="password" name = "cpassword" id="login-input" placeholder="Confirm Password">
                <button id="button-submit" name = "submit" value = "signup" type="submit">REGISTER</button>
            </form>
            <p id="login-btn">Already have an account? <a href="login.php" id="login-link">Login here</a></p>
        </div>
    </section>
    <?php } ?>
</body>
</html>
