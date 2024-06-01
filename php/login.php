<?php
        session_start();

        include("connection.php");
        if(isset($_POST['submit'])){
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $sql = "SELECT * FROM users WHERE username = '$username' ";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) == 0){
                die("Account not found");
            }

            $user = mysqli_fetch_object($result);

            if(!password_verify($password, $user->password)){
                echo "
                    <script>
                    window.location.href = '../login.php'
                    alert('Incorrect credentials')
                    </script>
                ";
            }

            if(!isset($_SESSION['username'])){
                header("Location: ../home.php");
            }

        }
    ?>