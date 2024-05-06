<script>
// clear session /logout pag nagback sa page na to
    window.onload = function() {
        fetch('logout.php');
    }
</script>

<?php 
@include 'config.php';
session_start();


if(isset($_POST['submit'])){
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    $select = " SELECT * FROM user WHERE userName = '$username' && password = '$password' ";
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
       $row = mysqli_fetch_array($result);
          $_SESSION['userID'] = $row['userID'];
          $_SESSION['userName'] = $row['userName'];
          header("location:index.php?ids={$row['userID']}");
          exit();
 
    }else{
       $error[] = 'Incorrect login details!';
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-login.css">
    <title>Login to TAMBuys</title>
</head>
<body>
<div class="form-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="logo-container">
            <img src="assets/tambuys-wordmark-gold.png" alt="Logo" height="40"> 
        </div>

        <div class="divider"></div>
        <h3>LOG IN</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
        ?>
        <input type="text" name="userName" maxlength="20" required placeholder="Enter your username">
        <input type="password" name="password" maxlength="50" required placeholder="Enter your password">
        <input type="submit" name="submit" value="log in" class="form-btn">
        <p>don't have an account? <a href="register.php">register now</a></p>
        <p><a href="index.php">continue without logging in</a></p>
    </form>
        
</div>


</body>
</html>