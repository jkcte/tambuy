<?php
@include 'config.php';
session_start();
$userLoggedin = TRUE;
// checking kung naka login
if (!isset($_SESSION['userName'])) {
    $userLoggedin = FALSE;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link rel="stylesheet" href="style/profilestyler1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-L/ovuoK1k2fD9Dn4WfZzBvMwJN5de8WKtZoLPzWzTC+g5mryiAsH/pUvLJr2etAa+BhHqvzjK67V0fcThSlx5Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <?php
    include 'sidebar.php';
    ?>
    <div class="main_content">
        <div class="container1">
            <script>
                $(document).ready(function() {
                    $("#panel").css('display', 'none');
                    $("#flip").click(function() {
                        $("#panel").slideToggle("slow");
                        $(this).text(function(i, text) {
                            return text === "See Less" ? "See More" : "See Less";
                        });
                    });
                });
            </script>
            <div class="imgcont">
                <img src="tambuys-icon-gold.png" width="150" height="150">
                <div><br>
                    <div class="text">
                        <strong><h2>Nina Batumbakal<img src="img/verified.png" style="margin-left: 10px; width: 20px; height: 20px;"></h2></strong><br>
                        <b><h3>Rating:</h3></b> <br>
                        <span style="color:gray">Joined (Databased) month ago</span>
                    </div><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at convallis sapien, at volutpat lorem. Mauris et dictum risus. Maecenas vulputate venenatis nibh vitae venenatis. Morbi vitae metus ut risus convallis consectetur. Aliquam erat volutpat. Nam ultricies scelerisque massa non semper. Pellentesque id pellentesque mi. Nunc id auctor elit, vitae lacinia lectus. In id massa et massa dapibus lobortis. Donec fringilla sagittis massa. Morbi nunc justo, tempus a mollis in, dignissim eget orci.
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="container">
            <div>
                <span style="color: #005200;"><h2>Listings</h2></span><br>
                <div class="imglist">
                    <?php
                    $query_profile = "SELECT * FROM product WHERE sellerID = '11'";
                    $result_profile = mysqli_query($conn, $query_profile);
                    $counter = 0;
                    // Display the first four listings
                    while (($row = mysqli_fetch_array($result_profile)) and ($counter < 4)) {
                    ?>
                        <div class="listing-container" data-name="p<?= $counter + 1 ?>">
                            <?php echo '<img src= "data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="180" height="180">' ?>
                            <div class="listing-text"><?= $row['productName'] ?><br><span style="color: #fac72a">P<?= $row['price'] ?></span></div>
                        </div>

                    <?php $counter++;
                    } ?>
                </div>
                <br>
                <span id="panel">
                    <?php
                    // Check if there are more listings
                    if (mysqli_num_rows($result_profile) > 4) {
                        // Display the rest of the listings
                        while ($row = mysqli_fetch_array($result_profile)) {
                    ?>
                            <div class="imglist">
                                <div class="listing-container" data-name="p5">
                                    <?php echo '<img src= "data:image/jpeg;base64,' . base64_encode($row['image']) . '" width="180" height="180">' ?>
                                    <div class="listing-text"><?= $row['productName'] ?><br><span style="color: #fac72a">P<?= $row['price'] ?></span></div>
                                </div>
                            </div>
                <?php }
                    } ?>
                </span>
                <?php
                // Display "See More" button if there are more listings
                if (mysqli_num_rows($result_profile) > 4) { ?>
                    <center><button id="flip" class="buttondesign">See More</button></center>
                <?php } ?>
            </div>
        </div>
        <div class="products_preview">
            <div class="preview" data-target="p1">
                <i class="fas fa-times"></i>
                <img src="tambuys-icon-gold.png" width="180" height="180">
                <h3>Bracelet</h3>
                <span style="color:gray">Rating: </span>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at convallis sapien, at volutpat lorem. Mauris et dictum risus.</p>
                <div class="price_preview">
                    P100.00
                </div>
                <div>
                    <div class="option_buy">
                        <a href="#" class="buy">Buy Now</a>
                    </div>
                    <div class="option_cart">
                        <a href="#" class="cart">Add to Cart</a>
                    </div>

                </div>

            </div>
            <!-- Other product previews go here -->
        </div>
        <?php
        include 'footer.php';
        ?>
    </div>
    <script src="script.js"></script>
    <script src="profilescr.js"></script>
</body>

</html>
