<?php 
@include 'config.php';
include_once 'classes.php';
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
    <title>TamBuys | Home </title>
    <!-- swiper -->
    <link rel="stylesheet" href="style/swiper.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/67c66657c7.js" ></script>
    <script src="script-carousel.js" defer></script>
</head>


<body>



<?php include 'sidebar.php'?>
<section class="main-content">
    <div class="head">
        <img src="assets/tambuys-icon-text.png"  alt="">
    </div>
 

    <div class="wrapper">
    <section class="ad-container">
    <div class="left">
	<div class="slider-wrapper">
		<div class="slider">
			<img id="slide-5" src="img/ads/5.jpg" />
			<img id="slide-6" src="img/ads/6.gif" />

		</div>
		<div class="slider-nav">
			<a href="#slide-5"></a>
			<a href="#slide-6"></a>

		</div>
	</div>
    </div>
    <div class="right">
	<div class="slider-wrapper">
		<div class="slider-2">
			<img id="slide-1" src="img/ads/1.jpg" />
			<img id="slide-2" src="img/ads/2.jpg" />
			<img id="slide-3" src="img/ads/3.jpg" />
            <img id="slide-4" src="img/ads/1.jpg" />
		</div>
		<div class="slider-nav">
			<a href="#slide-1"></a>
			<a href="#slide-2"></a>
			<a href="#slide-3"></a>
            <a href="#slide-4"></a>
		</div>
	</div>
    </div>


