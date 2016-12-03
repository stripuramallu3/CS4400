<?php
include("configuration.php");
if (isset($_POST['username'])) {
    $username=$_POST['username'];
} else {
    $username = "";
}

if (isset($_POST['password'])) {
    $password=$_POST['password'];
} else {
    $password = "";
}

$username = mysqli_real_escape_string($db, $username);
$password = mysqli_real_escape_string($db, $password);
$query = "SELECT Username, Password, UserType FROM user WHERE Username='$username' AND Password='$password'";
$output = mysqli_query($db, $query) or die (mysqli_error($db));
$numRows = mysqli_num_rows($output);
$rows = mysqli_fetch_row($output);

if ($numRows == 1) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $userType = $rows[2];
    $_SESSION['userType'] = $userType;
    if ($userType == "Student") {
        header("location:$redirectURLStudent");
        echo("Student Redirect");
    } else {
        header("location:$redirectURLAdmin");
        echo("Admin Redirect");
    }
} else {
    echo('
        <html>
        <head>
            <meta http-equiv="refresh" content="2;url=http://localhost/CS4400/index.html"
        </head>
        <body>
            Invalid Username or Password. Please Try Again. Refresh In 2 Second.
        </body>
        </html>
    ');
}

?>