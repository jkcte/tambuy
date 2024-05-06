<?php

require_once 'dbhandler.php';


function insertToCart($connect, $image, $productID, $quantity, $productName, $price, $sellerID, $userID){
  $query = "INSERT INTO `cart` (`image`, `productID`, `quantity`, `productName`, `price`, `userID`, `sellerID`) VALUES (?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "biisdii", $image, $productID, $quantity, $productName, $price, $userID, $sellerID);
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
}

function getSellerUser($connect, $userID){
  $query = "SELECT sellerID FROM sellers WHERE userID = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
  }
  return $result;
}

function deleteCartItem($connect, $productID){
  $query = "DELETE FROM `cart` WHERE productID = ?";
  $stmt = mysqli_prepare($connect, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($connect));
  }

  // Bind parameters and execute the statement
  mysqli_stmt_bind_param($stmt, 'i', $productID);
  if (mysqli_stmt_execute($stmt)) {
      return 'Product deleted successfully.';
  } else {
      return 'Error deleting product: ' . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}

function deleteCart($connect){
  $query = "TRUNCATE `cart`;";
  $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
}

function getCart($connect){
  $query = "SELECT * FROM `cart`;";
  $stmt = mysqli_stmt_init($connect);
  $total = 0;
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    $result = array();
    while($row = mysqli_fetch_assoc($resultSet)) {
      $result[] = $row;
    }
    foreach ($result as $row) {
      $total += $row['price'];
    }
    mysqli_stmt_close($stmt);
  }
  $returnee =array(
    "cart" => $result,
    "sum" => $total
  );
  return $returnee;
}

function getItemFromCart($connect, $productID){
  $query = "SELECT * FROM `cart` WHERE productID = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "i", $productID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
      mysqli_stmt_close($stmt);
    }
    return $result;
}


function adjustQuantity($connect, $productID, $function){
  $item = getItemFromCart($connect, $productID)['quantity'];
  $query = "UPDATE cart SET quantity = ? WHERE productID = ?;";
  $stmt = mysqli_stmt_init($connect);
  $newQty = $item + $function;
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "ii", $newQty, $productID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
}

#inserts
function insertUser($connect, string $userName, $firstName, $sirName, $contactNumber, string $studentID, $studentEmail, string $password, string $profilePicture, string $bio) {
    $query = "INSERT INTO `user` (`userName`, `firstName`, `sirName`, `contactNumber`, `studentID`, `studentEmail`, `password`, `profilePicture`, `bio`) VALUES (?, ?, ?, ? ,? ,? ,? ,? ,?);";
    $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "sssiisssbs", $userName, $firstName, $sirName, $contactNumber, $studentID, $studentEmail, $password, $profilePicture, $bio);
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
    return $result && $isAffected === 1;
  }

function insertSeller($connect, $userID, string $shopName, string $description) {
    $query = "INSERT INTO `sellers` (`userID`,`shopName`, `description`, `verified`, `averageRating`) VALUES (?, ?, ?, 0, 0);";
    $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "iss",$userID, $shopName, $description);
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
    return $result && $isAffected === 1;
  }

function insertProduct($connect, $sellerID, $productName, $image, $description, $stocks, $price, $tags){
  $query = "INSERT INTO `product` (`sellerID`, `productName`, `image`, `description`, `stocks`, `price`, `tags`, averageRating) VALUES (?, ?, ?, ?, ?, ?, ?, 0);";
  $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "isbsids", $sellerID, $productName, $image, $description, $stocks, $price, $tags);
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
    return $result && $isAffected === 1;
}

function insertTransaction($connect, $userID){
  $query = "INSERT INTO `transactions` (`userID`, `status`) VALUES (?, \"on hold\");";
  $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "i", $userID);
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
    return $result;
}

function insertRating($connect, $type, $userID, $ID, $rate){
  if ($type == "product") $query = "INSERT INTO `ratinghistory` ('productOrSeller', 'userID', 'productID', 'rate') VALUES (?, ?, ?, ?);";
  if ($type == "seller") $query = "INSERT INTO `ratinghistory` ('productOrSeller', 'userID', 'sellerID', 'rate') VALUES (?, ?, ?, ?);";

  $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "siii", $type, $userID, $ID, $rate);
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
    return $result && $isAffected === 1;
}

function insertProductTransaction($connect, $productID, $quantity, $transactionID, $sellerID){
  $query = "INSERT INTO `producthistory`(`productID`, `quantity`, `transactionID`, `sellerID`) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "iiii", $productID, $quantity, $transactionID, $sellerID);
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
    return $result && $isAffected === 1;
}

function insertChangeTransaction($connect, $transactionID, $previousStatus, $currentStatus){
  $query = "INSERT INTO `clicks` (`transactionID`, `previousStatus`, `currentStatus`) VALUES (?, ?)";
  $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "iss", $transactionID, $previousStatus, $currentStatus);
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
    return $result && $isAffected === 1;
}

