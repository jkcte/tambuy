<?php
$ids = isset($_GET['ids']) ? $_GET['ids'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/67c66657c7.js"></script>
<style>

</style>


  </head>

<footer class="footer">
  <div class="foot-container">
    <div class="foot-row">
      <div class="foot-col">
        <div class="logo">
            <a href="index.php"><img src="assets/tambuys-icon-text.png" alt="logo"/></a>
            <br>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </span>
        </div>
        
      </div>

      <div class="foot-col">
        <h4>Categories</h4>
        <ul>
          <li><a href="foodlistings.php?ids=<?php echo $ids; ?>">Food</a></li>
          <li><a href="electronicslistings.php?ids=<?php echo $ids; ?>">Electronics</a></li>
          <li><a href="clotheslistings.php?ids=<?php echo $ids; ?>">Clothes</a></li>
          <li><a href="bookslistings.php?ids=<?php echo $ids; ?>">Books</a></li>
          <li><a href="serviceslistings.php?ids=<?php echo $ids; ?>">Services</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h4>Information</h4>
        <ul>
          <li><a href="">About Us</a></li>
          <li><a href="">Contact Us</a></li>
          <li><a href="">Terms & Conditions</a></li>
          <li><a href="">FAQs</a></li>
        </ul>
      </div>



      <div class="foot-col">
        <h4>Follow Us</h4>
        <div class="socials">
          <a href="#"><i class="fa-brands fa-facebook"></i>Facebook</a>
          <a href="#"><i class="fa-brands fa-square-instagram"></i>Instagram</a>
          <a href=""><i class="fa-brands fa-twitter"></i>Twitter</a>
        </div>
      </div>

      
    </div>
    <p> &copy; 2024 EdTech Support. All rights reserved </p>
  </div>


</footer>
</html>