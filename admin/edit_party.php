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
$id=$_GET["id"];
$firstname = "";
$lastname = "";
$businessname ="";
$contact = "";
$address = "";
$city = "";
$res = mysqli_query($link,"select * from party_info where id='$id'");
while($row=mysqli_fetch_array($res)){
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $businessname = $row["businessname"];
    $contact = $row["contact"];
    $address = $row["address"];
    $city = $row["City"];

}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Edit Party Info</a></div>
    </div>
   
    <div class="container-fluid">
      <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Edit Party Info</h5>
            </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">
              <div class="control-group">
              <label class="control-label">First Name :</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="First name" name ="firstname" value="<?php echo $firstname;?>" />
              </div>
          </div>

          <div class="control-group">
          <label class="control-label">Last Name :</label>
            <div class="controls">
              <input type="text" class="span11" placeholder="Last name" name="lastname" value="<?php echo $lastname;?>"/>
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Business Name :</label>
            <div class="controls">
            <input type="text" class="span11" placeholder="Business Name" name = "businessname" value="<?php echo $businessname;?>"/>
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Contact</label>
            <div class="controls">
              <input type="text"  class="span11" placeholder="Enter Contact No" name = "contact" value="<?php echo $contact;?>" />
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Address: </label>
            <div class="controls">
                <textarea class="span11" name ="address" ><?php echo $address;?></textarea>
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">City</label>
            <div class="controls">
              <input type="text" class="span11" placeholder="Enter City" name ="city" value="<?php echo $city;?>"/>
            </div>
          </div>

          <div class="form-actions">
            <button type="submit" name="submit1" class="btn btn-success">Update</button>
          </div>

          <div class="alert alert-success" id="success" style="display:none">
              Record Updated Successfully
          </div>
         
        </form>
      </div>
    </div>

    </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['submit1'])){  
            mysqli_query($link,"update party_info set firstname='$_POST[firstname]', lastname='$_POST[lastname]', businessname='$_POST[businessname]', contact='$_POST[contact]',address='$_POST[address]', City='$_POST[city]' where id='$id'") or die(mysqli_error($link));
            ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="block";
                setTimeout(function(){
                    window.location="add_new_party.php";
                }, 1000);
            </script>
            <?php
}
?>
<?php
include "footer.php";
?>



