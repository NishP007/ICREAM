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
    if(isset($_POST['update_product'])){
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
        $update_detail = $_POST['update_detail'];
        $update_image = $_FILES['update_image']['name'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = 'image/'.$update_image;

        $update_query = mysqli_query($conn, "UPDATE `products` SET `id`='$update_id', `name`='$update_name', `price`='$update_price', `product_detail`='$update_detail', `image`='$update_image' WHERE id='$update_id'") or die('query failed');

        if($update_query){
            move_uploaded_file($update_image_tmp_name,$update_image_folder);
            header('location:admin_product.php');
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
        <title>Document</title>
    </head>
    <body>
    <section class="update-container">
        <?php
        if(isset($_GET['edit'])){
            $edit_id =$_GET['edit'];
            $edit_query = mysqli_query($conn,"SELECT * FROM `products` WHERE id ='$edit_id'") or die('query failed');
            if(mysqli_num_rows($edit_query) > 0){
                while($fetch_edit = mysqli_fetch_assoc($edit_query)){
            ?>
        <form method ="post" action="" enctype="multipart/form-data">
            <h2 style="text-align:center; color:purple">Update Form</h2>
            <img src="image/<?php echo $fetch_edit['image'] ;?>">
            <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id'] ;?>">
            <input type="text" name="update_name" value="<?php echo $fetch_edit['name'] ;?>">
            <input type="number" name="update_price" min="0" value="<?php echo $fetch_edit['price'] ;?>">
            <textarea name="update_detail"><?php echo $fetch_edit['product_detail'] ;?></textarea>
            <input type="file" name="update_image" accept="image/jpg,image/png,image/webp,image/jpg">
            <input type="submit" name="update_product" value="UPDATE" class="update">
            <button style="color: white; text-decoration:none; background: purple; padding: .5rem 1.5rem; text-transform:uppercase; line-height: 2; border-radius: .5rem;"><a href="admin_product.php" style="color:pink; font-size:15px">Cancel</a></button>
            <!--  </button>-->
        </form>
        <?php
            
            }
        }
             echo"<script>document.querySelector('.update-container').style.display='block'</script>";
    }
        ?>
    </section>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>