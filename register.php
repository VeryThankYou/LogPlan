<?php
//We start a session here, which can be used to save login-details. We also connect to our database with config.php
session_start();
include('config.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

  <div class="header">
   <ul>
      <a href="login.php"><li>Login</li></a>
      <a href="register.php"><li>Register</li></a>
    </ul>
  </div>


  <div class="inputPage">
    
  <form method="POST">
    <div class="nameBar">
      <p>Register</p>
    </div>

    <div class="inputBox">
      <table>
  
        <tr>
          <td><label >Email</label></td>
          <td><input type="email" name="email" placeholder="Enter email" required></td>
        </tr>
    
        <tr>
          <td><label >Firstname</label></td>
          <td><input type="text" name="firstname" placeholder="Firstname" required></td>
        </tr>
    
        <tr>
          <td><label >Surname</label></td>
          <td><input type="text" name="surname" placeholder="Surname" required></td>
        </tr>
    
        <tr>
          <td><label >Password</label></td>
          <td><input type="password" name="password" placeholder="Password" required></td>
        </tr>
    
      </table>
    </div>

    <div class="inputBox">
      <button type="submit" name="btnCreateUser">Create</button>
  </form>

      <button type="button" onclick="window.location.href='index.php'" name="btnCancel">Cancel</button>
    </div>
  </div>    
      
<?php
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
        //If an input is send in a form with the method POST, if the input's name is 'btnCreateUser', the following happens:
        if(isset($_POST['btnCreateUser'])){
          //The database is checked for users with the same email as what was given as an input
          $email = mysqli_real_escape_string($conn, $_POST['email']);

          $sql = "SELECT email FROM user WHERE email = '$email'";
          $result = $conn->query($sql);

          $row = mysqli_fetch_assoc($result);

          $count = mysqli_num_rows($result);

          if($count == 1) {
            //If there is such a user, a failure-message is send to the webpage
            echo "<span class='errorText'>Unable to create user. The email is already being used</span>";
          }else {
            //Otherwise, the info from the inputs are saved, the password is hashed, and everything gets saved as a new user in our database, in the table 'user'
            $password = mysqli_real_escape_string($conn, password_hash($_POST['password'], PASSWORD_DEFAULT));

            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
      
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $sql = "INSERT INTO user (email, password, firstname, surname) VALUES ('$email', '$password', '$firstname', '$surname')";

            $conn ->query($sql);
            
            //At last the user gets redirected to login.php
            header("location:login.php");
          }
        }
      }
      ?>

<script src="/js/main.js"></script>
</body>

</html>

