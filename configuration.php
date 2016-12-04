<?php
$username = 'root';
$password = '';
$host = 'localhost';
$database  = 'cs4400database';
$db = mysqli_connect($host, $username, $password, $database) or die ("ERROR! Could Not Establish Connection");
$redirectURLStudent = 'http://localhost/CS4400/studentpage.php';
$redirectURLAdmin = "http://localhost/CS4400/adminpage.php";
$redirectURLRegisterUser = "http://localhost/CS4400/createuser.php";

?>