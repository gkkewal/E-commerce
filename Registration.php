<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php require_once("Includes/DB.php"); ?>


<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->

    <link rel="stylesheet" href="assets/css/RegistrationStyle.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!--  -->
   </head>
<body>
  <div class="container">
  
<?php echo ErrorMessage();
//echo SuccessMessage();
?> 
  <div class="title">Registration</div>
    <div class="content">
      <form action="insertReg.php" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name <span style="color: red;">*</span></span>
            <input type="text" name="fname" placeholder="Enter your firstname" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="lname" placeholder="Enter your lastname" required>
          </div>
          <div class="input-box">
            <span class="details">Email<span style="color: red;">*</span></span>
            <input type="email" name="emailid" placeholder="Enter your email"  required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number<span style="color: red;">*</span></span>
            <input type="tel" name="contact" placeholder="Enter your number" required>
          </div>
          <div class="input-box">
            <span class="details">Password<span style="color: red;">*</span></span>
            <input type="password" name="password" placeholder="Enter your password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password"  name="confirmpassword" placeholder="Confirm your password" required>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" id="dot-1" value="M">
          <input type="radio" name="gender" id="dot-2" value="F">
          <input type="radio" name="gender" id="dot-3" value="O">
          <span class="gender-title">Gender<span style="color: red;">*</span></span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Other</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" name="submit" value="Register">
        </div>
      </form>
    </div>
  </div>

</body>
</html>
