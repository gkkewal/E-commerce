<?php 
require_once("Includes/Functions.php"); 
require_once("Includes/Sessions.php"); 
require_once("Includes/DB.php"); 
require_once("../vendor/autoload.php");
if(!isset($_SESSION['AdminName'])){
   if(!isset($_SESSION['UserId'])){
   die();
   }
}
$purchase_id = get_safe_value($conn,$_GET['id']);
//$css.= file_get_contents('https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css');
$css.= file_get_contents('Css/PDFStyle.css');
$html = '
<H1 align="center"> Purchase Report</H1>
<header class="clearfix">
<div id="logo" style="font-size:14px;padding:0px 20px;color:#000000;display:inline-flex;justify-content:flex-end;align-items:center;text-align:left">
        
        <img alt="" src="assets/img/logo1.png" width="35%" height="25%" >
        </div>        
        <div id="company" style="display:inline-flex;align-items:center;">
         <h2 class="name">J-Electricwala</h2>
         <div>1031,Luhar Sheri,Saraspur,<br/>Ahmedabad-380018.</div>
         <div>(+91) 9824411460</div>
         <div><a href=""> jalaramenterprise1@gmail.com</a></div>
        </div>

        
      
    </header>
    <main>
      <table>
      <thead>
        <tr>
          <th class="service">No.</th>
          <th class="desc">Brand</th>
          <th>Product</th>
          <th>QTY</th>
          <th>Price</th>
          <th>Supplier</th>
          <th>Purchase-type</th>
        </tr> 
      </thead>';
      global $ConnectingDB;
    $sql = "select * from purchase";
    $stmt = $ConnectingDB->query($sql);
    $No =0;
    while($DataRows = $stmt->fetch()){
        $No=$No+1;
        $Id = $DataRows["Purchase_id"];
        $Brand = $DataRows["brand"];
        $Product = $DataRows["product_name"];
        $Quantity = $DataRows["quantity"];
        $Price = $DataRows["price"];
        $Supplier = $DataRows["supplier_name"];
        $Purchase_type =$DataRows["purchase_type"];
        
      $html.='
      <tbody>
        <tr>
          <td class="ser">'.$NO.'</td>
          <td class="desc">'.$Brand.'</td>
          <td class="unit">'.$Product.'</td>
          <td class="qty">'.$Quantity.'</td>
          <td class="price">'.$Price.'</td>
          <td class="supp">'.$Supplier.'</td>
          <td class="pur">'.$Purchase_type.'</td>
        </tr>
      </tbody>';
      }
   $html.='
    </table>
  </main>
  <footer>
    Invoice was created on a computer and is valid without the signature and seal.
  </footer>
';
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output();

?>