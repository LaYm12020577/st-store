<?php
    ini_set("display_errors", 1);
    error_reporting(E_ALL & E_STRICT);
    include '../dbFiles/config.php';

    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']); 
        $email = mysqli_real_escape_string($conn, $_POST['email']); 
        $pass = mysqli_real_escape_string($conn, md5($_POST['password'])); 
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword'])); 
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;

        $select = mysqli_query($conn, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass'") or die('query failed');

        if(mysqli_num_rows($select) > 0){
            $message[] = 'User already exist!';
        } else{
            if($pass != $cpass){
                $message[] = 'Confirmed password does not match!';
            }elseif($image_size > 2000000){
                $message[] = 'Image size is too large';
            } else{
                $insert = mysqli_query($conn, "INSERT INTO `users` (`name`, `email`, `password`, `image`) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');


                if($insert){
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[] = 'Registered successfully!';
                    header('location: ../html files/login.php');
                } else{
                    $message[] = 'Registration failed :(';
                }
            }
        }
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/sign_in.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    
    <title>st:store</title>
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Register</h3>
            <?php
            ini_set("display_errors", 1);
            error_reporting(E_ALL & E_STRICT);
                if(isset($message)){
                    foreach($message as $message){
                        echo '<div class="message">'.$message.'</div>';
                    }
                }
            ?>
            <input type="text" name="name" placeholder="Enter username" class="box" required>
            <input type="email" name="email" placeholder="Enter email" class="box" required>
            <input type="password" name="password" placeholder="Enter password" class="box" required>
            <input type="password" name="cpassword" placeholder="Confirm password" class="box" required>
            <input type="file" name="image" class="box" accept="image/*">
            <input type="submit" name="submit" value="Register" class="btn">
            <p>Already have an account? <a href="../html files/login.php">Login</a>.</p>
        </form>
    </div>
</body>
</html>