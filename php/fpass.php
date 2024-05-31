<?php
    include("connection.php");

    if(isset($_POST['submit'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $npassword = mysqli_real_escape_string($conn, $_POST['npassword']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

        if($npassword == $cpassword){
            $result = mysqli_query($conn, "UPDATE users SET password = '$npassword' WHERE username = '$username' ") or die('Select Error');
            echo '
                <script>
                    window.location.href = "../login.php"
                    alert("Password Changed Successfully")
                </script>
            ';
        } else {
            echo '
                <script>
                    window.location.href = "../login.php"
                    alert("Password Do Not Match")  
                </script>
            ';
        }
        
    }
?>