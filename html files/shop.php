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

    $db = mysqli_connect('localhost', 'STEREOOMAN', 'laym12020577', 'products') or header('location: ../html files/shop.php');;
    $info = mysqli_query($db, "SELECT * FROM `product`");

     

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/shop.css" />
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
    <!-- JavaScript Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"
    ></script>

    <title>st:store</title>
  </head>
  <body>
    <?php
    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
      $fetch = mysqli_fetch_assoc($select);
    }
    ?>
    <header>
      <nav>
        <div class="burger">
          <div class="line-1"></div>
          <div class="line-2"></div>
          <div class="line-3"></div>
        </div>


        <div class="logo">
          <h4 style="font-family: cursive;">st-store</h4>
        </div>
        <ul class="nav-links">
          <li>
            <a href="../html files/index.php">
              <span class="icon"
                ><ion-icon name="home-outline"></ion-icon
              ></span>
              <span class="text">Home</span>
            </a>
          </li>
          <li>
            <a href="../html files/shop.php">
              <span class="icon"
                ><ion-icon name="basket-outline"></ion-icon
              ></span>
              <span class="text">Shop</span>
            </a>
          </li>
          <li>
            <a href="../html files/addpost.php">
              <span class="icon"
                ><ion-icon name="add-circle-outline"></ion-icon
              ></span>
              <span class="text">Add post</span>
            </a>
          </li>
          <li>
            <a href="../html files/About.html">
              <span class="icon"
                ><ion-icon name="book-outline"></ion-icon
              ></span>
              <span class="text">About</span>
            </a>
          </li>
          <li>
            <a href="../html files/contact.html">
              <span class="icon"
                ><ion-icon name="paper-plane-outline"></ion-icon
              ></span>
              <span class="text">Contact Us</span>
            </a>
          </li>
        </ul>

        

        <div class="action">
          <div class="profile" onclick="menuToggle();">
            <img src="../imgs/userpic_male.png" alt="" />
          </div>
          <div class="menu">
            <h3>
              <span>Welcome!</span> <br />
              <?php
                ini_set("display_errors", 1);
                error_reporting(E_ALL & E_STRICT);
                if(!isset($user_id)){
                  echo Guest;
                } else{
                  echo $fetch['name'];
                }
                  ?>
            </h3>
            <ul>
              <li>
                <a href="../html files/profile.php">
                  <span class="icon"
                    ><ion-icon name="person-circle-outline"></ion-icon
                  ></span>
                  <span class="text">My Profile</span>
                </a>
              </li>
              <li>
                <a href="../html files/update_profile.php">
                  <span class="icon"
                    ><ion-icon name="create-outline"></ion-icon
                  ></span>
                  <span class="text">Edit Profile</span>
                </a>
              </li>
              <?php
                  ini_set("display_errors", 1);
                  error_reporting(E_WARNING | E_PARSE);
                  if(!isset($user_id)):
                  
                ?>
              <li>
                <a href="../html files/login.php">
                  <span class="icon"
                    ><ion-icon name="log-in-outline"></ion-icon
                  ></span>
                  <span class="text">Log In</span>
                </a>
              </li>
              <?php
                  else:
                ?>
              <li>
              <a href="../html files/profile.php?logout=<?php echo $user_id; ?>">
                <ion-icon name="log-out-outline"></ion-icon>
                <span class="text">Log Out</span>
              </a>
              </li>

              <?php endif; ?>
              </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Shop -->
    <section class="shop container">
      <div class="title-shop">
        <div class="main-icon-func">
          <h2 class="section-title">Shop Productes</h2>
        <ion-icon name="cart-outline" id="cart-icon"></ion-icon>
        </div>
        
        <div class="cart">
          <h2 class="cart-title">Your Cart</h2>
          <!-- cart content -->
          <div class="cart-content">
            
          </div>
          <!-- Total -->
          <div class="total">
            <div class="total-title">Total</div>
            <div class="total-price">$0</div>
          </div>
          <!-- buy btn -->
          <button type="button" class="btn-buy">Buy Now</button>
          <!-- cart close -->
          <i class="bx bx-x" id="close-cart"></i>
        </div>
      </div>

      <div class="shop-content">
        
          <?php
          while($right = mysqli_fetch_assoc($info)){?>
          <div class="product-box">
          <a href="../html files/productabout.php"><img src="../imgs/<?php echo $right['image'];?>" class="product-img"/></a>
          <h2 class="product-title"><?php echo $right['name'] ?></h2>
          <span class="price">$<?php echo $right['price'] ?></span>
          <ion-icon name="cart-outline" class="add-cart"></ion-icon>
          </div>
          <?php } ?>
          
          
        
       
      </div>
    </section>

    <script src="../jsfiles/NavBurger.js"></script>
    <script src="../jsfiles/dropprof.js"></script>
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
