<?php
include 'config.php';
session_start();
session_unset();
session_destroy();
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];
    $sql="DELETE FROM customer WHERE customer_id=$id ";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "deleted successfully";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href=index.php><button>RETURN TO THE HOMEPAGE</button></a>
</body>
</html>