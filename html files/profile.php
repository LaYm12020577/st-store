<?php
    ini_set("display_errors", 1);
    error_reporting(E_ALL & E_STRICT);
    include '../dbFiles/config.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id)){
      header('location: ../html files/login.php');
    }

    if(isset($_GET['logout'])){
      unset($user_id);
      session_destroy();
      header('location: ../html files/login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styles/profile.css">
   <!-- CSS only -->
   <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
      crossorigin="anonymous"
    />
  <title>st:store</title>
</head>
<body>
  <div class="container">
    <div class="profile">
        <?php
          $select = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$user_id'") or die('query failed');
          if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
          }
          if($fetch['image'] == ''){
            echo '<img src="../imgs/pacient-icon.png">';
          } else{
            echo '<img src="../imgs/'.$fetch['image'].'">';
          }
        ?>    
        <!-- <img src="../imgs/pacient-icon.png">
        <p>Komilov Bexruzbek</p> -->
        <p class="userns"><?php echo $fetch['name']; ?></p>   
        <a href="../html files/update_profile.php"><button class="btn">Edit</button></a>
        <a href="../html files/profile.php?logout=<?php echo $user_id; ?>"><button class="delete-btn">Logout</button></a>
        <a href="../html files/index.php"><button class="delete-btn">Home</button></a>
    </div>
  </div>
</body>
</html>