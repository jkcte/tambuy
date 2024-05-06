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
    <link rel="stylesheet" href="style/profilestyler1.css">
    <link rel="stylesheet" href="style/misc.css">
    <title>Order Summary</title>
    <style>
    #order_summary {
    border-collapse: collapse;
    width: 100%;
    }

    #order_summary td, #order_summary th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #order_summary tr:nth-child(even){background-color: #f2f2f2;}

    #order_summary tr:hover {background-color: #ddd;}

    #order_summary th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #005200;
    color: white;
    }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
<div class="main_content">
    <div class="body-text">
        <h3>Order Summary</h3>
        <div>
            <table id="order_summary" rules="none">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <!-- <th>Seller</th> -->
                <th>Seller</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php
            $query_cart = "SELECT * FROM cart";
            $result_cart = mysqli_query($conn,$query_cart);
            $total = 0;

            while (($row = mysqli_fetch_array($result_cart))) {
                $shopName = getSeller($conn, $row['sellerID'])['shopName'];
                ?>

                <tr>
                    <td><?= $row['productName'] ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $shopName?></td>
                    <td><?= $row['price'] ?></td>
                    <?php $indiv_total = $row['quantity']*$row['price']; ?>
                    <?php $total += $indiv_total ?>
                    <td><?= $indiv_total ?></td>
                </tr>
            <?php }
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'checkout') {
                    $transactionID = insertTransaction($conn, $ids);
                    while (($row = mysqli_fetch_array($result_cart))) {
                        echo "837rhy8q3iuwher98he89gthwh3rngiphwgerhnipo4ersegt  ETO SAGOT!!! ";
                        echo $row['quantity'];
                        insertProductTransaction($conn, $row['productID'], $row['quantity'], $transactionID, $row['sellerID']);
                    }
                }
            }
            ?>
            <tr>
                <td><b>TOTAL</b></td>
                <td><b><?= $total ?></b></td>
            </tr>
            </table>
        </div>
        <div class="cart_actions">
            <a href='index.php?action=checkout&ids=<?php echo $ids; ?>'><button>Check Out <i class='fa-solid fa-arrow-right'></i></button></a>
        </div>
    </div>
</div>

</body>
<html>