<?php
    include 'connection.php';
    session_start();

    $admin_id= $_SESSION['admin_id'];
    if(!isset($admin_id)){
        header('location:login.php');
    }
    if(isset($_POST['logout'])){
        session_destroy();
        header('location: login.php');
    }
/*--------------Adding products to database--------------------- */
if(isset($_POST['add_product'])){
    // Sanitize input
    $product_name = mysqli_real_escape_string($conn, $_POST['name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['price']);
    $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
    
    // Handle image upload
    if(isset($_FILES['image'])){
        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_size = $image['size'];
        $image_folder = 'image/'.$image_name;

        // Validate image file
        if($image_size > 2000000) {
            $message[] = 'Product image is too large';
        } else {
            // Move uploaded image file to destination folder
            if(move_uploaded_file($image_tmp_name, $image_folder)) {
                // Check if product name already exists
                $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name='$product_name'");
                if(mysqli_num_rows($select_product_name) > 0){
                    $message[] = 'Product name already exists';
                } else {
                    // Insert new product into database
                    $insert_product = mysqli_query($conn, "INSERT INTO `products`(`name`, `price`, `product_detail`, `image`) VALUES ('$product_name', '$product_price', '$product_detail', '$image_name')");
                    if($insert_product){
                        $message[] = 'Product added successfully';
                    } else {
                        $message[] = 'Failed to add product';
                    }
                }
            } else {
                $message[] = 'Failed to upload image';
            }
        }
    } else {
        $message[] = 'Image not found';
    }
}

    //delete products from database
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $select_delete_image = mysqli_query($conn , "SELECT image FROM `products` WHERE id='$delete_id'") or die('query failed');
        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        unlink('image/'.$fetch_delete_image['image']);

        mysqli_query($conn,"DELETE FROM `products` WHERE id='$delete_id'") or die("query failed");
        mysqli_query($conn,"DELETE FROM `cart` WHERE pid='$delete_id'") or die("query failed");
        mysqli_query($conn,"DELETE FROM `wishlist` WHERE pid='$delete_id'") or die("query failed");

        header('location:admin_product.php');
    }

    // update product
    // if(isset($_POST['update_product'])){
    //     $update_id = $_POST['update_id'];
    //     $update_name = $_POST['update_name'];
    //     $update_price = $_POST['update_price'];
    //     $update_detail = $_POST['update_detail'];
    //     $update_image = $_FILES['update_image']['name'];
    //     $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    //     $update_image_folder = 'image/'.$update_image;

    //     $update_query = mysqli_query($conn,"UPDATE `products` SET `id`='$update_id',`name`='$update_name',`price`='$update_price',`product_detail`='$update_detail',`image`='$update_image' WHERE id='update_id'") or die('query failed');
    //     if($update_query){
    //         move_uploaded_file($update_image_tmp_name,$update_image_folder);
    //         header('location:admin_product.php');
    //     }
    // }

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <!---boxicons---->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Document</title>
    </head>
    <body>
    <?php include'admin_header.php';?>
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
    <section class="add-products">
        <form method="post" action="" enctype="multipart/form-data">
            <h1>Add New Product</h1>
            <div class="input-field">
                <label>product name</label>
                <input type="text" name="name" required>
        </div>

        <div class="input-field">
                <label>product price</label>
                <input type="text" name="price" required>
        </div>

        <div class="input-field">
                <label>product detail</label>
                <textarea name="detail" required></textarea>
        </div>

        <div class="input-field">
                <label>product image</label>
                <input type="file" name="image" accept="image/jpg,image/png,image/jpeg,image/webp" required>
        </div>

                <input type="submit" name="add_product" value="add product" class="btn">
        </form>
    </section>
    <!----------show products section-------------->
    <section class="show-products">
        <div class="box-container">
            <?php 
                $select_products = mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');
                if(mysqli_num_rows($select_products)>0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
            
            ?>
            <div class="box">
                <img src="image/<?php echo $fetch_products['image']; ?>">
                <p>price : ₹ <?php echo $fetch_products['price']; ?></p>
                <h3><?php echo $fetch_products['name']; ?></h3>
                <p class="detail"><?php echo $fetch_products['product_detail']; ?></p>
                <a href="update.php?edit=<?php echo $fetch_products['id'] ?>" class="edit">edit</a>
                <a href="admin_product.php?delete=<?php echo $fetch_products['id'] ?>" class="delete" onclick="return confirm('delete this product');">delete</a>
            </div>
            <?php            
                    }
                }else{
                    echo '
                    <div class="empty">
                    <p>no products added yet!</p>
                    </div>
                    ';
                }
            ?>
        </div>
    </section>
    <div class="line"></div>
    


    <script type="text/javascript" src="script.js"></script>
</body>
</html>