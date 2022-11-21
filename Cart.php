<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php 
 //prx($_SESSION['cart']);
 if($_SESSION['cart']<=0){
    Redirect_to("empty_cart.php");

 }
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
        <div class="title">My Cart</div>
        <div class="underline"></div>
    </div>
    <section id="cart-container" class="container">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($_SESSION['cart'] as $key=>$val){
                    
                    $proArr=get_product($conn,'','','',$key,'','offer');
                    //prx($proArr);
                    $pname = $proArr[0]['name'];
                    if($proArr[0]['offer_price'] !== '0'){
                    // $pprice = $proArr[0]['price'];
                    $pprice = $proArr[0]['offer_price'];
                    }else{
                    $pprice = $proArr[0]['price'];
                    }
                    $pimage = $proArr[0]['image'];
                    $qty = $val['qty'];
                ?>
                <tr>
                    <td><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa fa-trash-alt "></i></a></td>
                    <td><img src="assets/img/<?php echo $pimage;?>" alt=""></td>
                    <td><h5><?php echo $pname;?></h5></td>
                    <td><h5><?php echo $pprice;?></h5></td>
                    <td><input class="w-25 pl-1" id="<?php echo $key?>qty" value="<?php echo $qty?>" type="number" max="5" min="1"/>
                    <br/><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')"><i>Update</i></a>
                    </td>
                    <td><h5><?php echo $qty*$pprice;?></h5></td>
                </tr>
                <?php }?>
                <!-- <tr>
                    <td><a href="#"><i class="fa fa-trash-alt"></i></a></td>
                    <td><img src="./assets/img/fan1.jpg" alt=""></td>
                    <td>
                        <h5>Fan
                        </h5>
                    </td>
                    <td>
                        <h5>$65</h5>
                    </td>
                    <td><input class="w-25 pl-1" value="1" type="number"></td>
                    <td>
                        <h5>$130.00</h5>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <div class="row">
            <hr class="second-hr">
                <div>
                    <div class="d-flex col-md-12 justify-content-between">
                    <a href="Home.php"><button type="button" class="btn btn-outline-primary ml-auto mb-2 mr-2">BACK TO HOME</button></a>
                    <a href="Checkout.php"><button type="button" class="btn btn-outline-primary ml-auto mb-2 mr-2">PROCEED TO CHECKOUT</button></a>
                    </div>
                </div>
        </div>
    </section>
    <!-- ======= Footer ======= -->
    <?php require_once("Includes/Footer.php") ?>
    <!-- Javascript Cdn -->
    <script src=" 	https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <scritp src="assets/js/main.js"></script>
</body>

</html>