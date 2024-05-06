<?php
@include 'config.php';

$error = [];
if(isset($_POST['submit'])){
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
   

   $select = " SELECT * FROM user WHERE userName = '$username' || email = '$email' ";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'User already exists.';
      }else{
         // username
      if (!preg_match('/^[A-Za-z0-9_]+$/', $username)) {
         $error[] = "Username should contain only letters, numbers, and underscores.";
      }
      //  email
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = "Invalid email format.";
      }
      // password strength
     
      // confirm pass 
      if($password != $cpassword){
         $error[] = 'Passwords not matched.';
      }

      // extract student number
   if(preg_match('/^.*?(\d{10})@.*?$/', $email, $matches)){
      $studentID = $matches[1];

   }else{
      if(($studentID >= 2000000000 && $studentID <= 2023999999) && (strpos($email, '@feu.edu.ph') === false) ) {
            $error[] = "Please enter a valid student email.";
      }
   }

   $select = " SELECT * FROM user WHERE userName = '$username' || email = '$email' ";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'User already exists.';
      }else{
         // username
      if (!preg_match('/^[A-Za-z0-9_]+$/', $username)) {
         $error[] = "Username should contain only letters, numbers, and underscores.";
      }
      //  email
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = "Invalid email format.";
      }
     
      // confirm pass 
      if($password != $cpassword){
         $error[] = 'Passwords not matched.';
      }
      // if (is_numeric($studentID) && $studentID <= 2000000000) {
      //    $error[] = "Student number must be greater than 2000000000.";
      // }
      }
      
      if(empty($error)){
         $insert = "INSERT INTO user(userName, email, password, profilePicture) VALUES('$username', '$email','$password','$profilePicture')";
         mysqli_query($conn, $insert);

         // log user in
         session_start();
         $select = " SELECT * FROM user WHERE userName = '$username' && password = '$password' ";
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
       $row = mysqli_fetch_array($result);
          $_SESSION['userID'] = $row['userID'];
          $_SESSION['userName'] = $row['userName'];
          header("location:index.php?ids={$row['userID']}");
          exit();
 
    }
         }
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
    <title>Signup to TAMBuys</title>
</head>
<body>
<div class="form-container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="logo-container">
            <img src="assets/tambuys-wordmark-gold.png" alt="Logo" height="40"> 
        </div>

        <div class="divider"></div>
        
        <h3>Create an Account</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
            $error =[];
         };
        ?>

        <input type="text" name="userName" maxlength="20" value="<?php echo $username; ?>" required placeholder="Enter a username">
        <input type="text" name="studentEmail" value="<?php echo $email; ?>"  required placeholder="Enter your email">
        <input type="password" name="password" maxlength="30" required placeholder="Enter your password">
        <input type="password" name="cpassword" maxlength="30" required placeholder="Confirm your password">
        <input type="file" name="profilePicture" accept=".jpg, .jpeg, .png, .gif, .webp" required>
        <br>
        <br>
        <input type="submit" name="submit" value="SIGNUP NOW" class="form-btn">
        <p>already have an account? <a href="login.php">login now</a></p>
    </form>

</div>

</body>

</html>