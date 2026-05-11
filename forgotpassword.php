<?php
// include connection to the database
include 'config.php';
include 'navbar.php';

// Step 1: Verify Email and Secret
if(isset($_POST['verify'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $secret = mysqli_real_escape_string($conn, $_POST['secret']);

    $select = "SELECT * FROM customer WHERE customer_email = '$email' AND customer_secret = '$secret'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $verified = true;
    } else {
        $error[] = 'Incorrect email or secret!';
    }
}

// Step 2: Reset Password
if(isset($_POST['reset'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if($pass != $cpass){
        $error[] = 'Passwords do not match!';
    } else {
        $update = "UPDATE customer SET customer_password = '$pass' WHERE customer_email = '$email'";
        mysqli_query($conn, $update);
        header('Location:userlogin.php');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forgot Password</title>
<style>
html {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
    scroll-behavior: smooth;
}

* {
    box-sizing: border-box;
}

input, select, textarea {
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

/* Responsive layout - when the screen is less than 780px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 780px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
}

.row p a {
    text-decoration: none;
    display: inline-block;
    color: blue;
}

.row p a:after {
    content: '';
    width: 0px;
    height: 2px;
    display: block;
    background: black;
    transition: 0.5s;
}

.row p a:hover::after {
    width: 100%;
}
</style>
</head>
<body>
<div style="height: 10vh;"></div>
<div class="container">
    <h1 style="text-align: center;">FORGOT PASSWORD</h1>

    <?php
    if(isset($error)){
        foreach($error as $error){
            echo '<span style="color:red;" class="error-msg">'.$error.'</span>';
        };
    };
    ?>

    <?php if(!isset($verified)) { ?>
    <form action="" method="post">
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
                <label>What is your first name?</label>
            </div>
            <div class="col-75">
                <input type="text" name="secret" required placeholder="enter your first name" autocomplete="off">
            </div>
        </div>

        <div class="row" style="padding-top: 4%;">
            <input type="submit" name="verify" value="VERIFY" class="form-btn">
        </div>
    </form>
    <?php } else { ?>
    <form action="" method="post">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <div class="row">
            <div class="col-25">
                <label>New Password</label>
            </div>
            <div class="col-75">
                <input type="password" name="password" required placeholder="enter your new password" autocomplete="off">
            </div>
        </div>

        <div class="row">
            <div class="col-25">
                <label>Confirm New Password</label>
            </div>
            <div class="col-75">
                <input type="password" name="cpassword" required placeholder="confirm your new password">
            </div>
        </div>

        <div class="row" style="padding-top: 4%;">
            <input type="submit" name="reset" value="CHANGE PASSWORD" class="form-btn">
        </div>
    </form>
    <?php } ?>
</div>
</body>
</html>
