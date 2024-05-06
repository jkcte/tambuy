<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
     <link rel="stylesheet" href="profilestyler1.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-L/ovuoK1k2fD9Dn4WfZzBvMwJN5de8WKtZoLPzWzTC+g5mryiAsH/pUvLJr2etAa+BhHqvzjK67V0fcThSlx5Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style type="text/css">
        
    </style>
    <?php
    @include 'config.php';
    session_start();
    $userLoggedin =TRUE;
    // checking kung naka login
    if(!isset($_SESSION['userName'])){
       $userLoggedin = FALSE;
    }
    
    $ids = isset($_GET['ids']) ? $_GET['ids'] : '';
    $data = isset($_GET['id']) ? $_GET['id'] : '';
    
    ?>

</head>
<?php
echo "<div class='remove-me'>";
include 'sidebar.php';
echo "</div>";
?>
<body id="body">
    <?php 
        include 'classes.php';
        $data = isset($_GET['id']) ? $_GET['id'] : '';
        //$seller = $_POST['seller'];
        $seller = getSeller($connect, $data);

        $products = getProduct($connect, $data);
    ?>
    <div style="margin-left:54px; max-width:100%;">
    <div class="head">
        <img src="assets/tambuys-icon-text.png"  alt="">
    </div>
    <div class="container1">
        <script> 
        $(document).ready(function(){
        $("#panel").css('display', 'none');
          $("#flip").click(function(){
            $("#panel").slideToggle("slow");
            $(this).text(function(i, text){
              return text === "See Less" ? "See More" : "See Less";
            });
          });
        });
        </script>
        <div class="imgcont">
            <img src="tambuys-icon-gold.png" width="150" height="150"> 
            <div><br>
                <div class="text">
                    <strong><h2><?php 
                    $profileimg="";
                    if ($seller['verified'] == 'verified') $profileimg ='verified.png';
                    else $profileimg="";
                    echo $seller["shopName"]."&nbsp"."<img src='$profileimg' width='20' height='20'>";; 


                    ?></h2></strong><br>
                    <b><h3>Rating:</h3></b> <br>
                    <span style="color:gray">Joined <?php 
                    $timestamp=strtotime($seller['dateStart']);
                    echo date("M d, Y",$timestamp); 
                    ?></span>
                </div><br>
                <?php 
                    echo $seller["description"];
                ?>
            </div>
        </div>
    </div>
        <br>
        <br>
        <div class="container">
        <div>
            <span style="color: #005200;"><h2>Listings</h2></span><br>
            

                <?php 
                    $counter=0;

                    echo "<div class='parentlist1'>"; 
                    echo "<div class='imglist'>"; 
                    $picture = "";
                    foreach($products as $product){ 
                        $counter+=1;
                        if ($product['image'] != null)
                            $picture ='data:image/jpeg;base64,'.base64_encode($product['image']);
                        else 
                            $picture = 'tambuys-icon-gold.png';
                        
                        if($counter<=4){
                            echo "<div class='listing-container' data-name=$counter>";
                            echo "<img src='$picture' width='180' height='180'>";
                            echo "<div class='listing-text'>".$product["productName"]."<br>"."<span style='color: #fac72a'>"."&#x20B1;".$product["price"]."</span>"."</div>";
                            echo "</div>";
                            if($counter == 4) {
                                echo "</div>"; 
                                echo "</div>"; 
                                echo "<span id='panel'>";
                                echo "<div class='parentlist1'>"; 
                                echo "<div class='imglist'>"; 
                            }
                        } else {
                            echo "<div class='listing-container' data-name=$counter>";
                            echo "<img src='tambuys-icon-gold.png' width='180' height='180'>";
                            echo "<div class='listing-text'>".$product["productName"]."<br>"."<span style='color: #fac72a'>"."&#x20B1;".$product["price"]."</span>"."</div>";
                            echo "</div>";
                        }
                    }

                    echo "</div>"; 
                    echo "</div>"; 
                    echo "</span>"; 

                    echo "<br>";

                    if ($counter>4){
                        echo "<center>"."<button id='flip' class='buttondesign'>"."See More"."</button>"."</center>";
                    }
                    ?>


        

        </div>
    </div>
    </div>
    
    <?php
        $counter1=0;
        echo "<div class='products_preview'>";
        $prods = getProduct($connect, $data);
        $picture="";

            foreach($prods as $product){
                if ($product['image'] != null)
                $picture ='data:image/jpeg;base64,'.base64_encode($product['image']);
                else $picture = 'tambuys-icon-gold.png';
                $counter1+=1;
                echo "<div class='preview' data-target=$counter1>";

                    echo "<i class='fas fa-times'>"."</i>";
                    echo "<div class='row1'>";
                        echo "<img src='tambuys-icon-gold.png' width='180' height='180'>";
                        
                    echo "</div>";
                    echo "<div class='rightcolumn'>";
                        echo "<span style='color:gray' class='rating'>"."Rating:"."</span>"."<br>";
                        echo "<p>".$product["description"]."</p>";
                    echo "</div>";


                    echo "<h3>".$product["productName"]."</h3>";
                    echo "<div class='price_preview'>"."&#x20B1;".$product["price"]."</div>";

                    echo "<div class='margin'>";
                    echo "<div class='option_cart'>";
                    echo "<form method='post' action='profile.php?ids=$ids&id={$product['productID']}'>";
                    echo "<input type='hidden' name='name' value='{$product['productName']}'>";
                    echo "<input type='hidden' name='sellerID' value='{$product['sellerID']}'>";
                    echo "<input type='hidden' name='price' value='{$product['price']}'>";
                    echo "<input type='hidden' name='quantity' value='1'>";
                    echo "<input type='hidden' name='image' value='base64_encode({$product['image']})'>";
                        echo "<input type='submit' class='cart' name='add_to_cart' value='Add to Cart'>";
                    echo "</form>";
                    
                    echo "</div>";
                        echo "<i class='heart fa-regular fa-heart'>"."</i>";
                    echo "</div>";

                echo "</div>";

                    

            }


        echo "</div>";
    ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".heart.fa-heart").click(function() {
          $(this).toggleClass("fa-regular fa-solid");
        });
      });
    </script>

    <script src="profilescr.js"></script>

</body>
<?php 
        //include 'footer.php';
    ?>
</html>
