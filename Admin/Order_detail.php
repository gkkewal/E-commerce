<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$order_id = $_GET["id"];
if (isset($_POST['update_order_status'])){
  global $ConnectingDB;
  $update_order_status=$_POST['update_order_status'];
  // $ConnectingDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // echo "update `order` set order_status='$update_order_status' where order_id='$order_id'";
  $sql = "update `order` set order_status=? where order_id=?";
  $ConnectingDB->prepare($sql)->execute([$update_order_status, $order_id]);
}
?>

<?php
date_default_timezone_set( "Asia/Kolkata");
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
            <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Order Details</h1></div>
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
         <thead class="thead-dark bg-dark text-white">
        <tr>
        <td>Product Image</td>
        <td>Product Name</td>
        <td>Quantity</td>
        <td>Price</td>
        <td>Total</td>
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select distinct(order_detail.order_detail_id),order_detail.*,product.name,product.image,`order`.address1,`order`.city,`order`.pincode from order_detail,product,
    `order` where order_detail.order_order_id='$order_id' and order_detail.product_product_id=product.product_id";
    $total_price=0;
    $stmt = $ConnectingDB->query($sql);
    $sr =0;
    while($row = $stmt->fetch()){
      $total_price=$total_price+($row['quantity']*$row['price']);
      $address=$row['address1'];
      $city=$row['city'];
      $pincode=$row['pincode'];
    ?>
    <tbody>
    <tr>
                    <td><img src="../assets/img/<?php echo $row['image'];?>" width="170px;" height="60px;" alt=""></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['quantity'];?></td>
                    <!-- <td><input class="w-25 pl-1" id="<?php echo $key?>qty" value="<?php echo $qty?>" type="number" max="5" min="1"/>
                    <br/><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')"><i>Update</i></a>
                    </td> -->
                    <td><?php echo $row['price'];?></td>
                    <td><?php echo $row['quantity']*$row['price'];?></td>
    </tr>
    
    </tbody>
    <?php
    }
    ?>
    <tr>
                    <td colspan="3"></td>
                    <td><h5>Total Price</h5></td>
                    <td><h5><?php echo $total_price?></h5></td>
                </tr>

    </table>
    <div id="address_details">
    <strong>Address</strong>
    <?php echo $address?>, <?php echo $city?>, <?php echo $pincode?><br/><br/>
    <strong>Order Status:</strong>
    <div class="badge badge-success mb-5">
    <?php
    $sql1 = "select order_status.name from order_status,`order` where `order`.order_id='$order_id' and 
              `order`.order_status=order_status.name";
    $stmt1 = $ConnectingDB->prepare($sql1);
    $stmt1->execute();
    $row = $stmt1->fetch();
    echo $row['name'];
    ?></div>
  <div>
    <form method="post">
        <select class="form-control text-dark mb-5 border-3" name="update_order_status">
            <option>Select status</option>
            <?php
             $stmt2 = $ConnectingDB->query("select * from order_status");
           while($row = $stmt2->fetch()){
                if($row['id']==$order_id){
                    echo "<option selected value=".$row['name'].">".$row['name']."</option>";
                }else{
                     echo "<option value=".$row['name'].">".$row['name']."</option>";
                }
              }
            ?>
        </select>
        <input type="submit" class="form-control btn-success"/>
    </form>
</div>  
            
            </div>
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