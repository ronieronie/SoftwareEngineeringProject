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
$gtotal = 0;
$product_sales = [];
$product_name = [];
$res = mysqli_query($link, "select * from products");
while($row=mysqli_fetch_array($res)){
    array_push($product_name,$row['product_name']);
    array_push($product_sales,$row['product_sales']);
    $gtotal = $gtotal+$row["product_sales"];
}
$product_name = json_encode($product_name);
$product_sales= json_encode($product_sales);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="product_sales.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Sales Report</a></div>
    </div>
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <h3><center>Product Sales Report</center></h3>
    
            <script>
                var xValues =<?php echo $product_name; ?>;
                var yValues = <?php echo $product_sales;?>;
                var barColors = [
                "#f44336",
                "#e81e63",
                "#9c27b0",
                "#673ab7",
                "#03a9f4",
                "#2196f3",
                "#03a9f4",
                "#00bcd4",
                "#009688",
                "#607d8b", 
                ];

                new Chart("myChart", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                    }]
                },
                options: {
                    title: {
                    display: true,
                    text: "Product Names"
                    }
                }
                });
        </script>
        <h3>
            <div style="float: right"><span style="float:left;">Total:&#8369;</span><span style="float: left" id="totalbill"><?php echo $gtotal; ?></span></div>
        </h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Suppliers Company</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Quantity</th>
                    <th>Net Sales</th>
                    <th>Gross Sales</th>
                    <th>VAT</th>
                    <th>Profit</th>
                    <th>Total Cost</th>
                    <th>Profit Rate</th>
                    <th>Returned</th>
                    <th>Refunded</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $qty = 0;
                $netsales = 0;
                $tax = 0;
                $gross = 0;
                $prof = 0;
                $i = 0;
                $tcostprice = 0;
                $gross = 0;
                $tot = 0;
                $tax = 0;
                $treturn = 0;
                $trefund = 0;
                $res=mysqli_query($link, "select * from products");
                while($row = mysqli_fetch_array($res)){
                    $prft = (int)$row["product_sales"]-(int)$row["cost_price"];
           
                    echo "<tr>";
                    echo "<td>"; echo $row["company_name"]; echo "</td>";
                    echo "<td>"; echo $row["product_name"]; echo "</td>";
                    echo "<td>"; echo $row["parts"]; echo "</td>";
                    echo "<td>"; echo $row["qty"]; echo "</td>";
                    echo "<td>&#8369;"; echo $row["product_sales"]; echo "</td>";
                    echo "<td>&#8369;"; echo $row["gross_sales"]; echo "</td>";
                    echo "<td>&#8369;"; echo $row["deductions"]; echo "</td>";
                    echo "<td>&#8369;"; echo $prft; echo "</td>";
                    echo "<td>&#8369;"; echo $row["cost_price"]; echo "</td>";
                    echo "<td>"; echo round(get_profit($row["cost_price"],$prft)); echo "%</td>";
                    echo "<td>"; echo $row["returned"]; echo "</td>";
                    echo "<td>&#8369;"; echo $row["refund"]; echo "</td>";
                    echo "</tr>";
                    $qty = $qty+$row["qty"];
                    $netsales = $netsales+$row["product_sales"];
                    $gross = $gross+$row["gross_sales"];
                    $tax = $tax+$row["deductions"];
                    $prof = $prof+$prft;
                    $tcostprice = $tcostprice+$row["cost_price"];
                    $treturn = $treturn+$row["returned"];
                    $trefund = $trefund+$row["refund"];
                }
                ?>  
            </tbody>
            <tbody>
                <tr>
                    <?php
                    ?>
                    <td></th>
                    <td></th>
                    <td></th>
                    <td>Total: <?php echo $qty;?></th>
                    <td>Total = &#8369;<?php echo $netsales;?></th>
                    <td>Total = &#8369;<?php echo $gross;?></th>
                    <td>Total = &#8369;<?php echo $tax;?></th>
                    <td>Total = &#8369;<?php echo $prof;?></th>
                    <td>Total = &#8369;<?php echo $tcostprice;?></td>
                    <td style = "color:red">Profit Rate: <?php echo round(get_profit($tcostprice,$prof));?>%</td>
                    <td>Total = &#8369;<?php echo $treturn;?></td>
                    <td>Total = &#8369;<?php echo $trefund;?></td>
            </tbody>
        </table>
    </div>
</div>
<?php
function get_profit($cost, $profit){
    $profrate = 0;
    if($cost!=0 && $profit!=0){
        $profrate = ($profit/$cost)*100;
    }
    return $profrate;
}
?>
<?php
include "footer.php";
?>



