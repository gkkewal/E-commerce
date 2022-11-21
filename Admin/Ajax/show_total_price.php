
<?php require_once("../Includes/DB.php"); 
?>
<?php
$price =$_GET["pri"];
$qty =$_GET["qty"];
$total =$qty * $price;
?>
<input class="form-control" type="number"  id="AmtTitle"  
<?php echo "value=$total"?>
>

