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
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Listings</title>
	<link rel="stylesheet" href="style/profilestyler1.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-footer.css">
</head>
<body>
	<?php
		include 'sidebar.php';
	?>
    <div class="main_content">
	<div class="containerlist"><br>
		<span style="color: #005200;"><h2>Electronics Listings</h2></span><br>
		<br>
        <div class="imglist">
		<?php 
            $query_electronics = "SELECT * FROM product WHERE tags = 'Electronics'";
            $result_electronics = mysqli_query($conn,$query_electronics);
            while (($row = mysqli_fetch_array($result_electronics))) {?>
            <div class='listing-container-list'>
            <form method="post" action="electronicslistings.php?ids=<?php echo $ids; ?>&id=<?=$row['productID'] ?>">
                <?php echo'<img src= "data:image/jpeg;base64,'.base64_encode($row['image']).'" class="imgsize">';?>
                <?php echo "<div class='listing-text-list'>{$row['productName']}<br><span style='color: #fac72a'>P{$row['price']}</span>"; ?>
                <input type="hidden" name="name" value="<?= $row['productName'] ?>">
                <input type="hidden" name="sellerID" value="<?= $row['sellerID'] ?>">
                <input type="hidden" name="price" value="<?= $row['price'] ?>">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="image" value="<?= base64_encode($row['image']) ?>">
                <div class='option_cart'><input type='submit' class='cart' name='add_to_cart' value='Add to Cart'></div>
            </form>
            </div>
            </div>
            <?php } ?>
        <br>
        </div>
        
	</div>
    <?php
        include 'footer.php';
    ?>
    </div>
</body>
</html>