<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() 
 ?>
<?php
$AdminId = $_SESSION["UserId"];
global $ConnectingDB;
$sql = "select * from admin where id='$AdminId'";
$stmt = $ConnectingDB->query($sql);
while($DataRows=$stmt->fetch()){
    $ExistingName = $DataRows['aname'];
    $ExistingUserName = $DataRows['username'];
    $ExistingHeadline=$DataRows['aheadline'];
    $ExistingBio=$DataRows['abio'];
    $ExistingImage=$DataRows['aimage'];

}


    if(isset($_POST["Submit"])){
    $AName = $_POST["Name"];
    $AHeadline = $_POST["Headline"];
    $ABio = $_POST["Bio"];
    $AImage = $_FILES["Image"]["name"];
    $Target = "Images/".basename($_FILES["Image"]["name"]);
    if(strlen($AHeadline)>12){
        $_SESSION["ErrorMessage"] = "Headline should not be greater than 12 characters";
            Redirect_to("MyProfile.php");
        }
    elseif(strlen($ABio)>500){
         $_SESSION["ErrorMessage"]="Bio should be less than 500 character" ;
            Redirect_to("MyProfile.php"); 
        }
        else{
            global $ConnectingDB;
            if(!empty($_FILES["Image"]["name"])){
                $sql = "UPDATE admin SET aname='$AName',aheadline='$AHeadline' ,aimage='$AImage',abio='$ABio' where id='$AdminId'";
            }else{
                $sql = "UPDATE admin SET aname='$AName',aheadline='$AHeadline' ,abio='$ABio' where id='$AdminId'";
            }
            $Execute=$ConnectingDB->query($sql);
            move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        if($Execute){
            $_SESSION["SuccessMessage"] = "Details updated successfully";
                Redirect_to("MyProfile.php");
        }else{
            $_SESSION["ErrorMessage"] = "Something went wrong. Try Again!!!";
                Redirect_to("MyProfile.php");
        }
            }
}
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Css\Style.css">
    <script src="https://kit.fontawesome.com/d331d0c0ff.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Admin Profile</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <h1><i class="fa fa-user mr-2" style="color:#27aae1;">
                    </i><?php echo $ExistingName; ?></h1>
                <small><?php echo $ExistingHeadline; ?></small>
            </div>
        </div>
    </header>
    <!-- HEADER-END -->
    <!-- MAIN AREA -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-dark text-light">
                        <h3><?php echo $ExistingName; ?></h3>
                    </div>
                <div class="card-body">
                    <img src="Images/<?php echo $ExistingImage; ?>" class="block img-fluid mb-3" alt="">
                    <hr>
                    <div class="">
                    <label for="" style="font-size: 30px;">Address :</label><br>
                        <?php echo $ExistingBio;?>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-9 foot">
                <?php echo ErrorMessage();
                      echo SuccessMessage(); 
                ?>
                <form class="" action="MyProfile.php" method="post" enctype="multipart/form-data">
                    <div class="card bg-dark text-light">
                        <div class="card-header bg-secondary text-light">
                            <h1>Edit Profile </h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                            <label for="Name">Name:</label>
                                <input class="form-control" type="text" name="Name" id="title"
                                    placeholder="Your Name" value="<?php echo $ExistingName;?>">
                            </div>
                            <div class="form-group">
                            <label for="Headline">About:</label>
                                <input class="form-control" type="text"id="title" name="Headline" value="<?php echo $ExistingHeadline; ?>">
                                    <small class="text-muted">You need to write about you</small>
                                    <span class="text-danger" >NOT GREATER THAN 12 CHARACTER</span>
                            </div>
                            <div class="form-group">
                                <label for="Bio">Address:</label>
                                <textarea class="form-control" placeholder="Bio" id="Post" name="Bio" rows="8" cols="80" 
                                value=""><?php echo$ExistingBio;?>
                                </textarea>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
                                    <label for="imageSelect" class="custom-file-label">Select Image:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Products.php" class="btn btn-warning btn-block"><i
                                            class="fas fa-arrow-left"></i> Back To Dashboard</a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" name="Submit" class="btn btn-success btn-block">
                                        <i class="fas fa-check"></i> Publish
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- MAIN AREA-END -->
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