<?php
@include 'config.php';
$error = [];
if(isset($_POST['submit'])){
    if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $insert = "INSERT INTO sellers(shopName, description, contactDetails) VALUES('$shopName', '$description', '$contactDetails')";
    mysqli_query($conn, $insert);
    exit();
    }

        }
// } 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-login.css">
    <title></title>
</head>

<style>
 /* nasa style-login.css */

</style>


<body>

<!-- -->


<div class="form-container" id="seller-regis">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
    <div class="logo-container">
            <img src="assets/tambuys-wordmark-gold.png" alt="Logo" height="40"> 
        </div>
        <div class="divider"></div>

    <h3>Store Registration Form</h3>
    <?php
        if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
            $error =[];
         };
        ?>
        <input type="text" name="shopName" placeholder="Enter your shop's name" required>
        <input type="email" placeholder="Enter your email" name="contactDetails" id="" required>
        <div class="divider" style="border: transparent"></div>
        <label for="registrationDocuments">Registration Documents:</label>
        
        <input type="file" name="registrationDocuments" accept=".pdf, .doc,.docx, .jpg, .jpeg" multiple>
        
        <textarea id="description" name="description" rows="4" placeholder="Write a short description about your shop"></textarea>
        
        <input name="submit" type="submit"onclick="togglePopup()" value="submit" class="form-btn">
    </form>

</div>


</body>


<script>
    function togglePopup(){
    document.getElementById("submitted").classList.toggle("active");
    }

    function toggleForm(){
    document.getElementById("seller-regis").classList.toggle("active");
    }

</script>
</html>