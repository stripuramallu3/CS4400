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
          <h2>Choose Functionality</h2>
          <br \>
          <br \>
          <form class="form-signin" role="form" method="post">
            <a href="http://localhost/CS4400/viewapplications1.php" style="cursor:pointer" align:"center">View Applications</a>
            <br \>
            <a href="http://localhost/CS4400/popularprojectreport.php" style="cursor:pointer" align:"center">View Popular Project Report</a>
            <br \>
            <a href="http://localhost/CS4400/applicationreport.php" style="cursor:pointer" align:"center">View Application Report</a>
            <br \>
            <a href="http://localhost/CS4400/addproject1.php" style="cursor:pointer" align:"center">Add Project</a>
            <br \>
            <a href="http://localhost/CS4400/addcourse1.php" style="cursor:pointer" align:"center">Add Course</a>
            <br \>
          </form>
          <br \>
          <br \>
          <a href="http://localhost/CS4400/logout.php"><button class="btn btn-lg btn-primary btn-block" type="submit">Log Out</button></a>
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