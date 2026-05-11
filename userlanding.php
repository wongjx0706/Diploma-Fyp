<?php
    session_start();
    include 'config.php';
    include 'navbar.php';

    //if user_id does not set
    if(!isset($_SESSION['user_id'])){
        //return to login form
        header('location:userlogin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sova Hotel | Settings Page</title>
   <style>
      body {
         margin: 0;
         padding: 0;
         font-family: Arial, sans-serif;
         background-color: #f2f2f2;
      }

      .flex-container {
         display: flex;
         height: 100vh;
      }

      .flex-main {
         flex: 1;
         padding: 2em;
         text-align: center;
      }

      .setting {
         height: 10vh;
         padding-top: 5vh;
         text-decoration: none;
         font-size: 1.563rem;
      }

      .setting a {
         text-decoration: none;
         color: black;
      }

      .setting:hover {
         opacity: 0.5;
      }

      .header {
         background-color: black;
         color: white;
         padding-top: 2em;
         margin: 0;
      }

      .subheader {
         opacity: 0.8;
         background-color: black;
         color: white;
         margin: 0;
         border-radius: 0em 0em 2em 2em;
         padding: 0em;
      }
   </style>

</head>
<body>

   <div class="flex-container">
      <div class="flex-side"></div>
      <div class="flex-main">
         <h1 class="header">Greetings, <?php echo $_SESSION['user_name'] ?></h1>
         <p class="subheader">Welcome to the settings page</p>
         <div style="text-align: center;">
            <div class="setting"><a href="userviewprofile.php"><i class="fa-sharp fa-solid fa-user"></i>  PROFILE SETTINGS </a></div>
            <div class="setting"><a href="userviewreservation.php"><i class="fa-sharp fa-solid fa-list"></i>  MY RESERVATIONS</a></div>
            <div class="setting"><a href="userviewreview.php"><i class="fa-sharp fa-solid fa-list"></i>  MY REVIEWS</a></div>
            <div class="setting"><a href="logout.php"><i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i> LOGOUT</a></div>
         </div>
      </div>
      <div class="flex-side"></div>
   </div>

   <footer>
    <?php
    include 'footer.php';
    ?>
    </footer>
</body>
</html>
