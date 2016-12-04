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
          <form class="form-signin" role="form" method="get" action="addcourse2.php">
            <h2 class="form-signin-heading">Add A Course</h2>
            <input type="text" name="cousreNumber" id="courseNumber" class="form-control" placeholder="Course Number" required autofocus>
            <br \>
            <input type="text" name="courseName" id="courseName" class="form-control" placeholder="Course Name" required>
            <br \>
            <input type="text" name="instructorName" id="instructorName" class="form-control" placeholder="Instructor" required>
            <br \>
            <input type="text" name="estimated" id="estimated" class="form-control" placeholder="Estimated Number of Students" required>
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
            <option selected disabled>Select A Category</option>
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
          <a href="http://localhost/CS4400/addcourse2.php"><button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button> </a>
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