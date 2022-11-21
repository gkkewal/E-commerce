<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>J-electricwala</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php require_once("Includes/Headlinks.php")?>
</head>

<body>

  <!-- Start Header -->  
<?php require_once("Includes/Header.php")?>
  <!-- End Header -->

  <!-- appliances -->

<!--navbar start-->
<?php require_once("Includes/Nav.php")?>
<!--navbar end-->


<section id="slider-main">
    <div class="container-fluid p-0">
      <div class="row">
        <div class="slider">
        <?php
                  $result=mysqli_query($conn,"select image_path from image");
                  $data = array();
                  while($row=mysqli_fetch_assoc($result)){
                        $data[]=$row;
                      }
        $i=0;
        foreach($data as $list){
        $act = '';
        if($i == 0){
          $act = 'active';
          }
        ?>
          <div class="col-lg-6 <?= $act; ?> ">
            <img src="Admin/Uploads/<?= $list['image_path'];?>"  class="img-fluid" alt="hello">
          </div>
        <?php $i++; }?>
        </div>
      </div>
    </div>
  </section> 

  <section id="new-arrival">
    <div class="container ">
    <div class="block_heading"><h2>New Arrival</h2></div>
     <!-- <div class="title">New Arrival</div>
      <div class="underline"></div> -->
      <div class="row ">
        <?php
          $get_product=get_product($conn,'latest',8,'','');
          //prx($get_product);
          foreach($get_product as $list){
        ?>
        <div class="col-lg-3 col-md-3 d-flex justify-content-center">
          <div class="best-main mb-4">
            <div class="product-img"><a href="Product.php?product_id=<?php echo $list['product_id']?>">
              <img src="assets/img/<?php echo $list['image']?>" class="img-fluid"></a>
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
              <p>MRP: ₹ <?php echo $list['price']?></p>
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
  <section id="best-sellers">
    <div class="container ">
      <!-- <div class="title">Best offer</div> -->
      <div class="block_heading"><h2>Best offer</h2></div>
      <!-- <div class="underline"></div> -->
      <div class="row ">
        <?php
          $get_product=get_best_offer($conn,'latest',8,'offer');
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
            <div class="best-product-price">
            <strike class="product_discount"> <span style='color:black'><p>MRP: ₹ <?php echo $list['price']?></p></span></strike>(Incl. of all taxes) <span style='color:red'><?php echo "(".$list['offer']."%off)"?></span>
            </div>
            <div class="best-product-offer">
              <p>Offer price:<?php echo $list['offer_price']?></p>
            </div>
            <div class="best-button mt-4">
            <a href="Product.php?product_id=<?php echo $list['product_id']?>&type=offer"><button>VIEW DETAILS</button></a>
            </div>
          </div>
        </div>
        <?php }?>
        
      </div>

    </div>
  </section>

  <!-- <section id="small_banner">
    <div class="container">
      <div class="title">Best Offers</div>
      <div class="underline"></div>
      <div class="row">
        <div class="col-lg-3 col-md-3"> 
          <img src="assets/img/AirtCoolerBanner.jpg" class="img-fluid">
        </div>
      </div>
    </div>
  </section> -->

  <section id="banner">
    <div class="container">
      <div class="banner_img">
        <img src="assets/img/range_shot.png" class="img-fluid">
      </div>
    </div>
  </section>


  <main id="main">

    <!-- ======= Brands ======= -->
  <section id="b">
      <div class="container">
      <div class="block_heading"><h2>Our Brands</h2></div>
        <div class="row">
        <?php
          $get_brand=get_best_brand($conn,'latest',4);
          //prx($get_brand);
          foreach($get_brand as $list){
        ?>
            <div class="col-lg-3 col-md-3">
              <img src="Admin/Uploads/<?php echo $list['bimage']?>" class="img-fluid">
            </div>  
        <?php } ?>
        </div>
      </div>
  </section>
    <!-- End Slider -->

    <!-- ======= About Section ======= -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
<?php require_once("Includes/Footer.php")?>
</body>

</html>