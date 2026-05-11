<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sova Hotel | About Us</title>
    <link rel="stylesheet" href="about.css">
    <link rel="icon" href="images/Icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #121212; /* Dark background */
            color: #eee; /* Light text */
        }
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px #333; /* Darker track shadow */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #888; /* Light scrollbar thumb */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555; /* Darker scrollbar thumb on hover */
        }
        .banner {
            background-color: #333; /* Darker banner background */
            height: 60vh;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            font-size: 2.5em;
            font-weight: bold;
        }
        .content, .header {
            padding: 5%;
            background-color: #292929; /* Darker content background */
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 1200px;
        }
        .header h1, .content h1 {
            color: #6C63FF; /* Accent color */
        }
        .content p {
            line-height: 1.6;
            margin-bottom: 20px;
            color: #ccc; /* Lighter text */
        }
        .content {
            text-align: left;
        }
        .staff {
            width: 100%;
            margin: 20px 0;
            text-align: center;
            border-collapse: collapse;
        }
        .staff th {
            color: white;
            padding: 10px;
        }
        .staff td {
            padding: 10px;
        }
        .staff img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .staff p {
            margin: 10px 0;
            color: #ccc; /* Lighter text */
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

    <div class="banner">
        ABOUT US
    </div>

    <div class="header" id="aboutinfo">
        <h1><b>ABOUT US</b></h1>
        <p>Our Building are Located in MMU Cyberjaya.<br><br>
            The primary objective of the SOVA Hotel, which opened in 2024, is to offer guests 
            a warm and welcoming experience. We integrate our services with the Internet to provide 
            our hotel services at your fingertips, with a particular focus on the Internet of Things 
            ecosystem (IoT). At SOVA Hotel, we give you a cozy place to call home so you can enjoy and 
            appreciate the special experiences we have to offer to the fullest.</p>
    </div>

    <div class="content" id="aboutinfo">
        <h1>LET US INTRODUCE OURSELVES</h1>
        <p>Welcome to our exquisite hotel, where luxury meets comfort in every detail.
            <br><br>Step into a world of elegance and charm as you enter our distinguished hotel.
            <br><br>Discover a sanctuary of indulgence and relaxation at our prestigious hotel.
            <br><br>Experience the epitome of hospitality and sophistication at our renowned hotel.
            <br><br>Escape to a haven of tranquility and opulence at our exclusive hotel.
            <br><br>Immerse yourself in the allure of our upscale hotel, where every moment is crafted for your pleasure.
            <br><br>Prepare to be captivated by the timeless allure and impeccable service of our iconic hotel.
            <br><br>Join us in a journey of refined luxury and unparalleled hospitality at our esteemed hotel.
            <br><br>Welcome to our distinguished establishment, where every guest is treated to a bespoke experience of comfort and style.
            <br><br>Indulge in the ultimate getaway at our opulent hotel, where every stay is a celebration of indulgence and relaxation.
        </p>
    </div>

    <div class="content">
        <table class="staff">
            <tr>
                <th colspan="3"><h1>Our Staff</h1></th>
            </tr>
            <tr>
                <td><img src="images/staffa.jpg" alt="Hotel Manager"/></td>
                <td><img src="images/staffb.jpg" alt="Reception Manager"/></td>
                <td><img src="images/staffc.jpg" alt="IT Manager"/></td>
            </tr>
            <tr id="staffinfo">
                <td><p>Name : Wong Jing Xiang<br/>Founder of SovaHotel</p></td>
                <td><p>Name : Chen Yong Qi<br/>Hotel Manager</p></td>
                <td><p>Name : Wong Ze Xiang<br/>Hotel Manager</p></td>
            </tr>
        </table>
    </div>

    <footer>
        <?php
        include 'footer.php';
        ?>
    </footer>
</body>
</html>
