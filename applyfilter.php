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
?>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=3">
    <title>Georgia Tech System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/studentpage.css" rel="stylesheet">
  </head>
  <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <div id="wrap">
     <div class="container">
        <div id="content">
        <h2>Search Page</h2>
        <?php
          function setValue($var, $db) {
            if (!isset($_GET[$var])) {
              return mysqli_real_escape_string($db, "");
            } else {
              return mysqli_real_escape_string($db, $_GET[$var]);
            }
          }
          function set($var) {
              if (!isset($_GET[$var])) {
                  return "";
              } else {
                  return $_GET[$var];
              }
          }
          $title = setValue("title", $db);
          $tempTile = set("title");
          $category1 = setValue("category1", $db);
          $category2 = setValue("category2", $db);
          $category3 = setValue("category3", $db);
          $category4 = setValue("category4", $db);
          $category5 = setValue("category5", $db);
          $category6 = setValue("category6", $db);
          $category7 = setValue("category7", $db);
          $category8 = setValue("category8", $db);
          $category9 = setValue("category9", $db);
          $tempcategory1 = set("category1");
          $tempcategory2 = set("category2");
          $tempcategory3 = set("category3");
          $tempcategory4 = set("category4");
          $tempcategory5 = set("category5");
          $tempcategory6 = set("category6");
          $tempcategory7 = set("category7");
          $tempcategory8 = set("category8");
          $tempcategory9 = set("category9");
          $designation = setValue("designation", $db);
          $tempDesignation = set("designation");
          $major = setValue("major", $db);
          $tempMajor = set("major");
          $year = setValue("year", $db);
          $tempYear = set("year");
          $project = setValue("project", $db);
          $tempProject = set("project");
          $course = setValue("course", $db);
          $tempCourse = set("project");
          $query =  "SELECT DISTINCT Pname FROM (project NATURAL JOIN requirements NATURAL JOIN projectcategory) WHERE Pname LIKE '%" . "$title" . "%' ";
          if ($tempcategory1 != "") {
            $query = $query . "AND (Cname = '$category1' ";
          }
          if ($tempcategory2 != "") {
            $query = $query . "OR Cname = '$category2' ";
          }
          if ($tempcategory3 != "") {
            $query = $query . "OR Cname = '$category3' ";
          }
          if ($tempcategory4 != "") {
            $query = $query . "OR Cname = '$category4' ";
          }
          if ($tempcategory5 != "") {
            $query = $query . "OR Cname = '$category5' ";
          }
          if ($tempcategory6 != "") {
            $query = $query . "OR Cname = '$category6' ";
          }
          if ($tempcategory7 != "") {
            $query = $query . "OR Cname = '$category7' ";
          }
          if ($tempcategory8 != "") {
            $query = $query . "OR Cname = '$category8' ";
          }
          if ($tempcategory9 != "") {
            $query = $query . "OR Cname = '$category9' ";
          }
          if ($tempcategory1 != "") {
            $query = $query . ") ";
          }
          if ($tempDesignation != "") {
            $query = $query . "AND dName = '$designation' ";
          }
          if ($tempMajor != "") {
            $query = $query . "AND Major = '$major' ";
          }
          if ($tempYear != "") {
            $query = $query . "AND Year = '$year' ";
          }
          $output1 = mysqli_query($db, $query);
          $query2 = "SELECT DISTINCT Name FROM (course INNER JOIN coursecategory ON course.Name = coursecategory.CourseName) WHERE Name LIKE '%" . "$title" . "%' OR CRN LIKE '%" . "$title" . "%' ";
          if ($tempcategory1 != "") {
            $query2 = $query2 . "AND (Cname = '$category1' ";
          }
          if ($tempcategory2 != "") {
            $query2 = $query2 . "OR Cname = '$category2' ";
          }
          if ($tempcategory3 != "") {
            $query2 = $query2 . "OR Cname = '$category3' ";
          }
          if ($tempcategory4 != "") {
            $query2 = $query2 . "OR Cname = '$category4' ";
          }
          if ($tempcategory5 != "") {
            $query2 = $query2 . "OR Cname = '$category5' ";
          }
          if ($tempcategory6 != "") {
            $query2 = $query2 . "OR Cname = '$category6' ";
          }
          if ($tempcategory7 != "") {
            $query2 = $query2 . "OR Cname = '$category7' ";
          }
          if ($tempcategory8 != "") {
            $query2 = $query2 . "OR Cname = '$category8' ";
          }
          if ($tempcategory9 != "") {
            $query2 = $query2 . "OR Cname = '$category9' ";
          }
          if ($tempcategory1 != "") {
            $query2 = $query2 . ") ";
          }
          if ($tempDesignation != "") {
            $query2 = $query2 . "AND dName = '$designation' ";
          }
          $output2 = mysqli_query($db, $query2);
          echo "<table class='table table-striped table-bordered'>
           <tr>
             <th>Name</th>
             <th>Type</th>
           </tr>";
          if ($project) {
            if ($output1) {
              while ($row = mysqli_fetch_row($output1)) {
                $temp = $row[0];
                $temp = str_replace(' ', '%20', $temp);
                echo "<tr><td>" . "<a href=http://localhost/CS4400/viewproject.php?name=" . $temp . "/>" . $row[0] ."</td><td>Project</td></tr>";
              }
            }
          }
          if ($course) {
            if ($output2) {
              while ($row = mysqli_fetch_row($output2)) {
                $temp = $row[0];
                $temp = str_replace(' ', '%20', $temp);
                echo "<tr><td>" . "<a href=http://localhost/CS4400/viewcourse.php?name=" . $temp . "/>" . $row[0] ."</td><td>Course</td></tr>";
              }
            }
          }
        ?>
      </form>
      <a href="http://localhost/CS4400/studentpage.php"> <button style="margin-bottom:10px" class="btn btn-lg btn-primary btn-block" type="submit">Back</button></a>
    </div>
    </div>
    </div>
  </body>
</html>

