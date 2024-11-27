<?php
session_start();
if(!isset($_SESSION["user"])){
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
            Return Products List</a></div>
    </div>
   
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <table class="table table-bordered">
                <tr>
                    <th>Bill Number</th>
                    <th>Return Date</th>
                    <th>Suppliers Company</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Packing Size</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>VAT 12%</th>
                    <th>Total</th>
                </tr>
                <?php
                $res = mysqli_query($link, "select * from return_products");
                while($row=mysqli_fetch_array($res)){
                    echo "<tr>";
                    echo "<td>"; echo $row["bill_no"]; echo "</td>";
                    echo "<td>"; echo $row["return_date"]; echo "</td>";
                    echo "<td>"; echo $row["product_company"]; echo "</td>";
                    echo "<td>"; echo $row["product_name"]; echo "</td>";
                    echo "<td>"; echo $row["product_parts"]; echo "</td>";
                    echo "<td>"; echo $row["packing_size"]; echo "</td>";
                    echo "<td>"; ?>&#8369;<?php echo $row["product_price"]; echo "</td>";
                    echo "<td>";  echo $row["product_qty"]; echo "</td>";
                    echo "<td>&#8369;";  echo $row["vat"]; echo "</td>";
                    echo "<td>"; ?>&#8369;<?php echo $row["total"]; echo "</td>";
                    echo "<tr>";
                }
                
                ?>
            </table>
        </div>

    </div>
</div>

<?php
include "footer.php";
?>



