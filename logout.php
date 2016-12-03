<?php
session_start();
session_destroy();
header("location:http://localhost/CS4400/index.html");
?>