<?php
    include 'config.php';
    include 'navbar.php';

    session_start();
    session_unset();
    session_destroy();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log out</title>

    <style>
        html{
            background-color: #333;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            scroll-behavior: smooth;
        }

        .center-text p{
            text-transform: uppercase;
            background-image: linear-gradient(
                to bottom right,
                white 0%,
                white 100%
            );
            background-size: 200% auto;
            color: white;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;

            font-size: 1.2em;
        }

        button{
            border: 0.2em solid white;
            border-radius: 0.5em;
            margin-top: 2em;
            width: 20em;
            height: 2em;
            background-color: grey;
            trnsition: 0.5s;
        }

        button:hover{
            border: 0.2em solid grey;
            border-radius: 0.5em;
            margin-top: 2em;
            width: 20em;
            height: 2em;
            background-color: white;
        }

        button a{
            color: white;
            width: 100%;
            padding: 0.5em 2.8em;
            transition: 0.5s;
        }
        button a:hover{
            color: black;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="center-text">
        <p>You have logged out</p>
        <button><a href=index.php>RETURN TO THE HOMEPAGE</a></button>
    </div>
</body>
</html>
