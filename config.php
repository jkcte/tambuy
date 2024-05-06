<?php
$conn = mysqli_connect('localhost','root','','shoppy-2');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
 }

    $username = test_input($_POST["userName"]);
    $userID = test_input($_POST["userID"]);
    $studentID = test_input($_POST["studentID"]);
    $email = test_input($_POST["studentEmail"]);
    $password = md5(test_input($_POST["password"]));
    $cpassword = md5(test_input($_POST["cpassword"]));
    $profilePicture = test_input($_POST["profilePicture"]);
?>