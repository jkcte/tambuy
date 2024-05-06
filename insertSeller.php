<?php
@include 'config.php';
session_start();
$ids = isset($_GET['ids']) ? $_GET['ids'] : '';
$userLoggedin =TRUE;
// checking kung naka login
if(!isset($_SESSION['userName'])){
   $userLoggedin = FALSE;
 }
	include_once "dbModify.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $shopname = htmlspecialchars($_POST["shopname"]);
    $description = htmlspecialchars($_POST["desc"]);
    
    insertSeller($conn,$ids,$shopname,$description);
}

	header("location:profile-demo.php?ids=$ids");
	exit();
?>
