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
$total = [];
$month = [];
$res = mysqli_query($link, "select * from sales_report");
while($row=mysqli_fetch_array($res)){
    array_push($month,$row['month']);
    array_push($total,$row['total']);
    $gtotal = $gtotal+$row["total"];
}
$month = json_encode($month);
$total= json_encode($total);

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="product_sales.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Sales Report</a></div>
    </div>
    <div class="container-fluid" style="padding: 10px">
        
        <div class="row-fluid" style="background-color: white; min-height: 100px;">

      
        <h3><center>Total Sales Report<button type="button" name="submit2" class="btn btn-warning" onclick="window.print();" style="float: right; margin-right: 10px">Print</button></h3></center>

      
        
            <div>
                <canvas id="myChart" style="width:100%;max-width:950px; margin-left: 320px"></canvas>
            </div>
            <script>
                var xValues = <?php echo $month; ?>;
                var yValues = <?php echo $total; ?>;
                var barColors = ["#033f63", "#28666e", "#7c9885", "#b5b682", "#fedc97","#033f63", "#28666e", "#7c9885", "#b5b682", "#fedc97","#033f63", "#28666e"];

                new Chart("myChart", {
                type: "bar",
                 data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
                },
                options: {
                legend: {display: false},
                title: {
                display: true,
                text: "Sales Report"
                }
            }
            });
        </script>
        <h3>
            <div style="float: right"><span style="float:left;">Total:&#8369;</span><span style="float: left" id="totalbill"><?php echo $gtotal; ?></span></div>
        </h3>
        <div class="span12">
                    <div class="widget-content nopadding">
                        <?php
                            ?>
                            <table class = "table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        <th>Month</th>
                                        <th>Net Sales</th>
                                        <th>Gross Sales</th>
                                        <th>Taxes</th>
                                        <th>Profit</th>
                                        <th>Total Cost</th>
                                        <th>Refunded</th>
                                        <th>Profit Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $profitrate = "";
                                    $res2=mysqli_query($link, "select * from sales_report");
                                    while($row2 = mysqli_fetch_array($res2)){
                                        $profit =(int)$row2["total"]-(int)$row2["totalcost"];
                                        echo "<tr>";
                                        echo "<td>";  echo $row2["month"]; echo"</td>"; 
                                        echo "<td>&#8369;";  echo $row2["total"]; echo"</td>";
                                        echo "<td>&#8369;";  echo $row2["gross_sales"]; echo"</td>"; 
                                        echo "<td>&#8369;";  echo $row2["deductions"]; echo"</td>";
                                        echo "<td>&#8369;";  echo $profit; echo"</td>";
                                        echo "<td>&#8369;";  echo $row2["totalcost"]; echo"</td>";
                                        echo "<td>&#8369;";  echo $row2["refund"]; echo"</td>";
                                        echo "<td>";  echo round(get_profit($row2["totalcost"],$profit));echo"%</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
</div>
<?php
function get_total($bill_id, $link){
    $total=0;
    $res2 = mysqli_query($link,"select * from billing_details where bill_id='$bill_id'");
    while($row2=mysqli_fetch_array($res2)){
        $total = (int)$total+(((int)$row2["price"]*(int)$row2["qty"])-(int)$row2["VAT"]);
    }
    return $total;
}
?>
<?php
function get_profit($cost, $profit){
    $profrate = 0;
    if($cost!=0&&$profit!=0){
        $profrate = ($profit/$cost)*100;
    }
  
    return $profrate;
}
?>
<?php
include "footer.php";
?>



