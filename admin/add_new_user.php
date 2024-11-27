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

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Add New User</a></div>
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
                <input type="text" class="span11" placeholder="First name" name ="firstname" />
              </div>
          </div>

          <div class="control-group">
          <label class="control-label">Last Name :</label>
            <div class="controls">
              <input type="text" class="span11" placeholder="Last name" name = "lastname" />
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Username :</label>
            <div class="controls">
            <input type="text" class="span11" placeholder="Enter Username" name = "username" />
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Password input</label>
            <div class="controls">
              <input type="password"  class="span11" placeholder="Enter Password" name = "password"  />
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Email :</label>
            <div class="controls">
             <input type="email" class="span11" placeholder="Enter Email" name = "email" />
            </div>
          </div>


          <div class="control-group">
          <label class="control-label">Role :</label>
            <div class="controls">
              <select name = "role" class="span11">
                  <option>User</option> 
                  <option>Admin</option> 
              </select>

            </div>
          </div>

          <div class="alert alert-danger" id="error" style="display:none">
              This Username is already exist. Please try another.
          </div>

          <div class="form-actions">
            <button type="submit" name="submit1" class="btn btn-success">Save</button>
          </div>

          <div class="alert alert-success" id="success" style="display:none">
              User inserted successfully!
          </div>
         
        </form>
      </div>
    </div>

    <!-- table-->
      <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $res = mysqli_query($link,"select * from user_register");
              while($row = mysqli_fetch_array($res)){
                  ?>
                  <tr>
                    <td><img src="user.png" class="me-2" alt="image" style= "width: 25px"><?php echo $row["firstname"]; ?></td>
                    <td><?php echo $row["lastname"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["role"]; ?></td>
                    <td><?php echo $row["status"]; ?></td>
                    <td><a class="badge badge-pill badge-success" href="edit_user.php?id=<?php echo $row["id"]; ?>">EDIT</a></td>
                    <td><a class="badge badge-danger" href="delete_user.php?id=<?php echo $row["id"]; ?>">DELETE</a></td>
                  </tr>
                  <?php
              }
              ?>
              </tbody>
            </table>
          </div>
    </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['submit1'])){
    $count=0;
    $res = mysqli_query($link, "select * from user_register where username='$_POST[username]'");
    $count=mysqli_num_rows($res);
        if($count>0){
            ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="none";
                document.getElementById("error").style.display="block";
            </script>
            <?php
        }
        else{
            mysqli_query($link,"insert into user_register values(NULL,'$_POST[firstname]','$_POST[lastname]', '$_POST[username]', '$_POST[password]', 'Active', '$_POST[email]', '$_POST[role]')");
            ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="block";
                document.getElementById("error").style.display="none";
                setTimeout(function(){
                    window.location.href=window.location.href;
                }, 1000);
            </script>
            <?php

        }
}
?>
<?php
include "footer.php";
?>



