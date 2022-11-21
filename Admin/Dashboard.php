<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php 
 $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() ?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/d331d0c0ff.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="stylesheet" href="Css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Dashboard</title>
</head>

<body>

    <!--HEADER-->
    <header class="bg-dark text-white py-3 text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fa fa-cog" style="color:#27aae1;"></i>Dashboard</h1>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="AddNewProduct.php" class="btn btn-primary btn-block"><i class="fas fa-edit"></i>Add New Product</a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Brand.php" class="btn btn-info btn-block"><i class="fas fa-edit"></i>Add New
                        Brand</a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Admins.php" class="btn btn-warning btn-block"><i class="fas fa-edit"></i>Add New Admin</a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Slider.php" class="btn btn-success btn-block"><i class="fas fa-check"></i>Add New Slider</a>
                </div>
            </div>
        </div>
    </header>
<section class="container py-2 mb-4">
    <div class="row">
    <div class="col-lg-12">
    <?php echo ErrorMessage();
          echo SuccessMessage();
    ?>
<div class="row d-flex justify-content-between">
<!-- left-side-area-start -->
    <div class="card text-center bg-dark text-white mb-3 col-2">
        <div class="card-body">
            <h1 class="lead">Product</h1>
            <h4 class="display-5">
                <i class="fab fa-redme"></i>
                <ion-icon name="appstore"></ion-icon>
                <?php TotalProducts(); ?>
            </h4>
        </div>
    </div>
    <div class="card text-center bg-dark text-white mb-3 col-2">
        <div class="card-body">
            <h1 class="lead">Category</h1>
            <h4 class="display-5">
                <i class="fab fa-redme"></i>
                <ion-icon name="folder"></ion-icon>
                <?php TotalCategory(); ?>
            </h4>
        </div>
    </div>
    <div class="card text-center bg-dark text-white mb-3 col-2">
        <div class="card-body">
            <h1 class="lead">SubCategory</h1>
            <h4 class="display-5">
                <i class="fab fa-redme"></i>
                <ion-icon name="photos"></ion-icon>
                <?php
                TotalSubCategory();
                ?>
            </h4>
        </div>
    </div>
    <div class="card text-center bg-dark text-white mb-3 col-2">
        <div class="card-body">
            <h1 class="lead">Admin</h1>
            <h4 class="display-5">
                <i class="fab fa-redme"></i>
                <ion-icon name="contact"></ion-icon>
                <?php
                TotalAdmins();
                ?>
            </h4>
        </div>
    </div>
    <div class="card text-center bg-dark text-white mb-3 col-2">
        <div class="card-body">
            <h1 class="lead">Supplier</h1>
            <h4 class="display-5">
                <i class="fab fa-redme"></i>
                <ion-icon name="contact"></ion-icon>
                <?php
                TotalSupplier();
                ?>
            </h4>
        </div>
    </div>
<!-- left-side-area-end -->
</div>

    </div>
    </div>
    </section>

    <!-- HEADER-END -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script>
    $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>