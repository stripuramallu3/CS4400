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
          $query = "SELECT * FROM project WHERE Pname='$name'";
          $query2 = "SELECT Cname FROM projectcategory WHERE Pname='$name'";
          $query3 = "SELECT Year, Department, Major FROM requirements WHERE Pname='$name'";
          $output = mysqli_query($db, $query);
          $output2 = mysqli_query($db, $query2);
          $output3 = mysqli_query($db, $query3);
          echo "<h2>" . $name . "</h2>";
          if ($output) {
            $row1 = mysqli_fetch_row($output);
            $advisor = $row1[3];
            $advisoremail = $row1[4];
            $string = $advisor . " (" . $advisoremail . ")";
            echo "<label>Advisor: </label><p>". $string . "</p><br />";
            $description = $row1[2];
            echo "<label>Description: </label><br /><p>". $description . "</p><br />";
            $designation = $row1[5];
            echo "<label>Designation: </label><p>". $designation . "</p><br />";
            $numStudents = $row1[0];
            echo "<label>Estimated Number of Students: </label><br /><p>". $numStudents . "</p><br />";
          }
          if ($output2) {
            $num = 1;
            while ($row2 = mysqli_fetch_row($output2)) {
              echo "<label>Category ". $num . ": </label><p>" . $row2[0] . "</p>";
              $num++;
            }
          }
          echo "<br /> <br />";
          if ($output3) {
            $num = 1;
            while ($row3 = mysqli_fetch_row($output3)) {
              echo "<label>Requirement ". $num . ":</label><p> " . $row3[0] . "</p>";
              $num++;
              if (is_null($row3[1]) || $row3[1] == '') {
                echo "<label>Requirement ". $num . ":</label><p> " . $row3[2] . "</p>";
              } else {
                echo "<label>Requirement ". $num . ":</label><p> " . $row3[1] . "</p>";
              }
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

