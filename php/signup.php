<?php
    include("connection.php");

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

        if($password == $cpassword){
            $result = mysqli_query($conn, "INSERT INTO users VALUES(null, '$username', '$password')") or die("Select Error");
            echo '
                <script>
                    window.location.href = "../login.php"
                    alert("Account Created Successfully")
                </script>
            ';
        } else {
            echo '
                <script>
                    window.location.href = "../signup.php"
                    alert("Password Do Not Match")
                </script>
            ';
        }
        
    }
?>