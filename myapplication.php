<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location:http://localhost/CS4400/index.hmtl");
        die("Unfortuently You Are Not Logged In");
    }
    if ($_SESSION['userType'] != "Student") {
        header("location:http://localhost/CS4400/adminpage.php");
    }
?>
<!DOCTYPE html>
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
    <script src="js/signin.js"></script>
    <div id="wrap">
     <div class="container">
        <div id="content">
        <h2>My Application</h2>
          <table class="table table-striped table-bordered">
           <tr>
             <th>Date</th>
             <th>Project Name</th>
             <th>Status</th>
           </tr>
          <?php
            include("configuration.php");
            $username = mysqli_real_escape_string($db, $_SESSION['username']);
            $query = "SELECT Date, Pname, Status FROM Apply WHERE GTemail = (SELECT GT_email FROM user WHERE Username = '$username') ORDER BY Date";
            $output = mysqli_query($db, $query);
            if ($output) {
              while ($row = mysqli_fetch_row($output)) {
                echo "<tr><td>". $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</tr>";
              }
            }
          ?>
          </table>
          <a href="http://localhost/CS4400/me.php"> <button class="btn btn-lg btn-primary btn-block" type="submit">Back</button> </a>
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