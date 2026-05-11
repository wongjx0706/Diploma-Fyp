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
    //hide sql error
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Room Reservations</title>
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

        /*onHold Table*/
        .onHold button{
            width: 80%;
            height: 80%;
            cursor: pointer;
            transition: 0.5s;
        }

        .onHold button:hover{
            background-color: red;
        }

        .onHold button a:hover{
            opacity: 1;
            font-weight: bold;
            color: white;
        }

        /*Approved Table*/
        .approved button{
            width: 80%;
            height: 80%;
            cursor: pointer;
            transition: 0.5s;
        }

        .approved button:hover{
            background-color: #04AA6D;
        }

        .approved button a:hover{
            opacity: 1;
            font-weight: bold;
            color: white;
        }

        .can_reserve{
            margin-top: 2em;
        }

        .back{
            margin-top: 2em;
        }
    </style>
</head>
<body>
    <div class="flex-container">

        <div class="flex-side"></div>

        <div class="flex-main">

            <h1 style="padding-top:15vh;">Reservations Made</h1>
            <p style="opacity: 0.6">View your reservations</p>

            <div id="testDiv">
                <table class="onHold" style="overflow-x:auto;">
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Reservation Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Room Type</th>
                            <th>Room Price</th>
                            <th>Total</th>
                            <th>Reservation Status</th>
                            <th>Payment Type</th>
                            <th>Account Number</th>
                            <th>Manage Reservation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM reservation WHERE customer_id = $id";
                            $result = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($result)){
                                $reservationid = $row['reservation_id'];
                                $roomid = $row['room_id'];
                                $date = $row['reservation_date'];
                                $status = $row['reservation_status'];
                                $paytype = $row['payment_type'];
                                $accnumber = $row['account_number'];
                                $checkin = $row['reservation_date_in'];
                                $checkout = $row['reservation_date_out'];
                                $total = $row['total_payment'];

                                if($status ==="On Hold"){
                                    $sql2 = "SELECT * FROM room WHERE room_id = $roomid";
                                    $result2 = mysqli_query($conn, $sql2);
                                    while($row = mysqli_fetch_assoc($result2)){
                                        $type = $row['room_name'];
                                        $price = $row['room_price'];
                                        echo '<tr>
                                        <td>'.$reservationid.'</td>
                                        <td>'.$date.'</td>
                                        <td>'.$checkin.'</td>
                                        <td>'.$checkout.'</td>
                                        <td>'.$type.'</td>
                                        <td>'.$price.'</td>
                                        <td>'.$total.'</td>
                                        <td>'.$status.'</td>
                                        <td>'.$paytype.'</td>
                                        <td>'.$accnumber.'</td>
                                        <td><button><a href="usercancelreservation.php?reservationid='.$reservationid.'">Cancel Reservation</a></button></td>
                                        </tr>';
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <h1 style="padding-top:2vh;">Past Reservations</h1>

            <!-- for APPROVED reservation -->
            <p>Approved Reservation</p>
            <div id="testDiv">
                <table class="approved">
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Reservation Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Room Type</th>
                            <th>Room Price</th>
                            <th>total</th>
                            <th>Reservation Status</th>
                            <th>Payment Type</th>
                            <th>Account Number</th>
                            <th>Write A Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM reservation WHERE customer_id = $id";
                            $result = mysqli_query($conn, $sql);

                            while($row = mysqli_fetch_assoc($result)){
                                $reservationid = $row['reservation_id'];
                                $roomid = $row['room_id'];
                                $date = $row['reservation_date'];
                                $status = $row['reservation_status'];
                                $paytype = $row['payment_type'];
                                $accnumber = $row['account_number'];
                                $checkin = $row['reservation_date_in'];
                                $checkout = $row['reservation_date_out'];
                                $total = $row['total_payment'];

                                if($status === "Approved") {
                                    $sql2 = "SELECT * FROM room WHERE room_id = $roomid";
                                    $result2 = mysqli_query($conn, $sql2);
                                    while($row = mysqli_fetch_assoc($result2)) {
                                        $type = $row['room_name'];
                                        $price = $row['room_price'];
                                        echo '<tr>
                                            <td>'.$reservationid.'</td>
                                            <td>'.$date.'</td>
                                            <td>'.$checkin.'</td>
                                            <td>'.$checkout.'</td>
                                            <td>'.$type.'</td>
                                            <td>'.$price.'</td>
                                            <td>'.$total.'</td>
                                            <td>'.$status.'</td>
                                            <td>'.$paytype.'</td>
                                            <td>'.$accnumber.'</td>
                                            <td><button><a href="userwritereview.php?reservationid='.$reservationid.'">Review Now</a></button></td>
                                        </tr>';
                                    }
                                }
                            }                      
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- for cancelled reservation -->
            <p class="can_reserve">Cancelled Reservation</p>
            <div id="testDiv">
                <table class="cancel">
                    <thead>
                        <tr>
                            <th>Reservation ID</th>
                            <th>Reservation Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                <th>Room Type</th>
                <th>Room Price</th>
                <th>total</th>
                <th>Reservation Status</th>
                <th>Payment Type</th>
                <th>Account Number</th>
            </tr>
    </thead>
    <tbody>
    <?php
        $sql = "SELECT * FROM reservation WHERE customer_id = $id";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $reservationid = $row['reservation_id'];
            $roomid = $row['room_id'];
            $date = $row['reservation_date'];
            $status = $row['reservation_status'];
            $paytype = $row['payment_type'];
            $accnumber = $row['account_number'];
            $checkin = $row['reservation_date_in'];
            $checkout = $row['reservation_date_out'];
            $total = $row['total_payment'];

            if($status != "Approved" && $status != "On Hold") {
                $sql2 = "SELECT * FROM room WHERE room_id = $roomid";
                $result2 = mysqli_query($conn, $sql2);
                while($row = mysqli_fetch_assoc($result2)) {
                    $type = $row['room_name'];
                    $price = $row['room_price'];
                    echo '<tr>
                        <td>'.$reservationid.'</td>
                        <td>'.$date.'</td>
                        <td>'.$checkin.'</td>
                        <td>'.$checkout.'</td>
                        <td>'.$type.'</td>
                        <td>'.$price.'</td>
                        <td>'.$total.'</td>
                        <td>'.$status.'</td>
                        <td>'.$paytype.'</td>
                        <td>'.$accnumber.'</td>
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
