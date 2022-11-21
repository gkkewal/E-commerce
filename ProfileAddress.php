<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() 
?> 
<?php
global $conn;
$UserId = $_SESSION["UserId"];
$sql ="select address from user where user_id='$UserId'";
$user_result = mysqli_query($conn,$sql);
$DataRows = mysqli_fetch_array($user_result);
$ExistingAdd=$DataRows['address'];
    //$ExistingImage=$DataRows['aimage'];
if(isset($_POST["Submit"])){
    $Address = mysqli_real_escape_string($conn,$_POST["Address"]);
    //    $AImage = $_FILES["Image"]["name"];
    //  $Target = "Images/".basename($_FILES["Image"]["name"]);
    if(!empty($_POST['Address'])){
         $sql = "update user set address='$Address' where user_id='$UserId'";
    }
    if (isset($_SESSION["UserId"])) {
        $Execute=mysqli_query($conn,$sql);
        Redirect_to("ProfileAddress.php");
    }
}
    
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Headlinks-start -->
    <?php require_once("Includes/Headlinks.php") ?>
    <!--SweetAlert-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="assets/css/My_Profile_Style.css">
    <title>Address</title>
    <style>
        .input {
            width: 100%;
        }
        textarea {
            resize: none;
        }
    </style>
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
            
            <div class="col-md-8 pt-5 pb-5">
                <div class="osahan-account-page-right p-4 h-100">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade  active show" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                            <div class="foradd d-flex justify-content-between">
                                <h4 class="font-weight-bold mt-0 mb-4">Manage Addresses</h4>
                                <!-- <p class="mb-0 text-black font-weight-bold"><a class="text-primary mr-3"  href=""><i class="fa fa-plus"></i> Add New Address</a></p> -->
                            </div>
                            <!-- Modal -->
                            <form class="row Profile tabShow" action="ProfileAddress.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bg-white card addresses-item mb-4 border border-primary shadow">
                                        <div class="gold-members p-4">
                                            <div class="media">
                                                <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1 text-secondary">Home</h6>
                                                    <textarea rows = "3" cols = "40" name = "Address" spellcheck="false" value="<?php echo $ExistingAdd;?>" fixed><?php echo $ExistingAdd;?></textarea><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-12">
                                    <hr class="mt-2 mb-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <button class="btn btn-style-1 btn-primary " type="submit" data-toast=""
                                data-toast-position="topRight" data-toast-type="success"
                                data-toast-icon="fe-icon-check-circle" data-toast-title="Success!"
                                data-toast-message="Your profile updated successfuly." name="Submit" >Update Profile</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</div>
</div>
    <!-- ======= Footer ======= -->
    <?php require_once("Includes/Footer.php") ?>
    <script>
        function popUp() {
            swal({
                title: "Good job!",
                text: "Your data is submitted!",
                icon: "success",
                button: "ok!",
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>