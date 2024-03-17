
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title></title>
    </head>
    <body>
        <header class="header">
            <div class="flex">
                <a href="admin.php" class="logo">I<span>Cream</span>
                <nav class="navbar">
                    <a href="admin.php">HOME</a>
                    <a href="admin_product.php">PRODUCTS</a>
                    <a href="admin_orders.php">ORDERS</a>
                    <a href="admin_user.php">USERS</a>
                    <a href="admin_message.php">MESSAGES</a>
                </nav>
            <div class="icons" style="display:flex;flex-direction:row;">
                <i class="bi bi-list" id="menu-btn"></i>
                <i class="bi bi-person" id="user-btn"></i>
            </div>
            <div class="user-box">
                <p>username :<span> <?php echo $_SESSION ['admin_name'] ?></span></p>
                <p>email :<span> <?php echo $_SESSION ['admin_email'] ?></span></p>
                <form method="post" class="logout">
                    <button name="logout" class="logout-btn">LOG OUT</button>
                </form>
            </div>
</div>
</header>
</body>
</html>