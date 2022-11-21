<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login(); 
 ?>
<?php
if(isset($_POST["Submit"])){
    $UserName = $_POST["UserName"];
    $Name = $_POST["Name"];
    $Password = $_POST["Password"];
    $ConfirmPasssword = $_POST["Confirmpassword"];
   // $Admin = $_SESSION["UserName"];
    date_default_timezone_set("Asia/Kolkata");
    $CurrentTime = time();
    $DateTime = strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

    if(empty($UserName)){
        $_SESSION["ErrorMessage"]="All fields must be filled out";
            Redirect_to("Admins.php");
        
    }elseif(strlen($Password)<4){
        $_SESSION["ErrorMessage"]= "Password should be greater than 4 character";
            Redirect_to("Admins.php");
    }elseif($Password !== $ConfirmPasssword){
        $_SESSION["ErrorMessage"]= "Password and Confirm Password should match";
            Redirect_to("Admins.php");
    }elseif(CheckUserNameExistsOrNot($UserName)){
        $_SESSION["ErrorMessage"]= "User name exists try Another one !";
            Redirect_to("Admins.php");
    }else{
        global $ConnectingDB;
        $sql = "insert into admin(datetime,username,password,aname)";
        $sql .= "values(:datetime,:userName,:password,:aName)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':datetime',$DateTime);
        $stmt->bindValue(':userName',$UserName);
        $stmt->bindValue(':password',$Password);
         $stmt->bindValue(':aName',$Name);
     //   $stmt->bindValue(':adminName',$Admin);
        $Execute=$stmt->execute();
        if($Execute){
            $_SESSION["SuccessMessage"] = "New Admin with the name ".$Name." added Successfully";
            Redirect_to("Admins.php");
        }else{
            $_SESSION["ErrorMessage"] = "Something went wrong. Try Again!!!";
            Redirect_to("Admins.php");
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
    <link rel="stylesheet" href="Css\Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Admins Page</title>
</head>
<body>
    <!--navbar-->
    
<div style="height:10px;background-color: #1C6DD0;"></div>
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
                <h1><i class="fa fa-user" style="color:#27aae1;"></i>Manage Admins</h1>
            </div>
        </div>
    </header>
    <!-- HEADER-END -->
    <!-- MAIN AREA -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-lg-1-col-lg-10" class="footer" >
            <?php echo ErrorMessage();
                  echo SuccessMessage();
            ?>
                <form class="" action="Admins.php" style="min-hight:400px" method="POST">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Add New Admin</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <lable for="username"><span class="FieldInfo">Username:</span></lable>
                                <input class="form-control" type="text" name="UserName" id="username"  value="">
                            </div>
                            <div class="form-group">
                                <lable for="Name"><span class="FieldInfo">Name:</span></lable>
                                <input class="form-control" type="text" name="Name" id="Name"  value="">
                            </div>
                            <small class="text-muted ">*Optional</small>
                            <div class="form-group">
                                <lable for="Password"><span class="FieldInfo">Password:</span></lable>
                                <input class="form-control" type="password" name="Password" id="Password"  value="">
                            </div>
                            <div class="form-group">
                                <lable for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span></lable>
                                <input class="form-control" type="password" name="Confirmpassword" id="ConfirmPassword"  value="">
                            </div>  
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back To Dashboard</a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="Submit" name="Submit"  class="btn btn-success btn-block">
                                             <i class="fas fa-check" ></i>Publish
                                    </button>
                                </div>
                            </div>
                       </div>
                    </div>   
                </form>
                <h2>Existing Admins</h2>                
        <table class="table table-striped table-hover">
        <thead class="thead-dark ">
        <tr>
        <th>No.</th>
        <th>Date&Time</th>
        <th>User Name</th>
        <th>Admin Name</th>
        <!-- <th>Action</th> -->
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select * from admin order by id desc";
    $stmt = $ConnectingDB->query($sql);
    $No =0;
    while($DataRows = $stmt->fetch()){
        $AdminId = $DataRows["id"];
        $DateTime = $DataRows["datetime"];
        $AdminUserName = $DataRows["username"];
        $AdminName =$DataRows["aname"];
        $No++;
    ?>
    <tbody>
    <tr>
    <td><?php echo htmlentities($No);?></td>
    <td><?php echo htmlentities($DateTime);?></td>
    <td><?php echo htmlentities($AdminUserName)?></td>
    <td><?php echo htmlentities($AdminName)?></td>
    <!-- <td>
        <a href="DeleteAdmin.php?id=<?php echo $AdminId;?>&type=admin" ><span class="btn btn-danger">Delete</span></a>
    </td> -->
    </tr>
    </tbody>
    <?php
    }
    ?>
    </table>   
                        </form>
            </div>
        </div>
    </section>
     <!-- MAIN AREA-END -->
    <!--FOOTER -->
    <?php require_once("Includes/Footer.php");?>
    <div style="height: 10px;background-color: #1C6DD0;"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        $('#year').text(new Date().getFullYear());    
    </script>
</body>
</html>