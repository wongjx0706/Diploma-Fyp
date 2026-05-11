<?php
    include 'config.php';
    session_start();
    //if user_name does not set
    if(!isset($_SESSION['user_id'])){
      //return to login form
      header('location:index.php');
    }
    include 'navbar.php';
    $id = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Review</title>
    <style>
        table, th, td{
            border: 1px solid;
            text-align: center;  
        }
        
        table{
            border-collapse: collapse;
        }

        th{
            width: 12em;
            line-height: 2em;
            background-color: #B2D2A4;
        }

        td{
            height: 5em;
        }

        #testDiv {
            overflow-x: auto;
        }

        td .update{
            margin: 2em 0em;
            transition: 0.5s;
        }

        td .update:hover{
            background-color: green;
            opacity: 1;
        }

        td .update a:hover{
            opacity: 1;
            color: white;
        }

        td .delete{
            margin-bottom: 2em;
            transition: 0.5s;
        }

        td .delete:hover{
            background-color: red;
            opacity: 1;
        }

        td .delete a:hover{
            opacity: 1;
            color: white;
        }

        .back{
            margin: 2em 0em;
        }
    </style>
</head>
<body>
    <div style="height:10vh;);"></div>

    <div class="flex-container">

        <div class="flex-side"></div>

            <div class="flex-main">

                <h1 style="padding-top:2vh;">Your Reviews</h1>
                <p style="opacity: 0.6">View your reviews</p>

                <div id="testDiv">
                <table style="overflow-x:auto;">
                <thead>
                        <tr>
                            <th>Review ID</th>
                            <th>Review Time</th>
                            <th>Reservation ID</th>
                            <th>Room Name</th>
                            <th>Reserved At</th>
                            <th>Price</th>
                            <th>Your Review</th>
                            <th>Manage Review</th>
                        </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT * FROM review WHERE customer_id = $id";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                        $reviewid = $row['review_id'];
                        $reviewtime = $row['review_time'];
                        $reservationid = $row['reservation_id'];
                        $reviewdescription = $row['review_description'];

                        $sql2 = "SELECT * FROM reservation WHERE reservation_id = $reservationid";
                        $result2 = mysqli_query($conn, $sql2);
                            while($row = mysqli_fetch_assoc($result2)){
                                $reservationdate = $row['reservation_date'];
                                $reservationstatus = $row['reservation_status'];
                                $roomid = $row['room_id'];

                                $sql3 = "SELECT * FROM room WHERE room_id = $roomid";
                                $result3 = mysqli_query($conn, $sql3);
                                    while($row = mysqli_fetch_assoc($result3)){
                                        $roomname = $row['room_name'];
                                        $price = $row['room_price'];

                                        echo '<tr>
                                        <td>'.$reviewid.'</td>
                                        <td>'.$reviewtime.'</td>
                                        <td>'.$reservationid.'</td>
                                        <td>'.$roomname.'</td>
                                        <td>'.$reservationdate.'</td>
                                        <td>'.$price.'</td>
                                        <td>'.$reviewdescription.'</td>
                                        <td><button class="update"><a href="userupdatereview.php?reviewid='.$reviewid.'">UPDATE</a></button>
                                        <button class="delete"><a href="userdeletereview.php?reviewid='.$reviewid.'">DELETE</button></td>
                                        </tr>';
                                    }
                            }
                    }
                ?>
                </tbody>
                </table>
                </div>
                
                <button class="back"><a href="userlanding.php"><i class="fa-sharp fa-solid fa-backward"></i> Back</a></button>
            </div>

        <div class="flex-side"></div>

    </div>
</body>
</html>