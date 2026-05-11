<?php   
include 'config.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sova Hotel | Room</title> 
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #121212; /* Dark background */
            color: #eee; /* Light text */
        }
        .banner {
            height: 60vh;
            background-color: #333; /* Darker banner background */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }
        .banner h1 {
            font-size: 3em;
            margin: 0;
        }
        .content {
            text-align: center;
            padding: 0 5%;
        }
        .header {
            padding: 2% 5%;
            font-size: 1.5em;
            color: #6C63FF; /* Accent color */
        }
        .description {
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .rooms-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 0 5%;
        }
        .room-card {
            width: calc(33.33% - 20px);
            background-color: #292929; /* Darker room card background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .room-card:hover {
            transform: translateY(-5px);
        }
        .room-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .room-details {
            padding: 20px;
        }
        .room-details h2 {
            margin: 0;
            color: #6C63FF; /* Accent color */
            font-size: 1.5em;
        }
        .room-details p {
            margin: 10px 0;
        }
        .book-button {
            background-color: #6C63FF; /* Accent color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .book-button:hover {
            background-color: #534bd4; /* Darker accent color on hover */
        }
        footer {
            background-color: #333; /* Darker footer background */
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }
        .book-button a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <!-- banner -->
    <div class="banner">
        <h1>ROOMS</h1>
    </div>
    <!-- banner -->

    <div class="content">
        <h2 class="header">Discover Our Rooms</h2>
        <p class="description">Experience the ultimate combination of comfort, luxury, and convenience in our carefully curated rooms. Enjoy a spotless environment where cleanliness is our top priority, and feel the difference with our welcoming and attentive service. Select from our variety of impeccably kept rooms and reserve your perfect getaway today.</p>
    </div>

    <div class="rooms-container">
        <?php
        $sql = "SELECT * FROM room ";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $id = $row['room_id'];
            $name = $row['room_name'];
            $desc = $row['room_description'];
            $price = $row['room_price'];
            $image = $row['room_image'];
        ?>
        <div class="room-card">
            <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>" class="room-image">
            <div class="room-details">
                <h2><?php echo $name; ?></h2>
                <p><?php echo nl2br($desc); ?></p>
                <p>Price per night: $<?php echo $price; ?></p>
                <button class="book-button"><a href="reservation.php?roomid=<?php echo $id; ?>">BOOK A ROOM</a></button>
            </div>
        </div>
        <?php
        }
        ?>
    </div>

    <footer>
    <?php
    include 'footer.php';
    ?>
    </footer>
   
</body>
</html>
