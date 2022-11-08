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

    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../styles/index.css" />
    <link rel="stylesheet" href="../styles/index.css">
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

        <div class="logo">
          <h4 style="font-family: cursive;">st-store</h4>
        </div>

        <ul class="nav-links">
          <li>
            <a href="../html file/index.php">
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

        
        <div class="action">
          <div class="profile" onclick="menuToggle();">
            <img src="../imgs/userpic_male.png" alt="" class="main-img">
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
                      ><ion-icon name="create-outline"></ion-icon></span>
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

    <section class="banner" style="overflow-x: hidden">
      <div class="imgBx">
        <img src="../imgs/slider4.png" width="100%" class="active" />
        <img src="../imgs/slider2.png" width="100%" />
        <img src="../imgs/slider1.png" width="100%" />
        <img src="../imgs/slider3.png" width="100%" />
      </div>

      <div class="contentBx">
        <div class="active">
          <h2>Slide Text One</h2>
          <p>
            Everything on this website automated and you can safely buy an
            account.
          </p>
        </div>

        <div>
          <h2>Slide Text Two</h2>
          <p>There is no guarantor which should be among the two users.</p>
        </div>

        <div>
          <h2>Slide Text Three</h2>
          <p>
            Here you can send facebook, playgames or twitter accounts. First so
            that the buyer is shure that the account exists, if account does not
            exist, then he can cut the deal
          </p>
        </div>

        <div>
          <h2>Slide Text Four</h2>
          <p>
            If you find programm glitch, you can write through contact us and
            you can describe the problem.
          </p>
        </div>
      </div>

      <div class="controls">
        <ul>
          <li onclick="PrevSlide();PrevSlideText();" class="control-left"></li>
          <li onclick="nextSlide();nextSlideText();" class="control-right"></li>
        </ul>
      </div>
    </section>

    

    <script src="../jsfiles/sliderBtn.js"></script>
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

<!-- 9370447125 -->
