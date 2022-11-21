<?php require_once("../Includes/Functions.php"); ?>
<?php require_once("../Includes/Sessions.php"); ?>
<?php require_once("../Includes/DB.php"); ?>
<?php //session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

    function send_password_reset($get_name,$get_email,$token)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->Username = "studypurpose9099@gmail.com";//email
        $mail->Password = "Kewal@123";//password
        
        $mail->SMTPSeture = "tls";
        $mail->Port = 587;
                     
        $mail->setFrom("studypurpose9099@gmail.com",$get_name);//email address
        $mail->addaddress($get_email);

        $mail->isHTML (true);
        $mail->Subject = "Reset Password Notification";

        $email_template = "
        <h2>Hello</h2>
        <h3>You are receiving this email because we received a password reset request for your account.</h3>
        <br/>
        <a href = 'http://localhost:8080/php%20prog/Project/Password-reset/reset_password.php?token=$token&email=$get_email'> Click Me </a>";
        $mail->Body = $email_template;
        if(!$mail->send()) {
            $_SESSION["SuccessMessage"] = "Message could not be sent.Mailer Error: ". $mail->ErrorInfo;
            Redirect_to("recover_email.php");
        } else {
            $_SESSION["SuccessMessage"] = "We e-mailed you a password reset link";
            Redirect_to("recover_email.php");
            //echo 'Message has been sent';
        }
        // $mail->send();
    }


   if(isset($_POST['password_reset_link']))
   {
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $token = md5(rand(10,50));

    $check_email =  "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run) > 0)
    {
   $row = mysqli_fetch_array($check_email_run);
   $get_name = $row['first_name'];
   $get_email = $row['email'];
   $update_token = "UPDATE user SET token = '$token' WHERE email='$get_email' LIMIT 1" ;
   $update_token_run = mysqli_query($conn,$update_token);

        if($update_token_run)
        {
            send_password_reset($get_name,$get_email,$token);
            $_SESSION["SuccessMessage"] = "Incorrect Username/Password";
            // $_SESSION['status'] = "We e-mailed you a password reset link";
            Redirect_to("recover_email.php");
            exit(0);   
        }else{
            $_SESSION['SuccessMessage'] = "Something Went wrong";
            Redirect_to("recover_email.php");
            exit(0);
        }
    }
    else
    {
        // echo 'Message has been sent';
        $_SESSION["SuccessMessage"] = "No Email Found";
        Redirect_to("recover_email.php");
        
        //exit(0);
    }
}

//reset_password
if (isset($_POST['password_update']))
{
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $new_password = mysqli_real_escape_string($conn,$_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn,$_POST['confirm_password']);
    $token = mysqli_real_escape_string($conn,$_POST['password_token']);
if(!empty($token))
{
    if(!empty($email) && !empty($new_password) && !empty($confirm_password)){
        //check token valid or not
        $check_token = "SELECT token FROM user WHERE token='$token' LIMIT 1"; 
        $check_token_run = mysqli_query($conn, $check_token);

        if(mysqli_num_rows($check_token_run) > 0){

            if($new_password == $confirm_password){
                $update_password = "UPDATE user SET password = '$new_password' WHERE token= '$token' LIMIT 1";
                $update_password_run = mysqli_query($conn, $update_password);

                    if($update_password_run){
                        $new_token = md5(rand(10,50));
                        $update_to_new_token = "UPDATE users SET token='$new_token' WHERE token='$token' LIMIT 1";
                        $update_to_new_token_run = mysqli_query($conn, $update_to_new_token);
                        
                        $_SESSION['SuccessMessage'] = "New password successfully updated";
                        Redirect_to("http://localhost:8080/php%20prog/Project/Login.php");
                        exit(0);

                    }else{
                        $_SESSION['SuccessMessage'] = "Old password not changed,something went wrong";
                        Redirect_to("reset_password.php?token=$token&email=$email");
                        exit(0);
                    }
            }
            else{
                $_SESSION['SuccessMessage'] = "Password and Confirm password not match";
                Redirect_to("reset_password.php?token=$token&email=$email");
                exit(0);
            }
        }else{
            $_SESSION['SuccessMessage'] = "Invalid Token";
            Redirect_to("reset_password.php?token=$token&email=$email");
            exit(0);
        }
    }
    else
    {
        $_SESSION['SuccessMessage'] = "All filled are Mandatory";
            Redirect_to("reset_password.php?token=$token&email=$email");
            exit(0);
    }

}
else{
    
    $_SESSION['SuccessMessage'] = "No Token Available";
            Redirect_to("reset_password.php");
            exit(0);
}
}
?>