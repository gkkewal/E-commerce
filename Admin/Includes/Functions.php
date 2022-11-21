<?php
    function Redirect_to($New_Location){
        header("Location:".$New_Location);
        exit;
    }?>
    
<?php
function Confirm_Login(){
    if(isset($_SESSION["UserId"])){
        return true;
    }else{
        $_SESSION["ErrorMessage"]="Login is Required !";
        Redirect_to("Login.php");
    }
}
function get_safe_value($ConnectingDB,$str){
    if($str!=''){
        $str=trim($str);
        return mysqli_real_escape_string($conn,$str);
    }
}
function TotalProducts(){
    global $ConnectingDB;
            $sql = "SELECT COUNT(*) FROM product";
            $stmt = $ConnectingDB->query($sql);
            $TotalRows= $stmt->fetch();
            $TotalProducts=array_shift($TotalRows);
            echo $TotalProducts;
}

function TotalCategory(){
    global $ConnectingDB;
            $sql = "SELECT COUNT(*) FROM category";
            $stmt = $ConnectingDB->query($sql);
            $TotalRows= $stmt->fetch();
            $TotalCategories=array_shift($TotalRows);
            echo $TotalCategories;
}

function TotalSubCategory(){
    global $ConnectingDB;
            $sql = "SELECT COUNT(*) FROM sub_category";
            $stmt = $ConnectingDB->query($sql);
            $TotalRows= $stmt->fetch();
            $TotalSubCategories=array_shift($TotalRows);
            echo $TotalSubCategories;
}

function TotalAdmins(){
    global $ConnectingDB;
            $sql = "SELECT COUNT(*) FROM admin";
            $stmt = $ConnectingDB->query($sql);
            $TotalRows= $stmt->fetch();
            $TotalAdmins=array_shift($TotalRows);
            echo $TotalAdmins;
}

function TotalSupplier(){
    global $ConnectingDB;
            $sql = "SELECT COUNT(*) FROM supplier";
            $stmt = $ConnectingDB->query($sql);
            $TotalRows= $stmt->fetch();
            $TotalSupplier=array_shift($TotalRows);
            echo $TotalSupplier;
}

    function CheckUserNameExistsOrNot($UserName){
    global $ConnectingDB;
        $sql = "SELECT username FROM admins WHERE username =:userName";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':userName',$UserName);
        $stmt->execute();
        $Result = $stmt->rowcount();
        if($Result==1){
            return true;
        }else{
            return false;
        }
}

    function Login_Attempt($UserName,$Password){
    global $ConnectingDB;
        $sql = "select * from admin where username=:userName AND password=:passWord limit 1";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':userName',$UserName);
        $stmt->bindValue(':passWord',$Password);
        $stmt->execute();
        $Result = $stmt->rowcount() ;
        if($Result==1){
            return $Found_Account=$stmt->fetch();
        }else{
            return null;
        }
}
function create_category()
{
    $Category = $_POST["CategoryTitle"];
    $Admin="group-28";
    date_default_timezone_set( "Asia/Kolkata");
    $currenttime=time();
    $Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
    $Status = "0";
    if(empty($Category)){
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
            Redirect_to("Categories.php");
        }
    elseif(strlen($Category)<2){
         $_SESSION["ErrorMessage"]="Category title should be greater than 2 character" ;
            Redirect_to("Categories.php"); }
    elseif(strlen($Category)>49){
        $_SESSION["ErrorMessage"] = "Category title should be less than 50 character";
            Redirect_to("Categories.php");
        }
    else{
        global $ConnectingDB;
        $sql = "insert into category(name,admin,datetime,status)";
        $sql .= "values(:categoryName,:adminName,:dateTime,:Status)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':categoryName',$Category);
        $stmt->bindValue(':adminName',$Admin);
        $stmt->bindValue(':dateTime',$Datetime);
        $stmt->bindValue(':Status',$Status);
        $Execute=$stmt->execute();
        if($Execute){
            $_SESSION["SuccessMessage"] = "Category is successfully added";
            Redirect_to("Categories.php");
        }else{
            $_SESSION["ErrorMessage"] = "something went wrong. Try Again!!!";
            Redirect_to("Categories.php");
        }
        }
}
function create_subcategory(){
    $Parentname = $_POST["categorytitle"];
    $SubCategory = $_POST["SubCategory"];
    $Admin="group-28";
    date_default_timezone_set( "Asia/Kolkata");
    $currenttime=time();
    $Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
    $Status = "0";
    if(!empty($Parentname))
    {
        global $ConnectingDB;
        $sql1 = "select category_id,name from category where name='$Parentname'";
        $stmt1 = $ConnectingDB->query($sql1);
        $DateRows = $stmt1->fetch();
        $ParentId = $DateRows["category_id"];
        
    }
    if(empty($SubCategory)){
        $_SESSION["ErrorMessage"] = "All fields must be filled out";
            Redirect_to("Categories.php");
        }
    elseif(strlen($SubCategory)<2){
         $_SESSION["ErrorMessage"]="Category title should be greater than 2 character" ;
            Redirect_to("Categories.php"); }
    elseif(strlen($SubCategory)>49){
        $_SESSION["ErrorMessage"] = "Category title should be less than 50 character";
            Redirect_to("Categories.php");
        }
    else{
        
        $sql = "insert into sub_category(sname,category_id,datetime,admin,status)";
        $sql .= "values(:subcategoryName,:parentId,:dateTime,:adminName,:Status)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':subcategoryName',$SubCategory);    
        $stmt->bindValue(':parentId',$ParentId);
        $stmt->bindValue(':dateTime',$Datetime);
        $stmt->bindValue(':adminName',$Admin);
        $stmt->bindValue(':Status',$Status);
        $Execute=$stmt->execute();
        if($Execute){
            $_SESSION["SuccessMessage"] = "Sub-Category is successfully added";
            Redirect_to("Categories.php");
        }else{          
            $_SESSION["ErrorMessage"] = "something went wrong. Try A gain!!!" ;
            Redirect_to("Categories.php");
        }
        }
}

