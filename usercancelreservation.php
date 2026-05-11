<?php
include 'config.php';
session_start();

$cancelled = "Cancelled By Customer";

//get user id from session cookie
$id = $_SESSION['user_id'];

//get reservation id from get or post
$reservationid = isset($_GET['reservationid']) ? $_GET['reservationid'] : $_POST['reservationid'];

//search for customer's specific reservation for reservation id
$sql = "SELECT * FROM reservation WHERE reservation_id = $reservationid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

//get the customer id from the reservation table
$verifyid = $row['customer_id'];

//if user id from cookies and user id from get reservation table does not match, it goes to index.php
if (is_null($verifyid) || $id != $verifyid) {
    header("Location: index.php");
    exit;
}

//if user_id does not set
if (!isset($_SESSION['user_id'])) {
    //return to login form
    header("Location: index.php");
    exit;
}

include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Reservation</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            color: #e0e0e0;
        }
        .container {
            display: flex;
            min-height: 100vh;
            padding: 2em;
            justify-content: center;
            align-items: center;
        }
        .content {
            background-color: #333;
            padding: 2em;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        h1 {
            color: #ffcc00;
            margin-bottom: 1em;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 1em;
        }
        .btn {
            padding: 1em 2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-cancel {
            background-color: #555;
            color: #e0e0e0;
        }
        .btn-cancel:hover {
            background-color: #777;
        }
        .btn-confirm {
            background-color: white;
            color: white;
        }
        .btn-confirm:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="content">
            <h1>Are you sure you want to cancel your reservation?</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="reservationid" value="<?php echo $reservationid; ?>">
                <div class="btn-group">
                    <a href="userviewreservation.php" class="btn btn-cancel">Cancel</a>
                    <input type="submit" name="submit" value="Yes" class="btn-confirm" style="color:white; background-color :red;">
                </div>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $sql2 = "UPDATE reservation SET reservation_status = '$cancelled' WHERE reservation_id = $reservationid";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    echo "<p>Reservation cancelled successfully.</p>";
                } else {
                    echo "<p>Error updating reservation: " . mysqli_error($conn) . "</p>";
                }
            }
            ?>
        </div>
    </div>

    <footer>
        <?php include 'footer.php'; ?>
    </footer>

</body>
</html>