function insertClick($connect, $productID, $userID){
  $query = "INSERT INTO clicks (productID, userID) VALUES (?, ?)";
  $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "ii", $productID, $userID);
      $result = mysqli_stmt_execute($stmt);
      $isAffected = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
    }
    return $result && $isAffected === 1;
}

function GetUser($connect, string $userID) {
  $query = "SELECT * FROM `user` WHERE `userID` = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
  }
  return $result;
}

function getUserID($connect, string $userName) {
  //Template Query
  $query = "SELECT `*` FROM `user` WHERE `userID` = ?;";
  //Create Prep stmt
  $stmt = mysqli_stmt_init($connect);
  //Prep prepared stmt
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    //Bind parameters to placeholder
    mysqli_stmt_bind_param($stmt, "s", $userName);
    // Run parameters inside the datbase
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
  }
  return $result;
}

#Update
function updateProductRatings($connect, $userID, $productID, $rate){
  $query ="UPDATE product_ratings SET rate = ? WHERE USERID = ? AND product_id = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "iss", $rate, $userID, $productID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
  }
}

function updateUser($conn, $userID, $username, $firstname, $surname, $contactNumber, $email, $bio) {
  // Sanitize inputs
  $username = mysqli_real_escape_string($conn, $username);
  $firstname = mysqli_real_escape_string($conn, $firstname);
  $surname = mysqli_real_escape_string($conn, $surname);
  $contactNumber = mysqli_real_escape_string($conn, $contactNumber);
  $email = mysqli_real_escape_string($conn, $email);
  $studentID = explode("@", $email);
  //$password = password_hash($password, PASSWORD_DEFAULT); // Hashing the password
  //$profilePicture = mysqli_real_escape_string($conn, $profilePicture);
  $bio = mysqli_real_escape_string($conn, $bio);

  // Prepare the SQL statement
  $query = "UPDATE user SET username=?, firstName=?, sirName=?, contactNumber=?, studentID = ?, email=?, bio=? WHERE userID=?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($conn));
  }

  // Bind parameters and execute the statement
  mysqli_stmt_bind_param($stmt, 'sssiissi', $username, $firstname, $surname, $contactNumber, $studentID[0], $email, $bio, $userID);
  if (mysqli_stmt_execute($stmt)) {
      if (mysqli_stmt_affected_rows($stmt) > 0) {
          return 'User updated successfully.';
      } else {
          return 'No changes made or user not found.';
      }
  } else {
      return 'Error updating user: ' . mysqli_stmt_error($stmt);
  }
}

function updateSeller($conn, $sellerID, $shopName, $contactDetails, $contactNumber, $socialMedia1, $socialMedia2, $socialMedia3, $description) {
  // Sanitize inputs
  $shopName = mysqli_real_escape_string($conn, $shopName);
  $contactDetails = mysqli_real_escape_string($conn, $contactDetails);
  $contactNumber = mysqli_real_escape_string($conn, $contactNumber);
  $socialMedia1 = mysqli_real_escape_string($conn, $socialMedia1);
  $socialMedia2 = mysqli_real_escape_string($conn, $socialMedia2);
  $socialMedia3 = mysqli_real_escape_string($conn, $socialMedia3);
  $description = mysqli_real_escape_string($conn, $description);

  // Prepare the SQL statement
  $query = "UPDATE sellers SET shopName=?, contactDetails=?, contactNumber=?, socialMedia1=?, socialMedia2=?, socialMedia3=?, description=? WHERE sellerID=?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($conn));
  }

  // Bind parameters and execute the statement
  mysqli_stmt_bind_param($stmt, 'sssssssi', $shopName, $contactDetails, $contactNumber, $socialMedia1, $socialMedia2, $socialMedia3, $description, $sellerID);
  if (mysqli_stmt_execute($stmt)) {
      if (mysqli_stmt_affected_rows($stmt) > 0) {
          return 'Seller updated successfully.';
      } else {
          return 'No changes made or seller not found.';
      }
  } else {
      return 'Error updating seller: ' . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}

function updateSellerVerification($conn, $sellerID, $verified) {
  $query = "UPDATE sellers SET verified=? WHERE sellerID=?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($conn));
  }

  // Bind parameters and execute
  mysqli_stmt_bind_param($stmt, 'ii', $verified, $sellerID);
  if (mysqli_stmt_execute($stmt)) {
      return 'Verification status updated successfully.';
  } else {
      return 'Error updating verification status: ' . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}

