
 <?php
    function Redirect_to($New_Location){
        header("Location:".$New_Location);
        exit;
    }?>
    
<?php
function pr($arr){
    echo '<pre>';
    print_r($arr);
}
function prx($arr){
    echo '<pre>';
    print_r($arr);
    die();
}
function get_safe_value($conn,$str){
    if($str!=''){
        $str=trim($str);
        return mysqli_real_escape_string($conn,$str);
    }
}

function Confirm_Login(){
    if(isset($_SESSION["UserId"])){
        return true;
    }else{
        $_SESSION["ErrorMessage"]="Login is Required !";
        Redirect_to("Login.php");
    }
}

//     function CheckUserNameExistsOrNot($UserName){
//     global $ConnectingDB;
//         $sql = "SELECT username FROM admins WHERE username =:userName";
//         $stmt = $ConnectingDB->prepare($sql);
//         $stmt->bindValue(':userName',$UserName);
//         $stmt->execute();
//         $Result = $stmt->rowcount();
//         if($Result==1){
//             return true;
//         }else{
//             return false;
//         }
// }

//     function Login_Attempt($UserName,$Password){
//         // global $conn;
//         $sql = "select * from user where email=? AND password=? limit 1";
//         $stmt = $conn->prepare($sql);
//         $stmt->bind_param("ss",$UserName,$Password);
//         $stmt->execute();
//         $stmt->bind_result($Email,$Password);
//         $stmt->store_result();
//         $rnum = $stmt->num_rows;
//         if($rnum==1){
//             return $Found_Account=$stmt->fetch();
//         }else{
//             return null;
//         }
// }

function get_product($conn,$type='',$limit='',$subcat_id='',$product_id='',$q='',$offer=''){
    // $sql = "select product.*,sub_category.sname from product,sub_category where product.status=0 ";
    if($offer!=''){
        $sql = "select * from product where status=1";    
    }    
    else{
    $sql = "select * from product where status=1 and offer = 0";
    }
    if ($subcat_id!='') {
        $sql.=" and subcategory_id=$subcat_id ";
        // $sql.=" and product.subcategory_id=$subcat_id ";
    }
    if ($product_id!='') {
        // $sql.=" and product.product_id=$product_id ";
        $sql.=" and product_id=$product_id ";
    }
    if ($q!='') {
        // $sql.=" and product.product_id=$product_id ";
        $sql.=" and ( name like '%$q%' or description like '%$q%' ) ";
    }
    //$sql.=" and product.subcategory_id=sub_category.subcategory_id ";
    // $sql.=" order by product.product_id desc";
    $sql.=" order by product_id desc";
    if($limit!=''){
        // $sql.=" product.limit $limit";
        $sql.=" limit $limit";
    }
    $res=mysqli_query($conn,$sql);
    $data = array();
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }  
    return $data;
}
function get_best_product($conn,$type='',$limit='',$subcat_id=''){
    $sql = "select * from product where status=1";
    if ($subcat_id!='') {
        $sql.=" and subcategory_id=$subcat_id ";
        // $sql.=" and product.subcategory_id=$subcat_id ";
    }
    if($type=='latest'){ 
        $sql.=" order by product_id asc";
    }
    if($limit!=''){
        $sql.=" limit $limit";
    }
    $res=mysqli_query($conn,$sql);
    $data = array();
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }  
    return $data;
}
function get_best_brand($conn,$type='',$limit=''){
    $sql = "select * from brand";
    // if($type=='latest'){
    //     $sql.=" order by brand_id asc";
    // }
    if($limit!=''){
        $sql.=" limit $limit";
    }
    $res=mysqli_query($conn,$sql);
    $data = array();
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }  
    return $data;
}
?>
<?php
function get_best_offer($conn,$type='',$limit='',$offer=''){
    $sql = "select * from product where status=1";
    if ($offer!='') {
        $sql.=" and offer != 0 ";
        // $sql.=" and product.subcategory_id=$subcat_id ";
    }
    if($type=='latest'){ 
        $sql.=" order by product_id asc";
    }
    if($limit!=''){
        $sql.=" limit $limit";
    }
    $res=mysqli_query($conn,$sql);
    $data = array();
    while($row=mysqli_fetch_assoc($res)){
        $data[]=$row;
    }  
    return $data;
}?>