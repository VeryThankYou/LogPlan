<?php
session_start();
//This file has our connection to our database
include('config.php');

//Check if we have a session called email. This way we block users from changing the url and trying to skip login.
if(!isset($_SESSION['email'])){
  header('location: index.php');
}
$timeid = $_SESSION['time-element'];


if ($_SERVER["REQUEST_METHOD"] == "POST")  {
    if(isset($_POST['back'])){
        header('location:project.php');
    } else if(isset($_POST['adddes'])){

        $des = $_POST['dscrpt'];
        $sql = "UPDATE time_element SET description = '$des' WHERE id = '$timeid';";
        $conn->query($sql);
    }
}
$sql = "SELECT * FROM time_element WHERE id='$timeid';";
$result = $conn->query($sql);
$row = $row = $result->fetch_assoc();
$dscrpt = $row['description'];
$start = $row['start_time'];
$end = $row['end_time'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>
<body>
<?php

echo $start;
?>
<br>
<?php
echo $end;
?>
<br>

<form method='POST'>
Description
<br>
<?php
echo "<textarea name='dscrpt'>$dscrpt</textarea>";
?>
<input type='submit' name='adddes' value='Save description'>
</form>
<form method='POST'>
<input type='submit' name='back' value='Back'>
</form>

</body>
</html>