<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php 
if (isset($_SESSION["UserId"])) {
    Redirect_to("Dashboard.php");
}

if(isset($_POST["Submit"]))
{ 
    $UserName = $_POST["Username"];
    $Password = $_POST["Password"];

    if (empty($UserName)||empty($Password)){
        $_SESSION["ErrorMessage"]= "All fields must be filled out";
            Redirect_to("Login.php");
    }else{
        $Found_Account=Login_Attempt($UserName,$Password);
        if($Found_Account){
            $_SESSION["UserId"]=$Found_Account['id'];
            $_SESSION["UserName"]=$Found_Account['username'];
            $_SESSION["AdminName"]=$Found_Account['aname'];

            $_SESSION["SuccessMessage"]= "Welcome ".$_SESSION['AdminName']."!";
            if(isset($_SESSION["TrackingURL"])){
            Redirect_to($_SESSION["TrackingURL"]);
            }else{
            Redirect_to("Dashboard.php");
        }
        }else{
            $_SESSION["ErrorMessage"] = "Incorrect Username/Password";
            Redirect_to("Login.php");
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
    <script src="https://kit.fontawesome.com/d331d0c0ff.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Login</title>
</head>

<body  style="background-color: #5372F0;">

    <!--HEADER-->
    <!-- <header class="bg-dark text-white text-center py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
            </div>
        </div>
    </header> -->
    <!--HEADER-END-->

    <!--MIAN PART-START-->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-sm-3 col-sm-6" style="min-height:500px" >
            <br><br><br>
            <?php echo ErrorMessage();
                  echo SuccessMessage();
            ?>
                <div class="card bg-secondary text-light">
                    <div class="card-header">
                        <h4>WELCOME BACK ! </h4>
                    </div>    
                        <div class="card-body bg-dark">
                        
                        <form action="Login.php" class="" method="POST">
                            <div class="form-group">
                                <label for="username"><span class="FieldInfo">Username:</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-white bg-info"><i class="fas fa-user"></i></span>
                                        </div>
                                    <input type="text" class="form-control" name="Username" id="username" value="">
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="password"><span class="FieldInfo">Password:</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-white bg-info"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="Password" id="password" value="">
                                </div>
                            </div>
                            <input type="submit" name="Submit" class="btn btn-info btn-block " value="Login">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--MIAN PART-END-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
    <script>
        $('#year').text(new Date().getFullYear());    
    </script>
</body>

</html>