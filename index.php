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
    //ADDING PRODUCTS  to wishlist
    if(isset($_POST['add_to_wishlist'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $wishlist_number = mysqli_query($conn,"SELECT * FROM `wishlist` WHERE name='$product_name' AND user_id='$user_id'") or die('query failed');
        $cart_number = mysqli_query($conn,"SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'") or die('query failed');
        if(mysqli_num_rows($wishlist_number)>0){
            $message[]='product already exist in wishlist';
        }
        else if(mysqli_num_rows($cart_number)>0){
            $message[]='product already exist in cart';
        }
        else{
            mysqli_query($conn,"INSERT INTO `wishlist` (`user_id`,`pid`,`name`,`price`,`image`) VALUES ('$user_id','$product_id','$product_name','$product_price','$product_image')");
            $message[]='product successfully added in wishlist';
        }
    } 

    //ADDING PRODUCTS TO CART
    if(isset($_POST['add_to_cart'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity =$_POST['product_quantity'];
        $cart_number = mysqli_query($conn,"SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'") or die('query failed');
        if(mysqli_num_rows($cart_number)>0){
            $message[]='product already exist in cart';
        }
        else{
            mysqli_query($conn,"INSERT INTO `cart` (`user_id`,`pid`,`name`,`price`,`quantity`,`image`) VALUES ('$user_id','$product_id','$product_name','$product_price',' $product_quantity','$product_image')");
            $message[]='product successfully added in cart';
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
    <div class="slider-section">
        <div class="slide-show-container">
             <div class="wrapper-one">
                <div class="wrapper-text">My advice to you is not to inquire why or wither, but just enjoy your ice cream while its on your plate</div>
            </div>
        <div class="wrapper-two">
                <div class="wrapper-txt">"Indulge in Scoops of Happiness Discover Our Sweet Symphony of Flavors!"</div>
            </div>
        <div class="wrapper-three">
                <div class="wrapper-textt">"Never Settle For Just One Scoop!!"</div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card">
            <div class="detail">
                <span>15% OFF</span>
                <h1>ON ALL</h1>
                <h1>ICE-CREAM</h1>
                <a href="shop.php">shop now</a>
            </div>
        </div>
        <div class="card">
            <div class="detail">
                <span>Choose Your Toppings</span>
                <h1>Buy 1</h1>
                <h1>Get 1 Free</h1>
                <a href="shop.php">shop now</a>
            </div>
        </div>
        <div class="card">
            <div class="detail">
                <span>Extra 5% OFF</span>
                <h1>On Seasonal</h1>
                <h1>Fruits Ice-Cream</h1>
                <a href="shop.php">shop now</a>
            </div>
        </div>
</div>
        <div class="categories">
            <h1 class="title">TOP CATEGORIES</h1>
                <div class="box-container">
                    <div class="box">
                        <img src="image/fruit.jpg">
                        <span>FRUIT PULP</span>
                    </div>
                    <div class="box">
                        <img src="image/dryfruits.jpg">
                        <span>DRY FRUIT</span>
                    </div>
                    <div class="box">
                        <img src="image/cone.jpg">
                        <span>WAFFLE CONE</span>
                    </div>
                    <div class="box">
                        <img src="image/cup.jpg">
                        <span>CUP</span>
                    </div>
                    <div class="box">
                        <img src="image/toppings.jpg">
                        <span>TOPPINGS</span>
                    </div>
                </div>
        </div>
        <div class="banner3">
            <div class="detail">
                <span>BETTER THAN OTHERS!</span>
                <h1>NATURAL ICE-CREAM</h1>
                <p>Believe in us!!You will never get disappointed</p>
                <a href="shop.php">explore<i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
        <div class="shop">
            <h1 class="title">Shop best selling</h1>
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
        <div class="box-container">
            <?php
                $select_products =mysqli_query($conn,"SELECT * FROM `products` LIMIT 4") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products=mysqli_fetch_assoc($select_products)){
                ?>
                <form action="" method="post" class="box">
                    <img src="image/<?php echo $fetch_products['image'];?>">
                    <div class="price">₹<?php echo $fetch_products['price'];?>/-</div>
                    <div class="name"><?php echo $fetch_products['name'];?></div>
                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id'];?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'];?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price'];?>">
                    <input type="hidden" name="product_quantity" value="1" min="0">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">
                    <div class="icon">
                        <a href="view_page.php?pid=<?php echo $fetch_products['id'];?>" class="bi bi-eye-fill"></a>
                        <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                        <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
                    </div>
                </form>
            <?php
                    }
                }else{
                        echo '<p class="empty">No Products Added Yet!!</p>';
                }
            ?>
        </div>
        <div class="more">
        <a href="shop.php">Load More</a>    
        <i class="bi bi-arrow-down"></i>
        </div>
        </div>
    <?php include 'footer.php';?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>