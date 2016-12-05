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
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        $name = str_replace('%20', ' ', $name);
    } else {
        $name = '';
    }
    $username = mysqli_real_escape_string($db, $_SESSION['username']);
    $query = "SELECT major_n, Year FROM user WHERE Username='$username'";
    $output = mysqli_query($db, $query);
    if ($output) {
        $row = mysqli_fetch_row($output);
        $major = $row[0];
        $year = $row[1];
        if (is_null($major) or $major == "" or is_null($year) or $year == "") {
          echo('
                <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=http://localhost/CS4400/createuser.html"
                </head>
                <body>
                    Please Enter Major/Year Before Apply to Projects. Refresh in 5 Seconds.
                </body>
                </html>
            ');
        }
    }
    if ($output) {
        $tempname = $name;
        $name = mysqli_real_escape_string($db, $name);
        $username = mysqli_real_escape_string($db, $_SESSION['username']);
        $query1 = "SELECT major_n, Year, GT_email FROM user WHERE Username='$username' ";
        $output1 = mysqli_query($db, $query1);
        $majortemp = "";
        $yeartemp = "";
        $email = "";
        $majorProj = "";
        $yearProj = "";
        $deptProj = "";
        $dept = "";
        $tempemail = "";
        if ($output1) {
            $row = mysqli_fetch_row($output1);
            $majortemp = $row[0];
            $yeartemp = $row[1];
            $email = $row[2];
            $tempemail = $row[2];
            $email = mysqli_real_escape_string($db, $email);
            $major = mysqli_real_escape_string($db, $row[0]);
            $year = mysqli_real_escape_string($db, $row[1]);
            $query2 = "SELECT Dept_Name FROM major WHERE Major_Name = '$major'";
            $output2 = mysqli_query($db, $query2);
            $row = mysqli_fetch_row($output2);
            $dept = $row[0];
        }
        $query3 = "SELECT Major, Year, Department FROM requirements WHERE Pname = '$name'";
        $output3 = mysqli_query($db, $query3);
        if ($output3) {
            $row = mysqli_fetch_row($output3);
            $majorProj = $row[0];
            $yearProj = $row[1];
            $deptProj = $row[2];

        }
        $in = false;
        $query = "SELECT Pname, GTemail FROM apply";
        $output = mysqli_query($db, $query);
        if ($output) {
            while ($row = mysqli_fetch_row($output)) {
                if ($row[0] == $tempname and $row[1] == $tempemail) {
                    $in = true;
                }
            }
        }

        if ((!$in) AND ($majorProj == $majortemp OR $majorProj == "") AND ($yearProj == $yeartemp OR $yearProj == "") AND ($deptProj == $dept OR $deptProj == "")) {
            $today = date("Y-m-d");
            $today = mysqli_real_escape_string($db, $today);
            $query = "INSERT INTO apply (Date, Status, GTemail, Pname) VALUES ('$today', 'Pending', '$email', '$name')";
            $output = mysqli_query($db, $query);
            echo('
                <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=http://localhost/CS4400/studentpage.php"
                </head>
                <body>
                    Successfully Applied. Application is Now Pending. Refresh in 5 Seconds.
                </body>
                </html>
            ');
        } else {
            echo('
                <html>
                <head>
                    <meta http-equiv="refresh" content="5;url=http://localhost/CS4400/studentpage.php"
                </head>
                <body>
                    You are Not Qualified for this Project Or Have Already Applied to this Project. Refresh in 5 Seconds.
                </body>
                </html>
            ');
        }

    }

?>