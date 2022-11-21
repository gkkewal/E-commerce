<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php
global $conn;
$UserId = $_SESSION["UserId"];
$ExistingEmail = $_SESSION["Emailid"];
$sql ="select * from user where user_id='$UserId'";
$user_result = mysqli_query($conn,$sql);

while($DataRows = mysqli_fetch_array($user_result,MYSQLI_ASSOC)){
    $ExistingFName = $DataRows['first_name'];
    $ExistingLName = $DataRows['last_name'];
    $ExistingPhone = $DataRows["phone"];
    $ExistingDOJ=$DataRows['doj'];
    //$ExistingImage=$DataRows['aimage'];
}
?>
               <div class="forcard">
                    <div class="author-card pb-3 pt-3">
                        <div class="author-card-profile">
                            <div class="author-card-avatar"><img
                                    src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Daniel Adams">
                            </div>
                            <div class="author-card-details">
                                <h5 class="author-card-name text-lg"><?php echo $ExistingFName;?></h5><span
                                    class="author-card-position"><?php echo $ExistingDOJ;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="wizard">
                        <nav class="list-group list-group-flush">
                            <a href="MyProfile.php" class="tab acitve list-group-item"> <i class="fa fa-user"></i>
                                Profile Settings</a>
                            <a href="ProfileAddress.php" class="tab list-group-item"><i
                                    class="fa fa-location-dot"></i>Address</a>
                            <!-- <a href="ProfileWishlist.php" class="tab list-group-item"><i
                                    class="fa fa-heart"></i>wishlist</a> -->
                            <a href="ProfileOrder.php" class="tab list-group-item"> <i
                                    class="fa fa-cart-shopping"></i>Orders</a>
                        </nav>
                    </div>
                </div>