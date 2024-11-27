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
$firstname = "";
$lastname = "";
$username = "";
$password = "";
$email = "";
$status = "";
$role = "";
$res = mysqli_query($link, "select * from user_register where id = '$id'");
while($row=mysqli_fetch_array($res)){
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $username = $row["username"];
    $password = $row["password"];
    $email = $row["email"];
    $status = $row["status"];
    $role = $row["role"];  
}
?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Edit User</a></div>
    </div>
   
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Add New User</h5>
            </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">
              <div class="control-group">
              <label class="control-label">First Name :</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="First name" name ="firstname" value = "<?php echo $firstname; ?>"/>
              </div>
          </div>

          <div class="control-group">
          <label class="control-label">Last Name :</label>
            <div class="controls">
              <input type="text" class="span11" placeholder="Last name" name = "lastname" value = "<?php echo $lastname; ?>" />
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Username :</label>
            <div class="controls">
            <input type="text" class="span11" placeholder="Enter Username" name = "username" value = "<?php echo $username; ?>"readonly />
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Password input</label>
            <div class="controls">
              <input type="password"  class="span11" placeholder="Enter Password" name = "password" value = "<?php echo $password; ?>"  />
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Email :</label>
            <div class="controls">
             <input type="email" class="span11" placeholder="Enter Email" name = "email" value = "<?php echo $email; ?>"/>
            </div>
          </div>


          <div class="control-group">
          <label class="control-label">Role :</label>
            <div class="controls">
              <select name = "role" class="span11">
                  <option <?php if($role=="User"){ echo "selected"; }?>>User</option> 
                  <option <?php if($role=="Admin"){ echo "selected"; }?>>Admin</option> 
              </select>
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Status :</label>
            <div class="controls">
              <select name = "status">
                  <option <?php if($status=="Active"){ echo "selected"; }?>>Active</option> 
                  <option <?php if($status=="Inactive"){ echo "selected"; }?>>Inactive</option> 
              </select>

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
    mysqli_query($link, "update user_register set firstname='$_POST[firstname]', lastname='$_POST[lastname]', password='$_POST[password]', status='$_POST[status]',email='$_POST[email]', role='$_POST[role]' where id='$id'") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
        setTimeout(function(){
            window.location="add_new_user.php";
        }, 1000);
    </script>
    <?php
}
?>
<?php
include "footer.php";
?>



 