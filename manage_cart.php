<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php require_once("add_to_cart.php"); ?>
<?php
  $pid=mysqli_real_escape_string($conn,$_POST['pid']);
  $qty=mysqli_real_escape_string($conn,$_POST['qty']);
  $type=mysqli_real_escape_string($conn,$_POST['type']);
  
  $obj=new add_to_cart();
if ($type=='add'){
      $obj->addProduct($pid,$qty);
}
if ($type=='update'){
    $obj->updateProduct($pid,$qty);
}
if ($type=='remove'){
  $obj->removeProduct($pid);
}
  echo $obj->totalProduct();
?>