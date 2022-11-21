<?php 
require_once("Includes/Functions.php"); 
require_once("Includes/Sessions.php"); 
require_once("Includes/DB.php"); 
require_once("Vendor/autoload.php");
if(!isset($_SESSION['AdminName'])){
   if(!isset($_SESSION['UserId'])){
   die();
   }
}
$order_id = get_safe_value($conn,$_GET['id']);
//$css.= file_get_contents('https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css');
$css= file_get_contents('./assets/css/PDFStyle.css');
$html = '
<H1 align="center"> Invoice</H1>
<header class="clearfix">
        <div id="company" style="display:inline-flex;align-items:center;">
         <h2 class="name">J-Electricwala</h2>
         <div>1031,Luhar Sheri,Saraspur,<br/>Ahmedabad-380018.</div>
         <div>(+91) 9824411460</div>
         <div><a href=""> jalaramenterprise1@gmail.com</a></div>
        </div>

        
      
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">Dharmesh</h2>
          <div class="address">26,Luharsheri,Saraspur,Ahmedabad-380018</div>
          <div class="email"><a href="mailto:j-electricwala.com">j-electricwala.com</a></div>
        </div>

      </div>
      <table>
      <thead>
        <tr>
          <th class="service">SERVICE</th>
          <th class="desc">DESCRIPTION</th>
          <th>PRICE</th>
          <th>QTY</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>';
      if(isset($_SESSION['AdminName'])){
        $res=mysqli_query($conn,"select distinct(order_detail.order_detail_id),order_detail.*,product.name,product.image,product.price,product.offer_price from order_detail,product,
        `order` where order_detail.order_order_id='$order_id' and order_detail.product_product_id=product.product_id");
     }else{
     $uid = $_SESSION['UserId'];
     $res=mysqli_query($conn,"select distinct(order_detail.order_detail_id),order_detail.*,product.name,product.image,product.price,product.offer_price,product.description from order_detail,product,
     `order` where order_detail.order_order_id='$order_id' and `order`.user_user_id='$uid' and 
     order_detail.product_product_id=product.product_id");
     }
     $total_price=0;
     while($row=mysqli_fetch_assoc($res)){
          if($row['offer_price'] !== '0'){
             $pp = $row['offer_price'];
             } else{ 
             $pp = $row['price'];}
             $ppp = $row['quantity']*$pp;
             $total_price=$total_price+($row['quantity']*$pp);
      $html.='
        <tr>
          <td class="service">'.$row['name'].'</td>
          <td class="desc">'.$row['description'].'</td>
          <td class="unit">'.$row['quantity'].'</td>
          <td class="qty">'.$pp.'</td>
          <td class="total">'.$ppp.'</td>
        </tr>';
      }
   $html.='
        <tr>
          <td colspan="4" class="grand total">GRAND TOTAL</td>
          <td class="grand total">'.$total_price.'</td>
        </tr>
      </tbody>
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