<?php
ini_set("display_errors", 1);
error_reporting(E_ALL & E_STRICT);
include '../dbFiles/config.php';
session_start();
$user_id = $_SESSION['user_id'];

    

    if(isset($_GET['logout'])){
      unset($user_id);
      session_destroy();
      header('location: ../html files/login.php');
    }

    $db = mysqli_connect('localhost', 'STEREOOMAN', 'laym12020577', 'products') or die('connection failed');
    $info = mysqli_query($db, "SELECT * FROM `product`");
    if(mysqli_num_rows($info)){
        $infa = mysqli_fetch_assoc($info);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/pa.css">
    <!-- <title>st:store</title> -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="product">
                   <div class="image">
                            <img src="../imgs/<?php echo $infa['image'];?>" class="product-image" style="margin-top: 20px;">
                        </div>

                    <div class="info">
                        
                        <div class="name">
                            <h3><?php echo $infa['name']; ?></h3>
                            <ion-icon name="cart-outline" class="add-cart"></ion-icon>
                        </div>

                        <div class="price">
                            <span>$<?php echo $infa['price']; ?></span>
                        </div>

                        <div class="about">
                            <p><?php echo $infa['about_product']; ?></p>
                        </div>
                    </div>

                    

                    

                </div>
            </div>
        </div>
    </div>
    <script src="../jsfiles/cart.js"></script>

    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
</body>
</html>