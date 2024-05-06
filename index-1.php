<?php 
@include 'config.php';
session_start();
$userLoggedin =TRUE;
// checking kung naka login
if(!isset($_SESSION['username'])){
   $userLoggedin = FALSE;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>TAMBuys</title>
</head>
<body>

<br>
<?php if(!isset($userLoggedin) || empty($userLoggedin)){ // pag nde naka login login lng kita tas else may welcome new post and logout
         echo '<p>you are logged out. <a href="login.php">log in</a> or <a href="register.php">register</a> to make changes</p>';
      }else{?>
         <h1>welcome, <span><?php echo $_SESSION["username"] ?></span></h1>
         <br>
         <a  href="logout.php">LOGOUT NOW</a>

      <?php }?>



</body>
</html>