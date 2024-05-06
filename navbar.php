<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/67c66657c7.js"></script>
</head>
<body>
    <input type="checkbox" id="check">
    <nav class="navbar">
        <div class="logo">
            <a href="index.php"><img src="assets/tambuys-wordmark-gold.png" alt="logo"/></a>
        </div>
        <div class="search-box">
            <input type="search" placeholder="search for a product...">
            <span class="fa fa-search"></span>
        </div>
        <ul>
            <li class="profile-drop"><a href="#">Profile</a></li> <!-- TEMPORARY FIX ONLY: Di ko lang magawa as of the moment yung ibababa ng dropdown yung content below (while nakasandwich-menu). For now kasi napatong lang siya huhu -->
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Likes</a></li>
            <li>
                <a href="#">Categories <i class="fas fa-caret-down"></i></a>
                <div class="dropdown-menu">
                    <ul>
                        <li><a href="foodlistings.php">Food</a></li>
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">Clothes</a></li>
                        <li><a href="#">Books</a></li>
                        <li><a href="#">Services</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="user-menu">
        <?php if(!isset($userLoggedin) || empty($userLoggedin)){?>
            <li><a href="login.php">Login</a> / <a href="register.php">Signup</a></li><?php
            }else{?>
                <li>Hi, <a href="#"><?php echo $_SESSION["userName"]?></a></li>
                <li class="icon"><a href="#"><img src="img/icons/default-profile.jpg" alt="logo"/></a></li>
                <li><a href="logout.php">Logout</a></li>
                <?php }?>
        
        
        </ul>
        
        <?php if(isset($userLoggedin) && ($userLoggedin)){?>
            <ul>
                <div class="cart-btn">
                    <button id="open_cart_btn">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                </div>
            </ul>
        <?php }?>

        <label for="check" class="bar">
            <span class="fa fa-bars" id="bars"></span>
            <span class="fa fa-times" id="times"></span>
        </label>
    </nav>
    <div class="overlay" id="overlay"></div>
    <div class="sidecart" id="sidecart">
        <div class="cart-content">
            <div class="cart-header">
                <i class="fa-solid fa-cart-shopping" style="font-size: 30px; color: var(--main-black);"></i>
                <div class="header-title">
                    <h2>Your Cart</h2>
                    <span class="items-num">1</span>
                </div>
                <span id="close_btn" class="close_btn">&times;</span>
            </div>
            <div class="cart-items">
                <div class="cart-item">
                    <div class="remove-item">
                        <span>&times;</span>
                    </div>
                    <div class="item-img">
                        <img src="img/product1.jpg" alt="">
                    </div>
                    <div class="item-details">
                        <p>Product Name</p>
                        <strong>₱150.00</strong>
                        <div class="qty">
                            <span>-</span>
                            <strong>1</strong>
                            <span>+</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-actions">
                <div class="subtotal">
                    <p>Total</p>
                    <p>₱<span id="subtotal-price">6969.00</span></p>
                </div>
                <button>Order Summary <i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
    </div>
<script src="script.js"></script>
</body>
</html>