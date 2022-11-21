<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php
global $conn;
if(isset($_GET["q"])){
$q = mysqli_real_escape_string($conn,$_GET["q"]);
$get_product=get_product($conn,'',8,'','',$q);
// $cat_arr = array();
// while ($row = mysqli_fetch_assoc($cat_res)) {
//     $cat_arr[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $_GET["q"];?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php require_once("Includes/Headlinks.php") ?>
    <link href="assets/css/CatStyle.css" rel="stylesheet">
</head>

<body>
    <?php require_once("Includes/Header.php") ?>
    <?php require_once("Includes/Nav.php") ?>
    
    <section id="new-arrival">
    <div class="container ">
      <!-- <div class="title">New Arrival</div> -->
      <!-- <div class="underline"></div> -->
      <div class="row ">
        <?php
          if(count($get_product>0)){
          //prx($get_product);
          foreach($get_product as $list){
        ?>
        <div class="col-lg-3 col-md-3 d-flex justify-content-center">
          <div class="best-main mb-4">
            <div class="best-img"><a href="Product.php?id=<?php echo $list['Product_id']?>">
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
            <div class="best-button mt-4 justify-content-center ">
              <a href="Product.php?product_id=<?php echo $list['product_id']?>"><button>VIEW DETAILS</button></a>
              <!-- <a href=""><button>VIEW DETAILS</button></a> -->
            </div>
            <!-- <div class="best-button mt-4">
              <a href=""><button>VIEW DETAILS</button></a>
            </div> -->
          </div>
          
        </div>
        <?php }} else{
                echo "Data not found";
            }?>
      </div>
    </div>
  </section>

    <?php require_once("Includes/Footer.php") ?>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/CatSrc.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>