function updateProduct($conn, $productID, $image, $description, $tags, $price) {
  // Sanitize inputs
  $image = mysqli_real_escape_string($conn, $image);
  $description = mysqli_real_escape_string($conn, $description);
  $tags = mysqli_real_escape_string($conn, $tags);
  $price = floatval($price);  // Ensuring price is treated as a float

  // Prepare the SQL statement
  $query = "UPDATE products SET image=?, description=?, tags=?, price=? WHERE productID=?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($conn));
  }

  // Bind parameters and execute the statement
  mysqli_stmt_bind_param($stmt, 'ssssi', $image, $description, $tags, $price, $productID);
  if (mysqli_stmt_execute($stmt)) {
      if (mysqli_stmt_affected_rows($stmt) > 0) {
          return 'Product updated successfully.';
      } else {
          return 'No changes made or product not found.';
      }
  } else {
      return 'Error updating product: ' . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}

function updateProductStock($conn, $productID, $stocks) {
  $stocks = intval($stocks);  // Ensuring stocks are treated as an integer

  // Prepare the SQL statement
  $query = "UPDATE products SET stocks=? WHERE productID=?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($conn));
  }

  // Bind parameters and execute
  mysqli_stmt_bind_param($stmt, 'ii', $stocks, $productID);
  if (mysqli_stmt_execute($stmt)) {
      return 'Stock updated successfully.';
  } else {
      return 'Error updating stock: ' . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}

function updateTransactionStatus($conn, $transactionID, $status) {
  // Sanitize inputs
  $status = mysqli_real_escape_string($conn, $status);

  // Prepare the SQL statement
  $query = "UPDATE transactions SET status=? WHERE transactionID=?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($conn));
  }

  // Bind parameters and execute the statement
  mysqli_stmt_bind_param($stmt, 'si', $status, $transactionID);
  if (mysqli_stmt_execute($stmt)) {
      if (mysqli_stmt_affected_rows($stmt) > 0) {
          return 'Transaction status updated successfully.';
      } else {
          return 'No changes made or transaction not found.';
      }
  } else {
      return 'Error updating transaction status: ' . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}

#delete
function deleteUser($conn, $userID) {
  // Prepare the SQL statement
  $query = "DELETE FROM users WHERE userID = ?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($conn));
  }

  // Bind parameters and execute the statement
  mysqli_stmt_bind_param($stmt, 'i', $userID);
  if (mysqli_stmt_execute($stmt)) {
      return 'User deleted successfully.';
  } else {
      return 'Error deleting user: ' . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}

function deleteSeller($conn, $sellerID) {
  // Prepare the SQL statement
  $query = "DELETE FROM sellers WHERE sellerID = ?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($conn));
  }

  // Bind parameters and execute the statement
  mysqli_stmt_bind_param($stmt, 'i', $sellerID);
  if (mysqli_stmt_execute($stmt)) {
      return 'Seller deleted successfully.';
  } else {
      return 'Error deleting seller: ' . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}

function deleteProduct($conn, $productID) {
  // Prepare the SQL statement
  $query = "DELETE FROM products WHERE productID = ?";
  $stmt = mysqli_prepare($conn, $query);
  if (!$stmt) {
      die('MySQL prepare error: ' . mysqli_error($conn));
  }

  // Bind parameters and execute the statement
  mysqli_stmt_bind_param($stmt, 'i', $productID);
  if (mysqli_stmt_execute($stmt)) {
      return 'Product deleted successfully.';
  } else {
      return 'Error deleting product: ' . mysqli_stmt_error($stmt);
  }

  // Close the statement
  mysqli_stmt_close($stmt);
}


#get
function GetUsername($connect, string $userName) {
  $query = "SELECT `userName` FROM `user` WHERE `userName` = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
  }
  return $result;
}

function getAmountUsers($connect){
  $query = "SELECT COUNT(userID) FROM user";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
      die('MySQL prepare error: ' . mysqli_error($connect));
  }
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  return $result;
}

function getStudentID($connect, string $userName) {
  $query = "SELECT `studentID` FROM `user` WHERE `userName` = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "s", $studentID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
  }
  return $result;
}

function getPassword($connect, string $username) {
  $query = "SELECT `password` FROM `user` WHERE `userName` = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    mysqli_stmt_close($stmt);
  }
  return $result;
}

function getSeller($connect, string $sellerID) {
    $query = "SELECT * FROM `sellers` WHERE `sellerID` = ?;";
    $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "i", $sellerID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
      mysqli_stmt_close($stmt);
    }
    return $result;
  }

function isUserSeller($connect, $userID){
  $query = "SELECT COUNT(userID) FROM sellers WHERE userID = ?;";
  $stmt = mysqli_stmt_init($connect);
  $bool = false;
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "i", $userID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
      mysqli_stmt_close($stmt);
    }
    if ($result['COUNT(userID)'] != 0) $bool = true;
    return $bool;
  }

