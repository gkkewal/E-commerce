<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
if(isset($_GET["id"])&&("admin"==$_GET["type"])){
  $SearchQueryParameter = $_GET["id"];
  global $ConnectingDB;
    $sql = "delete from admin where id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);
      if($Execute){
      $_SESSION["SuccessMessage"] = "Admin Deleted successfully";
          Redirect_to("Admins.php");
  }else{
      $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
          Redirect_to("Admins.php");
 }
}
?>