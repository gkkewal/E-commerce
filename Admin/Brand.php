<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
if(isset($_POST["addbrand"])){
    create_brand();
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <script src="https://kit.fontawesome.com/d331d0c0ff.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Brand</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 "></div>
                <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Manage Brand</h1>
            </div>
        </div>
    </header>
    <!-- HEADER-END -->
    <!-- MAIN AREA -->
    <section class="container py-2 mb-4">
        <div class="row">
            <form class="form" action="Brand.php" method="post" enctype="multipart/form-data">
            <div class="offset-lg-1-col-lg-10 foot">
                <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
                        <form class="" action="" method="post">
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <lable for="title"><span class="FieldInfo">Brand Name:</span></lable>
                                <input class="form-control" type="text" name="BrandTitle" id="title"
                                    placeholder="Type Name Here" value="" required>
                            </div>
                            <h6><span class="FieldInfo">Select Image To Upload!:</h6>
                            <div class="form-group"> 
                                <input type="file" name="Image" id="imageSelect" class="form-control p-1" value="" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i
                                            class="fas fa-arrow-left"></i> Back To Dashboard</a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" name="addbrand" class="btn btn-success btn-block">
                                        <i class="fas fa-check"></i> Publish
                                    </button>
                                </div>
                            </div>
                        </div>
                        <h2>Existing Brand</h2>                
        <table class="table table-striped table-hover">
        <thead class="thead-dark ">
        <tr>
        <th>No.</th>
        <th>Brand</th>
        <th>BrandImage</th>
        <th>Action</th>
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select * from brand";
    $stmt = $ConnectingDB->query($sql);
    $No =0;
    while($DataRows = $stmt->fetch()){
        $Id = $DataRows["brand_id"];
        $Brand = $DataRows["brand"];
        $ImgBrand = $DataRows["bimage"];
        $No++;
    ?>
    <tbody>
    <tr>
    <td><?php echo htmlentities($No);?></td>
    <td><?php echo htmlentities($Brand);?></td>
    <td><?php echo htmlentities($ImgBrand);?></td>
    <td>
        <a href="Delete.php?id=<?php echo $Id;?>&type=brand" ><span class="btn btn-danger">Delete</span></a>
    </td>
    </tr>
    </tbody>
    <?php
    }
    ?>
    </table>   
                        </form>
                        
                </div>
                
            </form>
        </div>
    </section>

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