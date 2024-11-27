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
$product_company = "";
$product_name = "";
$parts = "";
$product_qty = "";
$packing_size = "";
$selling_price = "";
$cost_price = "";

$res = mysqli_query($link, "select * from stock_master where id = '$id'");
while($row=mysqli_fetch_array($res)){
    $product_company = $row["product_company"];
    $product_name = $row["product_name"];
    $packing_size = $row["packing_size"];
    $parts = $row["product_parts"];
    $product_qty = $row["product_qty"];
    $selling_price = $row["selling_price"];
    $cost_price = $row["cost_price"];
}
?>
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
            <label class="control-label">Suppliers Company :</label>
                <div class="controls">
                <select class="span11" name ="company_name" readonly>
                    <?php
                    $res=mysqli_query($link, "select * from stock_master");
                    while($row=mysqli_fetch_array($res)){
                        ?>
                        <option <?php if($row["product_company"]==$product_company){ echo "selected"; } ?>>
                        <?php
                        echo $row["product_company"];
                        echo "</option>";
                    }
                    ?>
                </select>
                </div>
            </div>

           <div class="control-group">
           <label class="control-label">Enter Product Name :</label>
                <div class="controls">
                <input type="text" placeholder = "Enter Product Name" class="span11" name ="product_name" value = "<?php echo $product_name;?>" readonly>
                </div>
            </div>

            <div class="control-group">
           <label class="control-label">Enter Packing Size :</label>
                <div class="controls">
                <input type="text" placeholder = "Enter Product Name" class="span11" name ="packing_size" value = "<?php echo $packing_size;?>" readonly>
                </div>
            </div>


            <div class="control-group">
            <label class="control-label">Select Parts :</label>
                <div class="controls">
                <select class="span11" name ="parts" readonly>
                    <?php
                    $res=mysqli_query($link, "select * from stock_master");
                    while($row=mysqli_fetch_array($res)){
                        ?>
                        <option <?php if($row["product_parts"]==$parts){ echo "selected"; } ?>>
                        <?php
                        echo $row["product_parts"];
                        echo "</option>";
                    }
                    ?>
                </select>
                </div>
            </div>

            <div class="control-group">
            <label class="control-label">Enter Quantity:</label>
                <div class="controls">
                <input type="text" placeholder = "Enter Packing Size" class="span11" name ="qty"  value = "<?php echo $product_qty;?>" readonly>
                </div>
            </div>
            
            <div class="control-group">
            <label class="control-label">Cost Price:</label>
                <div class="controls">
                <input type="text" placeholder = "Enter Packing Size" class="span11" name ="qty"  value = "<?php echo $cost_price;?>" readonly>
                </div>
            </div>

            <div class="control-group">
            <label class="control-label">Selling Price:</label>
                <div class="controls">
                <input type="text" placeholder = "Enter Packing Size" class="span11" name ="price"  value = "<?php echo $selling_price;?>">
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
    mysqli_query($link,"Update stock_master set selling_price='$_POST[price]' where id = '$id'") or die(mysqli_error($link));
    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
        setTimeout(function(){
            window.location="stock_master.php";
        }, 1000);
    </script>
    <?php
}
?>
<?php
include "footer.php";
?>



 