<?php   
session_start();
include 'config.php';
include 'navbar.php';

// Redirect to login form if user_id is not set
if(!isset($_SESSION['user_id'])){
    header('location:userlogin.php');
    exit(); // Terminate the script
}

$defaultStatus = "On Hold";
$customerID = $_SESSION['user_id'];

// Get the selected room's ID
$roomID = isset($_GET['roomid']) ? $_GET['roomid'] : '';

// Fetch the selected room details from the database
$selectRoom = "SELECT * FROM room WHERE room_id = '$roomID'";
$resultRoom = mysqli_query($conn, $selectRoom);
$selectedRoom = mysqli_fetch_assoc($resultRoom);

// Check if the selected room exists
if (!$selectedRoom) {
    echo "Invalid room ID";
    exit(); // Terminate the script
}

$reservedDates = array();
$reservedDatesIn = array();
$reservedDatesOut = array();

try {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT reservation_date_in, reservation_date_out, reservation_date FROM reservation WHERE room_id = ? AND reservation_status IN (?, 'Approved')");
    
    // Bind the parameters to the SQL query
    $stmt->bind_param("ss", $roomID, $defaultStatus);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        // Get the result set from the executed statement
        $resultReservedDates = $stmt->get_result();
        
        // Fetch each row and add the reservation dates to the array
        while ($row = $resultReservedDates->fetch_assoc()) {
            $reservedDates[] = $row['reservation_date'];
            $reservedDatesIn[] = $row['reservation_date_in'];
            $reservedDatesOut[] = $row['reservation_date_out'];
        }
        
        // Free result set
        $resultReservedDates->free();
    } else {
        // Handle query execution error
        throw new Exception("Error executing query: " . $stmt->error);
    }
    
    // Close the statement
    $stmt->close();
} catch (Exception $e) {
    // Handle exceptions
    echo "Exception caught: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOVA Hotel | Reservation</title>
    <style>
    /* Style the container */
      .container {
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 0px 20px 80px;
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

      button[type=submit]{
         background-color: #D3D3D3;
         color: black;
         margin-top: 30px;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         float: right;
         padding: 8px 5px;
      }

      button[type=submit]:hover{
        background-color: #04AA6D;
        opacity: 1;
        color: white;
      }

      /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
      @media screen and (max-width: 600px) {
        .col-50{
            width: 50%;
        }
        button[type=submit], button{
            width: 100%;
            margin-top: 0;
        }
        
      }
    </style>
</head>
<body>
    <!--banner-->
    <div style="height: 20vh; background-color: #333;"></div>
    <!-- banner -->

    <!--site content-->
    <div class="flex-container">
    
        <!--side padding-->
        <div class="flex-side"></div>

        <!-- main content -->
        <div class="flex-main" style="min-height: 130vh;">
            <form method="post">
                <h1 style="text-align:center; background-color: #333; color: white; padding-top: 2em; margin: 0em;">Book a room</h1>
                <p style="opacity: 0.8; text-align:center; background-color: #333b; color: white; margin: 0em; border-radius: 0em 0em 2em 2em; padding: 0em;">DuitNow QR</p>
                <div class="container" style="text-align:center;">
                    <?php
                        // Display the selected room's details
                        $roomName = $selectedRoom['room_name'];
                        $roomPrice = $selectedRoom['room_price'];
                        echo '<p class="row">';
                        echo "<p class='col-50'>Selected Room: $roomName</p>";
                        echo "<p class='col-50'>Price per night: RM $roomPrice</p>";
                        echo "<input type='hidden' name='room' value='$roomID'>";
                        echo '</p>';
                    ?>

                    <p class="col-50">
                    <label for="date">Booking Date (today)</label> 
                    <input type="date" name="date" id="date" required autocomplete="off" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" data-reserved-dates="<?php echo implode(',', $reservedDates); ?>">
                    </p>
                    
                    <p class="col-50">
                    <label for="datein">DateCheckIn</label> 
                    <input type="date" name="datein" id="datein" required autocomplete="off" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" data-reserved-dates="<?php echo implode(',', $reservedDatesIn); ?>">
                    </p>

                    <p class="col-50">
                    <label for="dateout">DateCheckOut</label> 
                    <input type="date" name="dateout" id="dateout" required autocomplete="off" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" data-reserved-dates="<?php echo implode(',', $reservedDatesOut); ?>">
                    </p>

                    <p class="row">
                        <p class="col-50"><label>Account Number</label> <input type="text" inputmode="numeric" pattern="\d*" name="accountnumber" required autocomplete="off"></p>
                    </p>

                    <div class="row">
                        <div class="col-50"><strong>Total Price:</strong></div>
                        <div class="col-50" id="total-price">RM 0</div>

                    <p class="row">
                        <p class="col-50">
                        <label for="totalpayment">Total pay</label> 
                        <input type="text" inputmode="numeric" pattern="\d*" name="totalpayment" required autocomplete="off"></p>
                    </p>

                    <div class="row">
                        <div><img src="images/duitnowqr.jpg" alt="QR Code" style="width:15em; height:15em; margin: 2em 0;"></div>
                    </div>

                    <p class="row">
                        <p class="col-50"></p>
                        <button type="button"><a href="reservation.php?roomid=<?php echo $roomID; ?>">Change to ONLINE TRANSFER</a></button>
                    </p>
                    <p class="row">
                        <button type="submit" name="submit">Make a reservation</button>
                    </p>
                </div>
            </form>
            <?php
                if (isset($_POST['submit'])) {
                    $roomSelection = $_POST['room'];
                    $date = $_POST['date'];
                    $datein = $_POST['datein'];
                    $dateout = $_POST['dateout'];

                    // Check if the room is already on hold or approved for the selected date
                    $selectReservation = "SELECT * FROM reservation WHERE room_id = '$roomSelection' AND (reservation_date = '$date' OR reservation_date_in = '$datein' OR reservation_date_out = '$dateout') AND reservation_status IN ('$defaultStatus', 'Approved')";
                    $resultReservation = mysqli_query($conn, $selectReservation);

                    if (mysqli_num_rows($resultReservation) > 0) {
                        echo '<div><strong>Room is already on hold or approved for the selected date(s). Please select another room or date(s).</strong></div>';
                    } else {
                        $sql = "INSERT INTO reservation (customer_id, room_id, reservation_date, reservation_date_in, reservation_date_out, reservation_status, payment_type, account_number, total_payment) VALUES ('$customerID', '$roomSelection', '$date', '$datein', '$dateout', '$defaultStatus', 'DuitNow', '$_POST[accountnumber]', '$_POST[totalpayment]')";
                        $upload = mysqli_query($conn, $sql);
                        if ($upload) {
                            echo '<div style="text-align:center;"><strong>Reservation is successfully made</strong></div>';
                        } else {
                            echo '<div style="text-align:center;"><strong>Reservation failed</strong></div>';
                        }
                    }
                }
            ?>
        </div>
    </div>

    <!--side padding-->
    <div class="flex-side"></div>

    <script>
//----------------------------------------------------------------------------------------------------------------------------------------------------
var reservedDatesIn = document.getElementById("datein").getAttribute("data-reserved-dates").split(",");
        var reservedDatesOut = document.getElementById("dateout").getAttribute("data-reserved-dates").split(",");
        var checkInDateInput = document.getElementById("datein");
        var checkOutDateInput = document.getElementById("dateout");
        var submitButton = document.querySelector("button[type='submit']");
        var totalPriceElement = document.getElementById("total-price");
        var roomPrice = <?php echo $roomPrice; ?>;

        checkInDateInput.addEventListener("change", function () {
            var selectedDate = new Date(this.value);
            var formattedDate = selectedDate.toISOString().split("T")[0];

            if (reservedDatesIn.includes(formattedDate)) {
                alert("Selected check-in date is not available. Please choose another date.");
                this.value = "";
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
                checkOutDateInput.setAttribute("min", new Date(selectedDate.getTime() + (24 * 60 * 60 * 1000)).toISOString().split('T')[0]);
            }
            calculateTotalPrice();
        });

        checkOutDateInput.addEventListener("change", function () {
            var selectedCheckInDate = new Date(checkInDateInput.value);
            var selectedCheckOutDate = new Date(this.value);

            if (selectedCheckOutDate <= selectedCheckInDate) {
                alert("Check-out date must be after the check-in date.");
                this.value = "";
                submitButton.disabled = true;
            } else {
                submitButton.disabled = false;
            }
            calculateTotalPrice();
        });

        function calculateTotalPrice() {
            var checkInDate = new Date(checkInDateInput.value);
            var checkOutDate = new Date(checkOutDateInput.value);

            if (checkInDate && checkOutDate && checkOutDate > checkInDate) {
                var timeDifference = checkOutDate.getTime() - checkInDate.getTime();
                var dayDifference = timeDifference / (1000 * 3600 * 24);
                var totalPrice = dayDifference * roomPrice;
                totalPriceElement.textContent = 'RM ' + totalPrice.toFixed(2);
            } else {
                totalPriceElement.textContent = 'RM 0';
            }
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const disableReservedDates = (inputId) => {
                const inputElement = document.getElementById(inputId);
                const reservedDates = inputElement.getAttribute('data-reserved-dates').split(',');

                inputElement.addEventListener('input', () => {
                    const selectedDate = inputElement.value;
                    if (reservedDates.includes(selectedDate)) {
                        alert("This date is reserved. Please choose another date.");
                        inputElement.value = "";
                    }
                });
            };

            disableReservedDates('datein');
            disableReservedDates('dateout');
        });
//--------------------------------------------------------------------------------------------------------------------------

        document.addEventListener('DOMContentLoaded', (event) => {
            const disableReservedDates = (inputId) => {
                const inputElement = document.getElementById(inputId);
                const reservedDates = inputElement.getAttribute('data-reserved-dates').split(',');

                inputElement.addEventListener('input', () => {
                    const selectedDate = inputElement.value;
                    if (reservedDates.includes(selectedDate)) {
                        alert("This date is reserved. Please choose another date.");
                        inputElement.value = "";
                    }
                });
            };

            disableReservedDates('date');
            disableReservedDates('datein');
            disableReservedDates('dateout');
        });
    </script>
</body>
</html>
