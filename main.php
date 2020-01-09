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

if ($_SERVER["REQUEST_METHOD"] == "POST")  {
  //Checks if we have pussed the button named conversation
  if(isset($_POST['newProject'])){
    $user = userID($_SESSION['email'], $conn);
    $name = $_POST['projectName'];

    $sql = "INSERT INTO project (name, user_id) VALUES ('$name', '$user');";
    $conn ->query($sql);

    $sql = "SELECT MAX(id) FROM project WHERE user_id=$user;";
    $result = $conn->query($sql);
    $fetch = $result;
    $row = mysqli_fetch_assoc($fetch);
    $project = $row['MAX(id)'];

    $sql = "INSERT INTO user_project (user_id, project_id) VALUES ('$user', '$project');";
    $conn ->query($sql);

   
    } if(isset($_POST['open'])){

      $hentid = $_POST['openid'];
      $_SESSION['project'] = $hentid;
      header('location:project.php');

    }

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
    <a href="main.php"><li>Find your PenPal!</li></a>
    <a href="index.php"><li>Logout</li></a>
  </ul>
</div>

  <div class="inputPage">

    <div class="nameBar">
      <p>Find your PenPal</p>
    </div>
    <form method="POST">
      <input type="text" name="projectName">
      <input type="submit" name="newProject" value="Create Project">
    </form>

  </div>
<?php
$userid = userID($_SESSION['email'], $conn);
$sql = "SELECT * FROM project INNER JOIN user_project ON project.id = user_project.project_id WHERE user_project.user_id = $userid;";
$result = $conn->query($sql);

if($result->num_rows > 0){
  ?>

  <table class="gaesteSe">
    <tr>
      <th>Project</th>
    </tr>
  <?php
  // løb alle rækker igennem
  while($row = $result->fetch_assoc()) {
  ?>
    <tr>
  <?php
  $name = $row['name'];
  $id = $row['id'];
  echo "<td>$name</td><form method='POST'><td><input type='submit' class='button' name='open' value='Open' /><input type='hidden' value='$id' name='openid'/></td></form>";
  ?>
    </tr>
  <?php

}
?>
</table>
<?php
}
?>
<body>
</html>