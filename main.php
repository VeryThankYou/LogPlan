<?php
session_start();
//This file has our connection to our database
include('config.php');

//Check if we have a session called email. This way we block users from changing the url and trying to skip login.
if(!($_SESSION['email'])){
  header('location: index.php');  
}

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

<div class="header">
   <ul>
      <a href="/main.php"><li>Find your PenPal!</li></a>
      <a href="/index.php"><li>Logout</li></a>
    </ul>
  </div>

  <div class="inputPage">

    <div class="nameBar">
      <p>Find your PenPal</p>
    </div>


  </div>

<body>
</html>