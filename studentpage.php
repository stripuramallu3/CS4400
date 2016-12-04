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
          <a href = "http://localhost/CS4400/me.php"> <button class="btn btn-lg btn-primary" type="button"> <span class="glyphicon glyphicon-user" aria-hidden="true"> </span>
          </button>
        </a>
        <div> <a href = "http://localhost/CS4400/logout.php" style:"line-height:2.0" style="float:right">Logout</a> </div>
        <h2>Main Page</h2>
        <form class="form-signin" role="form" method="get" action="applyfilter.php">
          <input type="text" name="title" id="title" class="form-control" maxlength="255" placeholder="Title"> </input>
          <br />
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
          <br />
          <br />
          <select name="designation" class="form-control" id="designation">
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
          <select name="major" class="form-control" id="major">
            <option selected disabled>Select a Major </option>
            <?php
                include("configuration.php");
                $query = "SELECT Major_Name FROM major";
                $output = mysqli_query($db, $query) or die (mysqli_error($db));
                while ($row = mysqli_fetch_row($output)) {
                    echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                }
            ?>
          </select>
          <select name="year" class="form-control" id="year">
            <option selected disabled>Select a Year </option>
            <option value="Freshmen">Freshmen</option>
            <option value="Sophomore">Sophomore</option>
            <option value="Junior">Junior</option>
            <option value="Senior">Senior</option>
          </select>
          <br />
          <br />

          <input type="checkbox" name="project" id="projectRadio">Project</input>
          <br \>
          <input type="checkbox" name="course" id="courseRadio">Course</input>
          <br />
          <br />
          <button style="margin-bottom:10px" class="btn btn-lg btn-primary btn-block" type="submit">Apply Filter</button>
      </form>
      <form action="studentpage.php">
        <button style="margin-bottom:10px" class="btn btn-lg btn-primary btn-block" type="submit">Reset Filter</button>
      </form>
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

