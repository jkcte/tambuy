<?php

include_once 'config.php';
include 'dbModify.php';
$ids = isset($_GET['ids']) ? $_GET['ids'] : '';

if (isset($_POST['add_to_cart'])) {
    insertClick($connect,$_GET['id'],$ids);
    insertToCart($connect, $_POST['image'], $_GET['id'], $_POST['quantity'], $_POST['name'], $_POST['price'], $_POST['sellerID'], $ids);
    if (isset($_SESSION['cart'])) {
        $session_array_id = array_column($_SESSION['cart'], "id");

        if (!in_array($_GET['id'], $session_array_id)) {
            $session_array = array(
                'id' => $_GET['id'],
                "name" => $_POST['name'],
                "sellerID" => $_POST['sellerID'],
                "price" => $_POST['price'],
                "quantity" => $_POST['quantity'],
                "image" => $_POST['image']
            );
            $_SESSION['cart'][] = $session_array;
        }
    }else{
        $session_array = array(
            'id' => $_GET['id'],
            "name" => $_POST['name'],
            "sellerID" => $_POST['sellerID'],
            "price" => $_POST['price'],
            "quantity" => $_POST['quantity'],
            "image" => $_POST['image']
        );
        $_SESSION['cart'][] = $session_array;
    }
}

?>