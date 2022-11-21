<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login(); 
 

?> 

<?php

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
if(isset($_POST["Submit"])){
    $Fname = mysqli_real_escape_string($conn,$_POST["fname"]);
    $Lname = mysqli_real_escape_string($conn,$_POST["lname"]);
    $Phone = mysqli_real_escape_string($conn,$_POST["phone"]);
    $Email = mysqli_real_escape_string($conn,$_POST["email_id"]);
//    $AImage = $_FILES["Image"]["name"];
//  $Target = "Images/".basename($_FILES["Image"]["name"]);
if(!empty($_POST['pass'])&&!empty($_POST['con_pass'])){
    if($_POST['pass']==$_POST['con_pass']){
     $sql = "update user set first_name='$Fname',last_name='$Lname',phone='$Phone' , email='$Email',password='".$_POST['pass']."' where user_id='$UserId'";
    }
}else{
    $sql = "update user set first_name='$Fname',last_name='$Lname',phone='$Phone' , email='$Email' where user_id='$UserId'";
}
if (isset($_SESSION["UserId"])) {
    $Execute=mysqli_query($conn,$sql);
    Redirect_to("MyProfile.php");
}
}
// if($Execute){
// $_SESSION["SuccessMessage"] = "Details updated successfully";
//     Redirect_to("My_Profile.php");
// }else{
// $_SESSION["ErrorMessage"] = "Something went wrong. Try Again!!!";
//     Redirect_to("My_Profile.php");
// }

?>
<!Doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?php require_once("Includes/Headlinks.php")?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/My_Profile_Style.css">
    <title>Profile Information</title>
</head>

<body>
<?php require_once("Includes/Header.php")?>
<?php require_once("Includes/Nav.php")?>
    <div class="container mt-5">
        <div class="row">
            <div class="half pt-5 col-lg-4 pb-5 ">
                <!-- Account Sidebar-->
                <?php require_once("Includes/Account_slider.php")?>
            </div>
            <!-- Profile Settings-->
            <div class="col-lg-8 pb-5 pt-5">
                <form class="row Profile tabShow" action="MyProfile.php" method="POST">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-fn">First Name</label>
                            <input class="form-control" type="text" name ="fname" id="account-fn" value="<?php echo $ExistingFName;?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-ln">Last Name</label>
                            <input class="form-control" type="text" name ="lname" id="account-ln" value="<?php echo $ExistingLName;?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-email">E-mail Address</label>
                            <input class="form-control" type="text" name ="email_id" id="account-email" value="<?php echo $ExistingEmail;?>" required
                                >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-phone">Phone Number</label>
                            <input class="form-control" type="text" name="phone" id="account-phone" value="<?php echo $ExistingPhone;?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-pass">New Password</label>
                            <input class="form-control" type="password" name="pass" id="pass">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="account-confirm-pass">Confirm Password</label>
                            <input class="form-control" type="password" name="con_pass" id="con_pass">
                        </div>
                        <div id="showErrorcPwd"></div>
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
    <?php require_once("Includes/Footer.php")?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){        
        $('#con_pass').keyup(function(){
        var pwd = $('#pass').val();
        var cpwd =$('#con_pass').val();
        if(pwd!=cpwd){
            $('#showErrorcPwd').html('** Password are not matching');
            $('#showErrorcPwd').css('color','red');
            return false;
        }else{
            $('#showErrorcPwd').html('');
            return true;
        }
        });
    });
    </script>
</body>

</html>