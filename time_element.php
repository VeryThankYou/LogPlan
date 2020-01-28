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
        echo "Hej";
        $commenttext = $_POST['commentText'];
        $userid = userID($_SESSION['email'], $conn);
        $sql = "INSERT INTO comment (user_id, time_element_id, text) VALUES ('$userid', '$timeid', '$commenttext');";
        $conn->query($sql);
    }
}
$sql = "SELECT * FROM time_element WHERE id='$timeid';";
$result = $conn->query($sql);
$row = $row = $result->fetch_assoc();
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

<?php

if($result->num_rows > 0){

    ?>

  <table class="kommentarer">
    <tr>
      <th>LogComments</th>
    </tr>
    <tr>
    <td>User</td>
    <td>LogComment</td>
    </tr>
    <?php
  // løb alle rækker igennem
  while($row = $result->fetch_assoc()) {
  ?>
    <tr>
  <?php
  $poster = $row['user_id'];
  $comment = $row['text'];
  echo "<td>$poster</td><td>$comment</td>";
  ?>
    </tr>
  <?php
}
}else{
    echo "There are no LogComments on this time-element";
}
?>
<form method='POST'>
<textarea name='commentText'>Write your LogComment here...</textarea>
<input type='submit' name='postComment' value='Post comment'>
</form>
</body>
</html>