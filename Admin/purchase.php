<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() 
 ?>
<script type="text/javascript">
    function select_brand(BrandTitile){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("ProductTitile").innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET", "Ajax/load_product_using_company.php?brand_name="+BrandTitile,true);
        xmlhttp.send();
    }
    function count_price(price){
    document.getElementById("AmtTitle").value= eval(document.getElementById("qtytitle").value)*eval(document.getElementById("price").value);
        
    // var xmlhttp = new XMLHttpRequest();
    // xmlhttp.onreadystatechange = function(){
    //     if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
    //     {
    //         document.getElementById("AmtTitle").innerHTML=xmlhttp.responseText;
    //     }
    // };
    // var Qty= document.getElementById("qtytitle").value;
    // xmlhttp.open("GET", "Ajax/show_total_price.php?pri="+price+"&qty="+Qty,true);
    // xmlhttp.send();
    }
</script> 
<?php
    if(isset($_POST["Submit"]))
{
    $Brand = $_POST["Brand"];
    $Product = $_POST["Product"];
    $Quantity = $_POST["Qty"];
    $Price = $_POST["Price"];
    $Supplier = $_POST["Supplier"];
    $Purchasetype = $_POST["Purchasetype"];
    $Admin="Group28";
    date_default_timezone_set( "Asia/Kolkata");
    $currenttime=time();
    $Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
    if(empty($Quantity)){
        $_SESSION["ErrorMessage"] = "Quantity can't be empty";
            Redirect_to("purchase.php");
        }
    elseif(strlen($Quantity)<1){
         $_SESSION["ErrorMessage"]="Quantity should be greater than 1 character" ;
            Redirect_to("purchase.php"); }
    elseif(strlen($Quantity)>10){
        $_SESSION["ErrorMessage"] = "Quantity should be less than 10 character";
            Redirect_to("purchase.php");
    }
    else{
        global $ConnectingDB;
        $sql = "insert into purchase(brand,product_name,quantity,price,supplier_name,purchase_type)";
        $sql .= "values(:braNd,:productName,:qUantity,:pRice,:suPplier_name,:purChasetype)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':braNd',$Brand);
        $stmt->bindValue(':productName',$Product);
        $stmt->bindValue(':qUantity',$Quantity);
        $stmt->bindValue(':pRice',$Price);
        $stmt->bindValue(':suPplier_name',$Supplier);
        $stmt->bindValue(':purChasetype',$Purchasetype);
         $Execute=$stmt->execute();
    if($Execute){
        $_SESSION["SuccessMessage"] = "Purchase is successfully added";
        global $ConnectingDB;
        $sql = "update product set productonhand=productonhand+$Quantity where name='$Product'";
        $Execute=$ConnectingDB->query($sql);    
        Redirect_to("Purchase.php");
    }else{
        $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
            Redirect_to("Purchase.php");
    }
        }
}
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Css\Style.css">
    <script src="https://kit.fontawesome.com/d331d0c0ff.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Purchase</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
                <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Purchase</h1>
            </div>
        </div>
    </header>
    <!-- HEADER-END -->
    <!-- MAIN AREA -->
    <section class="container py-2 mb-4">
        <div class="row">
            <div class="offset-lg-1-col-lg-10 foot">
                <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
                <form class="" action="purchase.php" method="post" enctype="multipart/form-data">
                    <div class="card bg-secondary text-light mb-3">
                        <!-- <div class="card-header">
                            <h1>Purchase</h1>
                        </div> -->
                        <div class="card-body bg-dark">
                            
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Brand Name:</span></label>
                                <select class="form-control" id="BrandTitile" name="Brand" onchange="select_brand(this.value)">
                                <option>select</option>  
                                <?php
                                   global $ConnectingDB;
                                   $sql = "select brand_id,brand from brand";
                                   $stmt = $ConnectingDB->query($sql);
                                   while($DateRows = $stmt->fetch()){
                                    $Brandid = $DateRows["brand_id"];
                                    $BrandName = $DateRows["brand"];
                                   ?>
                                   <option><?php echo $BrandName;?></option>
                                <?php }   ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Product Name:</span></label>
                                <div class="control"  id="ProductTitile">
                                    <select class="form-control">
                                    <option>select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Supplier Name:</span></label>
                                <select class="form-control" id="SupplierTitile" name="Supplier">
                                <option>select</option>
                                   <?php
                                   global $ConnectingDB;
                                   $sql = "select supplier_id,supp_name from supplier";
                                   $stmt = $ConnectingDB->query($sql);
                                   while($DateRows = $stmt->fetch()){
                                    $Suppid = $DateRows["supplier_id"];
                                    $SuppName = $DateRows["supp_name"];
                                   ?>
                                   <option><?php echo $SuppName; ?></option>
                                <?php }   ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Qtytitle"><span class="FieldInfo">Enter Quantity:</span></label>
                                <input class="form-control" type="number" name="Qty" id="qtytitle" placeholder="Type Quantity Here" value="">
                            </div>
                            <div class="form-group">
                                <label for="pricetitle"><span class="FieldInfo">Enter Price:</span></label>
                                <input class="form-control" type="number" name="Price" id="price"
                                    placeholder="Type Price Here" value="" onkeyup="count_price(this.value)">
                            </div>
                            <div class="form-group">
                                <label for="amounttitle"><span class="FieldInfo">Total Amount:</span></label>
                                    <input class="form-control" type="number" id="AmtTitle" readonly>

                                
                            </div>
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Payment Type:</span></label>
                                <select class="form-control" id="purchasetype" name="Purchasetype">
                                <option>select</option>
                                    <option>CHASE</option>
                                   <option>CHEQUE</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Products.php" class="btn btn-warning btn-block"><i
                                            class="fas fa-arrow-left"></i> Back To Dashboard</a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" name="Submit" class="btn btn-success btn-block">
                                        <i class="fas fa-check"></i> Publish
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
        <thead class="thead-dark ">
        <tr>
        <th>No.</th>
        <th>Brand</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Supplier</th>
        <th>Purchase-type</th>
        <!-- <th>Action</th> -->
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select * from purchase";
    $stmt = $ConnectingDB->query($sql);
    $No =0;
    while($DataRows = $stmt->fetch()){
        $Id = $DataRows["Purchase_id"];
        $Brand = $DataRows["brand"];
        $Product = $DataRows["product_name"];
        $Quantity = $DataRows["quantity"];
        $Price = $DataRows["price"];
        $Supplier = $DataRows["supplier_name"];
        $Purchase_type =$DataRows["purchase_type"];
        $No++;
    ?>
    <tbody>
    <tr>
    <td><?php echo htmlentities($No);?></td>
    <td><?php echo htmlentities($Brand);?></td>
    <td><?php echo htmlentities($Product);?></td>
    <td><?php echo htmlentities($Quantity);?></td>
    <td><?php echo htmlentities($Price);?></td>
    <td><?php echo htmlentities($Supplier);?></td>
    <td><?php echo htmlentities($Purchase_type);?></td>
    <!-- <td>
        <a href="Delete.php?id=<?php echo $Id;?>&type=purchase" ><span class="btn btn-danger">Delete</span></a>
    </td> -->
    </tr>
    </tbody>
    <?php
    }
    ?>
    </table>
                </form>
            </div>
        </div>
    </section>
    <!-- MAIN AREA-END -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script>
    $('#year').text(new Date().getFullYear());
    </script>
</body>

</html>