<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() 
 ?>
 <script type="text/javascript">
    function select_category(CategoryTitile){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("SubCategoryTitile").innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","Ajax/load_subcat_using_cat.php?cat="+CategoryTitile,true);
    xmlhttp.send();
    }
    function count_price(price){
    var dis_price;
    var offer = document.getElementById("offerTitile").value;
    if(offer!=null){
    dis_price = eval(price)*eval(offer)/100;
    document.getElementById("Offerprice").value = eval(price)-eval(dis_price);
    }else{
        document.getElementById("Offerprice").value = 0;
    }
    }
</script> 

<?php
    if(isset($_POST["Submit"]))
{
    $Product = $_POST["ProductTitle"];
    $SubCategoryName = $_POST["SubCategory"];
    $Image = $_FILES["Image"]["name"];
    $Target = "Uploads/".basename($_FILES["Image"]["name"]);
    $Price = $_POST["Price"];
    $ProductDescription = $_POST["ProductDescription"];
    $Admin="Group28";
    $Productonhand = "5";
    $Status = "0";
    $Brand = $_POST["Brand"];
    if($_POST['Offer']!==null){
        $Offer = $_POST['Offer'];
        $offer_Price = $_POST['OfferPrice'];
    }
    date_default_timezone_set( "Asia/Kolkata");
    $currenttime=time();
    $Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
    if(!empty($SubCategoryName))
    {
        global $ConnectingDB;
        $sql1 = "select subcategory_id from sub_category where sname='$SubCategoryName'";
        $stmt1 = $ConnectingDB->query($sql1);
        $DateRows = $stmt1->fetch();
        $SubId = $DateRows["subcategory_id"];
    }
    if(empty($Product)){
        $_SESSION["ErrorMessage"] = "Product name can't be empty";
            Redirect_to("AddNewProduct.php");
        }
    elseif(strlen($Product)<4){
         $_SESSION["ErrorMessage"]="Product name should be greater than 4 character" ;
            Redirect_to("AddNewProduct.php"); }
    elseif(strlen($Product)>49){
        $_SESSION["ErrorMessage"] = "Product name should be less than 50 character";
            Redirect_to("AddNewProduct.php");
    }
    else{
        global $ConnectingDB;
        if($Offer!==null){
        $sql = "insert into product(name,price,productonhand,description,brand,subcategory_id,image,status,datetime,admin,offer,offer_price)";
        $sql .= "values(:productName,:pRice,:productOnHand,:deS,:braNd,:subCategory,:imagE,:sTatus,:dateTime,:aDmine,:Offer,:offer_Price)";
        }else{
        $sql = "insert into product(name,price,productonhand,description,brand,subcategory_id,image,status,datetime,admin)";
        $sql .= "values(:productName,:pRice,:productOnHand,:deS,:braNd,:subCategory,:imagE,:sTatus,:dateTime,:aDmine)";
        }
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':productName',$Product);
        $stmt->bindValue(':pRice',$Price);
        $stmt->bindValue(':productOnHand',$Productonhand);
        $stmt->bindValue(':deS',$ProductDescription);
        $stmt->bindValue(':braNd',$Brand);
        $stmt->bindValue(':subCategory',$SubId);
        $stmt->bindValue(':imagE',$Image);
        $stmt->bindValue(':sTatus',$Status);
        $stmt->bindValue(':dateTime',$Datetime);
        $stmt->bindValue(':aDmine',$Admin);
        if($Offer!==null){
            $stmt->bindValue(':Offer',$Offer);
            $stmt->bindValue(':offer_Price',$offer_Price);
        }
        $Execute=$stmt->execute();
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
    if($Execute){
        $_SESSION["SuccessMessage"] = "Product is successfully added";
            Redirect_to("AddNewProduct.php");
    }else{
        $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
            Redirect_to("AddNewProduct.php");
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

    <title>Add New Product</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
                <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Add Product</h1>
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
                <form class="" action="AddNewProduct.php" method="post" enctype="multipart/form-data">
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header">
                            <h1>Add New Products</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Product Name:</span></label>
                                <input class="form-control" type="text" name="ProductTitle" id="title"
                                    placeholder="Type Title Here" value="">
                            </div>
                            <div class="form-group">
                                <lable for="CategoryTitile"><span class="FieldInfo">Choose Category:</span></lable>
                                <select class="form-control" id="CategoryTitile" name="Category" onchange="select_category(this.value)">
                                   <option>select</option>
                                   <?php
                                   global $ConnectingDB;
                                   $sql = "select category_id,name from category";
                                   $stmt = $ConnectingDB->query($sql);
                                   while($DateRows = $stmt->fetch()){
                                    $id = $DateRows["category_id"];
                                    $CategoryName = $DateRows["name"];
                                   ?>
                                   <option><?php echo $CategoryName; ?></option>
                                <?php }   ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <lable for="SubCategoryTitile"><span class="FieldInfo">Choose Sub-Category:</span></lable>
                                <select class="form-control" id="SubCategoryTitile" name="SubCategory">
                                   <option>select</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <lable for="BrandTitile"><span class="FieldInfo">Choose Brand:</span></lable>
                                <select class="form-control" id="BrandTitile" name="Brand">
                                <option>select</option>
                                   <?php
                                   global $ConnectingDB;
                                   $sql = "select brand_id,brand from brand";
                                   $stmt = $ConnectingDB->query($sql);
                                   while($DateRows = $stmt->fetch()){
                                    $Brandid = $DateRows["brand_id"];
                                    $BrandName = $DateRows["brand"];
                                   ?>
                                   <option><?php echo $BrandName; ?></option>
                                <?php }   ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ChooseImage"><span class="FieldInfo">Choose Image:</span></label>
                                <div class="custom-file">

                                    <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
                                    <label for="imageSelect" class="custom-file-label">Select Image:</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <lable for="BrandTitile"><span class="FieldInfo">Choose Offer:</span></lable>
                                <select class="form-control" id="offerTitile" name="Offer">
                                <option>select</option>
                                   <?php
                                   global $ConnectingDB;
                                   $sql = "select offers_id,offer,discount from offers";
                                   $stmt = $ConnectingDB->query($sql);
                                   while($DateRows = $stmt->fetch()){
                                    $Offersid = $DateRows["offers_id"];
                                    $Offer = $DateRows["offer"];
                                    $Discount = $DateRows["discount"];
                                   ?>
                                   <option><?php echo $Discount; ?></option>
                                <?php }   ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pricetitle"><span class="FieldInfo">Price:</span></label>
                                <input class="form-control" type="number" name="Price" id="price"
                                    placeholder="Type Price Here" value="" onkeyup="count_price(this.value)">
                            </div>

                            <div class="form-group">
                                <label for="offerpricetitle"><span class="FieldInfo">Offer Price:</span></label>
                                <input class="form-control" type="number" name="OfferPrice" id="Offerprice"
                                    placeholder="Type Price Here" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="description"><span class="FieldInfo">Product Description:</span></label>
                                <textarea class="form-control" id="" name="ProductDescription" rows="8"
                                    cols="80"></textarea>
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