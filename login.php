<?php
//Here a session is started, so any login-details can be saved
session_start();
//Connect to our database
include('config.php');

//Variables for checking login are created
$email="";
$pw="";
$cpw="";
$cemail="";

//If the mail-input and the pw-input are send, the following happens:
if(!empty( $_POST['email'] ) && !empty( $_POST['pw'] )) {
  //The email and password from the input are saved in the variables $email and $pw
  $email = $_POST['email'];
  $pw = $_POST['pw'];
  
  //Here we check our database for a user with the email given as input
  $sql = "SELECT password FROM user WHERE email='$email';";
  $result = $conn->query($sql);
	$fetch = $result;
  $row = mysqli_fetch_assoc($fetch);
  
  //Here the hashed password of the user from the database, is saved in $cpw, and cmail is set to the mail given as input
	$cpw = $row['password'];
  $cemail = $email;
}
  //Check if the mail is correct, and if the written password matches the hashed password from the database
  if($email == $cemail && password_verify($pw, $cpw) == true) {
    //The mail is saved as a session-variable
    $_SESSION['email'] = $email;
    //Redirects to main.php
    header('location:main.php');
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
      <a href="/logplan/login.php"><li>Login</li></a>
      <a href="/logplan/register.php"><li>Register</li></a>
    </ul>
  </div>


  <div class="inputPage">

    <div class="nameBar">
      <p>Login</p>
    </div>

    <div class="inputBox">
      <form method="POST">
        <table>

          <tr>
            <th>Mail: <br/></th>
            <th><input type="text" name="email" /></th>
          </tr>

          <tr>
            <th>Password: <br /></th>
            <th><input type="password" name="pw" /></th>
          </tr>

          <tr>
            <th><input type="submit" value="Login" /> </th>
          </tr>

        </table>
      </form>
    </div>
  </div>
</body>
</html>