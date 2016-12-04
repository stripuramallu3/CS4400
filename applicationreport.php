<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location:http://localhost/CS4400/index.hmtl");
        die("Unfortuently You Are Not Logged In");
    }
    if ($_SESSION['userType'] != "Admin") {
        header("location:http://localhost/CS4400/studentpage.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=3">
    <title>Georgia Tech System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/studentpage.css" rel="stylesheet">
  </head>
  <body>
    <script src="js/bootstrap.min.js"></script>
    <div id="wrap">
     <div class="container">
        <div id="content">
          <form>
          <h2>Application Report</h2>
          <label>Total Number of Applications:
            <?php
              include("configuration.php");
              $query = "SELECT * FROM apply";
              $output = mysqli_query($db, $query);
              $count = 0;
              while ($row = mysqli_fetch_row($output)) {
                $count = $count + 1;
              }
              echo (string)$count;
            ?>
          </label>
          <br \>
          <label>Total Number of Accepted Applications:
            <?php
              include("configuration.php");
              $query = "SELECT * FROM apply WHERE Status = 'Accepted'";
              $output = mysqli_query($db, $query);
              $count = 0;
              while ($row = mysqli_fetch_row($output)) {
                $count = $count + 1;
              }
              echo (string)$count;
            ?>
          </label>
          <table class="table table-striped table-bordered">
           <tr>
             <th>Project Name</th>
             <th>Number of Applicants</th>
             <th>Acceptance Rate</th>
             <th>Top 3 Majors</th>
           </tr>
          <?php
            include("configuration.php");
            $projectNames = "SELECT Pname FROM project ORDER BY Pname";
            $output = mysqli_query($db, $projectNames);
            $projectNames = array();
            $count = 0;
            while ($row = mysqli_fetch_row($output)) {
              array_push($projectNames, $row[0]);
              $count = $count + 1;
            }
            $numApplicants = "SELECT Pname, COUNT(*) FROM apply GROUP BY Pname ORDER BY Pname";
            $output = mysqli_query($db, $numApplicants);
            $numApplicants = array();
            while ($row = mysqli_fetch_row($output)) {
              $numApplicants[$row[0]] = $row[1];
            }
            $accepted = "SELECT Pname, Count(*) FROM apply WHERE Status = 'Accepted' GROUP BY Pname ORDER BY Pname";
            $output = mysqli_query($db, $accepted);
            $accepted = array();
            while ($row = mysqli_fetch_row($output)) {
              $accepted[$row[0]] = $row[1];
            }
            $topMajor = "SELECT * FROM (SELECT Pname ,COUNT(*) AS 'numMajors', major_n FROM (SELECT major_n, Pname FROM User INNER JOIN apply ON user.GT_email = apply.GTemail) AS table1 GROUP BY major_n ORDER BY 'Pname, numMajors') AS table2";
            $output = mysqli_query($db, $topMajor);
            $topMajor = array();
            $numCount = 0;
            $tempPname = "";
            while ($row = mysqli_fetch_row($output)) {
              if ($numCount == 0) {
                $tempPname = $row[0];
                $topMajor[$row[0]] = $row[2];
                $numCount++;
              } else if ($numCount < 3 && $row[0] == $tempPname) {
                  $topMajor[$row[0]] =  $row[2] . ", " . $topMajor[$row[0]];
                  $numCount++;
              } else if ($row[0] == $Pname) {
                  $numCount++;
              } else {
                  $numCount = 1;
                  $topMajor[$row[0]] = $row[2];
                  $tempPname = $row[0];
              }
            }
            for ($i = 0; $i < $count; $i++) {
              if (array_key_exists($projectNames[$i], $numApplicants)) {
                $tempNumApplicants = $numApplicants[$projectNames[$i]];
              } else {
                $tempNumApplicants = 0;
              }
              if (array_key_exists($projectNames[$i], $accepted)) {
                $tempAccepted = $accepted[$projectNames[$i]];
              } else {
                $tempAccepted = 0;
              }
              if ($tempNumApplicants == 0) {
                $tempRate = 0;
              } else {
                $tempRate = ($tempAccepted/$tempNumApplicants) * 100;
              }
              if (array_key_exists($projectNames[$i], $topMajor)) {
                $tempTopMajor = $topMajor[$projectNames[$i]];
              } else {
                $tempTopMajor = "None";
              }

               echo "<tr><td>". $projectNames[$i] . "</td><td>" . $tempNumApplicants . "</td><td>" . $tempRate . "%" .  "</td><td>" . $tempTopMajor . "</tr>";
            }
          ?>
          </table>
          </form>
          <br \>
          <br \>
          <br \>
          <br \>
          <a href="http://localhost/CS4400/adminpage.php"><button class="btn btn-lg btn-primary btn-block" type="submit">Back</button></a>
        </div>
    </div>
    </div>
    <div id="footer">
      <div class="container">
        <p class="muted credit">Created By Daniel Loo, Pranav Marathe, Sreeramamurthy Tripuramallu  FALL 2016</p>
      </div>
    </div>
  </body>
</html>