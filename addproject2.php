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
        } elseif (isset($_POST[$var]) == "") {
            return mysqli_real_escape_string($db, "");
        } else {
          return mysqli_real_escape_string($db, $_POST[$var]);
        }
    }
    function set($var, $db) {
        if (!isset($_POST[$var])) {
            return "";
        } else {
            return $_POST[$var];
        }
    }
    $projectName = setValue("projectName", $db);
    $advisor = setValue("advisor", $db);
    $advisorEmail = setValue("advisorEmail", $db);
    $description = setValue("description", $db);
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
    $estimated = setValue("estimated", $db);
    $tempcategory1 = set("category1", $db);
    $tempcategory2 = set("category2", $db);
    $tempcategory3 = set("category3", $db);
    $tempcategory4 = set("category4", $db);
    $tempcategory5 = set("category5", $db);
    $tempcategory6 = set("category6", $db);
    $tempcategory7 = set("category7", $db);
    $tempcategory8 = set("category8", $db);
    $tempcategory9 = set("category9", $db);
    $major = setValue("major", $db);
    $tempmajor = set("major", $db);
    $year = setValue("year", $db);
    $tempyear = set("year", $db);
    $department = setValue("department", $db);
    $tempdepartment = setValue("department", $db);
    $query = "INSERT INTO project (numStudents, Pname, Description, aname, aemail, dName) VALUES ('$estimated', '$projectName', '$description', '$advisor', '$advisorEmail', '$designation')";
    $output = mysqli_query($db, $query);
    $array = array($category1, $category2, $category3, $category4, $category5, $category6, $category7, $category8, $category9);
    $array2 = array($tempcategory1, $tempcategory2, $tempcategory3, $tempcategory4, $tempcategory5, $tempcategory6, $tempcategory7, $tempcategory8, $tempcategory9);
    for ($i = 0; $i < count($array); $i++) {
        if ($array2[$i] != "" ) {
            $var = $array[$i];
            $query = "INSERT INTO projectcategory (Pname, Cname) VALUES ('$projectName', '$var')";
            $output = mysqli_query($db, $query);
        }
    }
    $query = "INSERT INTO requirements (Pname, Major, Department, Year) VALUES ('$projectName','$major', '$department', '$year')";
    $output = mysqli_query($db, $query);
    header("location:http://localhost/CS4400/addproject1.php");
?>