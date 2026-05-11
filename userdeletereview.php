<?php
include 'config.php';
session_start();

//get user id from session cookie
$id = $_SESSION['user_id'];

//get review id from get
if(isset($_GET['reviewid'])){
    $reviewid = $_GET['reviewid'];
}
else{
    $reviewid = $_POST['reviewid'];
}

//search for customer's specific review for review id
$sql = "SELECT * FROM review WHERE review_id = $reviewid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

//get the customer id from the review table
$verifyid = $row['customer_id'];

//if user id from cookies and user id from get review table does not match, it goes to index.php
if (is_null($verifyid) || $id != $verifyid) {
    header("location: index.php");
}

//if user_name does not set
if(!isset($_SESSION['user_id'])){
  //return to login form
  header('Location: index.php');
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
    <title>Delete Review</title>

    <style>
        input[type=submit]{
            margin-top: 2em;
            transition: 0.5s;
            cursor: pointer;
        }

        input[type=submit]:hover{
            background-color: red;
            color: white;
            opacity: 1;
        }
    </style>
</head>
<body>

    <!--banner-->
    <div style="height:10vh; );"></div>

    <!--site content-->
    <div class="flex-container" style="min-height: 65vh;">

        <!--side padding-->
        <div class="flex-side"></div>

        <!-- main content -->
        <div class="flex-main">
            <h1 style="background-color: #333; color: white; padding-top: 2em; text-align: center;">ARE YOU SURE ABOUT DELETING YOUR REVIEW?</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="hidden" name="reviewid" value="<?php echo $reviewid; ?>">
                <button type="button"><a href="userviewreview.php">CANCEL</button></a>
                <input type="submit" name="submit" value="YES">
            </form>

        
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $sql2 = "DELETE FROM review WHERE review_id = $reviewid";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    echo "Review deleted successfully.";
                } else {
                    echo "Error deleting review: " . mysqli_error($conn);
                }
            }
            ?>
        </div>

        <!--side padding-->
        <div class="flex-side"></div>

    </div>

    <footer>
        <?php include 'footer.php' ?>
    </footer>

</body>
</html>