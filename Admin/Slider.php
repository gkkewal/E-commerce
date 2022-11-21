<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() 
 ?>
 <?php
 if(isset($_POST["Upload"])){
  create_slider();
 }
 //$result = $ConnectingDB->query("select image_path from image");
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

    <title>Add New Slider</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
                <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Add Slider</h1>
            </div>
        </div>
    </header>
    <!-- HEADER-END -->
    <!-- MAIN AREA -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-lg-1-col-lg-10 foot">
                <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
                <form class="" action="Slider.php" method="post" enctype="multipart/form-data">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Add New Slider</h1>
                        </div>
                        <div class="card-body bg-dark">
                        <h4><span class="FieldInfo">Select Image To Upload!:</h4>
                        <div class="form-group"> 
                            <input type="file" name="Image" id="imageSelect" class="form-control p-1" value="">
                        </div>
                        <div class="form-group"> 
                            <input type="submit" name="Upload" class="btn btn-warning btn-block" value="Upload Image">
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="container py-2 mb-4">
    <div class="row">
    <div class="col-lg-12">
    <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
    <table class="table table-striped table-hover">
        <thead class="thead-dark ">
        <tr>
        <th>#</th>
        <th>Image</th>
        <th>Status</th>
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select * from image";
    $stmt = $ConnectingDB->query($sql);
    $sr =0;
    while($DataRows = $stmt->fetch()){
        $Id = $DataRows["image_id"];
 //       $Datetime = $DataRows["datetime"];
        $Image = $DataRows["image_path"];
        $Status = $DataRows["status"];
        $sr++;
    ?>
    <tbody>
    <tr>
    <td><?php echo $sr;?></td>
    <td><img src="Uploads/<?php echo $Image;?>" width="170px;" height="50px;"></td>
    <td>
    <div class="form-check form-switch ">
    <input type="checkbox" class="form-check-input " <?php if($Status==1){echo "checked";}?> onclick="slider(<?php echo $Id; ?>)" id="check">
    <!-- <label class="custom-control-label" for="switch1">Toggle me</label> -->
     </div>
    </td>
    </tr>
    </tbody>
    <?php
    }
    ?>
    </table>
    </div>
    </div>
    </section>
    <!-- MAIN AREA-END -->
    <!--FOOTER -->
    <?php require_once("Includes/Footer.php");?>
    <div style="height: 10px;background-color: #1C6DD0;"></div>

<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.l.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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
        function slider(id){
            var Id = id;
            $.ajax({url:"toggle.php?sliderid="+Id, type:"GET",
                   success: function(result){
                        if(result=='1'){
                            swal("Done!","status is Active","success");
                        }else{
                            swal("Done!","status is Deactive","success");
                        }
                    }
            });
        }
</script>
    <script>
    $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>