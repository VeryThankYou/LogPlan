<?php
// To have access to the sessions variables
session_start();
// Contains our connection to our database
include('config.php');
session_unset();
//Checks if a submit button that is inside the form, has been pushed.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Checks if it is the login button
  if(isset($_POST["login"])) {
  header('location:login.php');
  } 
  //There are only 2 buttons so if it is not the first then it is the second.
  else {
    header('location:register.php');	}
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
    </ul>
  </div>

  <div class="inputPage">

    <div class="nameBar">
      <p>PenPal</p>
    </div>

    <div class="inputBox">
      <table>
        <tr>
          <form method="POST"><th><input type="submit" name="login" value="Login"/></th></form>
        </tr>
        <tr>
          <form method="POST"><th><input type="submit" name="register" value="Register"/></th></form>
        </tr>
      </table>
    </div>  
  </div>

</body>
</html>