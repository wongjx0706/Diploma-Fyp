<?php
//connect to the database sovadata  
$conn = mysqli_connect('localhost','root','','sovadata4');
if (!$conn) {
    echo "Error connecting to MySQL: " . mysqli_connect_error();
    die;
}
?>