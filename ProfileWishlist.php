<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Headlinks-start -->
    <?php require_once("Includes/Headlinks.php") ?>
    <!-- Headlinks-end-->
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="assets/css/My_Profile_Style.css">
    <title>Wishlist</title>
</head>

<body>
    <!-- Start Header -->
    <?php require_once("Includes/Header.php") ?>
    <!-- End Header -->

    <!--navbar start-->
    <?php require_once("Includes/Nav.php") ?>
    <!--navbar end-->

    <div class="container mt-5">
        <div class="row">
            <div class="half pt-5 col-lg-4 pb-5">
                <!-- Account Sidebar-->
                <?php require_once("Includes/Account_slider.php")?>
            </div>
            <!-- Wishlist-->
            <div class="Wishlist tabShow col-lg-8 pb-5 pt-5">
                <!-- Item-->
                <div class="cart-item d-md-flex justify-content-between"><span class="remove-item"><i class="fa fa-times"></i></span>
                    <div class="px-3 my-3">
                        <a class="cart-item-product" href="#">
                            <div class="cart-item-product-thumb">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Product">
                            </div>
                            <div class="cart-item-product-info">
                                <h4 class="cart-item-product-title">Canon EOS M50 Mirrorless Camera</h4>
                                <div class="text-lg text-body font-weight-medium pb-1">$910.00</div><span>Availability:
                                    <span class="text-success font-weight-medium">In Stock</span></span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Item-->
                <div class="cart-item d-md-flex justify-content-between">
                    <span class="remove-item"><i class="fa fa-times"></i></span>
                    <div class="px-3 my-3">
                        <a class="cart-item-product" href="#">
                            <div class="cart-item-product-thumb"><img src="" alt="Product"></div>
                            <div class="cart-item-product-info">
                                <h4 class="cart-item-product-title">Apple iPhone X 256 GB Space Gray</h4>
                                <div class="text-lg text-body font-weight-medium pb-1">$1,450.00</div>
                                <span>Availability: <span class="text-warning font-weight-medium">2 - 3
                                        Weeks</span></span>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Item-->
                <div class="cart-item d-md-flex justify-content-between"><span class="remove-item"><i class="fa fa-times"></i></span>
                    <div class="px-3 my-3">
                        <a class="cart-item-product" href="#">
                            <div class="cart-item-product-thumb"><img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="Product"></div>
                            <div class="cart-item-product-info">
                                <h4 class="cart-item-product-title">HP LaserJet Pro Laser Printer</h4>
                                <div class="text-lg text-body font-weight-medium pb-1">$188.50</div><span>Availability:
                                    <span class="text-success font-weight-medium">In Stock</span></span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" checked="" id="inform-me">
                    <label class="custom-control-label" for="inform-me">Inform me when item from my wishlist is
                        available</label>
                </div>
            </div>
        </div>
    </div>
    <!-- ======= Footer ======= -->
    <?php require_once("Includes/Footer.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>