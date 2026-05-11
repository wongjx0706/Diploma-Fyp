<?php
    include 'config.php';
    include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="facilities.css">
    <title>Sova Hotel | Reviews</title>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #121212; /* Dark background */
            color: #eee; /* Light text */
        }

        .header {
            letter-spacing: 5px;
            font-weight: bold;
        }

        .desc {
            margin: 2em;
            font-weight: normal;
            font-size: 16pt;
        }

        .reserve {
            margin-bottom: 1.5em;
            font-size: 12pt;
        }

        .banner {
            height: 10vh;
            background-size: cover;
            background-position: center;
        }

        .content {
            text-align: center;
            padding: 5%;
            background-color: #292929; /* Darker content background */
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 1200px;
        }

        .content hr {
            width: 50%;
            display: inline-block;
        }

        footer {
            background-color: #333; /* Darker footer background */
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }
    </style>
</head>
<body>

    <!-- Banner -->
    <div class="banner"></div>
    <!-- Banner -->

    <!-- Introduction Section -->
    <div class="content">
      <h1 class="header"><u>REVIEWS</u></h1>
      <p> Learn why our customers continuously rave about our top-notch service, comfortable rooms, and spotless cleanliness. Benefit from the experiences of other travelers to guide your decision for your upcoming stay.

</p>
    </div>
    <!-- Introduction Section -->

    <!-- Reviews Section -->
    <?php
    $sql = "SELECT * FROM customer";
    $result1 = mysqli_query($conn, $sql);

    while ($row1 = mysqli_fetch_assoc($result1)) {
        $customername = $row1['customer_name'];
        $customerid = $row1['customer_id'];

        $sql2 = "SELECT * FROM review WHERE customer_id = $customerid";
        $result2 = mysqli_query($conn, $sql2);

        while ($row2 = mysqli_fetch_assoc($result2)) {
            $reviewtime = $row2['review_time'];
            $reviewdescription = $row2['review_description'];

            $reservationid = $row2['reservation_id'];
            $sql3 = "SELECT * FROM reservation WHERE reservation_id = $reservationid";
            $result3 = mysqli_query($conn, $sql3);

            while ($row3 = mysqli_fetch_assoc($result3)) {
                $reservationdate = $row3['reservation_date'];
                $reservationstatus = $row3['reservation_status'];

                $roomid = $row3['room_id'];
                $sql4 = "SELECT * FROM room WHERE room_id = $roomid";
                $result4 = mysqli_query($conn, $sql4);

                while ($row4 = mysqli_fetch_assoc($result4)) {
                    $roomname = $row4['room_name'];

                    echo '<div class="content">
                        <hr>
                        <h1 class="header">'.$customername.' ('.$roomname.')</h1>
                        <h2 class="desc">"'.$reviewdescription.'"</h2>
                        <p class="reserve">Reserved At : '.$reservationdate.', Review Time : '.$reviewtime.'</p>
                    </div>';
                }
            }
        }
    }
    ?>
    <!-- Reviews Section -->

    <!-- Footer -->
    <footer>
    <?php include 'footer.php'; ?>
    </footer>
    <!-- Footer -->

</body>
</html>
