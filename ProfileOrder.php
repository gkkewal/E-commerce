<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php
Confirm_Login();
global $conn;
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$uid = $_SESSION['UserId'];
$result=mysqli_query($conn,"select * from user where user_id =$uid ");
$row = $result->fetch_assoc();
$fn=$row['first_name'] ;
$ln=$row['last_name'];
$uemail=$row['email'];
$uphone=$row['phone'];
$uadd=$row['address'];                 
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Headlinks-start -->
    <?php require_once("Includes/Headlinks.php") ?>
    <!-- Headlinks-end-->

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="assets/css/My_Profile_Style.css">
    <title>Orders</title>
</head>

<body>
    
  <!-- Start Header -->
  <?php require_once("Includes/Header.php") ?>
  <!-- End Header -->

  <!--navbar start-->
  <?php require_once("Includes/Nav.php") ?>
  <!--navbar end-->

    <div class="container mt-5">
        <div class="row">
            <div class="half pt-5 col-lg-4 pb-5 ">
                <!-- Account Sidebar-->
                <?php require_once("Includes/Account_slider.php")?>
            </div>
            <!-- Orders Table-->
            <div class="Order tabShow pt-5 pb-5 col-lg-8">
                <!-- <div class="d-flex justify-content-end pb-3">
                    <div class="form-inline">
                        <label class="text-muted mr-3" for="order-sort">Sort Orders</label>
                        <select class="form-control" id="order-sort">
                            <option>All</option>
                            <option>Delivered</option>
                            <option>In Progress</option>
                            <option>Delayed</option>
                            <option>Canceled</option>
                        </select>
                    </div>
                </div> -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                <th>Address</th>
                                <th>Invoice</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                                
                        // $sql = "select * from `order` where user_user_id='$uid'";
                        $res=mysqli_query($conn,"select `order`.*,order_status.name as 
                        order_status_str from `order`,order_status where `order`.user_user_id='$uid' 
                        and order_status.name=`order`.order_status");
                        // $res = mysqli_query($conn, $sql) ;
                        while($row=mysqli_fetch_assoc($res)){
                        ?>
                            <tr>
                                <td><a class="navi-link" href="my_order_detail.php?id=<?php echo $row['order_id']?>" data-toggle="modal"><?php echo $row['order_id']?></a></td>
                                <td><?php echo $row['added_on']?></td>
                                <td><span class="badge bg-success m-0"><?php echo $row['order_status_str']?></span></td>
                                <td><span class="badge bg-success m-0"><?php echo $row['payment_status']?></span></td>
                                <td><span><?php echo $row['address1']?><br/>
                                    <?php echo $row['city']?><br/>
                                    <?php echo $row['pincode']?>
                                    </span></td>
                                <td>
                                    <a href="order_pdf.php?id=<?php echo $row['order_id'];?>&type=order"><span class="btn btn-primary">PDF</span></a>
                                    <!-- <button class="btn btn-primary" onclick="generatePDF()">PDF</button> -->
                                </td>
                            </tr>
                        <?php }?>    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("Includes/Footer.php") ?>
    <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
    <script>
        function generatePDF(){
            var pdfObject = jsPDFInvoiceTemplate.default(props); //returns number of pages created
            //const pdfObject = jsPDFInvoiceTemplate(props); //returns number of pages created
            console.log("Object created: ", pdfObject);
        }
//or in browser


var props = {
    outputType: jsPDFInvoiceTemplate.OutputType.Save,
    returnJsPDFDocObject: true,
    fileName: "Invoice",
    orientationLandscape: false,
    compress: true,
    logo: {
        src: "assets/img/logo1.png",
        width: 53.33, //aspect ratio = width/height
        height: 26.66,
        margin: {
            top: 0, //negative or positive num, from the current position
            left: 0 //negative or positive num, from the current position
        }
    },
    business: {
        //name: "Business Name",
        address: "1031,Luhar Sheri,Saraspur,Ahmedabad-380018",
        phone: "(+91) 9824411460",
        email: "jalaramenterprise1@gmail.com",
        //email_1: "info@example.al",
        website: "www.Jelectricwala.com",
    },
    contact: {
        label: "Invoice issued for:",
        name: "<?php echo $fn." ".$ln?>",
    //    address: "<php echo $uadd?>",
        phone: "(+91) <?php echo $uphone?>",
        email: "<?php echo $uemail?>",
        //otherInfo: "www.website.al",
    },
    invoice: {
        label: "Invoice #: ",
        num: 19,
       // invDate: "Payment Date: 01/01/2021 18:12",
       //invGenDate: "Invoice Date: 02/02/2021 10:17",
        headerBorder: false,
        tableBodyBorder: false,
        header: [
          {
            title: "#", 
            style: { 
              width: 10 
            } 
          }, 
          { 
            title: "Title",
            style: {
              width: 30
            } 
          }, 
          { 
            title: "Description",
            style: {
              width: 80
            } 
          }, 
          { title: "Price"},
          { title: "Quantity"},
          { title: "Unit"},
          { title: "Total"}
        ],
        table: Array.from(Array(10), (item, index)=>([
            index + 1,
            "There are many variations ",
            "Lorem Ipsum is simply dummy text dummy text ",
            200.5,
            4.5,
            "m2",
            400.5
        ])),
        invTotalLabel: "Total:",
        invTotal: "145,250.50",
        invCurrency: "ALL",
        row1: {
            col1: 'VAT:',
            col2: '20',
            col3: '%',
            style: {
                fontSize: 10 //optional, default 12
            }
        },
        row2: {
            col1: 'SubTotal:',
            col2: '116,199.90',
            col3: 'ALL',
            style: {
                fontSize: 10 //optional, default 12
            }
        },
        //invDescLabel: "Invoice Note",
        //invDesc: "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.",
    },
    footer: {
        text: "The invoice is created on a computer and is valid without the signature and stamp.",
    },
    pageEnable: true,
    //pageLabel: "Page ",
};
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>