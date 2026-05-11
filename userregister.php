<?php
  //include connection to the database
  include 'config.php';

  include 'navbar.php';

  //if user click sumbit button
  if(isset($_POST['submit'])){

    //mysqli_real_escape_string prevents sql injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $secret = mysqli_real_escape_string($conn, $_POST['secret']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

    //get password and password
    $select = " SELECT * FROM customer WHERE customer_email = '$email' && customer_password = '$pass' ";
    //search for email and password
    $result = mysqli_query($conn, $select);

    //check if user exist or not
    if(mysqli_num_rows($result) > 0){
        //error message if user exist
        $error[] = 'user already exist!';

    }else{
        //error message if password and confirmed password does not exist
        if($pass != $cpass){
          $error[] = 'password does not matched!';
        }
        else{
          //insert input data into the database
          $insert = "INSERT INTO customer (customer_name, customer_email, customer_contactnum, customer_password, customer_secret) VALUES('$name','$email','$number','$pass','$secret')";
          mysqli_query($conn, $insert);

          //go to the login form
          header('Location:userlogin.php');
        }
    }

  };
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Registration</title>
<style>

html{
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
    scroll-behavior: smooth;
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
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: black;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  opacity: 0.5;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
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
  padding-top: 20px;
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
    color: blue;
}

.row p a:after{
  content: '';
  width: 0px;
  height: 2px;
  display: block;
  background: black;
  transition: 0.5s;
}

.row p a:hover::after{
  width: 100%;
}
</style>
</head>
<body>
<div style="height: 10vh;"></div>
<div class="container">
  <form action="" method="post">
    <h1 class="header" style="text-align: center;">REGISTER</h1>

    <?php
    if(isset($error)){
       foreach($error as $error){
        echo '<span style="color:red;"class="error-msg">'.$error.'</span>';
      };
    };
    ?>

    <div class="row">
        <div class="col-25">
          <label>Name</label>
        </div>
        <div class="col-75">
          <input type="text" name="name" required placeholder="enter your name" autocomplete="off">
        </div>
    </div>
  

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
        <label>Contact Number</label>
      </div>
      <div class="col-75">
        <input type="text" name="number" required placeholder="enter your contact number" autocomplete="off">
      </div>
    </div>

    <div class="row">
      <div class="col-25">
        <label>What is your first name ?</label>
      </div>
      <div class="col-75">
        <input type="text" name="secret" required placeholder="enter your first name" autocomplete="off">
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

    <div class="row">
      <div class="col-25">
        <label>Confirm Password</label>
      </div>
      <div class="col-75">
        <input type="password" name="cpassword" required placeholder="confirm your password">
      </div>
    </div>

    <div class="row" style="padding-top: 4%;">
       <input type="submit" name="submit" value="REGISTER NOW" class="form-btn">
       <p style="text-align: center;">Already have an account? <a href="userlogin.php">Login now</a></p>
    </div>
  </form>
</div>

</body>
</html>