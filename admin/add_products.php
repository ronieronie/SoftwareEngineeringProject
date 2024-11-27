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
            Add New Products</a></div>
    </div>
   
    <div class="container-fluid">
      <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Add New Products</h5>
            </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">

            <div class="control-group">
            <label class="control-label">Select Suppliers :</label>
                <div class="controls">
                <select class="span11" id="company_name" name ="product_company" onchange="select_company(this.value)">
                    <option >Select</option>
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

            <div class="control-group">
            <label class="control-label">Select Category :</label>
                <div class="controls" id = "parts_div">
                <select class="span11" name = "parts">
                    <option>Select</option>
                </select>
                </div>
            </div>
            
           <div class="control-group">
           <label class="control-label">Enter Product Name :</label>
                <div class="controls">
                <input type="text" placeholder = "Enter Product Name" class="span11" name ="product_name">
                </div>
            </div>

            <div class="control-group">
            <label class="control-label">Enter Package Size:</label>
                <div class="controls">
                <select type="text" placeholder = "Enter Packing Size" class="span11" name ="packing_size">
                  <option>SMALL (W:13cm L:23cm H:16cm)</option>
                  <option>MEDIUM (W:15cm L:26cm H:18cm)</option>
                  <option>LARGE (W:17cm L:29cm H:19cm)</option>
                </select>
                </div>
            </div>


          <div class="alert alert-danger" id="error" style="display:none">
              This Products is already exist. Please try another.
          </div>

          <div class="form-actions">
            <button type="submit" name="submit1" class="btn btn-success">Save</button>
          </div>

          <div class="alert alert-success" id="success" style="display:none">
              New Products has inserted successfully!
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
                  <th>SUPPLIERS NAME</th>
                  <th>PRODUCT NAME</th>
                  <th>PRODUCT CATEGORY</th>
                  <th>PACKAGE SIZE</th>
                  <th>EDIT</th>
                  <th>DELETE</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $res = mysqli_query($link,"select * from products");
              while($row = mysqli_fetch_array($res)){
                  ?>
                  <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["company_name"]; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["parts"]; ?></td>
                    <td><?php echo $row["packing_size"]; ?></td>
                    <td><center><a href="edit_products.php?id=<?php echo $row["id"]; ?>" style="color:green">Edit</a></center></td>
                    <td><center><a href="delete_products.php?id=<?php echo $row["id"]; ?>"style="color:red">Delete</a></center></td>
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
<script type="text/javascript">
    function select_company(company_name) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status==200){
            document.getElementById("parts_div").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "forajax/load_parts_using_company.php?company_name="+company_name, true);
        xmlhttp.send();      
    }

</script>

<?php
if(isset($_POST['submit1'])){
    $count=0;
    $res = mysqli_query($link, "select * from products where product_name='$_POST[product_name]'");
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

            mysqli_query($link,"insert into products values(NULL,'$_POST[product_company]', '$_POST[product_name]', '$_POST[parts]', '$_POST[packing_size]','0','0','0','0','0','0','0','0')") or die(mysqli_error($link));
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



