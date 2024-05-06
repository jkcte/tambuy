<?php

@include 'config.php';
include_once 'dbModify.php';

session_start();
session_unset();
session_destroy();

header('location:login.php');

deleteCart($conn);

?>