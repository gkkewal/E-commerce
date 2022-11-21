<?php 
 require_once("Includes/Functions.php"); 
 require_once("Includes/Sessions.php"); 
 require_once("Includes/DB.php"); 
 $order_id = get_safe_value($conn,$_GET['id']);
?>
<?php
    // $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login(); 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <?php require_once("Includes/Headlinks.php") ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="./assets/css/CartStyle.css">
</head>

<body>
    <!-- Start Header -->
    <?php require_once("Includes/Header.php") ?>
    <!-- End Header -->

    <!--navbar start-->
    <?php require_once("Includes/Nav.php") ?>
    <!--navbar end-->
    <div class="container">
        <div class="title">My Order</div>
        <div class="underline"></div>
    </div>
    <section id="cart-container" class="container">
        <table width="100%">
            <thead>
                <tr>
                    <td>Product Image</td>
                    <td>Product Name</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                    <?php
                    $uid = $_SESSION['UserId'];
                    $res=mysqli_query($conn,"select distinct(order_detail.order_detail_id),order_detail.*,product.name,product.image,product.price,product.offer_price from order_detail,product,
                    `order` where order_detail.order_order_id='$order_id' and `order`.user_user_id='$uid' and 
                    order_detail.product_product_id=product.product_id");
                    $total_price=0;
                    while($row=mysqli_fetch_assoc($res)){
                         if($row['offer_price'] !== '0'){
                            $pp = $row['offer_price'];
                            } else{ 
                            $pp = $row['price'];}
                        $total_price=$total_price+($row['quantity']*$pp);
                    ?>
                <tr>
                    <!-- <td><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa fa-trash-alt "></i></a></td> -->
                    <td><img src="assets/img/<?php echo $row['image'];?>" alt=""></td>
                    <td><h5><?php echo $row['name'];?></h5></td>
                    <td><h5><?php echo $row['quantity'];?></h5></td>
                    <!-- <td><input class="w-25 pl-1" id="<?php echo $key?>qty" value="<?php echo $qty?>" type="number" max="5" min="1"/>
                    <br/><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')"><i>Update</i></a>
                    </td> -->
                    <td><h5><?php echo $pp; ?></h5></td>
                    <td><h5><?php echo $row['quantity']*$pp;?></h5></td>
                </tr>
                <?php }?>
                <tr>
                    <td colspan="3"></td>
                    <td><h5>Total Price</h5></td>
                    <td><h5><?php echo $total_price?></h5></td>
                </tr>
            </tbody>
        </table>
        <!-- <div class="row">
            <hr class="second-hr">
                <div>
                    <div class="d-flex col-md-12 justify-content-between">
                    <a href="Home.php"><button type="button" class="btn btn-outline-primary ml-auto mb-2 mr-2">PROCEED TO CHECKOUT</button></a>
                    <a href="Checkout.php"><button type="button" class="btn btn-outline-primary ml-auto mb-2 mr-2">PROCEED TO CHECKOUT</button></a>
                    </div>
                </div>
        </div> -->
    </section>
    <!-- ======= Footer ======= -->
    <?php require_once("Includes/Footer.php") ?>
    <!-- Javascript Cdn -->
    <script src=" 	https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <scritp src="assets/js/main.js"></script>
</body>

</html>