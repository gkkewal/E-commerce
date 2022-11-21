<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php Confirm_Login() ?>

<?php $SearchQueryParameter = $_GET["id"];?>
<?php
if(isset($_POST["Submit"]))
{
        global $ConnectingDB;
        $sql = "delete from product where product_id='$SearchQueryParameter'";
        $Execute=$ConnectingDB->query($sql);
        if($Execute){
        $_SESSION["SuccessMessage"] = "Product Deleted successfully";
            Redirect_to("Products.php");
    }else{
        $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
            Redirect_to("Products.php");
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

    <title>Delete Product</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
                <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Delete Product</h1>
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
                      global $ConnectingDB;
                      
                      $sql = "select * from product where product_id='$SearchQueryParameter'";
                      $stmt = $ConnectingDB->query($sql);
                      while($DataRows=$stmt->fetch()){
                        $Name = $DataRows["name"];
                        $Subcategory = $DataRows["subcategory_id"];
                        $Image = $DataRows["image"];
                        $Price = $DataRows["price"];
                        $Quantity = $DataRows["productonhand"];
                        $ProductDescription = $DataRows["description"];
                      }
                ?>
                <form class="" action="DeleteProduct.php?id=<?php echo $SearchQueryParameter;?>" method="post" enctype="multipart/form-data">
                    <div class="card bg-secondary text-light mb-3">
                         <div class="card-header">
                            <h1>Edit Product Details</h1>
                        </div>
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <label for="title"><span class="FieldInfo">Product Name:</span></label>
                                <input disabled class="form-control" type="text" name="ProductTitle" id="title"
                                    placeholder="Type Title Here" value="<?php echo $Name;?>">
                            </div>
                            <div class="form-group">
                                <span class="FieldInfo">Existing SubCategory:</span>
                                <?php
                                    echo $Subcategory;
                                ?></br>
                            </div>
                            <div class="form-group">
                                <span class="FieldInfo">Existing Image:</span>
                                <img src="Uploads/<?php echo $Image;?>" width="170px"; height="70px";>
                                </br>
                            </div>
                            <div class="form-group">
                                <label for="pricetitle"><span class="FieldInfo">Price:</span></label>
                                <input disabled class="form-control" type="number" name="Price" id="title"
                                    placeholder="Type Price Here" value="<?php echo $Price;?>">
                            </div>
                            <div class="form-group">
                                <label for="description"><span class="FieldInfo">Product Description:</span></label>
                                <textarea disabled class="form-control" id="description" name="ProductDescription" rows="8"
                                 cols="80" value=""><?php echo $ProductDescription;?>
                                </textarea>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Products.php" class="btn btn-warning btn-block"><i
                                            class="fas fa-arrow-left"></i> Back To Dashboard</a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                     <button type="submit" name="Submit" class="btn btn-danger btn-block">
                                        <i class="fas fa-trash"></i> Delete
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