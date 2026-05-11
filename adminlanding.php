<?php
    include 'config.php';
    session_start();
    //if user_name does not set
    if(!isset($_SESSION['user_id'])){
        //return to login form
        header('location:index.php');
    }
    include 'adminnavbar.php';
    $id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Landing Page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl7/6S2z6k4dAC6A4u2Dj/r2lVc2yK8PS6WpPavKP5xQ+a/5nhW8zXy5d6NdrXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
      body {
         font-family: 'Arial', sans-serif;
         margin: 0;
         padding: 0;
         box-sizing: border-box;
         background-color: #f4f4f4;
      }

      .container {
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
         padding-top: 100px;
         padding-bottom: 100px;
      }

      .welcome-message {
         text-align: center;
         background-color: #993347;
         color: white;
         padding: 2em;
         border-radius: 15px;
         width: 70%;
         margin: 20px auto;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
         transition: transform 0.3s;
      }

      .welcome-message:hover {
         transform: translateY(-5px);
      }

      .welcome-message h1 {
         margin: 0;
         font-size: 2.5rem;
         text-transform: uppercase;
         letter-spacing: 2px;
      }

      .welcome-message p {
         opacity: 0.9;
         font-size: 1.2rem;
         margin-top: 10px;
      }

      .settings {
         display: grid;
         grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
         gap: 20px;
         margin: 20px;
         width: 70%;
      }

      .setting {
         background-color: white;
         padding: 1em;
         border-radius: 15px;
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
         text-align: center;
         transition: transform 0.3s;
      }

      .setting:hover {
         transform: translateY(-5px);
      }

      .setting a {
         color: #333;
         text-decoration: none;
         font-size: 1.2rem;
         display: flex;
         flex-direction: column;
         align-items: center;
      }

      .setting i {
         font-size: 2rem;
         margin-bottom: 10px;
         color: #993347;
      }
   </style>
</head>
<body>

   <div class="container">
      <div class="welcome-message">
         <h1>Hi, <?php echo $_SESSION['user_name'] ?></h1>
         <p>Welcome to the Admin page</p>
      </div>

      <div class="settings">
         <div class="setting">
            <a href="adminviewprofile.php">
               <i class="fa-sharp fa-solid fa-user"></i>
               PROFILE SETTINGS
            </a>
         </div>
         <div class="setting">
            <a href="adminviewreservation.php">
               <i class="fa-sharp fa-solid fa-server"></i>
               RESERVATION DATABASE
            </a>
         </div>
         <div class="setting">
            <a href="adminviewuserlist.php">
               <i class="fa-sharp fa-solid fa-server"></i>
               CUSTOMER DATABASE
            </a>
         </div>
         <div class="setting">
            <a href="adminviewreview.php">
               <i class="fa-sharp fa-solid fa-server"></i>
               REVIEW DATABASE
            </a>
         </div>

         <div class="setting">
            <a href="adminroomupload.php">
               <i class="fa-sharp fa-solid fa-server"></i>
               ROOM DATABASE
            </a>
         </div>
         <div class="setting">
            <a href="logout.php">
               <i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i>
               LOG OUT
            </a>
         </div>
      </div>
   </div>

</body>
</html>
