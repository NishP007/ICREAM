<?php
    include 'connection.php';
    session_start();

    $user_id= $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }
// SEND MESSAGE
if(isset($_POST['submit-btn'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $number = mysqli_real_escape_string($conn,$_POST['number']);
    $message = mysqli_real_escape_string($conn,$_POST['message']);

    $select_message =mysqli_query($conn,"SELECT * FROM `message` WHERE name='$name' AND email='$email' AND number='$number' AND message='$message'") or die('query failed');
    if(mysqli_num_rows($select_message) >0){
        echo 'message already send';
    }
    else{
        mysqli_query($conn,"INSERT INTO `message`(`user_id`,`name`,`email`,`number`,`message`) VALUES ('$user_id','$name','$email','$number','$message')") or die('query failed');
    }
}

?>

<style type="text/css">
    <?php include 'main.css'; ?>
    </style>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <title>Icream</title>
    </head>
    <body>
    <?php include 'header.php'; ?>
   <div class="banner">
        <h1>"Contact Us"</h1>
   </div>
    <div class="help">
        <h1 class="title">Need Help</h1>
        <div class="box-container">
            <div class="box">
                <div>
                <i class="bi bi-geo-alt "></i>
                    <h2>Address</h2>   
                </div>
                <p>PlotNo.1 A Building B Street Mumabi 111000</p>
            </div>

            <div class="box">
                <div>
                <i class="bi bi-door-open"></i>
                    <h2>Opening</h2>   
                </div>
                <p>We Are Open From 10:00 Am To 11:00 Pm</p>
            </div>

            <div class="box">
                <div>
                <i class="bi bi-telephone"></i>
                    <h2>Our Contact</h2>   
                </div>
                <p>1112333232 / 2148378348 / 1318423889</p>
            </div>

            <div class="box">
                <div>
                <i class="bi bi-cart3"></i>
                    <h2>Special Offer</h2>   
                </div>
                <p>Exclusive 15% OFF On All Products & Extra 5% on Other*</p>
            </div>
        </div>
    </div>
    <div class="formm-container">
        <div class="form-section">
            <form method="post">
                <h1>Send Us Your Question!!</h1>
                <p>We'll Get Back To You Within 1 Or 2 Days.</p>
                <div class="input-field">
                <label>Your Name</label>
                <input type="text" name="name"></input>
                </div>

                <div class="input-field">
                <label>Your Email</label>
                <input type="text" name="email"></input>
                </div>

                <div class="input-field">
                <label>Your Number</label>
                <input type="text" name="number"></input>
                </div>

                <div class="input-field">
                <label>Message</label>
                <textarea name="message"></textarea>
                </div>
                <input type="submit" name="submit-btn" class="btn" value="Send message">   
            </form>
        </div>
    </div>
    <?php include 'footer.php';?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>