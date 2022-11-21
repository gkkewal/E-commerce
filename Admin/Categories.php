<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/Header.php");?>
<?php
    $_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login() 
 ?>
<?php
if(isset($_POST["addcat"])){
    create_category();
}

if(isset($_POST["addsubcat"])){
    create_subcategory();
}
?>
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

    <title>Categories</title>
</head>

<body>
    <!--navbar-->
    <!--NAVBAR-END-->
    <!--HEADER-->
    <header class="bg-dark text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12 "></div>
                <h1><i class="fa fa-edit" style="color:#27aae1;"></i>Manage Categories</h1>
            </div>
        </div>
    </header>
    <!-- HEADER-END -->
    <!-- MAIN AREA -->
    <section class="container py-2 mb-4">
        <div class="row">
            <form class="form" action="Categories.php?add=" method="POST">
            <div class="offset-lg-1-col-lg-10 foot">
                <?php echo ErrorMessage();
                      echo SuccessMessage();
                ?>
                    <div class="card bg-secondary text-light mb-3">
                        <div class="card-header row">
                            <div class="col-lg-6 mb-2 ">
                                    <a href="Categories.php?add=add-category" class="btn btn-primary btn-block"><i class="fas fa-plus"></i>Add Category</a>
                            </div>
                            <div class="col-lg-6 mb-2 ">
                                <!-- <button type="Submit" name="AddSubCategory" > -->
                                <a href="Categories.php?add=add-subcategory" class="btn btn-info btn-block"><i class="fas fa-plus "></i>Add SUb-Category</a>
                                <!-- </button> -->
                            </div>
                        </div>
                    </div>
                    <?php
                                  
                                  if(isset($_GET["add"])){
                                    $add=$_GET["add"];
                                  switch($add){
                                          case 'add-category':                      
                                ?>
                        <form class="" action="" method="post">
                        <div class="card-body bg-dark">
                            <div class="form-group">
                                <lable for="title"><span class="FieldInfo">Category Title:</span></lable>
                                <input class="form-control" type="text" name="CategoryTitle" id="title"
                                    placeholder="Type Title Here" value="" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i
                                            class="fas fa-arrow-left"></i> Back To Dashboard</a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" name="addcat" class="btn btn-success btn-block">
                                        <i class="fas fa-check"></i> Publish
                                    </button>
                                </div>
                            </div>
                        </div>
                        <h2>Existing Categories</h2>                
        <table class="table table-striped table-hover">
        <thead class="thead-dark ">
        <tr>
        <th>No.</th>
        <th>Category</th>
        <th>Admin</th>
        <th>Datetime</th>
        <th>Status</th>
        <!-- <th>Action</th> -->
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select * from category";
    $stmt = $ConnectingDB->query($sql);
    $No =0;
    while($DataRows = $stmt->fetch()){
        $Id = $DataRows["category_id"];
        $Category = $DataRows["name"];
        $Admin =$DataRows["admin"];
        $Status = $DataRows["status"];
        $Datetime = $DataRows["datetime"];
        $No++;
    ?>
    <tbody>
    <tr>
    <td><?php echo htmlentities($No);?></td>
    <td><?php echo htmlentities($Category);?></td>
    <td><?php echo htmlentities($Admin)?></td>
    <td><?php echo htmlentities($Datetime)?></td>
    <td>
    <div class="form-check form-switch ">
    <input type="checkbox" class="form-check-input " <?php if($Status==1){echo "checked";}?> onclick="CatStatus(<?php echo $Id;?>)" id="check">
    <!-- <label class="custom-control-label" for="switch1">Toggle me</label> -->
  </div>
    </td>
    <!-- <td>
        <a href="Delete.php?id=<?php echo $Id;?>&type=cat" ><span class="btn btn-danger">Delete</span></a>
    </td> -->
    </tr>
    </tbody>
    <?php
    }
    ?>
    </table>   
                        </form>
                        <?php
                            break;
                            case 'add-subcategory':
                        ?>
                        
                        <div class="card-header bg-secondary ">
                            <h2 style="color:white">Create Subcategory</h2>
                        </div>
                        <form class="" action="" method="post">
                        <div class="card-body bg-dark">
                        <div class="form-group">
                                
                                <lable for="categorytitle"><span class="FieldInfo">Category </span></lable>
                                <select class="form-control" id="parentid" name="categorytitle">
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
                                <lable for="subtitle"><span class="FieldInfo">Sub-Category Title:</span></lable>
                                <input class="form-control" type="text" name="SubCategory" id="subtitle"
                                    placeholder="Type Title Here" value="" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <a href="Dashboard.php" class="btn btn-warning btn-block"><i
                                            class="fas fa-arrow-left"></i> Back To Dashboard</a>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" name="addsubcat" class="btn btn-success btn-block">
                                        <i class="fas fa-check"></i> Publish
                                    </button>
                                </div>
                            </div>
                        </div> 
                        <br>
                        <h2>Existing SubCategories</h2>                
        <table class="table table-striped table-hover">
        <thead class="thead-dark ">
        <tr>
        <th>No.</th>
        <th>SubCategory</th>
        <th>Category</th>
        <th>Admin</th>
        <th>Datetime</th>
        <th>Status</th>
        <!-- <th>Action</th> -->
        </tr>
        </thead>
    
    <?php
    global $ConnectingDB;
    $sql = "select * from sub_category";
    $stmt = $ConnectingDB->query($sql);
    $No =0;
    while($DataRows = $stmt->fetch()){
        $Id = $DataRows["subcategory_id"];
        $Subcategory = $DataRows["sname"];
        $Category_id = $DataRows["category_id"];
        $sql1 = "select name from category where category_id='$Category_id'";
        $stmt1 = $ConnectingDB->query($sql1);
        $DataRows2 = $stmt1->fetch();
        $Catname = $DataRows2["name"];
        $Admin =$DataRows["admin"];
        $Status = $DataRows["status"];
        $Datetime = $DataRows["datetime"];
        $No++;
    ?>
    <tbody>
    <tr>
    <td><?php echo htmlentities($No);?></td>
    <td><?php echo htmlentities($Subcategory);?></td>
    <td><?php echo htmlentities($Catname);?></td>
    <td><?php echo htmlentities($Admin)?></td>
    <td><?php echo htmlentities($Datetime)?></td>
    <td>
    <div class="form-check form-switch ">
    <input type="checkbox" class="form-check-input " <?php if($Status==1){echo "checked";}?> onclick="SubCatStatus(<?php echo $Id;?>)" id="check">
    <!-- <label class="custom-control-label" for="switch1">Toggle me</label> -->
  </div>
    </td>
    <!-- <td>
        <a href="Delete.php?id=<?php echo $Id;?>&type=subcat" ><span class="btn btn-danger">Delete</span></a>
    </td> -->
    </tr>
    </tbody>
    <?php
    }
    ?>
    </table>   
                        </form>
                <?php
                            break; 
                            default: ;
                            break;
                                   }  }
                                   else{
                                       
                                   }

                        ?>
                        
                </div>
                
            </form>
        </div>
    </section>
    <!-- MAIN AREA-END -->
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
        function CatStatus(id){
            var Id = id;
            $.ajax({
                url:"toggle.php?catid="+Id,type:"GET",
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
        function SubCatStatus(id){
            var Id = id;
            $.ajax({url:"toggle.php?subcatid="+Id,type:"GET",
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