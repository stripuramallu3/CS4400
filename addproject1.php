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
          <form class="form-signin" role="form" method="post" action="addproject2.php">
            <h2 class="form-signin-heading">Add A Project</h2>
            <input type="text" name="projectName" id="projectName" class="form-control" placeholder="Project Name" required autofocus>
            <br \>
            <input type="text" name="advisor" id="advisor" class="form-control" placeholder="Advisor" required>
            <br \>
            <input type="text" name="advisorEmail" id="advisorEmail" class="form-control" placeholder="Advisor Email" required>
            <br \>
            <textarea type="text" name="description" id="description" class="form-control" placeholder="Project Description" required></textarea>
            <br \>
            <select name="designation" class="form-control" id="designation" required>
            <option selected disabled>Select A Designation</option>
            <?php
                include("configuration.php");
                $query = "SELECT Name FROM designation";
                $output = mysqli_query($db, $query) or die (mysqli_error($db));
                while ($row = mysqli_fetch_row($output)) {
                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                }
            ?>
          </select>
          <br \>
          <select name="category1" class="form-control" id="category1">
            <option selected disabled required>Select A Category</option>
            <?php
              include("configuration.php");
              $query = "SELECT Name FROM category";
              $output = mysqli_query($db, $query) or die (mysqli_error($db));
              $numRows = mysqli_num_rows($output);
              if ($numRows > 0) {
                while ($row = mysqli_fetch_row($output)) {
                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                }
              }
            ?>
          </select>
          <a style="cursor:pointer" id="addACategory" onClick="addCategory();checkCategory();">Add A Category</a>
          <br \>
          <br \>
          <input type="text" name="estimated" id="estimated" class="form-control" placeholder="Estimated Number of Students" required>
          <br \>
          <br \>
          <label>Major Requirement: </label>
          <select name="major" class="form-control" id="major">
            <option selected value="None">None</option>
            <?php
                include("configuration.php");
                $query = "SELECT Major_Name FROM major";
                $output = mysqli_query($db, $query) or die (mysqli_error($db));
                while ($row = mysqli_fetch_row($output)) {
                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                }
            ?>
          </select>
          <br \>
          <label>Year Requirement: </label>
          <select name="year" class="form-control" id="year">
            <option selected value="None">None</option>
            <option value="Freshmen">Freshmen</option>
            <option value="Sophomore">Sophomore</option>
            <option value="Junior">Junior</option>
            <option value="Senior">Senior</option>
          </select>
          <br \>
          <label>Department Requirment: </label>
          <select name="department" class="form-control" id="department">
            <option selected value="None">None</option>
            <?php
                include("configuration.php");
                $query = "SELECT Dept_Name FROM department";
                $output = mysqli_query($db, $query) or die (mysqli_error($db));
                while ($row = mysqli_fetch_row($output)) {
                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                }
            ?>
          </select>
          <br \>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
          </form>
          <br \>
          <br \>
          <a href="http://localhost/CS4400/adminpage.php"> <button class="btn btn-lg btn-primary btn-block" type="submit">Back</button></a>
        </div>
    </div>
    </div>
    <div id="footer">
      <div class="container">
        <p class="muted credit">Created By Daniel Loo, Pranav Marathe, Sreeramamurthy Tripuramallu  FALL 2016</p>
      </div>
    </div>
    <script type="text/javascript">
      var categoryNumber = 1
      function addCategory() {
        if (categoryNumber < 9) {
            var temp = 'category'+categoryNumber;
            categoryNumber++;
            $("select[" + "name=" + "'" + temp + "'"+ "]")
              .clone()
              .attr('name', 'category'+categoryNumber)
              .attr('id','category'+categoryNumber)
              .insertBefore("select[" + "name=" + "'" + temp + "'"+ "]")
        }
      }
      function checkCategory() {
        if (categoryNumber >= 9) {
            document.getElementById("addACategory").innerHTML="";
        }
      }
    </script>
  </body>
</html>