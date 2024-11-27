<?php
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"inventory") or die(mysqli_error($link));
?>