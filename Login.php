<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>
<?php 
if (isset($_SESSION["UserId"])) {
     Redirect_to("Home.php");
}

if(isset($_POST["Submit"]))
{ 
    global $conn;
    $username = mysqli_real_escape_string($conn, $_POST['Emailid']);  
    $password = mysqli_real_escape_string($conn, $_POST['Password']);  
    if (empty($username)||empty($password)){
        $_SESSION["ErrorMessage"]= "All fields must be filled out";
            Redirect_to("Login.php");
    }   
    else{
        $sql = "select * from user where email = '".$username."' and password = '".$password."'";  
        $result = mysqli_query($conn,$sql);  
        $row = mysqli_fetch_array($result);  
        $count = $row['user_id'];  
        // $sql1 = "select * from user where email = '".$username."' and password = '".$password."'";  
        // $result1 = mysqli_query($conn,$sql1);  
        // $row1 = mysqli_fetch_array($result1);  
        if($count>0){
                $_SESSION["UserId"]=$row['user_id'];
                $_SESSION["First_name"]=$row['first_name'];
                $_SESSION["Emailid"]=$row['email'];
                $_SESSION["Password"]=$row['password'];
                //$_SESSION["SuccessMessage"]= "Welcome ".$_SESSION['Emailid']."!";
                if(isset($_SESSION["TrackingURL"])){
                    Redirect_to($_SESSION["TrackingURL"]);
                }else{
                Redirect_to("Home.php");
                }
            }else{
            $_SESSION["ErrorMessage"] = "Incorrect Username/Password";
            Redirect_to("Login.php");
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/LoginStyle.css">
    <!-- font_awsome_csn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="wrapper">
    <?php echo ErrorMessage();
//echo SuccessMessage();
?> 
        <header>Login Form</header>
        <form action="Login.php" method="POST">
            <div class="field email">
                <div class="input-area">
                    <input type="email" name="Emailid" id="emailid" placeholder="Email Address">
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Email can't be blank</div>
            </div>
            <div class="field password">
                <div class="input-area">
                    <input type="password" name="Password" id="password" placeholder="Password">
                    <i class="icon fas fa-lock"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Password can't be blank</div>
            </div>
            <div class="pass-link"><a href="Password-reset/recover_email.php">Forgot Password?</a></div>
            <input type="submit" name="Submit" value="Login">
        </form>
        <div class="signup-link">Not yet member? <a href="Registration.php">Signup Now</a></div>
    </div>
</body>

</html>
<!-- 
<script>
        const form = document.querySelector("form"),
            eField = form.querySelector(".email"),
            eInput = eField.querySelector("input"),
            pField = form.querySelector(".password"),
            pInput = pField.querySelector("input");

        form.onsubmit = (e) => {
            e.preventDefault();
            if (eInput.value == " ") {
                eField.classList.add("shake", "error");
            }
            if (pInput.value == " ") {
                pField.classList.add("shake", "error");
            }

            setTimeout(() => {
                eField.classList.remove("shake");
                pField.classList.remove("shake");
            }, 500);

            eInput.onkeyup = () => {
                let pattern = /^[^ ]+\.[a-z]{2,3}$/;
                if (!eInput.value.match(pattern)) {
                    eField.classList.add("error");
                    let errorTxt = eField.querySelector(".error-txt");
                    (eInput.value != "") ? errorTxt.innerText = "Enter a valid email address" : errorTxt.innerText = "Email can't be blank";
                } else {
                    eField.classList.remove("error");
                }
            }


            pInput.onkeyup = () => {
                if (pInput.value == "") {
                    pField.classList.add("error");
                } else {
                    pField.classList.remove("error");
                }
            }
        }</script> -->