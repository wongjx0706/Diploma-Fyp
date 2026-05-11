<?php
   include 'config.php';
   session_start();

   // Check if user is logged in
   if(!isset($_SESSION['user_id'])){
      header('location:adminlogin.php');
      exit();
   }

   include 'adminnavbar.php';

   $id = $_SESSION['user_id'];
   $sql = "SELECT * FROM staff WHERE staff_id = $id";
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);

   // Initialize variables with the existing data
   $name = $row['staff_name'];
   $email = $row['staff_email'];
   $number = $row['staff_contactnum'];
   $newpass = '';

   if(isset($_POST['submit'])){
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $number = mysqli_real_escape_string($conn, $_POST['number']);
      $newpass = mysqli_real_escape_string($conn, $_POST['newpassword']);
      $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

      if($newpass != $cpass){
         $error[] = 'Password does not match!';
      }
      else{
         // Check if any fields were changed
         if($name != $row['staff_name'] || $email != $row['staff_email'] || $number != $row['staff_contactnum'] || !empty($newpass)){
            $update = "UPDATE staff SET ";
            $update .= "staff_name = '$name', ";
            $update .= "staff_email = '$email', ";
            $update .= "staff_contactnum = '$number' ";

            if(!empty($newpass)){
               $update .= ", staff_password = '$newpass' ";
            }

            $update .= "WHERE staff_id = $id";

            mysqli_query($conn, $update);
            header('Location: logout.php');
            exit();
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
   <title>Update Profile</title>

   <style>
      body {
         font-family: 'Arial', sans-serif;
         background-color: #f4f4f4;
         margin: 0;
         padding: 0;
      }

      .flex-container {
         display: flex;
         justify-content: center;
         align-items: center;
         min-height: 100vh;
         flex-direction: column;
         background-color: #f4f4f4;
      }

      .flex-main {
         background-color: white;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         width: 80%;
         max-width: 600px;
         margin: 20px;
      }

      h1, p {
         text-align: center;
         margin: 0;
      }

      h1 {
         background-color: #993347;
         color: white;
         padding: 1em;
         border-radius: 10px 10px 0 0;
      }

      p {
         background-color: #993347;
         color: white;
         opacity: 0.9;
         padding: 0.5em;
         border-radius: 0 0 10px 10px;
      }

      .container {
         background-color: #f2f2f2;
         padding: 20px;
         border-radius: 10px;
         margin-top: 20px;
      }

      .row {
         display: flex;
         flex-wrap: wrap;
         justify-content: space-between;
         margin-bottom: 20px;
      }

      .col-50 {
         flex: 0 0 48%;
      }

      input {
         width: 100%;
         padding: 10px;
         margin-top: 5px;
         margin-bottom: 15px;
         border-radius: 5px;
         border: 1px solid #ccc;
      }

      input[type=submit] {
         background-color: #D3D3D3;
         color: black;
         border: none;
         cursor: pointer;
         transition: background-color 0.3s, color 0.3s;
      }

      input[type=submit]:hover {
         background-color: #04AA6D;
         color: white;
      }

      button {
         padding: 10px 20px;
         background-color: #993347;
         color: white;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s, color 0.3s;
      }

      button:hover {
         background-color: #04AA6D;
      }

      .error-msg {
         color: red;
         text-align: center;
         margin-bottom: 15px;
      }

      @media screen and (max-width: 600px) {
         .col-50 {
            flex: 0 0 100%;
         }
      }
   </style>
</head>
<body>
   <div style="height:10vh; );"></div>
      <div class="flex-container">
         <div class="flex-main">
      
         <h1>Manage Your Profile</h1>
         <p>Update your account here</p>

         <form action="" method="post">

            <div class="container">
               <?php if(isset($error)): ?>
                  <span class="error-msg"><?php echo implode('<br>', $error); ?></span>
               <?php endif; ?>

               <div class="row">
                  <div class="col-50">Name: <?php echo $row['staff_name']; ?></div>
                  <div class="col-50">New Name: <input type="text" name="name" placeholder="Update your name" value="<?php echo $name; ?>" autocomplete="off"></div>
               </div>

               <div class="row">
                  <div class="col-50">Email: <?php echo $row['staff_email']; ?></div>
                  
               </div>

               <div class="row">
                  <div class="col-50">Contact Number: <?php echo $row['staff_contactnum']; ?></div>
                  <div class="col-50">New Contact Number: <input type="text" name="number" placeholder="Update your contact number" value="<?php echo $number; ?>" autocomplete="off"></div>
               </div>

               <div class="row">
                  <div class="col-50">Password: ********</div>
                  <div class="col-50">New Password: <input type="password" name="newpassword" placeholder="New password" autocomplete="off"></div>
               </div>

               <div class="row">
                  <div class="col-50"></div>
                  <div class="col-50">Confirm Password: <input type="password" name="cpassword" placeholder="Reconfirm your new password" autocomplete="off"></div>
               </div>

               <div class="row">
                  <div class="col-50">
                     <button type="button" onclick="location.href='adminlanding.php'"><i class="fa-sharp fa-solid fa-backward"></i> BACK</button>
                  </div>
                  <div class="col-50">
                     <input type="submit" name="submit" value="UPDATE">
                  </div>
               </div>
               
            </div>               
         </form>
      </div>
   </div>
</body>
</html>
