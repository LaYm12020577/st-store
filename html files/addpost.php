<?php
    ini_set("display_errors", 1);
    error_reporting(E_ALL & E_STRICT);
    $msql = mysqli_connect('localhost', 'STEREOOMAN', 'laym12020577', 'products') or die('connection failed');
    session_start();
    $user_id = $_SESSION['user_id'];

    $image_width = "1280";
    $image_height = "1280";


    if(!isset($user_id)){
      header('location: ../html files/login.php');
    }


    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($msql, $_POST['name']); 
        $price = mysqli_real_escape_string($msql, $_POST['price']); 
        $a_p = mysqli_real_escape_string($msql, $_POST['about_product']); 
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;

        $select = mysqli_query($msql, "SELECT * FROM `product` WHERE `about_product` = '$a_p AND `price` = '$price'");
        $insert = mysqli_query($msql, "INSERT INTO `product` (`name`, `price`, `about_product`, `image`) VALUES('$name', '$price', '$a_p', '$image')") or die('query failed');
        if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Registered successfully!';
            header('location: ../html files/login.php');
        } else{
            $message[] = 'Registration failed :(';
        }
        header('location: ../html files/index.php');
      }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    <link rel="stylesheet" href="../styles/adp.css" />
    <title>st:store</title>
  </head>
  <body>
  <?php
    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$user_id'");
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

        <ul class="nav-links">
          <li>
            <a href="index.php">
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
            <a href="..//html files/About.html">
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

        <div class="logo">
          <h4>Account Shop</h4>
        </div>

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
                  echo 'Guest';
                }else{
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
                <a
                  href="../html files/profile.php?logout=<?php echo $user_id; ?>"
                >
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


        <form action="" method="post" enctype="multipart/form-data">
          
          <div class="inputBox">
            <h3>ADD YOUR POST</h3>
          <input type="text" name="name" placeholder="product name" class="box" required />
          <input type="text" name="price" placeholder="product price" class="box" required />
          <textarea name="about_product" placeholder="about product" class="box" required ></textarea>
          <input type="file" name="image" class="box" accept="image/*"/>
          <input type="submit" name="submit" value="Create Post">
        </div>
        </form>


    <script src="../jsfiles/NavBurger.js"></script>
    <script src="../jsfiles/dropprof.js"></script>
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
