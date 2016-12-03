<?php
    session_start();
    include("configuration.php");
    if (isset($_POST['major'])) {
        $major=$_POST['major'];
    } else {
        $major = NULL;
    }
    if (isset($_POST['year'])) {
        $year=$_POST['year'];
    } else {
        $year = NULL;
    }
    $username = mysqli_real_escape_string($db, $_SESSION['username']);
    $tempMajor = mysqli_real_escape_string($db, $major);
    $tempYear = mysqli_real_escape_string($db, $year);
    $query = "UPDATE user SET major_n = '$tempMajor', Year = '$tempYear' WHERE Username = '$username'";
    $output = mysqli_query($db, $query);
    $_SESSION['major'] = $major;
    $_SESSION['year'] = $year;
    header("location:http://localhost/CS4400/me.php");

?>