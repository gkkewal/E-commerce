<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); 
if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
?>
    <script>
        window.location.href = 'Home.php';
    </script>
<?php } ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
Confirm_Login() 
 ?>
 <?php
date_default_timezone_set( "Asia/Kolkata");
$currenttime=time();
$ctotal = 0;
foreach($_SESSION['cart'] as $key=>$val){
$proArr=get_product($conn,'','','',$key,'','offer');
if($proArr[0]['offer_price'] !== '0'){
    $pprice = $proArr[0]['offer_price'];
    }else{
    $pprice = $proArr[0]['price'];
    }
$qty = $val['qty'];
$ctotal =$ctotal+($pprice*$qty);
}
if(isset($_POST['submit'])){
    //prx($_POST);
    $address = get_safe_value($conn,$_POST['address']);
    $city = get_safe_value($conn,$_POST['city/state']);
    $pincode = get_safe_value($conn,$_POST['pincode']);
    $payment_type = get_safe_value($conn,$_POST['paymentMethod']); 
    $userid = $_SESSION["UserId"];
    $total_price = $ctotal;
    $payment_status = "pending";
    if($payment_type=='COD'||$payment_type=='Debit card'){
    $payment_status = "success";}
    
    $order_status = 'pending';
    $added_on=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
    mysqli_query($conn,"insert into `order`(user_user_id,address1,city,pincode,payment_type,payment_status,order_status,added_on,total_price) 
    values('$userid','$address','$city','$pincode','$payment_type','$payment_status','$order_status', '$added_on','$total_price')");

    $order_id=mysqli_insert_id($conn);
    foreach($_SESSION['cart'] as $key=>$val){
        $proArr=get_product($conn,'','','',$key);
        $pprice = $proArr[0]['price'];
        $qty = $val['qty'];
        mysqli_query($conn,"insert into `order_detail`(order_order_id,product_product_id,quantity,price) 
        values('$order_id','$key','$qty','$pprice')");
    }
    unset($_SESSION["cart"]);?>
    <script>
        window.location.href = 'Thanks_page.php';
    </script>
    <?php
}
?>
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>
      <?php require_once("Includes/Headlinks.php")?>
        <link rel="stylesheet" href="assets/css/empty_cart_style.css">
        <script>

        function gateway(x){
            if(x==0)
            document.getElementById('gateway').style.display='block';
            else
            document.getElementById('gateway').style.display='none';
        }

        </script>
        <style>
         .cc{
            margin-right: 23px;
            padding: 0;
            border: 0;
        }
        </style>

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
    </head>
    <body>
    <?php require_once("Includes/Header.php")?>
    <?php require_once("Includes/Nav.php")?>




<body class="bg-light">

    <div class="container mb-5">
        <main>
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Price Details</span>
                        <!-- <span class="badge bg-primary rounded-pill">3</span> -->
                    </h4>
                    <ul class="list-group mb-3">
                    <?php 
                        $ctotal = 0;
                        foreach($_SESSION['cart'] as $key=>$val){
                        $proArr=get_product($conn,'','','',$key,'','offer');
                        // prx($proArr);
                        $pname = $proArr[0]['name'];
                        if($proArr[0]['offer_price'] !== '0'){
                            // $pprice = $proArr[0]['price'];
                            $pprice = $proArr[0]['offer_price'];
                            }else{
                            $pprice = $proArr[0]['price'];
                            }
                        $pimage = $proArr[0]['image'];
                        $qty = $val['qty'];
                        $ctotal =$ctotal+($pprice*$qty);
                        ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0"><?php echo $pname ?></h6>
                                <small class="text-muted">Qty: <?php echo $qty ?></small>
                            </div>
                            <span class="text-muted">MRP: ₹<?php echo $pprice*$qty ?></span>
                        </li>
                        <?php }?>
                        <!-- <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Third item</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$5</span>
                        </li> -->
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (₹)</span>
                            <strong><?php echo $ctotal ?></strong>
                        </li>
                    </ul>

                    <!-- <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </form> -->
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Billing address</h4>
                    <form class="needs-validation" method="post">
                        <div class="row g-3">
                            <!-- <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback"> Valid first name is required.</div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">Valid last name is required.</div>
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" id="username" placeholder="Username" required>
                                    <div class="invalid-feedback">Your username is required.</div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                                <input type="email" class="form-control" id="email" placeholder="you@example.com">
                                <div class="invalid-feedback">Please enter a valid email address for shipping updates.</div>
                            </div> -->

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
                                <div class="invalid-feedback">Please enter your shipping address.</div>
                            </div>

                            <!-- <div class="col-12">
                                <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                            </div> -->

                            <!-- <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <select class="form-select" id="state" required>
                                         <option value="">Choose...</option>
                                        <option>Gujarat</option>
                                        <option>Rajasthan</option>
                                        <option>Mharastra</option>
                                        <option>M.P</option>
                                </select>
                                <div class="invalid-feedback">Please provide a valid state.</div>
                            </div> -->
                            <div class="col-md-5">
                                <label for="city/state" class="form-label">City/State</label>
                                <input type="text" class="form-control" id="city/state" name="city/state"placeholder="" required>
                                <!-- <select class="form-select" id="country" required>
                                    <option value="">Choose...</option>
                                    <option>India</option>
                                </select> -->
                                <div class="invalid-feedback">Please  enter your  City/State.</div>
                            </div>

                            <div class="col-md-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="number" class="form-control" id="zip" name="pincode" placeholder="" required minlength="3" maxlength="6" size="10">
                                <div class="invalid-feedback">Zip code required.</div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="same-address">
                            <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="save-info">
                            <label class="form-check-label" for="save-info">Save this information for next time</label>
                        </div> -->

                        <hr class="my-4">

                        <h4 class="mb-3">Payment</h4>

                        <div class="my-3">
                            <div class="form-check">
                            <input id="debit" name="paymentMethod" type="radio" class="form-check-input" value="COD" onclick="gateway(1)" novalidate>    
                            <!-- <input id="cod" name="paymentMethod" type="radio" class="form-check-input" value="COD" onclick="gateway(1)" required> -->
                                <label class="form-check-label" for="COD">COD</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" value="Debit card" onclick="gateway(0)" required>
                                <label class="form-check-label" for="debit">Debit card</label>
                            </div>
                        </div>

                        <div class="row gy-3" id="gateway">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">Name on card is required</div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Debit card number</label>
                                <input type="text" class="form-control" id="cc-number" placeholder=""  required minlength="11" maxlength="12" size="10">
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration(mm/yy)</label>
                                <input type="text" class="form-control" id="cc-expiration" placeholder="" required minlength="5" maxlength="5" size="10"> 
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="number" class="form-control" id="cc-cvv" placeholder="" required min="100" max="999">
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                            
                        <hr class="my-4">
                        <!-- <button type="button" > -->
                        <input class="form-control" type="submit" name="submit" value="Continue to checkout"/>
                    </form>
                </div>
            </div>
        </main>
<!-- 
        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017–2021 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer> -->
    </div>
        <?php require_once("Includes/Footer.php")?>
        <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <!-- <script src="form-validation.js"></script> -->
        <script>
    document.getElementById('gateway').style.display='none';
    $('#year').text(new Date().getFullYear());
    </script>
    </body>
    </html>