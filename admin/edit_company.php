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
$companyname = "";

$res = mysqli_query($link, "select * from company_name where id = '$id'");
while($row=mysqli_fetch_array($res)){
    $companyname= $row["company_name"];
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Edit Company</a></div>
    </div>
   
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Edit Company</h5>
            </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">
              <div class="control-group">
              <label class="control-label">Suppliers Name :</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="Enter Suppliers Name" name ="companyname" value = "<?php echo $companyname; ?>"/>
              </div>
          </div>

          <div class="form-actions">
            <button type="submit" name="submit1" class="btn btn-success">Update</button>
          </div>

          <div class="alert alert-success" id="success" style="display:none">
              Record Updated Successfully!
          </div>
         
        </form>
      </div>
    </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['submit1'])){
    mysqli_query($link, "update company_name set company_name='$_POST[companyname]' where id=$id") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
        setTimeout(function(){
            window.location="add_new_company.php";
        }, 1000);
    </script>
    <?php
}
?>
<?php
include "footer.php";
?>



 