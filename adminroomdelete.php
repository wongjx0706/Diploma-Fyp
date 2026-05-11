<?php
include 'config.php';
session_start();

// Get user id from session cookie
$id = $_SESSION['user_id'];

// Get room id from GET or POST
$roomid = isset($_GET['roomid']) ? $_GET['roomid'] : $_POST['roomid'];

include 'adminnavbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Room</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 0px auto;
            padding: 90px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h1 {
            color: #fff;
            background-color: #993347;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px -20px;
        }

        p {
            margin: 10px 0;
            font-size: 1.1em;
        }

        .form-container {
            margin-top: 20px;
        }

        .form-container button,
        .form-container input[type="submit"] {
            padding: 10px 20px;
            margin: 10px 5px 0 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .form-container input[type="submit"] {
            background-color: red;
            color: white;
        }

        .form-container input[type="submit"]:hover {
            background-color: darkred;
        }

        .form-container .back-button {
            background-color: #555;
            color: white;
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 4px;
        }

        .form-container .back-button:hover {
            background-color: #444;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 1.1em;
            color: green;
        }

        .error {
            text-align: center;
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Confirm Room Deletion</h1>

        <?php
            $sql = "SELECT * FROM room WHERE room_id=$roomid";
            $result = mysqli_query($conn, $sql);
            $name = "";

            if ($row = mysqli_fetch_assoc($result)) {
                $name = $row['room_name'];
            }
        ?>

        <p><strong>ID:</strong> <?php echo $roomid; ?></p>
        <p><strong>Name:</strong> <?php echo $name; ?></p>

        <div class="form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="roomid" value="<?php echo $roomid; ?>">
                <a class="back-button" href="adminlanding.php">BACK</a>
                <input type="submit" name="submit" value="YES">
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql2 = "DELETE FROM room WHERE room_id = $roomid";
            $result2 = mysqli_query($conn, $sql2);

            if ($result2) {
                echo "<div class='message'>Room deleted successfully.</div>";
            } else {
                echo "<div class='error'>Error deleting room: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>
    </div>

</body>
</html>
