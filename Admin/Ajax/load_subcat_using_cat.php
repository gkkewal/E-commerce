<?php require_once("../Includes/DB.php"); 
?>
<?php
$Category =$_GET["cat"];
global $ConnectingDB;
$sql1 = "select category_id from category where name='$Category'";
$stmt1 = $ConnectingDB->query($sql1);
$DateRows1 = $stmt1->fetch();
$cat_id = $DateRows1["category_id"];
$sql = "select subcategory_id,sname from sub_category where category_id='$cat_id'";
$stmt = $ConnectingDB->query($sql); 
?>
<select class="form-control" id="SubCategoryTitile" name="SubCategory">
<option>select</option>
<?php
while($DateRows = $stmt->fetch()){
 echo "<option>";
 echo $DateRows["sname"];
 echo "</option>";
}
echo "</select>";
?>
