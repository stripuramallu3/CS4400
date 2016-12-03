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
        <h2>Edit Profile</h2>
        <form action="editprofilebackButton.php" method="post" class="form-signin" role="form" required>
          <label>Major: </label>
          <select name="major" class="form-control" id="major">
          <?php
            include("configuration.php");
            $username = mysqli_real_escape_string($db, $_SESSION['username']);
            $query = "SELECT major_n FROM user WHERE Username='$username'";
            $output = mysqli_query($db, $query);
            $numRows = mysqli_num_rows($output);
            $row = mysqli_fetch_row($output);
            if ($numRows == 0 or is_null($row[0]) or $row[0] == "NULL" or $row[0] == NULL or $row[0] == "") {
              echo "<option selected disabled>Select A Major</option>";
              $query = "SELECT Major_Name FROM major";
              $output = mysqli_query($db, $query);
              while ($row = mysqli_fetch_row($output)) {
                echo '<option value="'.$row[0].'">'.$row[0].'</option>';
              }
            } else {
              echo '<option value="'.$row[0].'">'.$row[0].'</option>';
              $query = "SELECT Major_Name FROM major WHERE Major_Name !='$row[0]'";
              $output = mysqli_query($db, $query);
              while ($row = mysqli_fetch_row($output)) {
                echo '<option value="'.$row[0].'">'.$row[0].'</option>';
              }
            }
          ?>
          </select>
          <br \>
          <br \>
          <label>Year:</label>
          <select name="year" method="post" class="form-control" id="year" required>
          <?php
            include("configuration.php");
            $username = mysqli_real_escape_string($db, $_SESSION['username']);
            $query = "SELECT Year FROM user WHERE Username='$username'";
            $output = mysqli_query($db, $query);
            $numRows = mysqli_num_rows($output);
            $row = mysqli_fetch_row($output);
            if ($numRows == 0 or is_null($row[0]) or $row[0] == "NULL" or $row[0] == NULL or $row[0] == "") {
              echo "<option selected disabled>Select A Year</option>";
              echo '<option value="Freshmen">Freshmen</option>';
              echo '<option value="Sophomore">Sophomore</option>';
              echo '<option value="Junior">Junior</option>';
              echo '<option value="Senior">Senior</option>';
            } else {
              echo '<option value="'.$row[0].'">'.$row[0].'</option>';
              $array = array("Freshmen","Sophomore","Junior", "Senior");
              $index = array_search($row[0], $array);
              array_splice($array,$index,1);
              for ($i = 0; $i < count($array); $i++) {
                echo '<option value="'.$array[$i].'">'.$array[$i].'</option>';
              }
            }
          ?>
          </select>
          <br />
          <br />
          <label>Department:
            <?php
              include("configuration.php");
              $username = mysqli_real_escape_string($db, $_SESSION['username']);
              $query = "SELECT Dept_Name FROM major WHERE Major_Name = (SELECT major_n FROM user WHERE Username='$username')";
              $output = mysqli_query($db, $query);
              $numRows = mysqli_num_rows($output);
              $row = mysqli_fetch_row($output);
              if ($numRows == 0 or is_null($row) or $row == "NULL" or $row == NULL) {

              } else {
                echo $row[0];
              }
            ?>
          </label>
          <br />
          <br />
          <button class="btn btn-lg btn-primary btn-block">Back</button>
      </form>
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
