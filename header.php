
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="main.css">
        <title></title>
    </head>
    <body>
        <header class="header">
            <div class="flex">
                <a href="index.php" class="logo">I-<span>Cream</span>
                <nav class="navbar">
                    <a href="index.php">HOME</a>
                    <a href="shop.php">SHOP</a>
                    <a href="order.php">ORDERS</a>
                    <a href="about.php">ABOUT-US</a>
                    <a href="contact.php">CONTACT</a>
                </nav>
            <div class="icons header-alignment">
                <i class="bi bi-list" id="menu-btn"></i>
                <?php
                    $select_wishlist = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE user_id='$user_id'") or die('query failed');
                    $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                ?>
                <a href="wishlist.php"><i class="bi bi-heart"><span>(<?php echo $wishlist_num_rows;?>)</span></i></a>

                <?php
                    $select_cart = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
                    $cart_num_rows = mysqli_num_rows($select_cart);
                ?>
                <a href="cart.php"><i class="bi bi-cart"><span>(<?php echo $cart_num_rows;?>)</span></i></a>

                <i class="bi bi-person" id="user-btn"></i>
            
            <div class="user-box"  style="right:-2%;top:69.5px">
                <p>username :<span> <?php echo $_SESSION ['user_name'] ?></span></p>
                <p>email :<span> <?php echo $_SESSION ['user_email'] ?></span></p>
                <form method="post" class="logout">
                    <button name="logout" class="logout-btn">LOG OUT</button>
                </form>
            </div>
</div>
</div>
</header>
</body>
</html>