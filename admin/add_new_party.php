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
            Add New Party</a></div>
    </div>
   
    <div class="container-fluid">
      <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Add New Party</h5>
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
          <label class="control-label">Business Name :</label>
            <div class="controls">
            <input type="text" class="span11" placeholder="Business Name" name = "businessname" />
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Contact</label>
            <div class="controls">
              <input type="text"  class="span11" placeholder="Enter Contact No" name = "contact"  />
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">Address: </label>
            <div class="controls">
                <textarea class="span11" name ="address" ></textarea>
            </div>
          </div>

          <div class="control-group">
          <label class="control-label">City</label>
            <div class="controls">
              <input type="text" class="span11" placeholder="Enter City" name ="city"/>
            </div>
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
                  <th>Business Name</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $res = mysqli_query($link,"select * from party_info");
              while($row = mysqli_fetch_array($res)){
                  ?>
                  <tr>
                    <td><?php echo $row["firstname"]; ?></td>
                    <td><?php echo $row["lastname"]; ?></td>
                    <td><?php echo $row["businessname"]; ?></td>
                    <td><?php echo $row["contact"]; ?></td>
                    <td><?php echo $row["address"]; ?></td>
                    <td><?php echo $row["City"]; ?></td>
                    <td><a href="edit_party.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
                    <td><a href="delete_party.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
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
            mysqli_query($link,"insert into party_info values(NULL, '$_POST[firstname]', '$_POST[lastname]', '$_POST[businessname]', '$_POST[contact]','$_POST[address]','$_POST[city]')") or die(mysqli_error($link));
            ?>
            <script type="text/javascript">
                document.getElementById("success").style.display="block";
                setTimeout(function(){
                    window.location.href=window.location.href;
                }, 1000);
            </script>
            <?php
}
?>
<?php
include "footer.php";
?>



