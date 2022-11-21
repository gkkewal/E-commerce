<!-- <php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?> -->
<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
date_default_timezone_set("Asia/Kolkata");
$currenttime=time();
$Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
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
    
    <title>Order</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
        <nav class="navbar navbar-light ml-5 mr-5">
                <div>
            <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Order</h1></div>
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
        <table class="table table-striped table-hover">
         <thead class="thead-dark ">
        <tr>
        <th>Order ID</th>
        <th>Order Date</th>
        <th>Address</th>
        <th>Payment Type</th>
        <th>Payment Status</th>
        <th>Order Status</th>
        <th>Invoice</th>
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select `order`.*,order_status.name as 
    order_status_str from `order`,order_status where order_status.name=`order`.order_status";
    $stmt = $ConnectingDB->query($sql);
    $sr =0;
    while($row = $stmt->fetch()){
        // $Id = $DataRows["oder_id"];
        // $Odate = $DataRows["added_on"];
        // $Oadd = $DataRows["address1"];
        // $Ocity = $DataRows["city"];
        // $Opay_type = $DataRows["payment_type"];
        // $Opay_status = $DataRows["payment_status"];
        // $Ord_status = $DataRows["order_status"];
        $sr++;
    ?>
    <tbody>
    <tr>
    <td><a class="navi-link" href="Order_detail.php?id=<?php echo $row['order_id']?>" data-toggle="modal"><?php echo $row['order_id']?></a></td>
    <td><?php echo $row['added_on']?></td>
    <td><?php echo $row['address1']?><br/>
    <?php echo $row['city']?><br/>
    <?php echo $row['pincode']?>
    </td>
    <td><?php echo $row['payment_type'];?></td>
    <td><span class="badge bg-success m-0"><?php echo $row['payment_status']?></span></td>
    <td><span class="badge bg-success m-0"><?php echo $row['order_status_str']?></span></td>
    <td>
        <a href="../order_pdf.php?id=<?php echo $row['order_id'];?>&type=order"><span class="btn btn-primary">PDF</span></a>
        <!-- <button class="btn btn-primary" onclick="generatePDF()">PDF</button> -->
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