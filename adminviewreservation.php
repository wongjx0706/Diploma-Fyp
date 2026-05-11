<?php
    include 'config.php';
    session_start();
    //if user_name does not set
    if(!isset($_SESSION['user_id'])){
      //return to login form
      header('location:index.php');
    }
    include 'adminnavbar.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room Status</title>
    <style>
        table{
            border: 1px solid;
            border-collapse: collapse;
        }

        th{
            border: 1px solid;
            text-align: center;
            width: 20em;
            background-color: #993347;
            color: white;
            line-height: 2em;
        }

        td {
            border: 1px solid;
            text-align: center;
            height: 5em;
        }

        select{
            margin-top: 5em;
            margin-bottom: 1em;
        }

        button{
            margin-top: 2em;
        }

        button[type=submit]{
            margin-top: inherit;
            margin-bottom:1em;
            cursor: pointer;
        }

        button[type=submit]:hover{
            background-color: #bb9f5f;
            color: white;
        }
    </style>
</head>
<body>
    <div style="height:10vh; );"></div>

    <div class="flex-container">

        <div class="flex-side"></div>

            <div class="flex-main">

            <h1 style="padding-top:2vh;">Reservations database</h1>

            <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Reservation Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Room Type</th>
                        <th>Room Price</th>
                        <th>Total pay</th>
                        <th>Account number</th>
                        <th>Reservation Status</th>
                        <th>Update Reservation Status</th>
                    </tr>
                </thead>
                            
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <tbody>
                    <?php
                    $sql = "SELECT * FROM reservation";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $reservationid = $row['reservation_id'];
                        $customerid = $row['customer_id'];
                        $roomid = $row['room_id'];
                        $date = $row['reservation_date'];
                        $status = $row['reservation_status'];
                        $checkin = $row['reservation_date_in'];
                        $checkout = $row['reservation_date_out'];
                        $total = $row['total_payment'];
                        $acc = $row['account_number'];

                        $sql2 = "SELECT * FROM room WHERE room_id = $roomid";
                        $result2 = mysqli_query($conn, $sql2);

                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $type = $row2['room_name'];
                            $price = $row2['room_price'];
                        }

                        echo '<tr>
                                <td>' . $reservationid . '</td>
                                <td>' . $date . '</td>
                                <td>' . $checkin . '</td>
                                <td>' . $checkout . '</td>
                                <td>' . $type . '</td>
                                <td>' . $price . '</td>
                                <td>' . $total . '</td>
                                <td>' . $acc . '</td>
                                <td>' . $status . '</td>
                                <td>
                                    <form method="post" action="adminviewreservation.php">
                                        <input type="hidden" name="reservationid" value="' . $reservationid . '">
                                        <input type="hidden" name="currentstatus" value="' . $status . '">
                                        <select name="reservationstatus">
                                            <option value="On Hold" ' . ($status == "On Hold" ? "selected" : "") . '>On Hold</option>
                                            <option value="Approved" ' . ($status == "Approved" ? "selected" : "") . '>Approve</option>
                                            <option value="Cancel by the Hotel" ' . ($status == "Cancelled by the Hotel" ? "selected" : "") . '>Cancel</option>
                                        </select><br/>
                                        <button type="submit" name="submit">Change</button>
                                    </form>
                                </td>
                            </tr>';
                    }

                    if (isset($_POST['submit'])) {
                        $updatedstatus = $_POST['reservationstatus'];
                        $reservationid = $_POST['reservationid'];
                        $currentstatus = $_POST['currentstatus'];

                        // Code to update the reservation status in the database
                        $sql = "UPDATE reservation SET reservation_status='$updatedstatus' WHERE reservation_id='$reservationid'";
                        if (mysqli_query($conn, $sql)) {
                            echo "Reservation status updated successfully";
                            
                        } else {
                            echo "Error updating reservation status: " . mysqli_error($conn);
                        }
                    }
                    ?>
                </tbody>
            </form>

            </table>
            </div>
            
                <button><a href="adminlanding.php"><i class="fa-sharp fa-solid fa-backward"></i> BACK</a></button>
            
            </div>

        <div class="flex-side"></div>

    </div>
    
</body>
</html>