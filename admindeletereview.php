<?php
include 'config.php';
include 'adminnavbar.php';
session_start();

//if user_name does not set
if(!isset($_SESSION['user_id'])){
//return to login form
header('location:adminlogin.php');
}

//get reservation id from get
if(isset($_GET['deleteid'])){
    $reviewid = $_GET['deleteid'];
}
else{
    $reviewid = $_POST['reviewid'];
}

//search for customer's specific reservation for reservation id
$sql = "SELECT * FROM review WHERE review_id = $reviewid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Review</title>

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
            padding: 80px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #993347;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        form {
            text-align: center;
            margin: 20px 0;
        }

        input[type=submit], .back-button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #f44336;
            color: white;
        }

        input[type=submit]:hover {
            background-color: #d32f2f;
        }

        .back-button {
            background-color: #555;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .back-button:hover {
            background-color: #444;
        }

        .message {
            text-align: center;
            margin: 20px 0;
            font-size: 1.1em;
        }
    </style>
</head>
<body>

<div class="container">
        <h1>Confirm Deletion</h1>
        <p class="message">Are you sure you want to delete this review?</p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="hidden" name="reviewid" value="<?php echo $reviewid; ?>">
            <a class="back-button" href="adminlanding.php">BACK</a>
            <input type="submit" name="submit" value="YES">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql2 = "DELETE FROM review WHERE review_id = $reviewid";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                echo "Review deleted successfully.";
            } else {
                echo "Error deleting reviewinclude 'adminavbar.php';
                : " . mysqli_error($conn);
            }
        }
        ?>
    </div>

</body>
</html>