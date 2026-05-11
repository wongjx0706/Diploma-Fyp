<?php
include 'navbar.php';
  //include connection to the database
  include 'config.php';    
  session_start();  
  //if user click sumbit button
  if(isset($_POST['submit'])){

  //mysqli_real_escape_string prevents sql injection
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);

  //get email and password
  $select = " SELECT * FROM customer WHERE customer_email = '$email' && customer_password = '$pass' ";
  //search for email and password in sql
  $result = mysqli_query($conn, $select);

  //check if user exist or not
  if(mysqli_num_rows($result) > 0){
          //if user exist, fetch their name
          $row = mysqli_fetch_array($result);
          //user_name is now their name
          $_SESSION['user_name'] = $row['customer_name'];
          $_SESSION['user_id'] = $row['customer_id'];
          header('Location:userlanding.php');
  }
  else{
      $error[] = 'incorrect email or password!';
  }
  };
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Login</title>
<style>

html{
    background-color: #000; /* Set background color to black */
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
}

* {
  box-sizing: border-box;
}

input, select, textarea{
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
  background-color: #333;
  color: #fff;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
  color: #fff;
}

input[type=submit] {
  background-color: #000;
  color: #fff;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  opacity: 0.8;
}

.container {
  border-radius: 5px;
  background-color: #222;
  padding: 20px;
  width: 80%;
  margin-left: 10%;
  margin-right: 10%;
  margin-top: 5%;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  padding-top: 30px;
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 780px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

.row p a{
    text-decoration: none;
    display: inline-block;
    color: #007bff;
}

.row p a:after{
  display: none; /* Remove the transition */
}

</style>
</head>

<body>
<div style="height: 10vh;"></div>
<div class="container">
  <form action="" method="post">
    <h1 class="header" style="text-align: center; margin-bottom: 1em; color: #fff;">LOGIN</h1>

    <?php
    if(isset($error)){
       foreach($error as $error){
          echo '<span style="color:red;"class="error-msg">'.$error.'</span>';
       };
    };
    ?>

    <div class="row">
      <div class="col-25">
        <label>Email</label>
      </div>
      <div class="col-75">
      <input type="email" name="email" required placeholder="enter your email" autocomplete="off">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label>Password</label>
      </div>
      <div class="col-75">
      <input type="password" name="password" required placeholder="enter your password" autocomplete="off">
      </div>
    </div>

    <div class="row" style="padding-top: 10%;">
        <input type="submit" name="submit" value="LOGIN NOW" class="form-btn">
      
        <p style="text-align: center;"> <a href="userregister.php" style="color: #fff;">Don't have an account?</a><a href="userregister.php">Register now</a></p>
        <p style="text-align: center;"><a href="forgotpassword.php">Forgot Password? </a></p>
      <p style="text-align: center;"><a href="forgotpassword.php">Forgot Password? </a><a href="adminlogin.php">Staff login </a></p>
    </div>
  </form>
</div>

</body>
</html>
