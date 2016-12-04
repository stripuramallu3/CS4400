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
          <form class="form-signin" role="form" method="post">
          <h2>Application</h2>
          <table class="table table-striped table-bordered">
           <tr>
             <th>Project Name</th>
             <th>Applicant Major</th>
             <th>Applicant Year</th>
             <th>Status</th>
             <th></th>
             <th></th>
           </tr>
          <?php
            include("configuration.php");
            $table = "SELECT Pname, major_n, Year, Status, GTemail FROM (apply INNER JOIN user ON apply.GTemail = user.GT_email)";
            $output = mysqli_query($db, $table);
            if ($output) {
              while ($row = mysqli_fetch_row($output)) {
                if ($row[3] != "Pending") {
                  echo "<td>". $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>". $row[3] . "</td><td> </td> <td> </td></tr>";
                } else {
                  echo "<td>". $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>". $row[3] . "</td><td> <a href='http://localhost/CS4400/viewapplication2.php?gtemail=" . $row[4] . "&name=" . $row[0] ."'> Accept </a></td> <td> <a href='http://localhost/CS4400/viewapplication3.php?gtemail=" . $row[4] ."&name=" .$row[0] ."''>Reject</a></td></tr>";
                }
              }
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
  </body>
</html>