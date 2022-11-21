<?php require_once("./Includes/Functions.php"); ?>
<?php require_once("./Includes/Sessions.php"); ?>
<?php require_once("./Includes/DB.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>J-electricwala</title>
  <!-- icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php require_once("./Includes/Headlinks.php")?>
  <!-- Google Fonts -->
    <link rel="stylesheet" href="./assets/css/empty_cart_style.css">
</head>
<body>
<?php require_once("./Includes/Header.php")?>
<?php require_once("./Includes/Nav.php")?>
    <div class="container container12">
        <div class="row">
            <div class="col-md-12">
                <div class="card card1">
                    <div class="card-header">
                        <h4><b>Cart</b></h4>
                    </div>
                    <div class="card-body cart1">
                        <div class="col-sm-12 empty-cart-cls text-center"> <img src="./assets/img/empty_cart.png" width="130" height="130" class="ram img-fluid mb-4 mr-3">
                            <h3><strong>Your Cart is Empty</strong></h3>
                            <h4>Add something in to it</h4> <a href="Home.php" class="btn btn12 cart-btn-transform m-3" style="background-color: black;color: white;" data-abc="true">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("Includes/Footer.php")?>
</body>

</html>
<!--  -->