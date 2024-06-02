<?php
    session_start();

    include("php/connection.php");
    if(!isset($_SESSION['username'])){
        header("Location: index.html");
    }
    else {
        $id = $_SESSION['user_id'];
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$id'");
        if(mysqli_num_rows($sql) == 0){
            header("Location: index.html");
        }else{
            $user = mysqli_fetch_object($sql);
            if($user->verification_status != 0){
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_id = '$id'");
                while($result = mysqli_fetch_assoc($sql)){
                    $c_username =  $result['username'];
                    $_SESSION['password'] = str_repeat('*', strlen($_SESSION['password']));
                    $c_password = $_SESSION['password'];
                    $c_email = $result['email'];
                }
            }else{
                session_destroy();
                header("Location: index.html");
            }
        }
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="icon" href="img/CS.png">
    <link rel="stylesheet" href="css/home.css?v=<?php echo time(); ?>">
    <title>Cash Tool - Home</title>
</head>
<body>
    
    <div class="container">
        <aside>
            <div class="toggle">
                <div class="logo">
                    <span id="logo">Cash<span id="logo2">Tool</span></span>
                </div>
                <div class="close">
                    <span class="material-symbols-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a id="dashboard" href="#">
                    <span class="material-symbols-sharp">
                        dashboard
                    </span>
                    <h3>Dashboard</h3>
                </a>
                <a id="user-profile" href="#" class="active">
                    <span class="material-symbols-sharp">
                        person
                    </span>
                    <h3>User Profile</h3>
                </a>
                <a id="settings" href="#">
                    <span class="material-symbols-sharp">
                        settings
                    </span>
                    <h3>Settings</h3>
                </a>
                <a href="php/logout.php">
                    <span class="material-symbols-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <main id="dashboardPage" style="display: none;">
            <h1>Dashboard</h1>
            <div class="money">
                <h2>Current Money: <span id="money"></span></h2>

                <h2>Current Month: <span id="Month"></span></h2>
            </div>
        </main>

        <main id="userPage">
            <h1>User Profile</h1>
            <div class="user-info card">
                <p>Username: <b><?php echo $c_username ?></b></p>
                <p>Email: <b><?php echo $c_email ?></b></p>
                <p>Password: <b><?php echo $c_password ?></b></p>
            </div>
        </main>

        <main id="settingsPage" style="display: none;">
            <h1>Settings</h1>
        </main>

    </div>
    

    <script src="js/home.js"></script>
</body>
</html>