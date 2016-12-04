<?php
    include("configuration.php");
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location:http://localhost/CS4400/index.hmtl");
        die("Unfortuently You Are Not Logged In");
    }
    if ($_SESSION['userType'] != "Student") {
        header("location:http://localhost/CS4400/adminpage.php");
    }
    if (isset($_GET['gtemail'])) {
        $email = $_GET['gtemail'];
    } else {
        $email = '';
    }
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
    } else {
        $name = '';
    }
    $email = mysqli_real_escape_string($db, $email);
    $name = mysqli_real_escape_string($db, $name);
    $query = "UPDATE apply SET Status = 'Rejected' WHERE GTemail = '$email' AND Pname = '$name'";
    $output = mysqli_query($db, $query);
    header("location:http://localhost/CS4400/viewapplication1.php");
?>