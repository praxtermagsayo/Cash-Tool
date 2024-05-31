<?php
        session_start();

        include("connection.php");
        if(isset($_POST['submit'])){
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password' ") or die("Select Error");
            $row = mysqli_fetch_assoc($result);

            if(is_array($row) && !empty($row)){
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['user_id'] = $row['user_id'];
            } else {
                echo '<script>
                    window.location.href = "../login.php"
                    alert("Login failed. Invalid username or password!")
                    </script>
                    ';
            }
            if(isset($_SESSION['username'])){
                header("Location: ../home.php");
            } else{
                echo "  <script>
                            window.location.href = '../login.php'
                            alert('Login failed. Invalid username or password!')
                        </script>
                    ";
            }
        }

    ?>