<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() 
 ?>
<?php
if(isset($_POST["pur"])){
    //create_category();
}

if(isset($_POST["sales"])){
    //create_subcategory();
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
    <style>
        a{
            color: inherit;
            text-decoration: none;
        }
        </style>
    <title>Report</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 "></div>
                <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Report</h1>
            </div>
        </div>
    </header>
    <!-- HEADER-END -->
    <!-- MAIN AREA -->
    <section class="container py-2 mb-4">
        <div class="row">
            <form class="form" action="Report.php?add=" method="POST">
            <div class="offset-lg-1-col-lg-10 foot">
                <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header row">
                            <div class="col-lg-6 mb-2 ">
                                    <a href="Report.php?add=pur" class="btn btn-primary btn-block"><i class="fas fa-plus"></i>Purchase Report</a>
                            </div>
                            <div class="col-lg-6 mb-2 ">
                                <!-- <button type="Submit" name="AddSubCategory" > -->
                                <a href="Report.php?add=sales" class="btn btn-info btn-block"><i class="fas fa-plus "></i>Sales Report</a>
                                <!-- </button> -->
                            </div>
                        </div>
                    </div>
                    <?php
                                  
                                  if(isset($_GET["add"])){
                                    $add=$_GET["add"];
                                  switch($add){
                                          case 'pur':                      
                                ?>
                        <form class="" action="" method="post"> 
                        
                        <h2>Purchases</h2>                
                        <table class="table table-striped table-hover">
        <thead class="thead-dark ">
        <tr>
        <th>No.</th>
        <th>Brand</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Supplier</th>
        <th>Purchase-type</th>
        <!-- <th>Action</th> -->
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select * from purchase";
    $stmt = $ConnectingDB->query($sql);
    $No =0;
    while($DataRows = $stmt->fetch()){
        $Id = $DataRows["Purchase_id"];
        $Brand = $DataRows["brand"];
        $Product = $DataRows["product_name"];
        $Quantity = $DataRows["quantity"];
        $Price = $DataRows["price"];
        $Supplier = $DataRows["supplier_name"];
        $Purchase_type =$DataRows["purchase_type"];
        $No++;
    ?>
    <tbody>
    <tr>
    <td><?php echo htmlentities($No);?></td>
    <td><?php echo htmlentities($Brand);?></td>
    <td><?php echo htmlentities($Product);?></td>
    <td><?php echo htmlentities($Quantity);?></td>
    <td><?php echo htmlentities($Price);?></td>
    <td><?php echo htmlentities($Supplier);?></td>
    <td><?php echo htmlentities($Purchase_type);?></td> 
    <!-- <td>
        <a href="Delete.php?id=<?php echo $Id;?>&type=purchase" ><span class="btn btn-danger">Delete</span></a>
    </td> -->
    </tr>
    </tbody>
    <?php
    }
    ?>
    </table> 
        <div class="card-header row">
            <div class="col-lg-6 mb-2 ">
                <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back To Dashboard</a>
            </div>
            <div class="col-lg-6 mb-2 ">
                <a href="P_Report.php?type=purchase" class="btn btn-success btn-block"><i class="fas fa-check"></i>Generate Purchase Report</a>
            </div>
        </div>
                        </form>
                        <?php
                            break;
                            case 'sales':
                        ?>
                        
                        <form class="" action="" method="post">
                        
                        <br>
                        <h2>Sales</h2>                
                        <table class="table table-striped table-hover">
         <thead class="thead-dark ">
        <tr>
        <th>Order ID</th>
        <th>Order Date</th>
        <th>Address</th>
        <th>Payment Type</th>
        <th>Payment Status</th>
        <th>Order Status</th>
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select *  from `order` where order_status = 'Complete'";
    $stmt = $ConnectingDB->query($sql);
    $sr =0;
    while($row = $stmt->fetch()){
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
    <td><span class="badge bg-success m-0"><?php echo $row['order_status']?></span></td>
    </tr>
    </tbody>
    <?php
    }
    ?>

    </table>
    <div class="row">
        <div class="col-lg-6 mb-2">
            <a href="Dashboard.php" class="btn btn-warning btn-block"><i
            class="fas fa-arrow-left"></i> Back To Dashboard</a>
        </div>
        <div class="col-lg-6 mb-2">
          <button type="submit" name="sales" class="btn btn-success btn-block">
               <i class="fas fa-check"></i> Generate sales Report
          </button>
        </div>
    </div>     
                        </form>
                <?php
                            break; 
                            default: ;
                            break;
                                   }  }
                                   else{
                                       
                                   }

                        ?>
                        
                </div>
                
            </form>
        </div>
    </section>
    <!-- MAIN AREA-END -->

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
    $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>