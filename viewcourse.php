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
        <h2>View Course</h2>
        <?php
          include("configuration.php");
          if (isset($_GET['name'])) {
            $name = $_GET['name'];
            $name = str_replace('%20', " ", $name);
            $name = rtrim($name, "/");
          } else {
            $name = "";
          }
          $name = mysqli_real_escape_string($db, $name);
          $query = "SELECT Name, Instructor, dName, numStudents FROM course WHERE Name='$name'";
          $query2 = "SELECT Cname FROM coursecategory WHERE CourseName='$name'";
          $output = mysqli_query($db, $query);
          $output2 = mysqli_query($db, $query2);
          if ($output) {
            $row = mysqli_fetch_row($output);
            echo "<label>Course Name: " . $row[0] . "</label> <br />";
            echo "<label>Instructor: " . $row[1]  ."</label> <br />";
            echo "<label>Designation: " . $row[2] . "</label> <br />";
            echo "<label>Estimated Number of Students: " . $row[3] . "</label> <br />";
          }
          if ($output2) {
            $num = 1;
            while ($row = mysqli_fetch_row($output2)) {
              echo "<label>Category ". $num . ": " . $row[0] . "</label>";
              $num++;
            }
          }

        ?>
      </form>
      <br />
      <br />
      <a href="http://localhost/CS4400/studentpage.php"> <button style="margin-bottom:10px" class="btn btn-lg btn-primary btn-block" type="submit">Back</button></a>
    </div>
    </div>
    </div>
  </body>
</html>

