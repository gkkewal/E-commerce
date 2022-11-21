<?php require_once("../Includes/Functions.php"); ?>
<?php require_once("../Includes/Sessions.php"); ?>
<?php require_once("../Includes/DB.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Email</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/LoginStyle.css">
    <!-- font_awsome_csn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="wrapper">
        <header>Email</header>
        <form action="recover_email_code.php" method="POST">
            <div class="field email">
                <div>
                <?php //echo ErrorMessage();
                      echo SuccessMessage();
                      echo ErrorMessage();
                        ?> 
                </div>
                <div class="input-area">
                    <input type="email" name="email" id="emailid" placeholder="Enter Email Address">
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Email can't be blank</div>
            </div>
            <input type="submit" name="password_reset_link" value="Send Password Reset Link">
        </form>
    </div>
</body>

</html>