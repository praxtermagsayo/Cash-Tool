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
    <link rel="icon" href="../img/CS.png">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <title>Cash Tool - Email Verification</title>
</head>
<body>
    <section class="page">
        <div id="container">
            <h1>Verify your email</h1>

            <?php
                session_start();
                include ('connection.php');

                if(isset($_POST['submit'])){
                    $verification_code = $_POST['code'];
                    $email = $_SESSION['email'];
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($conn, $sql);
                    $user = mysqli_fetch_object($result);

                    if($verification_code == $user->verification_code){
                        $sql = "UPDATE users SET verification_status = '1' WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        echo "<h1>Email verified!</h1>";
                        echo "<a href = '../login.php'><button id='button-submit'>PROCEED</button></a>";
                    }else {
                        echo "<h1>ERROR</h1>";
                    }
                    
                }else {
            ?>

            <p><?php echo "Verification code has been sent to <b>" . $_SESSION['email'] . "</b>"; ?></p>
            <form id="verify-form" action="" method="post">
                <div class="code-input">
                    <input type="text" name="code">
                </div>
                <button id="button-submit" type="submit" value="verify" name="submit">SUBMIT</button>
            </form>
        </div>
    </section>
    <?php } ?>
</body>
</html>