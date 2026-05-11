<?php
    session_start();
    include 'config.php';  
    
    // If user_id is not set, redirect to login form
    if(!isset($_SESSION['user_id'])){
        header('location:index.php');
        exit();
    }
    include 'adminnavbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customer Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0px auto;
            padding: 80px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: white;
        }

        .button {
            padding: 8px 16px;
            margin: 5px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .button:hover {
            opacity: 0.9;
        }

        .submit {
            background-color: #4CAF50;
        }

        .delete {
            background-color: #f44336;
        }

        .back-btn {
            background-color: #555;
            color: white;
            display: block;
            margin: 20px 0;
            text-align: center;
        }

        .back-btn a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Customer Database</h1>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Password</th>
                        <th>Settings</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM customer";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['customer_id'];
                                $name = $row['customer_name'];
                                $email = $row['customer_email'];
                                $number = $row['customer_contactnum'];
                                $password = $row['customer_password'];
                                echo "<tr>
                                        <td>$id</td>
                                        <td>$name</td>
                                        <td>$email</td>
                                        <td>$number</td>
                                        <td>$password</td>
                                        <td>
                                            <button class='button submit'><a href='adminupdateuserlist.php?updateid=$id'>Update</a></button>
                                            <button class='button delete'><a href='admindeleteuserlist.php?deleteid=$id'>Delete</a></button>
                                        </td>
                                      </tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <button class="button back-btn"><a href="adminlanding.php">BACK</a></button>
    </div>
</body>
</html>
