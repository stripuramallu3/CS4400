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
          <h2>Popular Project</h2>
          <table class="table table-striped table-bordered">
           <tr>
             <th>Project Name</th>
             <th>Number of Applicants</th>
           </tr>
          <?php
            include("configuration.php");
            $numApplicants = "SELECT Pname, COUNT(*) AS count FROM apply GROUP BY Pname ORDER BY count LIMIT 10";
            $output = mysqli_query($db, $numApplicants);
            $projectName = array();
            $numApplicants = array();
            $count = 0;
            while ($row = mysqli_fetch_row($output)) {
              array_push($projectName, $row[0]);
              array_push($numApplicants, $row[1]);
              $count++;
            }
            for ($i = 0; $i < $count; $i++) {
              echo "<tr><td>". $projectName[$i] . "</td><td>" . $numApplicants[$i] . "</tr>";
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