<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <!-- all links start-->
    <?php require_once("Includes/Headlinks.php") ?>
    <!-- all links end-->
    <link rel="stylesheet" href="assets/css/404.css">
</head>

<body>
    <!------ Include the above in your HEAD tag ---------->
    <!-- Start Header -->
    <?php require_once("Includes/Header.php") ?>
    <!-- End Header -->

    <!--navbar start-->
    <?php require_once("Includes/Nav.php") ?>
    <!--navbar end-->

    <div class="page-wrap d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <span class="display-1 d-block">404</span>
                    <div class="leader mb-4">The page you are looking for was not found.</div>
                    <a href="#" class="btn btn-link" style="font-size: 2rem;">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("Includes/Footer.php") ?>
</body>

</html>



<!------ Include the above in your HEAD tag ---------->