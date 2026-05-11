<?php
include 'config.php';
session_start();
//if user_name does not set
if (!isset($_SESSION['user_id'])) {
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
    <title>View Profile</title>

    <style>
        /* Style the container */
        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 0px 20px 150px;
            margin: 30px 0px;
            text-align: center;
            justify-content: center;
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

        .update {
            background-color: #D3D3D3;
            color: black;
            margin-top: 50px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
            padding: 8px 5px;
        }

        .update:hover {
            background-color: #04AA6D;
        }

        .update a:hover {
            opacity: 1;
            color: white;
        }

        .back {
            padding: 5px 20px;
            margin-top: 50px;
            cursor: pointer;
            float: left;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .col-50 {
                width: 50%;
            }

            input[type=submit],
            button {
                width: 100%;
                margin-top: 0;
            }

            button a {
                padding: 0.5em 5em;
            }
        }
    </style>
</head>
<body>

<div class="flex-container">

    <div class="flex-side"></div>

    <div class="flex-main">
        <h1 style="text-align:center; background-color: black; color: white; padding-top: 2em; margin: 0em;">Profile Settings</h1>
        <p style="opacity: 0.8; text-align:center; background-color: black; color: white; margin: 0em; border-radius: 0em 0em 2em 2em; padding: 0em;">Set up your account here</p>
        <?php
        $sql = "SELECT * FROM customer WHERE customer_id=$id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <div class="container">
                <p class="row">
                    <p class="col-50">ID :</p>
                    <p class="col-50"><?php echo $id = $row['customer_id']; ?></p>
                </p>
                <p class="row">
                    <p class="col-50">Name :</p>
                    <p class="col-50"><?php echo $name = $row['customer_name']; ?></p>
                </p>
                <p class="row">
                    <p class="col-50">Email :</p>
                    <p class="col-50"><?php echo $email = $row['customer_email']; ?></p>
                </p>
                <p class="row">
                    <p class="col-50">Contact Number :</p>
                    <p class="col-50"><?php echo $password = $row['customer_contactnum']; ?></p>
                </p>
                <p class="row">
                    <p class="col-50">Password :</p>
                    <p class="col-50"><?php echo $password = $row['customer_password']; ?></p>
                </p>
                <button class="update"><a href="userupdateuserlist.php"> Update</a></button>
                <button class="back"><a href="userlanding.php"><i class="fa-sharp fa-solid fa-backward"></i> Back</a>
                </button>
            </div>
            <?php
        }
        ?>

        <!--<button><a href="deleteuser.php?deleteid=<?php /*echo $id;*/ ?>">Delete</a></button>-->
    </div>

    <div class="flex-side"></div>

</div>

</body>
</html>
