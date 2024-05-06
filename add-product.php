<?php
@include 'config.php';
session_start();
$userLoggedin =TRUE;
// checking kung naka login
if(!isset($_SESSION['userName'])){
   $userLoggedin = FALSE;
}

$ids = isset($_GET['ids']) ? $_GET['ids'] : '';
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
body{
    background: #ededed;
}

.main-content{
    padding: 50px;
}

.heading{
    color: var(--main-green);
    padding: 20px;
}

</style>


<body>
<?php include 'sidebar.php'?>
<div class="main-content add">


<div class="form-container-product">

<form action="" method="post" enctype="multipart/form-data">
    
    <div class="left">
    <h3 class="heading">Add New Product</h3>
    <div class="img-upload">
        <div class="img-area">
        <i class="fa-solid fa-cloud-arrow-up icon"></i>
        <h3>Upload Image</h3>
        <input type="file" accept=".jpg, .jpeg,.png">
        </div>
        <label for="productName">Product Name:</label><br>
    <input type="text" id="productName" name="productName" required>

    <label for="price">Price:</label><br>
    <input type="text" id="price" name="price" required>
    </div>
    </div>

    <div class="right">
    


    <label for="stocks">Stocks:</label><br>
    <input type="number" id="stocks" name="stocks" min="0" required maxlength="3"><br>

    <label for="tag">Tag:</label><br>
    <select id="category" name="tags">
        <option value="Food">Food</option>
        <option value="Electronics">Electronics</option>
        <option value="Books">Books</option>
        <option value="Clothes">Clothes</option>
        <option value="Services">Services</option>
    </select><br><br>

    <label for="description">Description:</label><br>
    <textarea id="description" name="description" rows="10" cols="50" required></textarea>
    <input type="submit" value="submit" class="form-btn">
    </div>
    
    

    

</div>

</form>

</div>
</body>
</html>


</body>

</html>