<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php 
		$_SESSION["UserId"]=null;
        $_SESSION["Emailid"]=null;
        $_SESSION["Password"]=null;
session_destroy();
Redirect_to("Home.php");
?>