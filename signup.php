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
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <title>Cash Tool</title>
</head>
<body>
    <section class="page" id="signup-page">
        <div id="container">
            <h1 id="header-text">REGISTER</h1>
            <?php
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\SMTP;
                use PHPMailer\PHPMailer\Exception;

                require 'vendor/autoload.php';
                session_start();

                include('php/connection.php');
                if(isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $cpassword = $_POST['cpassword'];

                    $_SESSION['email'] = $email;

                    $verify_query = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email' ");

                    if(mysqli_num_rows($verify_query) != 0){
                        echo "
                            <div class='message'>
                                <h3>This email is already used :(</h3>
                            </div>
                        ";
                        echo "
                            <a href='javascript:self.history.back()'><button id='button-submit'>GO BACK</button></a>
                        ";
                    }else {
                        $mail = new PHPMailer(true);

                        try{
                            $mail->SMTPDebug = 0;
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'wewmaaga@gmail.com';
                            $mail->Password = 'abefwgeiztjjxqwh';
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port =   587;
                            $mail->setFrom('wewmaaga@gmail.com', 'CashTool.com');
                            $mail->addAddress($email, $username);
                            $mail->isHTML(true);

                            $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

                            $mail->Subject = 'Email Verification';
                            $mail->Body = '<p>Dear User, <br>Please verify your email: <b style = "font-size: 20px;">' . $verification_code . '</b></p>';
                            $mail->send();

                            if($password == $cpassword){
                                $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
                                mysqli_query($conn, "INSERT INTO users(username, email, password, verification_code, role) VALUES('$username','$email','$encrypted_password', '$verification_code', 'user') ") or die('ERROR OCCURED');
    
                                echo "
                                    <div class='message'>
                                        <h3>Account Created! <br>Please verify your email address</h3>
                                    </div>
                                ";
                                echo "
                                    <a href='php/email-verification.php'><button id='button-submit'>Verify Email</button></a>
                                ";
                            }else {
                                echo "
                                    <div class='message'>
                                        <h3>Password do not match</h3>
                                    </div>
                                    <a href='javascript:self.history.back()'><button id='button-submit'>BACK</button></a>
                                    ";
                            }
                        }catch (Exception $e){
                            echo "Message could not be sent. Mailer Error : {$mail->ErrorInfo}";
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
