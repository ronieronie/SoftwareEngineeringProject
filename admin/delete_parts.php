<?php
session_start();
if(!isset($_SESSION["admin"])){
  ?>
  <script type="text/javascript">
    window.location="index.php";
  </script>
  <?php

}
?>
<?php
include "../user/connection.php";
$id=$_GET["id"];
mysqli_query($link, "delete from parts where id ='$id'");
?>
<script type ="text/javascript">
    window.location="add_new_parts.php";
</script>