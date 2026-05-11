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
    <title>Sova Hotel | Contact Us</title>
    <style>
        body {
            background-color: #121212;
            color: #E0E0E0;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .content {
            display: flex;
            height: 100vh;
        }
        .flex-50 {
            width: 50%;
        }
        .banner {
            background: black;
            height: 9vh;
            background-size: cover;
            background-position: center;
        }
        .contact-info {
            text-align: center;
            padding-top: 30vh;
        }
        .description {
            padding: 0 5%;
        }
        a {
            color: #BB86FC;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .social-icons i {
            font-size: 24px;
            color: #BB86FC;
        }
    </style>
</head>
<body>

    <!-- banner -->
    <div class="banner"></div>
    <!-- banner -->

    <div class="content">
        <div class="flex-50">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.605861093325!2d101.63801497413726!3d2.929069654467817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdb6e9ab2c6603%3A0xdedb9094d553b194!2sFaculty%20of%20Computing%20%26%20Informatics!5e0!3m2!1sen!2smy!4v1682696428377!5m2!1sen!2smy" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="flex-50 contact-info">
            <h1><u>CONTACT US</u></h1>
            <br>
            <p class="description">We're just a click or call away from assisting you. Find our phone number, email address, and social media links on this page.
            <br><br>Whether you have a question, need assistance with your reservation, or simply want to connect with us, we're here to help.</p>
            <br>
            <p>HSTHOTEL@gmail.com</p>
            <p>+01341233132</p>
            <br>
            <p>Follow our social medias</p>
            <br>
            <div class="social-icons">
                <i class="fa-brands fa-square-instagram"></i><p>INSTAGRAM</p>
                <i class="fa-brands fa-facebook"></i><p>FACEBOOK</p>
                <i class="fa-brands fa-linkedin"></i><p>LINKED IN</p>
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
