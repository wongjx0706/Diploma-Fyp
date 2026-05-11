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
    <title>Sova HOTEL | Facilities</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #121212;
            color: #e0e0e0;
        }
        .banner {
            height: 60vh;
            background-color: #1f1f1f;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .banner h1 {
            font-size: 3em;
            margin: 0;
        }
        .content {
            padding: 5%;
            text-align: center;
        }
        .facilities-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 5%;
        }
        .facility-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
            width: 100%;
            background-color: #1e1e1e;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }
        .facility-item img {
            width: 100%;
            max-width: 600px;
            height: auto;
        }
        .facility-details {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            text-align: center;
        }
        .facility-details h2 {
            margin: 0;
            color: #6C63FF;
        }
        .facility-details p {
            margin: 10px 0 0 0;
        }
        .spacer {
            height: 20px;
        }
        footer {
            background-color: #1f1f1f;
            color: #ffffff;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- banner -->
    <div class="banner">
        <h1>FACILITIES</h1>
    </div>
    <!-- banner -->

    <div class="content">
        <p>Our amenities include well-equipped fitness centers and pristine swimming pools to enhance your experience. Relish in superb dining options at our on-site restaurants or rejuvenate with a spa treatment. With contemporary conference rooms and event spaces, we meet the needs of both business and leisure guests.</p>
    </div>

    <div class="facilities-container">
        <!-- Static facility items (no database) -->
        <div class="facility-item">
            <img src="images/gym.jpg" alt="Gym">
            <div class="facility-details">
                <h2>Gym</h2>
                <p>Stay fit during your stay with our fully equipped gym.</p>
            </div>
        </div>

        <div class="facility-item">
            <img src="images/pool.jpg" alt="Swimming Pool">
            <div class="facility-details">
                <h2>Swimming Pool</h2>
                <p>Relax and unwind in our sparkling swimming pool.</p>
            </div>
        </div>

        <div class="facility-item">
            <img src="images/restaurant.jpg" alt="Restaurant">
            <div class="facility-details">
                <h2>Restaurant</h2>
                <p>Enjoy delicious meals at our on-site restaurant.</p>
            </div>
        </div>

        <div class="facility-item">
            <img src="images/spa.jpg" alt="Spa">
            <div class="facility-details">
                <h2>Spa</h2>
                <p>Indulge in luxury treatments at our rejuvenating spa.</p>
            </div>
        </div>

        <div class="facility-item">
            <img src="images/conference.jpg" alt="Conference Room">
            <div class="facility-details">
                <h2>Conference Room</h2>
                <p>Host your meetings and events in our modern conference room.</p>
            </div>
        </div>
    </div>

    <footer>
    <?php
    include 'footer.php';
    ?>
    </footer>

</body>
</html>
