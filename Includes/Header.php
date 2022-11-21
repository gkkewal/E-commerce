<?php require_once("Functions.php"); ?>
<?php require_once("Sessions.php"); ?>
<?php require_once("DB.php"); ?>
<?php require_once("./add_to_cart.php"); 
$obj=new add_to_cart();
$totalProduct = $obj->totalProduct();
?>
<section id="topbar" class="d-flex align-items-center">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center">
      <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">Jelectrical@gmail.com</a></i>
      <i class="bi bi-phone d-flex align-items-center ms-4"><span>9327020733</span></i>
    </div>
    <div class="social-links d-none d-md-flex align-items-center">
      <a href="https://twitter.com" class="twitter"><i class="bi bi-twitter"></i></a>
      <a href="https://www.facebook.com" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="https://www.instagram.com" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="https://www.skype.com" class="google-plus"><i class="bx bxl-skype"></i></a>
      <a href="https://www.linkedin.com" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
    </div>
  </div>
</section>
<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">
    <a href="Home.php" class="logo"><img src="assets/img/logo1.png" alt="" class="img-fluid"></a>
    <div class="search-container">
            <form class=" d-flex align-items-center" action="search.php" method="GET">
              <input type="text" id="Form_Search" value="" placeholder="Search.." name="q" role="searchbox" class="InputBox " autocomplete="off">
              <input type="submit" id="Form_Go" class="Button"value="GO">
            </form>
    </div>

    <div class="header_Icons">
    
      <div class="contact-info d-flex align-items-center">
    <?php if(isset($_SESSION["First_name"])){?>
      <i class="d-flex align-items-center ms-4"><span><?php echo "Welcome ".$_SESSION["First_name"].","?></span></i>
      <?php }?>
    </div>
    
      <div class="account_box icon_box"> <span class="icon"> <a href="javascript:void(0)"> <img src="./assets/img/account.jpg" alt=""></a></span>
      <!-- <span></span> -->
        <ul class="account_dropdwn">
          <li> <a href="./MyProfile.php">My Account</a></li>
          <li> <a href="./ProfileOrder.php">My Order</a></li>
          <!-- <li> <a href="./ProfileWishlist.php">Wishlist</a></li> -->
          <li class="sign_in_link">
          <span> 
               <?php if(isset($_SESSION["UserId"]) ){?> 
                <a href="./Logout.php"class="btn default_button" >Log out</a> <?php } else{?>
                <a href="./Login.php"class="btn default_button" >Sign In</a> <?php }?>
          </span>
          </li>
        </ul>
      </div>
      <div class="cart_box icon_box">
        <span class="icon"><a href="javascript:void(0)"><img src="./assets/img/cart.jpg" alt="" /></a><a href="Cart.php"><span class="cart_count cc" id="cart_count"><?php echo $totalProduct ?></span></a></span>
      </div>
    </div>
  </div>
  </header>