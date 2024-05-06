<?php

$dbServername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'shoppy-2'; 

// Connect

$connect = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!$connect){
    die("Connection failed: " . mysqli_connect_error());
}