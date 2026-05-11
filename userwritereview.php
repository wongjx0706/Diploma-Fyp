<?php
    include 'config.php';
    session_start();

    //get reservation id from get
    $reservationid = $_GET['reservationid'];
    //get user id from session cookie
    $id = $_SESSION['user_id'];

    //search fo customer's specific reservation for reservation id
    $sql = "SELECT * FROM reservation WHERE reservation_id = $reservationid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    //get the customer id from the reservation table
    $verifyid = $row['customer_id'];

    //if user id from cookies and user id from get reservation table does not match, it goes to index.php
    if (is_null($verifyid) || $id != $verifyid) {
        header("location: index.php");
    }    

    //getting the reservation date and status
    $reservationdate = $row['reservation_date'];
    $reservationstatus = $row['reservation_status'];


    //get the reserved room id for searching room name later
    $roomid = $row['room_id'];

    //finding room name based on the room id gotten from the reservation's room_id
    $sql2 = "SELECT * FROM room WHERE room_id = $roomid";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_assoc($result2);
    $roomname = $row['room_name'];
    
    //if user_name does not set
    if(!isset($_SESSION['user_id'])){
      //return to login form
      header('Location: index.php');
      exit;
    }
    include 'navbar.php';



    //getting the customer's name by searching customer database by their id
    $sql3 = "SELECT * FROM customer WHERE customer_id = $id";
    $result3 = mysqli_query($conn, $sql3);
    $row = mysqli_fetch_assoc($result3);
    $customername = $row['customer_name'];

    include 'navbar.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback and Review</title>

    <style>
    /* Style the container */
      .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 0px 20px 200px;
      margin: 30px 0px;
      text-align: justify;
      }

      /* Floating column for labels: 50% width */
      .col-50 {
      float: left;
      width: 50%;
      margin-top: 20px;
      }

      /* Clear floats after the columns */
      .row:after {
      content: "";
      display: table;
      clear: both;
      }

      input[type=submit]{
         background-color: #D3D3D3;
         color: black;
         margin-top: 20px;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         float: right;
         padding: 8px 5px;
      }

      input[type=submit]:hover{
        background-color: #04AA6D;
        color: white;
        opacity: 1;
      }

      .back{
         padding: 5px 20px;
         margin-top: 20px;
         cursor: pointer;
         float: left;
      }

      /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
      @media screen and (max-width: 1000px) {
        .col-50{
            width: 50%;
        }
        input[type=submit], button, textarea{
            width: 100%;
            margin-top: 0;
        }

        button a{
            padding: 0.5em 5em;
        }
      }
    </style>
</head>

<body>

    <!--banner-->
    <div style="height:10vh; );"></div>

    <!--site content-->
    <div class="flex-container">
   
        <!--side padding-->
        <div class="flex-side"></div>

        <!-- main content -->
        <div class="flex-main" style="min-height: 75vh;">

            <h1>Leave A Review</h1>

            <div class="container">
            <form method="post">

                <h2>Reservation Details:</h2>

                
                    <p class="row">
                        <p class="col-50">Customer Name :</p>
                        <p class="col-50"><?php echo $customername ?></p>
                    </p>
                    <p class="row">
                        <p class="col-50">Room reserved :</p>
                        <p class="col-50"><?php echo $roomname ?></p>
                    </p>
                    <p class="row">
                        <p class="col-50">Date of reservation :</p>
                        <p class="col-50"><?php echo $reservationdate ?></p>
                    </p>
                    <p class="row">
                        <p class="col-50">Reservation Status :</p>
                        <p class="col-50"><?php echo $reservationstatus ?></p>
                    </p>
                    <p class="row">
                        <p class="col-50">Enter your review :</p>
                        <p class="col-50"><textarea name="reviewdescription" rows="4" cols="50" required placeholder="ENTER YOUR REVIEW" autocomplete="off"></textarea></p>
                    </p>
                    <input type="submit" name="submit" value="Submit">
                    <button class="back"><a href="userviewreservation.php"><i class="fa-sharp fa-solid fa-backward"></i> Back</a></button>
            </form>
            </div>

            <?php
                if(isset($_POST['submit'])){
                    $reviewdescription = $_POST['reviewdescription'];
                    $sql4 = "INSERT INTO review (customer_id,reservation_id,review_time,review_description) VALUES ('$id','$reservationid',NOW(),'$reviewdescription')";
                    $upload = mysqli_query($conn,$sql4);
                    if($upload){
                        echo 'Review Posted';
                    }
                    else{
                        echo "Review failed to post";
                    }
                }
            ?>

        </div>

        <!--side padding-->
        <div class="flex-side"></div>

    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>

</html>