<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php
date_default_timezone_set( "Asia/Kolkata");
$currenttime=time();
$Datetime=strftime("%d-%B-%Y %H:%M:%S",$currenttime);

$FName = $_POST["fname"];
$LName = $_POST["lname"];
$Email = $_POST["emailid"];
$Pnumber = $_POST["contact"];
$Gender = $_POST["gender"];
$Password = $_POST["password"];
        global $conn;
        if(mysqli_connect_error()){
        die('Connect Error ('.mysqli_connect_errno().')'.mysqli_connect_error());
        }else{
        $select = "select email from user where email = ? limit 1";
        $stmt = $conn->prepare($select);
        $stmt->bind_param("s",$Email);
        $stmt->execute();
        $stmt->bind_result($Email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        if($rnum==0){
          $stmt->close();
          if(strlen($Pnumber)>10||strlen($Pnumber)<10||$Pnumber<1){
            $_SESSION["ErrorMessage"] = "Contact should be of 10 number!!";
            Redirect_to("Registration.php");
          }else{
          $insert = "insert into user(first_name,last_name,gender,password,email,phone,doj)
          values(?,?,?,?,?,?,?)"; 
          $stmt = $conn->prepare($insert);
          $stmt->bind_param("sssssis",$FName,$LName,$Gender,$Password,$Email,$Pnumber,$Datetime);
          $stmt->execute();
          Redirect_to("Home.php");
          }
        }
        else{
          $_SESSION["ErrorMessage"]="Someone already register using this email" ;
          Redirect_to("Registration.php");
        }
        $stmt->close();
        $conn->close();
        }?>
