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
          function setValue($var) {
            if (!isset($_GET[$var])) {
              return mysqli_real_escape_string($db, "");
            } else {
              return mysqli_real_escape_string($db, $_GET[$var]);
            }
          }
          $title = setValue("title");
          $category1 = setValue("category1");
          $category2 = setValue("category2");
          $category3 = setValue("category3");
          $category4 = setValue("category4");
          $category5 = setValue("category5");
          $category6 = setValue("category6");
          $category7 = setValue("category7");
          $category8 = setValue("category8");
          $category9 = setValue("category9");
          $designation = setValue("designation");
          $major = setValue("major");
          $year = setValue("year");
          $project = setValue("project");
          $course = setValue("course");
          $query1 = "";
          $query2 = "";
          if ($project == "on") {
            $query1 = "SELECT Pname FROM  "
          }
          $query = "SELECT Pname FROM "
        ?>
      </form>
      <a href="http://localhost/CS4400/studentpage.php"> <button style="margin-bottom:10px" class="btn btn-lg btn-primary btn-block" type="submit">Back</button></a>
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

