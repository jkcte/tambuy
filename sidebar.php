<?php
include_once 'transact.php';
$ids = isset($_GET['ids']) ? $_GET['ids'] : '';
$carts = getCart($connect)['cart'];

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'clearall') {
        deleteCart($connect);
        //header('Location : foodlistings.php');
    }
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] == $_GET['id']) {
                deleteCartItem($connect, $_GET['id']);
                //header('Location : foodlistings.php');
            }   
        }
    }
    if ($_GET['action'] == 'increase'){
        adjustQuantity($connect, $_GET['prodID'], 1);
        header('Location: ' . $_SERVER['PHP_SELF'] . '?ids=' .$ids);
    }
    if ($_GET['action'] == 'decrease'){
        adjustQuantity($connect, $_GET['prodID'], -1);
        header('Location: ' . $_SERVER['PHP_SELF'] . '?ids=' .$ids);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/67c66657c7.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="sidebar">
        <ul class="nav_list">
            <li>
                <a href="index.php?ids=<?php echo $ids; ?>&id=<?php echo $data;?>">
                    <i class='bx bxs-home'></i>
                    <span class="tooltip">Home</span>
                </a>
            </li>
            <li>
            <?php if(isset($userLoggedin) && ($userLoggedin)){?>
                <a href="profile-demo.php?ids=<?php echo $ids; ?>">
                    <i class='bx bx-user'></i>
                    <span class="tooltip">Profile</span>
                </a>
            <?php }?>
            </li>
            <li>
                <a href="shoplist.php?ids=<?php echo $ids; ?>">
                    <i class='bx bx-store'></i>
                    <span class="tooltip">Shops</span>
                </a>
            </li>
            <li></li>
            <li></li>
            <li>
            <?php if(isset($userLoggedin) && ($userLoggedin)){?>
                <button id="open_cart_btn">
                    <i class='bx bx-cart-alt'></i>
                </button>
                <span class="tooltip">Cart</span>
            <?php }?>
            </li>
            <li></li>
            <li></li>
            <li>
                <a href="">
                    <i class='bx bx-file' ></i>
                    <span class="tooltip">Reports</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa-regular fa-address-card"></i>
                    <span class="tooltip">About Us</span>
                </a>
            </li>
        </ul>
        <div class="log_out">
        <?php if(!isset($userLoggedin) || empty($userLoggedin)){?>
            <a href="login.php"><i class='bx bx-log-in' id="log_in"></i></a>
        <?php
        }else{?>
            <a href="logout.php"><i class='bx bx-log-out' id="log_out"></i></a>
        <?php }?>
        </div>
    </div>
    <div class="overlay" id="overlay"></div>
    <div class="sidecart" id="sidecart">
        <div class='cart_content'>
            <div class='cart_header'>
                <i class='bx bx-cart-alt' style='font-size: 30px; color: var(--main-black);'></i>
                <div class='header_title'>
                    <h2>Your Cart</h2>
                </div>
                <span id='close_btn' class='close_btn'>&times;</span>
            </div>
        <?php
        // $uri = $_SERVER['REQUEST_URI'];
        // $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        // $query_server = $_SERVER['QUERY_STRING'];
        $total = 0;
        $output = "";
        if (!empty($carts)) {
            foreach ($carts as $key) {
                $output .= "
                    <div class='cart_items'>
                        <div class='cart_item'>
                            <div class='remove_item'>
                                <a href='?action=remove&id=".$key['productID']."&ids=".$ids."&id=".$data."'>
                                    <span>&times;</span>
                                </a>
                            </div>
                            <div class='item_img'>
                            <img src= 'tambuys-icon-gold.png' class='imgsize'>
                            </div>
                            <div class='item_details'>
                                <p>".$key['productName']."</p>
                                <strong>₱".$key['price']."</strong>
                                <div class='qty'>
                                    <a href='?action=decrease&prodID=". $key['productID'] . "&ids=".$ids."&id=".$data."'>
                                    <span class='decreaseQty' data-id='".$key['productID']."'>-</span>
                                    </a>
                                    <strong class='qtyValue' id='qty_".$key['productID']."'>".$key['quantity']."</strong>
                                    <a href='?action=increase&prodID=". $key['productID'] . "&ids=".$ids."&id=".$data."'>
                                    <span class='increaseQty' data-id='".$key['productID']."'>+</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>";
            }

            $output .= "
                <div class='cart_actions'>
                    <div class='subtotal'>
                        <p>Total</p>
                        <p>₱<span id='subtotal-price'>".number_format(getCart($connect)['sum'],2)."</span></p>
                    </div>
                    <a href='order-summary.php?ids=".$ids."&id=".$data."'><button>Order Summary <i class='fa-solid fa-arrow-right'></i></button></a>
                    <a href='?action=clearall&ids=".$ids."&id=".$data."'>
                        <button>Clear All</button>
                    </a>
                </div>
            ";
        }
        echo $output;
        ?>

        </div>
    </div>

</body>
<script src="script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const decreaseButtons = document.querySelectorAll('.decreaseQty');
    const increaseButtons = document.querySelectorAll('.increaseQty');

    decreaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            const qtyElement = document.getElementById('qty_' + itemId);
            let quantity = parseInt(qtyElement.textContent);
            if (quantity > 1) {
                quantity--;
                qtyElement.textContent = quantity;
                updateTotal();
            }
        });
    });
    increaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            const qtyElement = document.getElementById('qty_' + itemId);
            let quantity = parseInt(qtyElement.textContent);
            quantity++;
            qtyElement.textContent = quantity;
            updateTotal();
        });
    });
    function updateTotal() {
        let total = 0;
        const items = document.querySelectorAll('.cart_item');
        items.forEach(item => {
            const price = parseFloat(item.querySelector('.item_details strong').textContent.replace('₱', ''));
            const quantity = parseInt(item.querySelector('.qtyValue').textContent);
            total += price * quantity;
        });
        document.getElementById('subtotal-price').textContent = total.toFixed(2);
    }
    
    // Initial total calculation on page load
    updateTotal();
});
</script>
</html>