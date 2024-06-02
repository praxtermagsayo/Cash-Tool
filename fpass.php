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
    <section class="page">
        <div id="container">
            <h1 id="header-text">Forgetful?</h1>
            <?php
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\SMTP;
                use PHPMailer\PHPMailer\Exception;

                require 'vendor/autoload.php';
                session_start();

                include ("php/connection.php");
                if(isset($_POST['submit'])){
                    $email = mysqli_real_escape_string($conn, $_POST['email']);
                    $npass = mysqli_real_escape_string($conn, $_POST['npassword']);
                    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

                    if($npass == $cpass){
                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $_SESSION['password'] = $npass;
                        $_SESSION['email'] = $email;

                        if(mysqli_num_rows($result) != 0){
                            
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
                                $mail->setFrom('wewmaaga@gmail.com', 'CashTool');
                                $mail->addAddress($email, $username);
                                $mail->isHTML(true);

                                $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

                                $mail->Subject = 'Change Password Verification';
                                $mail->Body = '<p>Dear User, <br>To change your password, enter this code: <b style = "font-size: 20px;">' . $verification_code . '</b></p>';
                                $mail->send();

                                $sql = "UPDATE users SET verification_code = '$verification_code' WHERE email = '$email'";
                                $result = mysqli_query($conn, $sql);
                                echo "
                                    <script>
                                        window.location.href='php/fpass-verification.php'
                                    </script>
                                ";
                            }catch(Exception $e){
                                echo "Message could not be sent. Mailer Error : {$mail->ErrorInfo}";
                            }
                        } else {
                            echo "
                                <div class='message'>
                                    <h3>Account does not exist</h3>
                                </div>
                            ";
                            echo "
                                <a href = 'javascript:self.history.back()'><button id = 'button-submit'>BACK</button></a>
                            ";
                        }
                    }else{
                        echo "
                            <div class='message'>
                                <h3>Password do not match</h3>
                            </div>
                        ";
                        echo "
                            <a href = 'javascript:self.history.back()'><button id = 'button-submit'>BACK</button></a>
                        ";
                    }
                }else{
            ?>
            <form action="" method="post" id="form-container">
                <input type="email" id="login-input" name="email" placeholder="Email" required>
                <input type="password" id="login-input" name="npassword" placeholder="New Password" required>
                <input type="password" id="login-input" name="cpassword" placeholder="Confirm Password" required>
                <button id="button-submit" name="submit" type="submit" value="changepass">CONFIRM</button>
            </form>
            <p id="login-btn">Remembered your password? <a href="login.php" id="login-link">Login here</a></p>
        </div>
    </section>
    <?php } ?>
</body>
</html>