<?php
include 'config.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

include 'navbar.php';
include 'config.php';

$id = $_SESSION['user_id'];

// Fetch the user data from the database
$sql = "SELECT * FROM customer WHERE customer_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Update the user data if form is submitted
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $newpass = mysqli_real_escape_string($conn, $_POST['newpassword']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // Check if password and confirmed password match
    if ($newpass != $cpass) {
        $error = 'Password does not match!';
    } else {
        // Check if any fields were changed
        if ($name != $row['customer_name'] || $email != $row['customer_email'] || $number != $row['customer_contactnum'] || !empty($newpass)) {
            $update = "UPDATE customer SET ";
            $update .= "customer_name = '$name', ";
            $update .= "customer_email = '$email', ";
            $update .= "customer_contactnum = '$number' ";

            // Update the password if a new password is provided
            if (!empty($newpass)) {
                $update .= ", customer_password = '$newpass' ";
            }

            $update .= "WHERE customer_id = $id";

            // Execute the update query
            mysqli_query($conn, $update);
            header('Location: logout.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .flex-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100vh;
        }

        .flex-main {
            width: 50%;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            background-color: black;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 0 -20px;
        }

        .form-container {
            margin-top: 20px;
        }

        .row {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 250px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"],
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #D3D3D3;
            color: black;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #04AA6D;
            color: white;
        }

        .error-msg {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="flex-container">
        <div class="flex-main">
            <form action="" method="post">
                <h1>Update Profile</h1>
                <p style="opacity: 0.8; text-align:center; background-color: black; color: white; margin: 0em; border-radius: 0em 0em 2em 2em; padding: 0em;">Update your account here</p>

                <?php if(isset($error)): ?>
                    <p class="error-msg"><?php echo $error; ?></p>
                <?php endif; ?>

                <div class="form-container">
                    <div class="row">
                        <span>Name: <?php echo $row['customer_name']; ?></span>
                        <input type="text" name="name" placeholder="Update your name" value="<?php echo $row['customer_name']; ?>">
                    </div>

                    <div class="row">
                        <span>Email: <?php echo $row['customer_email']; ?></span>
                        
                    </div>

                    <div class="row">
                        <span>Contact Number: <?php echo $row['customer_contactnum']; ?></span>
                        <input type="text" name="number" placeholder="Update your contact number" value="<?php echo $row['customer_contactnum']; ?>">
                    </div>

                    <div class="row">
                        <span>Password: <?php echo $row['customer_password']; ?></span>
                        <input type="password" name="newpassword" placeholder="New password">
                    </div>

                    <div class="row">
                        <span></span>
                        <input type="password" name="cpassword" placeholder="Reconfirm your new password">
                    </div>

                    <div class="row">
                        <button><a href="userviewprofile.php">Back</a></button>
                        <input type="submit" name="submit" value="Update">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
