<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() 
 ?>
 <?php $SearchQueryParameter = $_GET["id"];?>
<?php
    if(isset($_POST["Submit"]))
{
    $offer = $_POST["OfferTitle"];
    $s_date = $_POST["trip-start"];
    $e_date = $_POST["trip-end"];
    $discount = $_POST["discount"];
    // $ss_date = date("%B-%d-%Y",strtotime($trip_start));
    // $ee_date = date("%B-%d-%Y",strtotime($trip_end));
    // $s_date = strftime("%B-%d-%Y",$trip_start);
    // $e_date = strftime("%B-%d-%Y",$trip_end);
    // $Admin="Group28";
    // $Productonhand = "5";
    $Status = "0";
    //$Brand = $_POST["Brand"];;
     date_default_timezone_set( "Asia/Kolkata");
    $currenttime=time();
    $Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
    if(empty($offer)||empty($e_date)||empty($s_date)||empty($discount)){
        $_SESSION["ErrorMessage"] = "can't accept empty";
            Redirect_to("Offer.php");
        }
    elseif(strlen($offer)<4){
         $_SESSION["ErrorMessage"]="Product name should be greater than 4 character" ;
            Redirect_to("Offer.php"); }
    elseif(strlen($offer)>45){
        $_SESSION["ErrorMessage"] = "Product name should be less than 50 character";
            Redirect_to("Offer.php");
    }
    else{
        global $ConnectingDB;
        $sql = "update offers set offer='$offer',s_date='$s_date' ,e_date='$e_date' ,discount='$discount'
        where offers_id='$SearchQueryParameter'";
        $Execute=$ConnectingDB->query($sql);
//        $stmt->bindValue(':dateTime',$Datetime);
//        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
    if($Execute){
        $_SESSION["SuccessMessage"] = "Offer is successfully added";
            Redirect_to("Offer.php");
    }else{
         $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
       // $_SESSION["ErrorMessage"] = print($Execute);
            Redirect_to("Offer.php");
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

    <title>Edit Offer</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 "></div>
                <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Edit Offer</h1>
            </div>
        </div>
    </header>
    <!-- HEADER-END -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-lg-1-col-lg-10 foot">
                <?php echo ErrorMessage();
                      echo SuccessMessage();
                      global $ConnectingDB;
                      $sql = "select * from offers where offers_id='$SearchQueryParameter'";
                      $stmt = $ConnectingDB->query($sql);
                      $sr =0;
                      while($DataRows = $stmt->fetch()){
                        $Id = $DataRows["offers_id"];
                        $offer = $DataRows["offer"];
                        $s_date = $DataRows["s_date"];
                        $e_date = $DataRows["e_date"];
                        $discount = $DataRows["discount"];
                        $Status = $DataRows["status"];
                        $sr++;}
                ?>
                <form class="" action="EditOffer.php?id=<?php echo $SearchQueryParameter;?>" method="post" enctype="multipart/form-data">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Edit Offer</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Offer Name:</span></label>
                                <input class="form-control" type="text" name="OfferTitle" id="title"
                                    placeholder="Type Title Here" value="<?php echo $offer;?>">
                            </div>
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Start Date:</span></label>
                                <!-- <input class="form-control" type="number" name="s_date" id="title"
                                    placeholder="Type Price Here" value=""> -->
                                    <input type="date" id="start" name="trip-start" value="<?php echo $s_date;?>"
                                        min="2022-01-01" max="2022-12-31">
                            </div>
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">End Date:</span></label>
                                <!-- <input class="form-control" type="number" name="e_date" id="title"
                                    placeholder="Type Price Here" value=""> --> &nbsp;
                                    <input type="date" id="start" name="trip-end" value="<?php echo $e_date;?>"
                                        min="2022-01-01" max="2022-12-31">
                            </div>
                            <div class="form-group">
                                <label for="discounttitle"><span class="FieldInfo">Discount:</span></label>
                                <input class="form-control" type="number" name="discount" id="title"
                                    placeholder="Type Price Here" value="<?php echo $discount;?>">
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

    <!-- HEADER-END -->

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

<!-- 
    <script>
        function toggleOffer(id){
            var Id = id;
            $.ajax({
                url:"toggle.php?offerid="+Id,type:"GET",
                success: function(result){
                        if(result == '1'){
                            swal("Done!","status is Active","success");
                        }else{
                            swal("Done!","status is Deactive","success");
                        }
                    }
            });
        }
        </script> -->
    <script> 
    $('#year').text(new Date().getFullYear());
    </script>
    
      </body>
</html>  