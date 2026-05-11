<?php
session_start();
include 'config.php';

// If user_name is not set
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login form
    header('location:index.php');
    exit();
}

include 'adminnavbar.php';

// Handle room info update
if (isset($_POST['submitInfo'])) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'][$id];
        $price = $_POST['price'][$id];
        $desc = $_POST['desc'][$id];

        $updateQuery = "UPDATE room SET room_name = '$name', room_price = '$price', room_description = '$desc' WHERE room_id = $id";
        $result = mysqli_query($conn, $updateQuery);

        if ($result) {
            echo '<div class="message"><strong>Data updated successfully</strong></div>';
            header("Refresh:0");
            exit();
        } else {
            die(mysqli_error($conn));
        }
    }
}

// Handle image update
if (isset($_POST['submitImage'])) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $image = $_FILES['file'];

        // Get the file details
        $imagefilename = $image['name'];
        $imagefileerror = $image['error'];
        $imagefiletemp = $image['tmp_name'];

        // Separate file name and extension
        $filename_separate = explode('.', $imagefilename);
        $file_extension = strtolower(end($filename_separate));

        $allowed = array('jpg', 'jpeg', 'png', 'gif');

        // Check if the file extension is allowed
        if (in_array($file_extension, $allowed)) {
            $upload_image = 'uploads/' . $imagefilename;
            move_uploaded_file($imagefiletemp, $upload_image);

            $updateQuery = "UPDATE room SET room_image = '$upload_image' WHERE room_id = $id";
            $result = mysqli_query($conn, $updateQuery);

            if ($result) {
                echo '<div class="message"><strong>Image updated successfully</strong></div>';
                header("Refresh:0");
                exit();
            } else {
                die(mysqli_error($conn));
            }
        } else {
            echo '<p class="error">*You cannot upload this file type</p>';
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
    <title>Room Upload</title>
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .col-25 {
            width: 25%;
            padding-right: 10px;
            box-sizing: border-box;
        }

        .col-75 {
            width: 75%;
            box-sizing: border-box;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        .message {
            text-align: center;
            margin: 20px 0;
            font-size: 1.1em;
            color: green;
        }

        .error {
            text-align: center;
            color: red;
            margin: 10px 0;
        }

        button[type="submit"],
        .back-button {
            padding: 10px 20px;
            margin: 10px 5px 0 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"] {
            background-color: #04AA6D;
            color: white;
        }

        button[type="submit"]:hover {
            background-color: #039F5B;
        }

        .back-button {
            background-color: #555;
            color: white;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #993347;
            color: white;
        }

        td img {
            width: 100px;
            height: 75px;
        }

        td input[type="text"],
        td input[type="number"],
        td textarea {
            width: calc(100% - 20px);
            margin: 0 auto;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        td button[type="submit"],
        td .delete-button {
            margin-top: 5px;
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        td button[type="submit"] {
            background-color: #04AA6D;
            color: white;
        }

        td button[type="submit"]:hover {
            background-color: #039F5B;
        }

        td .delete-button {
            background-color: red;
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
        }

        td .delete-button:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

    <!-- Site content -->
    <div class="container">
        <h1>Room Upload</h1>

        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-25">
                    <label for="new_name">Room Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="new_name" name="new_name" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="new_desc">Room Description</label>
                </div>
                <div class="col-75">
                    <textarea id="new_desc" name="new_desc" rows="5" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="new_price">Room Price</label>
                </div>
                <div class="col-75">
                    <input type="number" id="new_price" min="1" step="any" name="new_price" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="file">Room Image</label>
                </div>
                <div class="col-75">
                    <input type="file" id="file" name="file" required>
                </div>
            </div>
            <div class="row">
                <button type="submit" name="submit">Upload Room</button>
            </div>

            <?php
            if (isset($_POST['submit'])) {
                $new_name = $_POST['new_name'];
                $new_desc = $_POST['new_desc'];
                $new_price = $_POST['new_price'];

                // Get the file details
                $image = $_FILES['file'];
                $imagefilename = $image['name'];
                $imagefileerror = $image['error'];
                $imagefiletemp = $image['tmp_name'];

                // Separate file name and extension
                $filename_separate = explode('.', $imagefilename);
                $file_extension = strtolower(end($filename_separate));

                $allowed = array('jpg', 'jpeg', 'png', 'gif');

                // Check if the file extension is allowed
                if (in_array($file_extension, $allowed)) {
                    $upload_image = 'uploads/' . $imagefilename;
                    move_uploaded_file($imagefiletemp, $upload_image);

                    $insertQuery = "INSERT INTO room (room_name, room_description, room_price, room_image) VALUES ('$new_name', '$new_desc', '$new_price', '$upload_image')";
                    $result = mysqli_query($conn, $insertQuery);

                    if ($result) {
                        echo '<div class="message"><strong>Room uploaded successfully</strong></div>';
                    } else {
                        die(mysqli_error($conn));
                    }
                } else {
                    echo '<p class="error">*You cannot upload this file type</p>';
                }
            }
            ?>
        </form>

        <!-- Display Room -->
        <h2 style="text-align: center; margin-top: 40px;">Rooms</h2>
        <table>
            <tr>
                <th>Room ID</th>
                <th>Room Name</th>
                <th>Room Description</th>
                <th>Room Price</th>
                <th>Room Image</th>
                <th colspan="3">Settings</th>
            </tr>
            <?php
            $query = "SELECT * FROM room";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['room_id'];
                $name = $row['room_name'];
                $desc = $row['room_description'];
                $price = $row['room_price'];
                $image = $row['room_image'];
                echo '
                    <tr>
                        <form method="post" enctype="multipart/form-data">
                            <td>' . $id . '</td>
                            <td><input type="text" name="name[' . $id . ']" value="' . $name . '" required></td>
                            <td><textarea name="desc[' . $id . ']" rows="3" required>' . $desc . '</textarea></td>
                            <td><input type="number" min="1" step="any" name="price[' . $id . ']" value="' . $price . '" required></td>
                            <td><img src="' . $image . '"></td>
                            <input type="hidden" name="id" value="' . $id . '">
                            <td><button type="submit" name="submitInfo">Update Info</button></td>
                        </form>
                        <form method="post" enctype="multipart/form-data">
                            <td>
                                <input type="hidden" name="id" value="' . $id . '">
                                <input type="file" name="file" required>
                                <button type="submit" name="submitImage">Update Image</button>
                            </td>
                        </form>
                        <td><a class="delete-button" href="adminroomdelete.php?roomid=' . $id . '">Delete</a></td>
                    </tr>
                ';
            }
            ?>
        </table>
    </div>

</body>
</html>
