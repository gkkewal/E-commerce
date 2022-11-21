<?php
session_start();

// define ('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/New Project');
// define ('SITE_PATH','localhost:8080/New Project/');
// define ('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH. '/assets/img/');
// define ('PRODUCT_IMAGE_SITE_PATH', SITE_PATH. 'assets/img/');
function ErrorMessage(){
    if(isset($_SESSION["ErrorMessage"])){
        $Output = "<div class=\" error alert alert-danger \" role=\"alert\">";
        $Output .= htmlentities($_SESSION["ErrorMessage"]);
        $Output .= "</div>";
        $_SESSION["ErrorMessage"] = null;
        return $Output;
    }
}
function SuccessMessage(){
    if(isset($_SESSION["SuccessMessage"])){
        $Output = "<div class=\"alert alert-success\">";
        $Output .= htmlentities($_SESSION["SuccessMessage"]);
        $Output .= "</div>";
        $_SESSION["SuccessMessage"] = null;
        return $Output;
    }
}
?>