?>
<?php function create_brand(){
    $Brand = $_POST["BrandTitle"];
    $Admin="group-28";
    date_default_timezone_set( "Asia/Kolkata");
    $currenttime=time();
    $ImgBrand = $_FILES["Image"]["name"];
    $Target = "Uploads/".basename($_FILES["Image"]["name"]);
    $Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
    //  if(!empty($ParentId))
    // {
    //     $_SESSION["ErrorMessage"] = "ParentId must be filled out".$ParentId;
    //         Redirect_to("Categories.php");
        
    // }
    if(empty($Brand)){
        $_SESSION["ErrorMessage"] = "Brand name must be filled out";
            Redirect_to("Brand.php");
        }
    elseif(strlen($Brand)<2){
         $_SESSION["ErrorMessage"]="Brand name should be greater than 2 character" ;
            Redirect_to("Brand.php"); }
    elseif(strlen($Brand)>49){
        $_SESSION["ErrorMessage"] = "Brand name title should be less than 50 character";
            Redirect_to("Brand.php");
        }
    else{
        global $ConnectingDB;
        $sql = "insert into brand(brand,bimage)";
        $sql .= "values(:bRand,:bImage)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':bRand',$Brand);
        $stmt->bindValue(':bImage',$ImgBrand);
        $Execute=$stmt->execute();
        if($Execute){
            move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
            $_SESSION["SuccessMessage"] = "Brand is successfully added";
            Redirect_to("Brand.php");
        }else{
            $_SESSION["ErrorMessage"] = "something went wrong. Try A gain!!!";
            Redirect_to("Brand.php");
        }
        }
}


?>
<?php function create_slider(){
    //$Brand = $_POST["BrandTitle"];
    // $Admin="group-28";
    // date_default_timezone_set( "Asia/Kolkata");
    // $currenttime=time();
    $PID = '1';
    $ImgSlider = $_FILES["Image"]["name"];
    $Target = "Uploads/".basename($_FILES["Image"]["name"]);
    $status = "0";
    //$Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);
    //  if(!empty($ParentId))
    // {
    //     $_SESSION["ErrorMessage"] = "ParentId must be filled out".$ParentId;
    //         Redirect_to("Categories.php");
        
    // }
    if(empty($ImgSlider)){
        $_SESSION["ErrorMessage"] = "Slider Image must be select out";
            Redirect_to("Slider.php");
        }
    else{
        global $ConnectingDB;
        $sql = "insert into image(image_path,product_product_id,status)";
        $sql .= "value(:Image,:piD,:Sta)";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':Image',$ImgSlider);
        $stmt->bindValue(':piD',$PID);
        $stmt->bindValue(':Sta',$status);
        $Execute=$stmt->execute();
        if($Execute){
            move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
            $_SESSION["SuccessMessage"] = "Slider is successfully added";
            Redirect_to("Slider.php");
        }else{
            $_SESSION["ErrorMessage"] = "something went wrong. Try A gain!!!";
            Redirect_to("Slider.php");
        }
        }
}

?>