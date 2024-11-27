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
$company_name = "";
$product_name = "";
$parts = "";
$packing_size = "";

$res = mysqli_query($link, "select * from products where id = '$id'");
while($row=mysqli_fetch_array($res)){
    $companyname= $row["company_name"];
    $product_name= $row["product_name"];
    $parts = $row["parts"];
    $packing_size = $row["packing_size"];
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Edit Products</a></div>
    </div>
   
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Edit Products</h5>
            </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">


            <div class="control-group">
            <label class="control-label">Suppliers Name :</label>
                <div class="controls">
                <select class="span11" name ="company_name" readonly>
                    <?php
                    $res=mysqli_query($link, "select * from company_name");
                    while($row=mysqli_fetch_array($res)){
                        ?>
                        <option <?php if($row["company_name"]==$company_name){ echo "selected"; } ?>>
                        <?php
                        echo $row["company_name"];
                        echo "</option>";
                    }
                    ?>
                </select>
                </div>
            </div>

            <div class="control-group">
           <label class="control-label">Enter Product Name :</label>
                <div class="controls">
                <input type="text" placeholder = "Enter Product Name" class="span11" name ="product_name" value = "<?php echo $product_name;?>">
                </div>
            </div>


            <div class="control-group">
            <label class="control-label">Motocycle Parts :</label>
                <div class="controls">
                <select class="span11" name ="motorparts" readonly>
                    <?php
                    $res=mysqli_query($link, "select * from parts");
                    while($row=mysqli_fetch_array($res)){
                        ?>
                        <option <?php if($row["parts"]==$parts){ echo "selected"; } ?>>
                        <?php
                        echo $row["parts"];
                        echo "</option>";
                    }
                    ?>
                </select>
                </div>
            </div>

            <div class="control-group">
            <label class="control-label">Enter Packing Size :</label>
                <div class="controls">
                <input type="text" placeholder = "Enter Packing Size" class="span11" name ="packing_size"  value = "<?php echo $packing_size;?>">
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
    mysqli_query($link, "update products set company_name='$_POST[company_name]', product_name='$_POST[product_name]', parts='$_POST[motorparts]', packing_size='$_POST[packing_size]' where id='$id'") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
        setTimeout(function(){
            window.location="add_products.php";
        }, 1000);
    </script>
    <?php
}
?>
<?php
include "footer.php";
?>



 