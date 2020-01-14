<?php
session_start();
//This file has our connection to our database
include('config.php');

//Check if we have a session called email. This way we block users from changing the url and trying to skip login.
if(!isset($_SESSION['email'])){
  header('location: index.php');  
}

function projectName($id, $conn){
  $sql = "SELECT name FROM project WHERE id='$id';";
  $result = $conn->query($sql);
  $fetch = $result;
  $row = mysqli_fetch_assoc($fetch);
  return $row['name'];
}

function userID($email, $conn){
  $sql = "SELECT id FROM user WHERE email='$email';";
  $result = $conn->query($sql);
  $fetch = $result;
  $row = mysqli_fetch_assoc($fetch);
  return $row['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST")  {
  if(isset($_POST['add'])){
    $input = $_POST['mail'];
    $inputid = userID($input, $conn);

    if($inputid == null){
      echo "findes ikke";
    } else{
      $proid = $_SESSION['project'];
      $sql = "SELECT * FROM user_project WHERE user_id='$inputid' AND project_id='$proid';";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
        echo "allerede del af projekt";
      } else{
        $sql = "INSERT INTO user_project (user_id, project_id) VALUES ('$inputid', '$proid');";
        $conn ->query($sql);
      }
    }


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
      <a href="login.php"><li>Login</li></a>
      <a href="register.php"><li>Register</li></a>
      <a href="main.php"><li>Projects</li></a>
    </ul>
  </div>
  <h1><?php
  $prjname = projectName($_SESSION['project'], $conn);
  echo $prjname;
  ?>
  </h1>
  <div>
  <form method='POST'>
  <input type="text" name="mail">
  <input type="submit" name="add" value="Add to project">
  </form>
  </div>
</body>
</html>
