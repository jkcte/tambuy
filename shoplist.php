<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
     <link rel="stylesheet" href="profilestyler1.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-L/ovuoK1k2fD9Dn4WfZzBvMwJN5de8WKtZoLPzWzTC+g5mryiAsH/pUvLJr2etAa+BhHqvzjK67V0fcThSlx5Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
    <style>
        body{
        background-color: rgba(210,215,211,0.9);}
    </style>
</head>

<body>
<?php include 'sidebar.php'?>
    <?php 
        include 'classes.php';

        $sellers = initSellers($connect);
        $products = getProduct($connect, 1) ;
    ?>
    <div style="margin-left:54px;">
    <div class="head">
        <img src="assets/tambuys-icon-text.png"  alt="">
    </div>
    <div class="container2">
        
                <?php 
                    $counter=0;
                    echo "<div class='parentlist'";
                    echo "<div class='imglist'>";
                    $picture = "";
                    foreach($sellers as $seller){
                        $data = $seller->sellerID;
                        if ($seller->picture != null)    
                        $picture = $seller->picture;
                        else $picture = 'tambuys-icon-gold.png';
                        echo "<a href = 'profile.php?id=$data&ids=$ids'>";
                        echo "<div class='listing-container' data-name=$counter>";
                        echo "<img src='img/img/assets/$picture' width='180' height='180'>";
                        echo "<div class='listing-text1'>"."<b>".$seller->shopName."</b>"."<br>"."</div>";

                        echo "</div>";

                        
                    }
                    echo "</div>";
           

                ?>

    </div>

    </div>
    </div>

</body>
</html>
