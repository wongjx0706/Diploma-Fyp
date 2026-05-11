<?php

//will fix soon
            //if user click submit button
            if ($_POST['REQUEST_METHOD'] == 'POST') {
                $updatedstatus = "";
                $reservationid = $_POST['reservation_id'];
                $reservationstatus = $_POST['reservationstatus'];

                if ($reservationstatus == 'onhold') {
                    $updatedstatus = "On Hold";
                    $update = "UPDATE reservation SET reservation_status='$updatedstatus' WHERE reservation_id=$reservationid";
                    $sql2 = "UPDATE reservation SET reservation_status = '$updatedstatus' WHERE reservation_id = $reservationid";
                    echo $sql2; // print out the SQL statement for debugging
                    $result2 = mysqli_query($conn, $sql2);

                } elseif ($reservationstatus == 'approved') {
                    $updatedstatus = "Approved";
                    $update = "UPDATE reservation SET reservation_status='$updatedstatus' WHERE reservation_id=$reservationid";
                    $sql2 = "UPDATE reservation SET reservation_status = '$updatedstatus' WHERE reservation_id = $reservationid";
                    echo $sql2; // print out the SQL statement for debugging
                    $result2 = mysqli_query($conn, $sql2);
                } elseif ($reservationstatus == 'cancel') {
                    $updatedstatus = "Cancelled By Hotel";
                    $update = "UPDATE reservation SET reservation_status='$updatedstatus' WHERE reservation_id=$reservationid";
                    $sql2 = "UPDATE reservation SET reservation_status = '$updatedstatus' WHERE reservation_id = $reservationid";
                    echo $sql2; // print out the SQL statement for debugging
                    $result2 = mysqli_query($conn, $sql2);
                }

                mysqli_query($conn, $update);
                if ($update) {
                    echo "Reservation cancelled successfully.";
                } else {
                    echo "Error updating reservation: " . mysqli_error($conn);
                }
            }

?>