function getProduct($connect, string $sellerID) {
  $query = "SELECT * FROM `product` WHERE `sellerID` = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "s", $sellerID);
    mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    $result = array();
    while($row = mysqli_fetch_assoc($resultSet)) {
      $result[] = $row;
    }
    mysqli_stmt_close($stmt);
  }
  return $result;
}

function getProductfromID($connect, string $productID) {
  $query = "SELECT * FROM `product` WHERE `productID` = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "s", $productID);
    mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    $result = array();
    while($row = mysqli_fetch_assoc($resultSet)) {
      $result[] = $row;
    }
    mysqli_stmt_close($stmt);
  }
  return $result;
}



function getUserTransaction($connect, string $userID) {
  $query = "SELECT * FROM `transactions` WHERE `userID` = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    $result = array();
    while($row = mysqli_fetch_assoc($resultSet)) {
      $result[] = $row;
    }
    mysqli_stmt_close($stmt);
  }
  return $result;
}

// function getSellerTransaction($connect, string $userID) {
//   $query = "SELECT * FROM transactions WHERE sellerID = ?;";
//   $stmt = mysqli_stmt_init($connect);
//   if (!mysqli_stmt_prepare($stmt, $query)) {
//     echo "Error: " . mysqli_error($connect);
//   } else {
//     mysqli_stmt_bind_param($stmt, "s", $userID);
//     mysqli_stmt_execute($stmt);
//     $resultSet = mysqli_stmt_get_result($stmt);
//     $result = array();
//     while($row = mysqli_fetch_assoc($resultSet)) {
//       $result[] = $row;
//     }
//     mysqli_stmt_close($stmt);
//   }
//   return $result;
// }

function getTransaction($connect, string $transactionID){
  $query = "SELECT * FROM 'transactions' WHERE 'transactionID' = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query))
    echo "Error: " . mysqli_error($connect);
  else {
    mysqli_stmt_bind_param($stmt, "s", $transactionID);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
  }
  return $results;
}

function getItemsPerTransaction($connect, string $transactionID){
  $query = "SELECT * FROM 'producthistory' WHERE 'productTransactionID' = ?;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query))
    echo "Error: " . mysqli_error($connect);
  else {
    mysqli_stmt_bind_param($stmt, "s", $transactionID);
    mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    $result = array();
    while($row = mysqli_fetch_assoc($resultSet)) {
      $result[] = $row;
    }
  }
  return $result;
}

function getProductRatings($connect, $productID){
  $query = "SELECT * FROM `ratinghistory` WHERE `productID` = ? AND `productOrSeller` = \"product\";";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "i", $productID);
    mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    $result = array();
    $average = 0;
    while ($row = mysqli_fetch_assoc($resultSet)) {
      $result[] = $row['rate'];
    }
    foreach($result as $rate){
      $average += $rate;
    }
    if (count($result) != 0) $average = $average/count($result);
    else $average = 0;
    
  }
  return $average;
}

function getSellerRatings($connect, $productID){
  $query = "SELECT * FROM `ratinghistory` WHERE `sellerID` = ? AND `productOrSeller` = \"seller\";";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "i", $productID);
    mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    $result = array();
    $average = 0;
    while ($row = mysqli_fetch_assoc($resultSet)) {
      $result[] = $row['rate'];
    }
    foreach($result as $rate){
      $average += $rate;
    }
    if (count($result) != 0) $average = $average/count($result);
    else $average = 0;
    
  }
  return $average;
}

function getClassificationRatings($connect, $productID){
  $rainingInManila = array(
    "retractors" => 0,
    "promoter" => 0
  );
  $query = "SELECT * FROM `ratinghistory` WHERE `sellerID` = ? AND `productOrSeller` = \"product\";";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "i", $productID);
    mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    $result = array();
    $average = 0;
    while ($row = mysqli_fetch_assoc($resultSet)) {
      if ($row['rate']> 3) $rainingInManila["promoter"] += 1;
      else if ($row['rate']<3) $rainingInManila["retractors"] +=1;
    }

  }
  return $rainingInManila;

}

function getClicks($connect, $productID){
  $query = "SELECT * FROM `ratinghistory` WHERE `sellerID` = ? AND `productOrSeller` = \"product\";";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    echo "Error: " . mysqli_error($connect);
  } else {
    mysqli_stmt_bind_param($stmt, "i", $productID);
    mysqli_stmt_execute($stmt);
    $resultSet = mysqli_stmt_get_result($stmt);
    $result = array();
    $average = 0;
    while ($row = mysqli_fetch_assoc($resultSet)) {
      $result[] = $row['userID'];
  
    }
    $newComers = array_unique($result);
    $disc = array(
      "newUsers" => count($newComers),
      "users" => count($result)
    );
  }
  return $disc;
}





?>