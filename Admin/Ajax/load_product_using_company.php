<?php require_once("../Includes/DB.php"); 
?>
<?php
$brandname =$_GET["brand_name"];
global $ConnectingDB;
$sql = "select product_id,name from product where brand='$brandname'";
$stmt = $ConnectingDB->query($sql); 
?>
<select class="form-control" id="ProductTitile" name="Product" >
<option>select</option>
<?php
while($DateRows = $stmt->fetch()){
 echo "<option>";
 echo $DateRows["name"];
 echo "</option>";
 
}
echo "</select>";
?>
