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
      echo "<div class='error'>user does not exist</div>";
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

  } else if(isset($_POST['time-element'])){

    $start = $_POST['start'];
    $end = $_POST['end'];
    $userid = userID($_SESSION['email'], $conn);
    $proid = $_SESSION['project'];
    $sql = "INSERT INTO time_element (user_id, project_id, end_time, start_time) VALUES ('$userid', '$proid', '$end', '$start');";
    $conn ->query($sql);

  } else if(isset($_POST['descript'])){

    $hentid = $_POST['time_element_id'];
    $_SESSION['time-element'] = $hentid;
    header('location:time_element.php');
}else if(isset($_POST['dlt'])){
  $commid = $_POST['time_element_id'];
  $sql = "DELETE FROM time_element WHERE id=$commid;";
  $conn->query($sql);
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

    <a href="main.php"><h1>LogPlan</h1></a>

    <a href="index.php">
      <div class="logout">
        <p>Logout</p>
      </div>
    </a>   

  </div>
  <div class="projectView">
    <h1>
    <?php
    $prjname = projectName($_SESSION['project'], $conn);
    echo $prjname;
    ?>
    </h1>
    <div class="projectInput">
      <div>
        <form method='POST'>
          <input type="text" name="mail">
          <input type="submit" name="add" value="Add to project">
        </form>
      </div>

      <div>
        <form method='POST'>
          <input type='date' name='start'>
          <input type='date' name='end'>
          <input type='submit' name='time-element' value='Create time-element'>
        </form>
      </div>
    </div>

      <?php
    $proid = $_SESSION['project'];
    $sql = "SELECT * FROM time_element WHERE project_id = $proid;";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
      ?>
    <center><div class="projectComment">
      <table>
        <tr>
          <th colspan="2">Time-elements</th>
        </tr>
      <?php
      // løb alle rækker igennem
      while($row = $result->fetch_assoc()) {
      ?>
        <tr>
      <?php
      $time = $row['start_time'];
      $id = $row['id'];
      echo "<td>$time</td><form method='POST'><td><input type='submit' class='open' name='descript' value='Open' /><input type='submit' class='delete' name='dlt' value='Delete' /><input type='hidden' value='$id' name='time_element_id'/></td></form>";
      ?>
        </tr>
    
    <?php
    }
    ?>

      </table>
    </div></center>
<?php
}
?>
  </div>
</body>
</html>
