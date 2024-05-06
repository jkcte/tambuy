<?php 
@include 'config.php';
session_start();
$ids = isset($_GET['ids']) ? $_GET['ids'] : '';
$userLoggedin =TRUE;
// checking kung naka login
if(!isset($_SESSION['userName'])){
   $userLoggedin = FALSE;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TamBuys | Profile </title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-new.css">
    <link rel="stylesheet" href="profile-demo.css">
    <!--<link rel="stylesheet" href="profilestyler1.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/67c66657c7.js" ></script>
    <script src="script-carousel.js" defer></script>
</head>

<style type="text/css">
   
button.edit{
   margin-left: 180px;
  font-size: 15px;
  padding: 6px 8px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  background-color: var(--main-green);
  color: var(--main-white);
}
button.edit:hover, form input.submit:hover{
  background-color: var(--main-gold);
  color: var(--main-green);
  border: none;
}

/* Style for pop-up */
        .popup {
            /* Your popup styles */
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 50px;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 400px;
            transition: opacity 0.3s ease;
        }

        /* Style for overlay */
        .overlays {
            /* Your overlay styles */
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            transition: opacity 0.3s ease;
        }

                .popup11 {
            /* Your popup styles */
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 50px;
            z-index: 9999;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 400px;
            transition: opacity 0.3s ease;
        }

        /* Style for overlay */
        .overlays11 {
            /* Your overlay styles */
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            transition: opacity 0.3s ease;
        }

        /* Your other styles */

        /* Style for close button */
        .close {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }

        .close11 {
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
        }

        form input:not(.submit){
            border: solid 1px;
            border-radius: 5px;
            padding: 2px;
            max-width: 250px;
            resize: none;
        }form textarea{
            border: solid 1px;
            border-radius: 5px;
            padding: 2px;
            max-width: 300px;
            resize: none;
        }
        form input.submit{
  font-size: 15px;
  padding: 6px 8px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  background-color: var(--main-green);
  color: var(--main-white);
        }

        button.register{
         margin-left: 520px;
transform: translateY(100px);
font-size: 18px;
padding: 12px 16px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  background-color: var(--main-green);
  color: var(--main-white);
        }

        button.register:hover{
         background-color: var(--main-gold);
  color: var(--main-green);
  border: none;
        }
</style>
   

<body>

<?php 
   include 'sidebar.php';
   include_once 'dbmodify.php';
   $user = getUser($conn, $ids);
   $username = $user["userName"];
   $firstname = $user['firstName'];
   $surname = $user['sirName'];
   $phone = $user['contactNumber'];
   $studentid = $user['studentID'];
   $email = $user['email'];
   $password = "********";
   $bio = $user['bio'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = htmlspecialchars($_POST["username"]);
    $firstname = htmlspecialchars($_POST["firstname"]);
    $surname = htmlspecialchars($_POST["surname"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);
    //$password = htmlspecialchars($_["password"]);
    $bio = htmlspecialchars($_POST["bio"]);
    
    updateUser($conn,$ids,$username,$firstname,$surname,$phone,$email,$bio);
}
?>

<!-- START OF PROFILE -->

<section class="section about-section gray-bg" id="about" style="padding-top: 30px">
   <div class="container">
      <div class="row align-items-center flex-row-reverse" style="margin-top: 10px;margin-bottom: 10px;">
         <div class="col-lg-6" style="transform: translateX(-30px);">
            <div class="about-text go-to">
               <h4> About Me </h4>
            
            <!-- Profile Details-->   
               <h6> Bio </h6>
                  <p id="bio"><?php echo $bio; ?></p>
               
               <div class="row about-list">
                  <div class="col-md-6">
                     <div class="media">
                        <label>Username</label>
                        <p><?php echo $username; ?></p>
                     </div>
                     <div class="media">
                        <label>First Name</label>
                        <p><?php echo $firstname; ?></p>
                     </div>
                     <div class="media">
                        <label>Surname</label>
                        <p><?php echo $surname; ?></p>
                     </div>
                     <div class="media">
                        <label>Phone No.</label>
                        <p><?php echo $phone; ?></p>
                     </div>
                  </div>
                  
                  <div class="col-md-6" style="transform: translateX(-40px);">
                     <div class="media">
                        <label>Student ID</label>
                        <p><?php echo $studentid; ?></p>
                     </div>
                     <div class="media">
                        <label>E-mail</label>
                        <p><?php echo $email; ?></p>
                     </div>
                     <div class="media">
                        <label>Password</label>
                     <p><mark>********</mark></p>
                     </div>
                     <div class="media">
                        <button class="edit" onclick="openPopup()">Edit Profile</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      
      <!-- Profile Picture-->
         <div class="col-lg-6">
            <div class="about-avatar">
                  <img src="user (1).png" title="" alt="" width="250px" height="250px" style="
                  transform: translate(-40px,-20px);">
            </div>
         </div>
      </div>
   </div>
</section>

<!-- EDIT PEROSNAL INFORMATION -->

<div id="popup" class="popup">
   <span class="close" onclick="closePopup()">&times;</span>
   <h2>Personal Information</h2>
   <hr>
   <form id="editForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?ids=<?php echo $ids;?>">
      
      Username: &nbsp; <input type="text" id="username" name="username" value="<?php echo $username; ?>" style="transform: translateX(10px);"><br><br>
      First name: &nbsp; <input type="text" id="firstname" name="firstname" value="<?php echo $firstname; ?>" style="transform: translateX(7px)";><br><br>
      Surname: &nbsp; <input type="text" id="surname" name="surname" value="<?php echo $surname; ?>" style="transform: translateX(19px);"><br><br>
      Phone No.: &nbsp; <input type="number" id="phone" name="phone" value="<?php echo $phone; ?>" style="transform: translateX(9px);"><br><br>
      E-mail: &nbsp; <input type="email" id="email" name="email" value="<?php echo $email; ?>" style="transform: translateX(38px);"><br><br>
      Bio: &nbsp;  <textarea id="bio" name="bio" rows="4" cols="50"><?php echo $bio; ?></textarea><br><br>
      <center><input type="submit" class="submit" value="Submit"></center>
   
   </form>
</div>

<!-- Overlay -->
<div id="overlays" class="overlays"></div>

<!-- NAVBAR OF PROFILE -->

<nav class="profile">
   <a href="javascript:void(0)" id="myshop" onclick="navi(1)">My Shop</a>
   <a href="javascript:void(0)" id="likes" onclick="navi(2)">Likes</a>
   <a href="javascript:void(0)" id="cart" onclick="navi(3)">Cart</a>
   <a href="javascript:void(0)" id="transaction" onclick="navi(4)">Transaction</a>
   <div class="animation start-home"></div>
</nav>

<!-- MY SHOP -->

<div id="mys" class="mys" style="margin-left: 100px;">
   
   
   <?php 
      $_isShop = isUserSeller($conn, $ids);
      
      if($_isShop == false){
         echo "<button class='register' onclick='openPopup11()'> Register now as Seller! </button>";
         echo "<center><i> Still no shop yet!</i></center>";
         ?>

   <div id="popup11" class="popup11">
      <span class="close11" onclick="closePopup11()">&times;</span>
      <h2> Register as Seller </h2>
      <hr>
      <form id="regseller" method="post" action="insertSeller.php?ids=<?php echo $ids ?>">

         Shop Name: &nbsp; <input type="text" id="shopname" name="shopname" required><br><br>
         Shop Description: &nsbp; <textarea id="desc" name="desc" rows="4" cols="50" required></textarea>
         Business Permit: &nbsp; <input type="file" accept=".jpg, .jpeg,.png" required>
         <center><input type="submit" class="submit" value="Submit"></center>
      </form>
   </div>
<div id="overlays11" class="overlays11"></div>
   <?php
      }
      else{
         $_sellerID = getSellerUser($conn, $ids)['sellerID'];
   ?>
   <br>
   <iframe id="myFrame" src="profile.php?id=<?php echo $_sellerID;?>" frameborder="0" width="100%" height="1000px"></iframe>
   <?php

   }

   ?>
</div>


<!-- LIKES -->

<div id="lik" class="lik">
   
   <h1> LIKES </h1>

</div>


<!-- CART -->

<div id="car" class="car">
   
   <h1> CART </h1>

</div>


<!-- TRANSACTION -->

<div id="tra" class="tra">
   
   <h1> TRANSACTION </h1>

</div>

</body>


<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">    

  function navi(on){
      if(on==1){
         document.getElementById("mys").style.display = "block";
         document.getElementById("lik").style.display = "none";
         document.getElementById("car").style.display = "none";
         document.getElementById("tra").style.display = "none";
        var elements = document.querySelectorAll("a:nth-child(1)~.animation");
        elements.forEach(function(element){
          element.style.left="0px";
        });

        var elements1 = document.querySelectorAll("nav.profile a:nth-child(1)");
        elements1.forEach(function(element1){
          element1.style.color="var(--main-white)";
        });

        var elements2 = document.querySelectorAll("nav.profile a:nth-child(2),nav.profile a:nth-child(3),nav.profile a:nth-child(4)");
        elements2.forEach(function(element2){
          element2.style.color="var(--main-green)";
        });
      }else if(on==2){
         document.getElementById("mys").style.display = "none";
         document.getElementById("lik").style.display = "inline-block";
         document.getElementById("car").style.display = "none";
         document.getElementById("tra").style.display = "none";
        var elements = document.querySelectorAll("a:nth-child(1)~.animation");
        elements.forEach(function(element){
          element.style.left="200px";
        });

         var elements1 = document.querySelectorAll("nav.profile a:nth-child(2)");
        elements1.forEach(function(element1){
          element1.style.color="var(--main-white)";
        });

          var elements2 = document.querySelectorAll("nav.profile a:nth-child(1),nav.profile a:nth-child(3),nav.profile a:nth-child(4)");
        elements2.forEach(function(element2){
          element2.style.color="var(--main-green)";
        });

      }else if(on==3){
         document.getElementById("mys").style.display = "none";
         document.getElementById("lik").style.display = "none";
         document.getElementById("car").style.display = "inline-block";
         document.getElementById("tra").style.display = "none";
        var elements = document.querySelectorAll("a:nth-child(1)~.animation");
        elements.forEach(function(element){
          element.style.left="400px";
        });

        var elements1 = document.querySelectorAll("nav.profile a:nth-child(3)");
        elements1.forEach(function(element1){
          element1.style.color="var(--main-white)";
        });
        
          var elements2 = document.querySelectorAll("nav.profile a:nth-child(1),nav.profile a:nth-child(2),nav.profile a:nth-child(4)");
        elements2.forEach(function(element2){
          element2.style.color="var(--main-green)";
        });
      }else if (on==4){
         document.getElementById("mys").style.display = "none";
         document.getElementById("lik").style.display = "none";
         document.getElementById("car").style.display = "none";
         document.getElementById("tra").style.display = "inline-block";
        var elements = document.querySelectorAll("a:nth-child(1)~.animation");
        elements.forEach(function(element){
          element.style.left="600px";
        });

        var elements1 = document.querySelectorAll("nav.profile a:nth-child(4)");
        elements1.forEach(function(element1){
          element1.style.color="var(--main-white)";
        });
        
          var elements2 = document.querySelectorAll("nav.profile a:nth-child(1),nav.profile a:nth-child(2),nav.profile a:nth-child(3)");
        elements2.forEach(function(element2){
          element2.style.color="var(--main-green)";
        });
      }
    }

   // Function to open pop-up
   function openPopup() {
      document.getElementById("popup").style.display = "block";
      document.getElementById("overlays").style.display = "block";
   }

   // Function to close pop-up
   function closePopup() {
      document.getElementById("popup").style.display = "none";
      document.getElementById("overlays").style.display = "none";
   }

    // Function to open pop-up
   function openPopup11() {
      document.getElementById("popup11").style.display = "block";
      document.getElementById("overlays11").style.display = "block";
   }

   // Function to close pop-up
   function closePopup11() {
      document.getElementById("popup11").style.display = "none";
      document.getElementById("overlays11").style.display = "none";
   }


   document.addEventListener("DOMContentLoaded", function() {
        var iframe = document.getElementById("myFrame");
        iframe.onload = function() {
            var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            var elementsToRemove = iframeDoc.getElementsByClassName("remove-me");
            for (var i = 0; i < elementsToRemove.length; i++) {
                elementsToRemove[i].parentNode.removeChild(elementsToRemove[i]);
            }
        };
    });


</script>

</html>