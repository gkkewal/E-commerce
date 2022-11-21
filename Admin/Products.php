<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php 
 $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() ?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/d331d0c0ff.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Css/Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Products</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1><i class="fa fa-blog" style="color:#27aae1;"></i>Product Details</h1>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="AddNewProduct.php" class="btn btn-primary btn-block"><i class="fas fa-edit"></i>Add New Product</a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Brand.php" class="btn btn-info btn-block"><i class="fas fa-edit"></i>Add New
                        Brand</a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Offer.php" class="btn btn-warning btn-block"><i class="fas fa-edit"></i>Add New Offer</a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="Slider.php" class="btn btn-success btn-block"><i class="fas fa-check"></i>Add New Slider</a>
                </div>
            </div>
        </div>
    </header>
    <section class="container py-2 mb-4">
    <div class="row">
    <div class="col-lg-12">
    <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
    <table class="table table-striped table-hover">
        <thead class="thead-dark ">
        <tr>
        <th>#</th>
        <th>Name</th>
        <th>SubCategory</th>
        <th>Admin</th>
        <th>Brand</th>
        <th>Banner</th>
        <th>Qantity</th>
        <th>Price</th>
        <th>Offer</th>
        <th>Offer_Price</th>
        <th>Status</th>
        <th>Action</th>
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select * from product";
    $stmt = $ConnectingDB->query($sql);
    $sr =0;
    while($DataRows = $stmt->fetch()){
        $Id = $DataRows["product_id"];
        $Name = $DataRows["name"];
        $Subcategoryid = $DataRows["subcategory_id"];
        $sql1 = "select sname from sub_category where subcategory_id='$Subcategoryid'";
        $stmt1 = $ConnectingDB->query($sql1);
        $DataRows2 = $stmt1->fetch();
        $SubName = $DataRows2["sname"];
        $Admin = $DataRows["admin"];
        $Brand = $DataRows["brand"];
 //       $Datetime = $DataRows["datetime"];
        $Image = $DataRows["image"];
        $Quantity = $DataRows["productonhand"];
        $Price = $DataRows["price"];
        $Status = $DataRows["status"];
        // if($DataRows["status"]!==0){
          $Offer = $DataRows["offer"];
          $offer_Price = $DataRows["offer_price"];
        //}
        $sr++;
    ?>
    <tbody>
    <tr>
    <td><?php echo $sr;?></td>
    <td><?php echo $Name;?></td>
    <td><?php echo $SubName;?></td>
    <td><?php echo $Admin;?></td>
    <td><?php echo $Brand;?></td>
    <td><img src="Uploads/<?php echo $Image;?>" width="70px;" height="70px;"></td>
    <td><?php echo $Quantity;?></td>
    <td><?php echo $Price;?></td>
    <?php if($Offer!=0){?>
    <td><?php echo $Offer;?></td>
    <td><?php echo $offer_Price;?></td><?php }else{?>
    <td>NULL</td>
    <td>NULL</td><?php }?>
    
    <td>
    <div class="form-check form-switch ">
    <input type="checkbox" class="form-check-input " <?php if($Status==1){echo "checked";}?> onclick="toggleStatus(<?php echo $Id;?>)" id="check">
    <!-- <label class="custom-control-label" for="switch1">Toggle me</label> -->
    </div>
    </td>
    <td>
        <div class="d-flex justify-content-around">
        <a href="EditProduct.php?id=<?php echo $Id;?>" ><span class="btn btn-warning"><i class="fas fa-edit"></i></span></a>
        <a href="DeleteProduct.php?id=<?php echo $Id;?>" ><span class="btn btn-danger"><i class="fas fa-trash"></i></span></a>
        </div>
    </td>
    </tr>
    </tbody>
    <?php
    }
    ?>
    </table>
    </div>
    </div>
    </section>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.l.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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
        function toggleStatus(id){
            var Id = id;
            $.ajax({
                url:"toggle.php?proid="+Id,type:"GET",
                success: function(result){
                        if(result == '1'){
                            swal("Done!","status is Active","success");
                        }else{
                            swal("Done!","status is Deactive","success");
                        }
                    }
            });
        }
        </script>
    <script>
    $('#year').text(new Date().getFullYear());
    </script>
    
</body>

</html>