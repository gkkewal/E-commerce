<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php
global $conn;
if(isset($_GET["product_id"])){
    $product_id = mysqli_real_escape_string($conn,$_GET["product_id"]);
    if(isset($_GET['type'])){
        $get_product=get_product($conn,'',8,'',$product_id,'',$_GET['type']);
    }else{
    $get_product=get_product($conn,'',8,'',$product_id);
    }// $cat_arr = array();
    // while ($row = mysqli_fetch_assoc($cat_res)) {
    //     $cat_arr[] = $row;
    //prx($get_product);
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
    <link rel="stylesheet" href="./assets/css/ProductStyle.css">
</head>

<body>
    <!-- Start Header -->
    <?php require_once("Includes/Header.php") ?>
    <!-- End Header -->

    <!--navbar start-->
    <?php require_once("Includes/Nav.php") ?>
    <!--navbar end-->

    <div class="super_container">
        <div class="single_product">
            <div class="container-fluid" style=" background-color: #fff; padding: 11px;">
                <div class="row">
                    <div class="col-lg-6 order-lg-2 order-1">
                        <div class="image_selected set_img">
                            <img src="assets/img/<?php echo $get_product['0']['image']?>" alt="full image"/>
                        </div>
                    </div>
                    <div class="col-lg-6 order-3">
                        <div class="product_description">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
                                    <!-- <li class="breadcrumb-item"><a href="Category.php?subcat_id="></a></li> -->
                                    <li class="breadcrumb-item active"><?php echo $get_product['0']['name']?></li>
                                </ol>
                            </nav>
                            <div class="product_name"><?php echo $get_product['0']['name']?></div>
                           <?php if(isset($_GET['type'])){?>
                            <div> <span class="product_price">Offer Price: ₹ <?php echo $get_product['0']['offer_price']?></span> 
                           </div>
                            <div> 
                           (Incl. of all taxes) <span style='color:red'><?php echo "(".$get_product['0']['offer']."%off)"?></span><br/>
                           <strike class="product_discount" style='color:black'> <span style='color:black'><p>MRP: ₹ <?php echo $get_product['0']['price']?></p></span></strike>
                            </div>
                            <?php }else{?>
                                <div> <span class="product_price">₹ <?php echo $get_product['0']['price']?></span> 
                                </div>
                            <?php }?>
                            <hr class="singleline">
                            <div> <span class="product_saved">Description:</span> <span style='color:black'><?php echo $get_product['0']['description']?></span> </div>
                            <hr class="singleline">
                            <div class="order_info d-flex flex-row">
                                <form action="#">
                            </div>
                            <div class="row">
                                <div class="col-xs-6" style="margin-left: 13px;">
                                        <h6><span>QTY: </span>
                                        <!-- <div class="quantity_buttons"> -->
                                        <select id="qty">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select></h6>
                                        <!-- </div> -->
                                </div>
                                <div class="col-xs-6"> 
                                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['product_id']?>','add')">
                                     <button type="button" class="btn btn-primary shop-button">Add to Cart</button></a>
                                     <a href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['product_id']?>','add','yes')">
                                     <button type="button" class="btn btn-success shop-button">Buy Now</button></a>
                                    <!-- <div class="product_fav"><i class="fas fa-heart"></i></div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="best-sellers">
    <div class="container ">
    <div class="block_heading"><h2>Related Product</h2></div>
      <div class="row ">
        <?php
          $get_product=get_product($conn,'latest',8,$get_product['0']['subcategory_id'],'','','offer');
          //prx($get_product);
          foreach($get_product as $list){
        ?>
        <div class="col-lg-3 col-md-3 d-flex justify-content-center">
          <div class="best-main mb-4">
            <div class="product-img">
              <img src="assets/img/<?php echo $list['image']?>" class="img-fluid">
            </div>
            <div class="best-product-name">
              <h5><?php echo $list['name']?> </h5>
            </div> 
            <div class="best-product-decs">
              <p><?php echo $list['description']?></p>
            </div>
            <!-- <div class="best-product-size">
              <p>Sweep Size 1250 mm</p>
            </div>
            <div class="best-product-offer">
              <p>Offer Price: ₹ 6,757.00</p>
            </div> -->
            <div class="best-product-price">
            <?php if($list['offer_price'] !== '0'){ ?>
              <!-- <strike class="product_discount" style='color:black'>  <span><p>MRP: ₹ <?php echo $list['price']?></p></span></strike> <br/>-->
              (Incl. of all taxes) <span style='color:red'><?php echo "(".$list['offer']."%off)"?></span>
              <p>Offer price: ₹ <?php echo $list['offer_price']?></p>
            <?php } else{ ?>
              <p>MRP: ₹ <?php echo $list['price']?></p>
            <?php }?>
            </div>
            <div class="best-button mt-4">
              <a href="Product.php?product_id=<?php echo $list['product_id']?>"><button>VIEW DETAILS</button></a>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
  </section>
    <!-- ======= Footer ======= -->
    <?php require_once("Includes/Footer.php") ?>
    <!-- Javascript Cdn -->
    <script src=" 	https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>