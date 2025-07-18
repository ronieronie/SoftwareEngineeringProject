<?php
session_start();
if(!isset($_SESSION["admin"])){
  ?>
  <script type="text/javascript">
    window.location="index.php";
  </script>
  <?php

}
include "header.php";
include "../user/connection.php";
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Add New Motor Parts</a></div>
    </div>
   
    <div class="container-fluid">
      <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Add New Motor Parts</h5>
            </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">
              <div class="control-group">
              <label class="control-label">Motor Parts :</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="Enter Motor Parts" name ="motorparts" />
              </div>
          </div>

          <div class="control-group">
            <label class="control-label">Select Suppliers :</label>
                <div class="controls">
                <select class="span11" name ="company_name">
                    <?php
                    $res=mysqli_query($link, "select * from company_name");
                    while($row=mysqli_fetch_array($res)){
                        echo "<option>";
                        echo $row["company_name"];
                        echo "</option>";
                    }
                    ?>
                </select>
                </div>
            </div>


          <div class="alert alert-danger" id="error" style="display:none">
              This Motor Parts is already exist. Please try another.
          </div>

          <div class="form-actions">
            <button type="submit" name="submit1" class="btn btn-success">Save</button>
          </div>

          <div class="alert alert-success" id="success" style="display:none">
              New Parts Inserted Successfully!
          </div>
         
        </form>
      </div>
    </div>

    <!-- table-->
      <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Product Category</th>
                  <th>Suppliers Name</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $res = mysqli_query($link,"select * from parts");
              while($row = mysqli_fetch_array($res)){
                  ?>
                  <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["parts"]; ?></td>
                    <td><?php echo $row["company_name"]; ?></td>
                    <td><center><a href="edit_parts.php?id=<?php echo $row["id"]; ?>" style="color:green">Edit</a></center></td>
                    <td><center><a href="delete_parts.php?id=<?php echo $row["id"]; ?>"style="color:red">Delete</a></center></td>
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
    $res = mysqli_query($link, "select * from parts where parts='$_POST[motorparts]' && company_name='$_POST[company_name]'");
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
 
            mysqli_query($link,"insert into parts values(NULL, '$_POST[motorparts]', '$_POST[company_name]')") or die(mysqli_error($link));
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



