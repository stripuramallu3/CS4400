<?php
  function categoryOptions() {
    include("configuration.php");
    $query = "SELECT * FROM category";
    $output = mysqli_query($db, $query) or echo(mysqli_error($db));
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0) {
      $temp = "";
      $tempRow = "";
      while($row = mysqli_fetch_row($output)) {
        $tempRow = $tempRow . $row['Name'];
        $temp = $temp . sprintf("<option value=%s>$s</option>", $row['Name'], $row['Name']);
      }
      return $temp;
    }
  }
?>