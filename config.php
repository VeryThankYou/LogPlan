<?php
$servername = "ftp.teknikfag.aze.dk";
$username = "logplan@ftp.teknikfag.aze.dk";
$password = "W.b.{XLR(4(W";
$dbname = "teknikfa_logplan";

$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>