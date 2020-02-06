<?php
session_start();
//This file has our connection to our database
include('config.php');

//Check if we have a session called email. This way we block users from changing the url and trying to skip login.
if(!isset($_SESSION['email'])){
  header('location: index.php');
}

function userID($email, $conn){
    $sql = "SELECT id FROM user WHERE email='$email';";
    $result = $conn->query($sql);
    $fetch = $result;
    $row = mysqli_fetch_assoc($fetch);
    return $row['id'];
  }

$timeid = $_SESSION['time-element'];

if ($_SERVER["REQUEST_METHOD"] == "POST")  {
    if(isset($_POST['back'])){
        header('location:project.php');
    } else if(isset($_POST['adddes'])){

        $des = $_POST['dscrpt'];
        $sql = "UPDATE time_element SET description = '$des' WHERE id = '$timeid';";
        $conn->query($sql);
    }else if(isset($_POST['postComment'])){
        $commenttext = $_POST['commentText'];
        $userid = userID($_SESSION['email'], $conn);
        $sql = "INSERT INTO comment (user_id, time_element_id, text) VALUES ('$userid', '$timeid', '$commenttext');";
        $conn->query($sql);
    }else if(isset($_POST['dlt'])){
      $commid = $_POST['dltid'];
      $sql = "DELETE FROM comment WHERE id=$commid;";
      $conn->query($sql);
    }
}
$sql = "SELECT * FROM time_element WHERE id='$timeid';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$dscrpt = $row['description'];
$start = $row['start_time'];
$end = $row['end_time'];

$sql ="SELECT * FROM comment WHERE time_element_id='$timeid';";
$result = $conn->query($sql);


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

    <a href="main.php"><h1>LogPlan</h1></a>

    <a href="index.php">
      <div class="logout">
        <p>Logout</p>
      </div>
    </a>   

    <div class="back">
      <form method='POST'>
      <input type='submit' name='back' value='Back'>
      </form>
    </div>

  </div>
  <h1 class="dateName">
    <?php

    echo $start;
    ?>
    <br>
    <?php
    echo $end;
    ?>
    <br>
  </h1>

  <div class="description">
    <p>Description</p>
    <form method='POST'>
    <br>
    <?php
    echo "<textarea name='dscrpt'>$dscrpt</textarea>";
    ?>
    <input type='submit' name='adddes' value='Save description'>
    </form>
  </div>
    
  <div class="writeComment">
    <p>LogComments</p>
    <form method='POST'>
      <textarea name='commentText'>Write your LogComment here...</textarea>
      <input type='submit' name='postComment' value='Post comment'>
    </form>
  </div>

  <table class="comments">
  
  <?php
  if($result->num_rows > 0){
  // løb alle rækker igennem
  while($row = $result->fetch_assoc()) {
  ?>
  
    <tr>
  
  <?php
  $poster = $row['user_id'];
  $id = $row['id'];
  $sql = "SELECT firstname, surname FROM user WHERE id='$poster';";
  $result2 = $conn->query($sql);
  $row2 = $result2->fetch_assoc();
  $fname = $row2['firstname'];
  $lname = $row2['surname'];
  $userid = userID($_SESSION['email'], $conn);

  $comment = $row['text'];
  echo "<td>$fname $lname</td><td style='width:100%;'>$comment</td>";
  if($poster == $userid){
    echo "<td><form method='POST'><input type='submit' name='dlt' value='Delete'><input type='hidden' name='dltid' value='$id'></form></td>";
  }
  ?>

    </tr>  
  </table>
  <?php
}
}else{
    echo "<div class='empty'>There are no LogComments on this time-element</div>";
}
?>
  
</body>
</html>