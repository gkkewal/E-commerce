<?php
    function Redirect_to($New_Location){
        header("Location:".$New_Location);
        exit;
    }?>
<?php 
require_once("Includes/DB.php");
global $ConnectingDB;
?>
<?php
if(isset($_GET['proid'])){
$proId = $_GET['proid'];
$stmt = $ConnectingDB->query("select * from product where product_id='$proId'");
$data = $stmt->fetch();
$status = $data['status'];
if($status == '1'){
  $status = '0';
}else{
  $status = '1';
}
$execute = $ConnectingDB->query("update product set status='$status' where product_id=$proId");
if($execute){
  echo $status;
}}?>
<?php
if(isset($_GET['catid'])){
  $catId = $_GET['catid'];
  $stmt = $ConnectingDB->query("select * from category where category_id='$catId'");
  $data = $stmt->fetch();
  $status = $data['status'];
  if($status == '1'){
    $status = '0';
  }else{
    $status = '1';
  }
  $execute = $ConnectingDB->query("update category set status='$status' where category_id=$catId");
  if($execute){
    echo $status;
  }}
?>
<?php
if(isset($_GET['subcatid'])){
  $subcatId = $_GET['subcatid'];
  $stmt = $ConnectingDB->query("select * from sub_category where subcategory_id='$subcatId'");
  $data = $stmt->fetch();
  $status = $data['status'];
  if($status == '1'){
    $status = '0';
  }else{
    $status = '1';
  }
  $execute = $ConnectingDB->query("update sub_category set status='$status' where subcategory_id=$subcatId");
  if($execute){
    echo $status;
  }}
?>
<?php
if(isset($_GET['sliderid'])){
  $Sliderid = $_GET['sliderid'];
  $stmt = $ConnectingDB->query("select * from image where image_id='$Sliderid'");
  $data = $stmt->fetch();
  $status = $data['status'];
  if($status == '1'){
    $status = '0';
  }else{
    $status = '1';
  }
  $execute = $ConnectingDB->query("update `image` set status='$status' where image_id=$Sliderid");
  if($execute){
    echo $status;
  }
}
?>
<?php
if(isset($_GET['offerid'])){
  $Offerid = $_GET['offerid'];
  $stmt = $ConnectingDB->query("select * from offers where offers_id='$Offerid'");
  $data = $stmt->fetch();
  $status = $data['status'];
  if($status == '1'){
    $status = '0';
  }else{
    $status = '1';
  }
  $execute = $ConnectingDB->query("update offers set status='$status' where offers_id=$Offerid");
  if($execute){
    echo $status;
  }
}
?>