<?php
    include 'connection.php';

    if(isset($_POST['submit-btn'])){
        $filter_name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $name = mysqli_real_escape_string($conn,$filter_name);

        $filter_email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
        $email = mysqli_real_escape_string($conn,$filter_email);

        $filter_password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        $password = mysqli_real_escape_string($conn,md5($filter_password));

        $filter_cpassword = filter_var($_POST['cpassword'],FILTER_SANITIZE_STRING);
        $cpassword = mysqli_real_escape_string($conn,md5($filter_cpassword));

        $user = "user";
        $select_user=mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

        if(mysqli_num_rows($select_user) > 0){
            $message[] = 'user already exist';
        }
        else
        {
            if($password != $cpassword){
                $message[] = 'wrong password';
            }
            else{
                mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `password`,`user_type`) VALUES ('$name', '$email', '$password','$user')") or die('query failed');
                 $message[] = 'register successfully';
                header('location:login.php');
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <!---boxicons---->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>User Registration Page</title>
    </head>
    <body>
    <?php
            if(isset($message)){
                    foreach ($message as $message) {
                        echo'
                        <div class ="message">
                        <span>'.$message.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>
                    ';
                }
            }
        ?>
        <section class="form-container">
        <form action ='' method="post" style="width:30vw;">
                <h3>Register Now</h3>
                <input type="text" name="name" placeholder="Enter your name" required>
                <input type="email" name="email" placeholder="Enter your email" required>
                <input type="password" name="password" placeholder="Enter your password" required>
                <input type="password" name="cpassword" placeholder="Confirm your password" required>
                <input type="submit" name="submit-btn" value="register now" class="btn">
                <P>Already have an account ?<a href="login.php">Login now</a></P>
            </form>
         </section>
    </body>
</html>