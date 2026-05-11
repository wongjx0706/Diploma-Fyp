<?php
   include 'config.php';
   session_start();

   // Check if user is logged in
   if(!isset($_SESSION['user_id'])){
      header('location:adminlogin.php');
      exit();
   }

   include 'adminnavbar.php';

   // Get customer ID from GET parameter
   $customerid = isset($_GET['updateid']) ? $_GET['updateid'] : '';

   // Fetch the customer data from the database
   $sql = "SELECT * FROM customer WHERE customer_id = $customerid";
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);

   // Define variables for the form inputs
   $name = $row['customer_name'];
   $email = $row['customer_email'];
   $number = $row['customer_contactnum'];
   $newpass = '';

   // Update the customer data if form is submitted
   if(isset($_POST['submit'])){
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $number = mysqli_real_escape_string($conn, $_POST['number']);
      $newpass = mysqli_real_escape_string($conn, $_POST['newpassword']);
      $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

      // Check if password and confirmed password match
      if($newpass != $cpass){
         $error = 'Password does not match!';
      }
      else{
         // Check if any fields were changed
         if($name != $row['customer_name'] || $email != $row['customer_email'] || $number != $row['customer_contactnum'] || !empty($newpass)){
            $update = "UPDATE customer SET ";
            $update .= "customer_name = '$name', ";
            $update .= "customer_email = '$email', ";
            $update .= "customer_contactnum = '$number' ";

            // Update the password if a new password is provided
            if(!empty($newpass)){
               $update .= ", customer_password = '$newpass' ";
            }

            $update .= "WHERE customer_id = $customerid";

            // Execute the update query
            mysqli_query($conn, $update);
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
   <title>Update Customer Profile</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f4f4f4;
         margin: 0;
         padding: 0;
      }

      .container {
         width: 60%;
         margin: 0px auto;
         padding:80px;
         background-color: #fff;
         border-radius: 8px;
         box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      h1 {
         text-align: center;
         color: #333;
         margin-bottom: 20px;
         padding: 10px;
         background-color: #4CAF50;
         color: white;
         border-radius: 8px 8px 0 0;
      }

      .form-group {
         display: flex;
         justify-content: space-between;
         margin-bottom: 15px;
      }

      .form-group label {
         width: 45%;
         margin-right: 5%;
         text-align: right;
         font-weight: bold;
      }

      .form-group input {
         width: 45%;
         padding: 8px;
         border: 1px solid #ddd;
         border-radius: 4px;
      }

      .error-msg {
         color: red;
         text-align: center;
         margin-bottom: 15px;
      }

      .form-actions {
         text-align: center;
         margin-top: 20px;
      }

      .form-actions input[type="submit"] {
         padding: 10px 20px;
         background-color: #4CAF50;
         color: white;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         transition: background-color 0.3s;
      }

      .form-actions input[type="submit"]:hover {
         background-color: #45a049;
      }

      .form-actions a {
         padding: 10px 20px;
         background-color: #555;
         color: white;
         border: none;
         border-radius: 4px;
         text-decoration: none;
         cursor: pointer;
         transition: background-color 0.3s;
         margin-left: 10px;
      }

      .form-actions a:hover {
         background-color: #444;
      }

      @media screen and (max-width: 768px) {
         .container {
            width: 90%;
         }

         .form-group {
            flex-direction: column;
            align-items: flex-start;
         }

         .form-group label,
         .form-group input {
            width: 100%;
            text-align: left;
         }

         .form-group label {
            margin-right: 0;
            margin-bottom: 5px;
         }
      }
   </style>
</head>
<body>
   <div class="container">
      <h1>Update Customer Profile</h1>

      <?php if(isset($error)): ?>
         <div class="error-msg"><?php echo $error; ?></div>
      <?php endif; ?>

      <form action="" method="post">
         <div class="form-group">
            <label>Current Name:</label>
            <div><?php echo $row['customer_name']; ?></div>
         </div>
         <div class="form-group">
            <label>New Name:</label>
            <input type="text" name="name" placeholder="Update your name" value="<?php echo $name; ?>" autocomplete="off">
         </div>

         <div class="form-group">
            <label>Current Email:</label>
            <div><?php echo $row['customer_email']; ?></div>
         </div>
         <div class="form-group">
            
         </div>

         <div class="form-group">
            <label>Current Contact Number:</label>
            <div><?php echo $row['customer_contactnum']; ?></div>
         </div>
         <div class="form-group">
            <label>New Contact Number:</label>
            <input type="text" name="number" placeholder="Update your contact number" value="<?php echo $number; ?>" autocomplete="off">
         </div>

         <div class="form-group">
            <label>New Password:</label>
            <input type="password" name="newpassword" placeholder="New password" autocomplete="off">
         </div>
         <div class="form-group">
            <label>Confirm Password:</label>
            <input type="password" name="cpassword" placeholder="Reconfirm your new password" autocomplete="off">
         </div>

         <div class="form-actions">
            <input type="submit" name="submit" value="Update">
            <a href="adminviewuserlist.php">Back</a>
         </div>
      </form>
   </div>
</body>
</html>
