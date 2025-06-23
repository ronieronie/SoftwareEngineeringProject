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
include "header.php";
include "../user/connection.php";
$id = $_GET["id"];
$motorparts = "";
$company = "";

$res = mysqli_query($link, "select * from parts where id = '$id'");
while($row=mysqli_fetch_array($res)){
    $motorparts= $row["parts"];
    $company = $row["company_name"];
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Edit Motor Parts</a></div>
    </div>
   
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Edit Parts</h5>
            </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">
              <div class="control-group">
              <label class="control-label">Suppliers Name :</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="Company Name" name ="motorparts" value = "<?php echo $company; ?>" readonly/>
              </div>
          </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">
              <div class="control-group">
              <label class="control-label">Motor Parts :</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="Company Name" name ="motorparts" value = "<?php echo $motorparts; ?>"/>
              </div>
          </div>

          <div class="form-actions">
            <button type="submit" name="submit1" class="btn btn-success">Update</button>
          </div>

          <div class="alert alert-success" id="success" style="display:none">
              Motor Parts Updated Successfully!
          </div>
         
        </form>
      </div>
    </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['submit1'])){
    mysqli_query($link, "update parts set parts='$_POST[motorparts]' where id='$id'") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
        setTimeout(function(){
            window.location="add_new_parts.php";
        }, 1000);
    </script>
    <?php
}
?>
<?php
include "footer.php";
?>



 