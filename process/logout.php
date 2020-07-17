<?php
session_start();
session_destroy();
// echo "hello";
 header("location:../views/index.php");
?>