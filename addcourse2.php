<?php
    include("configuration.php");
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location:http://localhost/CS4400/index.hmtl");
        die("Unfortuently You Are Not Logged In");
    }
    if ($_SESSION['userType'] != "Admin") {
        header("location:http://localhost/CS4400/studentpage.php");
    }
    function setValue($var, $db) {
        if (!isset($_POST[$var])) {
          return mysqli_real_escape_string($db, "");
        } else {
          return mysqli_real_escape_string($db, $_POST[$var]);
        }
    }
    $username = mysqli_real_escape_string($db, $_SESSION['username']);
    $courseNumber = setValue("courseNumber", $db);
    $courseName = setValue("courseName", $db);
    $instructor = setValue("instructorName", $db);
    $estimated = setValue("estimated", $db);
    $designation = setValue("designation", $db);
    $category1 = setValue("category1", $db);
    $category2 = setValue("category2", $db);
    $category3 = setValue("category3", $db);
    $category4 = setValue("category4", $db);
    $category5 = setValue("category5", $db);
    $category6 = setValue("category6", $db);
    $category7 = setValue("category7", $db);
    $category8 = setValue("category8", $db);
    $category9 = setValue("category9", $db);
    $query = "INSERT INTO Course (CRN, Name, Instructor, numStudents, dName) VALUES ('$courseNumber', '$courseName', '$instructor', '$estimated', '$designation')";
    $output = mysqli_query($db, $query);
    $array = array($category1, $category2, $category3, $category4, $category5, $category6, $category7, $category8, $category9);
    for ($i = 0; $i < count($array); $i++) {
        if ($array[i] != NULL and $array[i] != "" ) {
            $query = "INSERT INTO coursecategory (CourseName, Cname) VALUES ('$courseName', '$array[i]')";
            $output = mysqli_query($db, $query);
        }
    }
    header("location:http://localhost/CS4400/addcourse1.php");
?>
