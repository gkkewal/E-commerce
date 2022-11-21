<?php require_once("Includes/DB.php"); ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
$search_value=$_GET["search"];
if(!empty($search_value)){
global $ConnectingDB;
$sql = "select * from supplier where supp_name like '%$search_value%'";
$stmt = $ConnectingDB->query($sql);
$sr =0;
$output ="";
  $output = '<table class="table table-striped table-hover" id="tableid">
  <thead class="thead-dark ">
  <tr>
  <th>#</th>
  <th>Supplierr Name</th>
  <th>Contact</th>
  <th>Email</th>
  <th>Address</th>
  <th>Action</th>
  </tr>
  </thead>';
  while($DataRows = $stmt->fetch()){
    $sr++;
    $output .="<tbody>
    <tr>
    <td>{$DataRows["supplier_id"]}</td>
    <td>{$DataRows["supp_name"]}</td>
    <td>{$DataRows["supp_contact"]}</td>
    <td>{$DataRows["supp_email"]}</td>
    <td>{$DataRows["supp_add"]}</td>
    <td>
        <a href='EditSupplier.php?id={$DataRows["supplier_id"]}' ><span class='btn btn-warning'> Edit</span></a>
        <a href='Delete.php?id={$DataRows["supplier_id"]}&type=supp' ><span class='btn btn-danger'> Delete</span></a>
    </td>
    </tr>
    </tbody>"; 
}
$output .="</table>";
echo $output;
}
?>