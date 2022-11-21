<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
if(isset($_GET["id"])&&("subcat"==$_GET["type"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
    $sql = "delete from subcategory where subcategory_id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
      if($Execute){
      $_SESSION["SuccessMessage"] = "Sub-Category Deleted successfully";
          Redirect_to("Categories.php?add=add-subcategory");
  }else{
      $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
          Redirect_to("Categories.php?add=add-subcategory");
 }
}
?>
<?php
if(isset($_GET["id"])&&("cat"==$_GET["type"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
    $sql = "delete from category where category_id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
      if($Execute){
      $_SESSION["SuccessMessage"] = "Category Deleted successfully";
          Redirect_to("Categories.php?add=add-category");
  }else{
      $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
          Redirect_to("Categories.php?add=add-category");
 }
}
?>
<?php
if(isset($_GET["id"])&&("supp"==$_GET["type"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
    $sql = "delete from supplier where supplier_id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
      if($Execute){
      $_SESSION["SuccessMessage"] = "Supplier Deleted successfully";
          Redirect_to("AddNewSupplier.php");
  }else{
      $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
          Redirect_to("AddNewSupplier.php");
 }
}
?>
<?php
if(isset($_GET["id"])&&("brand"==$_GET["type"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
    $sql = "delete from brand where brand_id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
      if($Execute){
      $_SESSION["SuccessMessage"] = "Brand Deleted successfully";
          Redirect_to("Brand.php");
  }else{
      $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
          Redirect_to("Brand.php");
 }
}
?>
<?php
if(isset($_GET["id"])&&("user"==$_GET["type"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
    $sql = "delete from user where user_id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
      if($Execute){
      $_SESSION["SuccessMessage"] = "Purchase Deleted successfully";
          Redirect_to("Users.php");
  }else{
      $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
          Redirect_to("Users.php");
 }
}
?>
<?php
if(isset($_GET["id"])&&("offer"==$_GET["type"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
    $sql = "delete from offers where offers_id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
      if($Execute){
      $_SESSION["SuccessMessage"] = "Offer Deleted successfully";
          Redirect_to("Offer.php");
  }else{
      $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
          Redirect_to("Offer.php");
 }
}
?>