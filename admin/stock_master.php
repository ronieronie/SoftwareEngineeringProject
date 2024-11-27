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
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Stock Master</a></div>
    </div>
   
    <div class="container-fluid">
      <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Stock Master</h5>
            </div>

    </div>

    <!-- table-->
      <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Suppliers Name</th>
                  <th>Product Name</th>
                  <th>Product Category</th>
                  <th>Quantity</th>
                  <th>Packing Size</th>
                  <th>Cost Price</th>
                  <th>Selling Price</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $res = mysqli_query($link,"select * from stock_master");
              while($row = mysqli_fetch_array($res)){
                  ?>
                  <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["product_company"]; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["product_parts"]; ?></td>
                    <td><?php echo $row["product_qty"]; ?></td>
                    <td><?php echo $row["packing_size"]; ?></td>
                    <td>&#8369;<?php echo $row["cost_price"]; ?></td>
                    <td>&#8369;<?php echo $row["selling_price"]; ?></td>
                    <td><center><a href="edit_stocks.php?id=<?php echo $row["id"]; ?>" style="color:green">Edit</a></center></td>
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
include "footer.php";
?>



