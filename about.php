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
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <title>Icream</title>
    </head>
    <body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <h1>"About-Us"</h1>
        <p></p>
</div>
        <div class="about">
            <div class="row">
            <div class="detail">
                <h1>Visit our Icream Shop</h1>
                <p>Welcome to Icream, where we believe in crafting moments of pure delight through the magic of ice cream.
                At Icream, we are passionate about creating unforgettable experiences for our customers, one scoop at a time.
                 Our journey began with a simple dream to share our love for ice cream with the world. From that dream, 
                 we've built a haven where families, friends, and ice cream enthusiasts alike can indulge in the finest, 
                 handcrafted flavors that tantalize the taste buds and warm the soul.</p>
                 <!-- <a href="shop.php" class="btn2">Shop Now</a> -->
            </div>
            <div class="img-box">
                <img src="image/shop.jpg">
            </div>
        </div>
   </div>
   <div class="banner-2">
    <h1>"Celebrate life's sweetness with a scoop of happiness."</h1>
    <a href="shop.php" class="btn2">Shop Now</a>
</div>
<div class="services">
    <h1 class="title">Our Services</h1>
    <div class="box-container">
    <div class="box">
        <i class="bi bi-percent"></i>
        <h3>15% OFF+Free Shipping</h3>
        <p>Starting at ₹119/month .Plus,get ₹500 credit 1 year on regular order</p>
        </div>

        <div class="box">
        <i class='bx bx-popsicle'></i>
        <h3>Natural Ice-cream</h3>
        <p>Exclusive Quality Ice Cream</p>
        </div>

        <div class="box">
        <i class='bx bx-bell'></i>
        <h3>Notification</h3>
        <p>Get all Notification about our new products</p>
        </div>

        

    </div>
</div>
    <?php include 'footer.php';?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>