</section>
    </div>
   
    
    <!--  CATEGORIES  -->
    <div class="category-nav">
        <ul>
            <li><a href="foodlistings.php?ids=<?php echo $ids; ?>"><i class="fa-solid fa-utensils"></i><br>Food</a></li>
            <li><a href="electronicslistings.php?ids=<?php echo $ids; ?>"><i class="fa-solid fa-mobile-screen"></i><br>Electronics</a></li>
            <li><a href="clotheslistings.php?ids=<?php echo $ids; ?>"><i class="fa-solid fa-shirt"></i><br>Clothes</a></li>
            <li><a href="bookslistings.php?ids=<?php echo $ids; ?>"><i class="fa-solid fa-book-open"></i><br>Books</a></li>
            <li><a href="serviceslistings.php?ids=<?php echo $ids; ?>"><i class="fa-solid fa-user-group"></i><br>Services</a></li>
        </ul>
    </div>


    <!-- FEATURED -->

    <div class="featured">
    <div class="heading">Popular Listings
        <div class="buttons">
        <button class="prev-btn" onclick="plusSlides(-1)"><i class="fa-solid fa-angle-left"></i></button>
        <button class="next-btn" onclick="plusSlides(1)"><i class="fa-solid fa-angle-right"></i></button>
        </div>
        
    </div>
    <div class="product-wrapper">
        <ul class="featured-products">
        <?php

            $products = initProducts($connect);
            foreach($products as $product){
                echo "<li class='product-card slide'>";
                    echo"<form method='post' action='index.php?ids=" . $ids . "&id=". $product->productID;
                    echo"<img src= 'data:image/jpeg;base64,". $product->image ."' class='imgsize'>";
                    echo "<div class='listing-text-list'>{" . $product->productName . "}<br><span style='color: #fac72a'>P{". $product->price ."}</span>";
                    echo "<input type='hidden' name='name' value=" . $product->productName . ">";
                    echo "<input type='hidden' name='sellerID' value=" . $product->sellerID . ">";
                    echo "<input type='hidden' name='price' value=" . $product->price . ">";
                    echo "<input type='hidden' name='quantity' value='1'>";
                    echo "<input type='hidden' name='image' value=" . $product->image . ">";
                    echo "<div class='product-img'>
                            <img src='img/products/$product->image' alt='' draggable='false'>
                        </div>
                        <div class='product-info'>
                            <h4>$product->productName </h4>
                            <span class='price'>P" . $product->price . "</span>
                        </div>
                        <div class='option_cart'><input type='submit' class='cart' name='add_to_cart' value='Add to Cart'></div>
                        </form>
            
                    </li>";
            }
        ?>

            
        </ul>
    </div>

        
    
    <div class="heading">New Sellers
     <div class="wrapper wrap-seller">
        <ul class="carousel">

                <?php
            $query = "SELECT * FROM sellers";
            $result = mysqli_query($conn,$query);
            while (($row = mysqli_fetch_array($result))) {
                echo "<a href = 'profile.php?id=" . $row['sellerID'] . "&ids=$ids'>";
                echo "<li class='shop-card' onclick='window.location.href = '''>";
                echo "<div class='shop-logo'>";
                echo '<img src= "img/icons/'. $row['picture'].'" alt="" draggable="false">';
                echo "</div>";
                echo "<h3>" . $row['shopName'] . "</h3>";
                echo "<span>";
                        for ($i = 0; $i < 3; $i++) {
                            echo '<i class="fa-solid fa-star"></i>';
                        }
                echo "</span>
                </li></a>";
            }
            ?>

        </ul>
        
    </div>  

    </div>
    
    <!-- <div class="swiper mySwiper">
        <div class="container  ">
        <ul class="featured-shops">
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/feu_shs_uniform_1690372758_db342c0d.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/iphone_8_64gb_1714583003_c7cbef79_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/sony_whch520__wh_ch520_wireles_1714566747_ce8e4f03_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>

                </div>

            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/14744554dfc6eb427ca903626b24e1f7.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>

            </li>
            <li class="shop-card-feature">
                <div class="shop-logo">
                    <img src="img/icons/profile-2.jpg" alt="" draggable="false">
                </div>
                <div class="shop-info">
                    <h4>TAMS Bookstore</h4>
                    <span>Avg. Rating:<?php
                    for ($i = 0; $i < 3; $i++) {
                        echo '<i class="fa-solid fa-star rating"></i>';
                    }?>
                </span>
                <a href="" >go to shop</a>
                </div>

            </li>

        </ul>
        </div>
        <div class="container  ">
        <ul class="featured-shops ">
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/sony_whch520__wh_ch520_wireles_1714566747_ce8e4f03_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/iphone_8_64gb_1714583003_c7cbef79_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/trenchcoat_1714302873_5e42cad2_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>

                </div>

            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/stradivarius_bomber_jacket_1686564597_2a4f6c3e_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>

            </li>
            <li class="shop-card-feature">

                <div class="shop-logo">
                    <img src="img/icons/feu.png" alt="" draggable="false">
                </div>
                <div class="shop-info">
                    <h4>FEU Manila</h4>
                    <span>Avg. Rating:<?php
                    for ($i = 0; $i < 4; $i++) {
                        echo '<i class="fa-solid fa-star rating"></i>';
                    }?>
                </span>
                <a href="" >go to shop</a>
                </div>

            </li>

        </ul>
        </div>

        </div> -->
    </div>


    <!-- <div class="swiper ">
        <div  class="container">
        <ul id="seller1" class="featured-shops content-box">
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/feu_shs_uniform_1690372758_db342c0d.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/iphone_8_64gb_1714583003_c7cbef79_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/sony_whch520__wh_ch520_wireles_1714566747_ce8e4f03_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>

                </div>

            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/14744554dfc6eb427ca903626b24e1f7.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>

            </li>
            <li class="shop-card-feature">

                <div class="shop-logo">
                    <img src="img/icons/profile-2.jpg" alt="" draggable="false">
                </div>
                <div class="shop-info">
                    <h4>TAMS Bookstore</h4>
                    <span>Avg. Rating:<?php
                    for ($i = 0; $i < 3; $i++) {
                        echo '<i class="fa-solid fa-star rating"></i>';
                    }?>
                </span>
                <a href="" >go to shop</a>
                </div>

            </li>

        </ul>
    
        <ul id="seller2" class="featured-shops content-box">
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/sony_whch520__wh_ch520_wireles_1714566747_ce8e4f03_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/iphone_8_64gb_1714583003_c7cbef79_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/trenchcoat_1714302873_5e42cad2_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>

                </div>

            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/stradivarius_bomber_jacket_1686564597_2a4f6c3e_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>

            </li>
            <li class="shop-card-feature">

                <div class="shop-logo">
                    <img src="img/icons/feu.png" alt="" draggable="false">
                </div>
                <div class="shop-info">
                    <h4>FEU Manila</h4>
                    <span>Avg. Rating:<?php
                    for ($i = 0; $i < 4; $i++) {
                        echo '<i class="fa-solid fa-star rating"></i>';
                    }?>
                </span>
                <a href="" >go to shop</a>
                </div>

            </li>

        </ul>
    
        <ul id="seller1"class="featured-shops content-box">
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/sony_whch520__wh_ch520_wireles_1714566747_ce8e4f03_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/iphone_8_64gb_1714583003_c7cbef79_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>
            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/trenchcoat_1714302873_5e42cad2_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>

                </div>

            </li>
            <li class="product-card">
                <div class="product-img">
                    <img src="img/products/stradivarius_bomber_jacket_1686564597_2a4f6c3e_progressive.jpg" alt="" draggable="false">
                </div>
                <div class="product-info">
                    <h4> Product Name</h4>
                    <span class="price">P 300</span>
                </div>

            </li>
            <li class="shop-card-feature">
                <div class="shop-logo">
                    <img src="img/icons/iarfa" alt="" draggable="false">
                </div>
                <div class="shop-info">
                    <h4>FEU Manila</h4>
                    <span>Avg. Rating:<?php
                    for ($i = 0; $i < 4; $i++) {
                        echo '<i class="fa-solid fa-star rating"></i>';
                    }?>
                </span>
                <a href="" >go to shop</a>
                </div>

            </li>

        </ul>
        </div>
        
        </div>
    </div> -->

    
    <div class="product-grid">

    <div class="divider"></div>
    <div class="heading">Discover
    </div>
    <div class="product-wrapper">

        <?php
            $prods = initProducts($connect);
            $n = 0;
            $image = "";
            echo "<ul class='featured-products'>";
            foreach ($prods as $prod){
                if ($prod->image != null) $image = $prod->image;
                else $image = "tambuys-icon-gold.png";
                echo "<a href = 'profile.php?id=$prod->sellerID&ids=$ids'>";
                echo "<li class='product-card '>
                        <div class='product-img'>
                            <img src='$image' alt='' draggable='false'>
                        </div>
                        <div class='product-info'>
                            <h4> $prod->productName</h4>
                            <span class='price'>P $prod->price</span>
                        </div>

                    </li></a>";
                    $n++;
                if ($n % 5 == 0) echo "</ul>";
                
                if ($n % 5 == 0) echo "<ul class='featured-products'>";
            }
        ?>
    </div>
    </div>
                

</section>
<?php 
// include 'footer.php';

?> 
<!-- <script src="script.js"></script> -->
<!-- scroll to top -->
<a href="#"><button class="topbtn" title="Back to Top"><i class="fa fa-angle-up"></i></button></a>

<?php if(!isset($userLoggedin) || empty($userLoggedin)){?>
<span class="logged-out">
    You are logged out.
    <a href="login.php">Login</a> or <a href="register.php">Signup</a> now.<?php
            }?>
</span>

<script src="swiper.js">

</script>
</body>

</html>