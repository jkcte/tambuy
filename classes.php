<?php

//require_once 'dbhandler.php';
//require_once 'dbModify.php';

class Transact{
  public $productID;
  public $image;
  public $price;
  public $quantity;
  public $productName;

  function __construct($connect, $productID, $image, $price, $quantity, $productName)
  {
    $this->productID = $productID;
    $this->image = $image;
    $this->price = $price;
    $this->quantity = $quantity;
    $this->productName = $productName;
  }
}

class product{
    public $productID;
    public $sellerID;
    public $productName;
    public $image;
    public $description;
    public $price;
    public $stocks;
    public $tags;
    public $arrTags = array();
    
    public $rating = 0;
    public $popularity;
    
    function productRating($connect, $productID){
      $result = getProductRatings($connect, $productID);
      return $result;
    }

    // for creating Tags
    private function createArrTag(string $tags){
      $tags = str_replace(' ', '', $tags);
      $arrTags = explode(',' , $tags);

      return $arrTags;
    }

    public function __construct($connect, $productID, $sellerID, $productName, $image, $description, $stocks, $price, $tags){
      $this->productID = $productID;
      $this->sellerID = $sellerID;
      $this->productName = $productName;

      if ($image == null) $image = 'default.png';
      $this->image = $image;
      
      $this->description = $description;
      $this->price = $price;
      $this->tags = $tags;

      $this->stocks = $stocks;
      $this->rating = getProductRatings($connect, $productID);
      //$this->popularity = getPopularityRating($connect, $productID);

    }
  }


class sellers {
  public $sellerID;
  public $userId;
  public $shopName;
  public $date;
  public $description;
  public $picture;
  public $verified;
  public $products = array();
  public $averageRating;
  public $transactions;
  

  function __construct($connect, $sellerID){

    $query = "SELECT * FROM `sellers` WHERE `sellerID` = ?;";
    $stmt = mysqli_stmt_init($connect);
    if (!mysqli_stmt_prepare($stmt, $query)) {
      echo "Error: " . mysqli_error($connect);
    } else {
      mysqli_stmt_bind_param($stmt, "i", $sellerID);
      mysqli_stmt_execute($stmt);
      $results = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
      mysqli_stmt_close($stmt);
    }

    $this->sellerID = $sellerID;
    $this->userId = $results['userID'];
    $this->shopName = $results['shopName'];
    $this->date = $results['dateStart'];
    $this->description = $results['verified'];
    $this->picture = $results['picture'];
    //$this->transactions = getSellerTransaction($connect, $sellerID);
    $this->averageRating = getsellerRatings($connect, $sellerID);
  }

  function productLists($connect, $sellerID){
    $results = getProduct($connect, $sellerID);
    $products = array();

    if ($connect)
      foreach ($results as $row)
        array_push($products, $row['productID']);
    
    return $products;

  }

}

class user {
  public $userID;
  public $userName;
  public $fullName;
  public $contactNumber;
  public $studentID;
  public $studentEmail;
  public $password;
  public $dateMade;
  public $profilePicture;
  public $bio;

  public $transactions = array();

  function __construct($connect, $userID){
    $user = getUserID($connect, $userID);

    $this->userID = $userID;
    $this->userName = $user['userName'];
    $this->fullName = $user['sirName'] + ", " + $user['firstName'];
    $this->contactNumber = $user['contactNumber'];
    $this->studentID = $user['studentID'];
    $this->studentEmail = $user['studentEmail'];
    $this->password = $user['password'];
    $this->dateMade = $user['dateMade'];
    $this->profilePicture = $user['profilePicture'];
    $this->bio = $user['bio'];

    $this->transactions = getUserTransaction($connect, $userID);

  }
}

class transaction{
  
  public $transactID;
  public $userID;
  public $sellerID;
  public $date;
  public $status;

  function __construct($connect, $transactID, $userID, $sellerID, $date, $status){
    $this->transactID = $transactID;
    $this->userID = $userID;
    $this->sellerID = $sellerID;
    $this->date = $date;
    $this->status = $status;
  }

  function getItemsOnTransaction($connect, $transactionID){
    $result = getItemsPerTransaction($connect, $transactionID);
    $products = array();

    if ($connect)
      foreach ($result as $row)
        array_push($products, $row['productID']);
    
    return $products;

  }

}



function getPopularityRating($connect, string $productID){
  //rates note that a + b = 1
  $magnitudeA = .4;
  $magnitudeB = .6;
  // adoption rate (for Clicks)
  $clicks = getClicks($connect, $productID);
  $newClicks = $clicks["newUsers"];
  $users = getAmountUsers($connect);
  $adoptionRate = ($newClicks/$users) * 100;
  // NPS (for ratings)
  $classifications = getClassificationRatings($connect, $productID);
  
  $promoter = $classifications["promoter"];
  $detractor = $classifications["detractor"];
  
  $NPS = (1 + ($promoter - $detractor)/$newClicks)/2;

  $popularityRating = $magnitudeA*$adoptionRate + $magnitudeB*$NPS;
  
  return $popularityRating;
}
#Inititalzation
function initSellers($connect){
  $query = "SELECT * FROM sellers;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
      die('MySQL prepare error: ' . mysqli_error($connect));
  }
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $rows = array();
  while ($row = $result->fetch_assoc()){
      $rows[] = new sellers($connect, $row['sellerID']);
  }
  return $rows; // Consider returning the array to be used outside this function
}

function initProducts($connect){
  $query = "SELECT * FROM product;";
  $stmt = mysqli_stmt_init($connect);
  if (!mysqli_stmt_prepare($stmt, $query)) {
      die('MySQL prepare error: ' . mysqli_error($connect));
  }
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $rows = array();
  while ($row = $result->fetch_assoc()){
      $rows[] = new product($connect, $row['productID'], $row['sellerID'], $row['productName'], $row['image'], $row['description'], $row['stocks'], $row['price'], $row['tags']);
  }
  return $rows; // Consider returning the array to be used outside this function
}

function initTransactions($connect, $userID){
  $transactions = array();
  $transactions = getUserTransaction($connect, $userID);
  return $transactions;
}
#

function init($connect, $userID){
  initSellers($connect);
  initProducts($connect);
  initTransactions($connect, $userID);
  
}

?>