<?php
    session_start();
    include 'config.php';  
    
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
    <title>View Customer Review</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 0px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin: 100px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0px 0;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #ddd;
        }

        td {
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        button, .delete a {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover, .delete:hover {
            background-color: #45a049;
        }

        .delete a {
            display: block;
            color: white;
        }

        .delete:hover a {
            color: white;
        }

        .back-button {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .back-button a {
            color: white;
            background-color: #555;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-button a:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Review Database</h1>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Review ID</th>
                        <th>Customer ID</th>
                        <th>Review Time</th>
                        <th>Review Description</th>
                        <th>Manage Review</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //get data from the database
                        $sql = "SELECT * FROM review";
                        //store data from database inside a variable
                        $result = mysqli_query($conn, $sql);
                        //if variable exists
                        if ($result) {
                            //keep printing out database assoc array
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['review_id'];
                                $customerid = $row['customer_id'];
                                $reviewtime = $row['review_time'];
                                $reviewdescription = $row['review_description'];

                                echo '<tr>
                                <td>' . $id . '</td>
                                <td>' . $customerid . '</td>
                                <td>' . $reviewtime . '</td>
                                <td>' . $reviewdescription . '</td>
                                <td>
                                <button class="delete"><a href="admindeletereview.php?deleteid=' . $id . '">Delete</a></button>
                                </td>
                                </tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="back-button">
            <a href="adminlanding.php"><i class="fas fa-arrow-left"></i> BACK</a>
        </div>
    </div>
</body>
</html>
