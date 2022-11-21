<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
    if(isset($_POST["Submit"]))
{
    $Supplier = $_POST["SupplierTitle"];
    $Contact = $_POST["Contact"];
    $Email = $_POST["Email"];
    $Address = $_POST["Address"];
    $Admin="Group28";
    $Brand = "Bajaj";
    date_default_timezone_set( "Asia/Kolkata");
    $currenttime=time();
    $Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
    if(empty($Supplier)){
        $_SESSION["ErrorMessage"] = "Supplier name can't be empty";
            Redirect_to("AddNewSupplier.php");
        }
    elseif(strlen($Supplier)<4){
         $_SESSION["ErrorMessage"]="Supplier name should be greater than 4 character" ;
            Redirect_to("AddNewSupplier.php"); }
    elseif(strlen($Supplier)>49){
        $_SESSION["ErrorMessage"] = "Supplier name should be less than 50 character";
            Redirect_to("AddNewSupplier.php");
    }
    elseif(strlen($Contact)>10||strlen($Contact)<10||$Contact<1){
        $_SESSION["ErrorMessage"] = "Contact should be of 10 number!!";
            Redirect_to("AddNewSupplier.php");
    }
    else{
        global $ConnectingDB;
        $sql = "insert into supplier(supp_name,supp_contact,supp_email,supp_add)";
        $sql .= "values(:suplierName,:cOntact,:eMail,:aDdress)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':suplierName',$Supplier);
        $stmt->bindValue(':cOntact',$Contact);
        $stmt->bindValue(':eMail',$Email);
        $stmt->bindValue(':aDdress',$Address);
        $Execute=$stmt->execute();
    if($Execute){
        $_SESSION["SuccessMessage"] = "Supplier is successfully added";
            Redirect_to("AddNewSupplier.php");
    }else{
        $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
            Redirect_to("AddNewSupplier.php");
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
    
    <title>Add New Supplier</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
        <nav class="navbar navbar-light ml-5 mr-5">
                <div>
            <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Add Supplier</h1></div>
                <form class="form-inline my-2 my-lg-0 ml-auto">
                    <label class="strong">Search:&nbsp</label>
                    <input class="form-control" type="text"  id="search" placeholder="Search..." aria-label="Search">
                    <!-- <button class="btn btn-outline-white btn-md my-2 my-sm-0 ml-3 bg-info"  value="Search" type="submit">Search</button> -->
                </form>
            </nav>
            <!-- <div class="row">
                <div class="col-md-12"></div>
                <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Add Supplier</h1>
            </div> -->
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
                <form class="" action="AddNewSupplier.php" method="post" enctype="multipart/form-data">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Add Supplier Details</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Supplier Name:</span></label>
                                <input class="form-control" type="text" name="SupplierTitle" id="title"
                                    placeholder="Type Title Here" value="">
                            </div>
                            <div class="form-group">
                                <label for="contacttitle"><span class="FieldInfo">Contact:</span></label>
                                <input class="form-control" type="number" name="Contact" id="title"
                                    placeholder="Type Contact Number" value="">
                            </div>
                            <div class="form-group">
                                <label for="email"><span class="FieldInfo">Email:</span></label>
                                <input class="form-control" type="email" name="Email" id="title"
                                    placeholder="Type Price Here" value="">
                            </div>
                            <div class="form-group">
                                <label for="address"><span class="FieldInfo">Address:</span></label>
                                <textarea class="form-control" id="" name="Address" rows="8"
                                    cols="80"></textarea>
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
        <table class="table table-striped table-hover" id="tableid" name="tableid">
         <thead class="thead-dark ">
        <tr>
        <th>#</th>
        <th>Supplier Name</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Action</th>
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select * from supplier";
    $stmt = $ConnectingDB->query($sql);
    $sr =0;
    while($DataRows = $stmt->fetch()){
        $Id = $DataRows["supplier_id"];
        $Name = $DataRows["supp_name"];
        $Contact = $DataRows["supp_contact"];
        $Email = $DataRows["supp_email"];
        $Address = $DataRows["supp_add"];
        $sr++;
    ?>
    <tbody>
    <tr>
    <td><?php echo $sr;?></td>
    <td><?php echo $Name;?></td>
    <td><?php echo $Contact;?></td>
    <td><?php echo $Email;?></td>
    <td><?php echo $Address;?></td>
    <td>
        <a href="EditSupplier.php?id=<?php echo $Id;?>" ><span class="btn btn-warning"> Edit</span></a>
        <a href="Delete.php?id=<?php echo $Id;?>&type=supp" ><span class="btn btn-danger"> Delete</span></a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
<script type="text/javascript">
        $(document).ready(function(e){
            $("#search").keyup(function(){
                $("#here").show();
                var search_item = $(this).val();
                $.ajax({
                    url:"ajax-live-search.php",type:"GET",data:"search="+search_item,
                    success: function(data){
                        $("#tableid").html(data);
                    },
                });
            });
        });
    </script>
</body>

</html>