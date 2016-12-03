<?php
include("configuration.php");
if (isset($_POST['username'])) {
    $username=$_POST['username'];
} else {
        echo('
        <html>
        <head>
            <meta http-equiv="refresh" content="2;url=http://localhost/CS4400/createuser.html"
        </head>
        <body>
            Invalid Username. Please Try Again. Refresh In 2 Second.
        </body>
        </html>
    ');
}

if (isset($_POST['password']) && isset($_POST['confirmPassword']) && ($_POST['password'] == $_POST['confirmPassword'])) {
    $password=$_POST['password'];
} else {
    echo('
        <html>
        <head>
            <meta http-equiv="refresh" content="2;url=http://localhost/CS4400/createuser.html"
        </head>
        <body>
            Invalid Password or Passwords Do Not Match. Please Try Again. Refresh In 2 Second.
        </body>
        </html>
    ');
}


if (isset($_POST['gtEmail'])) {
    $gtEmail=$_POST['gtEmail'];
} else {
    echo('
        <html>
        <head>
            <meta http-equiv="refresh" content="2;url=http://localhost/CS4400/createuser.html"
        </head>
        <body>
            Invalid GTEmail. Please Try Again. Refresh In 2 Second.
        </body>
        </html>
    ');
}

if (isset($_POST['userType'])) {
    $userType=$_POST['userType'];
} else {
    echo('
        <html>
        <head>
            <meta http-equiv="refresh" content="2;url=http://localhost/CS4400/createuser.html"
        </head>
        <body>
            Invalid User Type. Please Try Again. Refresh In 2 Second.
        </body>
        </html>
    ');
}


$tempUserType = $userType;
$tempUsername = $username;
$tempPassword = $password;

$username = mysqli_real_escape_string($db, $username);
$password = mysqli_real_escape_string($db, $password);
$gtEmail = mysqli_real_escape_string($db, $gtEmail);
$userType = mysqli_real_escape_string($db, $userType);


$query = "SELECT * FROM user";
$output = mysqli_query($db, $query) or die (mysqli_error($db));
$numRowsOriginal = mysqli_num_rows($output);

$query = "SELECT * FROM user WHERE username = '$username' OR email = 'gtEmail'";
$output = mysqli_query($db, $query);

if ($output == false) {
    $query = "INSERT INTO user (Username, major_n, GT_email, Password, Year, UserType) VALUES ('$username', 'NULL', '$gtEmail', '$password', 'NULL', 'Student')";
    $output = mysqli_query($db, $query) or die ('
            <html>
            <head>
                <meta http-equiv="refresh" content="2;url=http://localhost/CS4400/createuser.html"
            </head>
            <body>
                Username or GT Email Already Exists. Please Try Again.
            </body>
            </html>
        ');

    $query = "SELECT * FROM user";
    $output = mysqli_query($db, $query) or die (mysqli_error($db));
    $numRowsNew = mysqli_num_rows($output);


    if (($numRowsNew - $numRowsOriginal) == 1) {
        session_start();
        $_SESSION['username'] = $tempUsername;
        $_SESSION['password'] = $tempPassword;
        $_SESSION['userType'] = $tempUserType;
        echo('
            <html>
            <head>
                <meta http-equiv="refresh" content="2;url=http://localhost/CS4400/studentpage.html"
            </head>
            <body>
                Refresh
            </body>
            </html>
        ');
    }
} else {
    echo('
        <html>
        <head>
            <meta http-equiv="refresh" content="2;url=http://localhost/CS4400/createuser.html"
        </head>
        <body>
            Username or GTEmail Already Exists.
        </body>
        </html>
    ');

}



?>