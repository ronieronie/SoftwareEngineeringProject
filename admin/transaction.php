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
    <div class="container-fluid" style = "padding:10px">
        
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <form class="form-inline" action="" name="form1" method="post">
                    <div class="form-group">
                        <label for="email">Select Start Date</label>
                        <input type="text" name="dt" id="dt" autocomplete="off" class="form-control" required style="width:200px;border-style:solid; border-width:1px; border-color:#666666" placeholder="click here to open calender"  >
                    </div>
                    <div class="form-group">
                        <label for="email">Select End Date</label>
                        <input type="text" name="dt2" id="dt2" autocomplete="off" placeholder="click here to open calender"  class="form-control" style="width:200px;border-style:solid; border-width:1px; border-color:#666666" >
                    </div>
                    <button type="submit" name="submit1" class="btn btn-success">Show Purchase From These Dates</button>
                    <button type="button" name="submit2" class="btn btn-warning" onclick="window.location.href=window.location.href">Clear Search</button>
                    <button type="button" name="submit2" class="btn btn-warning" onclick="window.print();">Print</button>
                 
               
               
                   
                </form>

        <h3><center>TRANSACTION RECORDS</center></h3>

        <div class="span12">

                    <div class="widget-content nopadding"  style="margin-right:100px">
                        <?php
                        if(isset($_POST['submit1'])){
                            ?>
                            <table class = "table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Purchase Date</th>
                                        <th>Bill ID</th>
                                        <th>Bill Type</th>
                                        <th>Name</th>
                                        <th>Total</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $res=mysqli_query($link,"select * from billing_header where date>='$_POST[dt]' && date<='$_POST[dt2]'");
                                    while($row = mysqli_fetch_array($res)){
                                        echo "<tr>";
                                        echo "<td>";  echo $row["date"]; echo"</td>"; 
                                        echo "<td>";  echo $row["bill_no"]; echo"</td>";
                                        echo "<td>";  echo $row["bill_type"]; echo"</td>"; 
                                        echo "<td>";  echo $row["full_name"]; echo"</td>"; 
                                        echo "<td>&#8369;"; echo get_total($row["id"],$link);echo "</td>";  
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php

                        }
                        else{
                            ?>
                            <table class = "table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Purchase Date</th>
                                        <th>Bill ID</th>
                                        <th>Bill Type</th>
                                        <th>Name</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $res=mysqli_query($link,"select * from billing_header");
                                    $res1 = mysqli_query($link, "select * from billing_details");
                                    while($row = mysqli_fetch_array($res)){
                                        echo "<tr>";
                                        echo "<td>";  echo $row["date"]; echo"</td>";
                                        echo "<td>";  echo $row["bill_no"]; echo"</td>";
                                        echo "<td>";  echo $row["bill_type"]; echo"</td>";  
                                        echo "<td>";  echo $row["full_name"]; echo"</td>";  
                                        echo "<td>&#8369;"; echo get_total($row["id"],$link);echo "</td>";
                                        echo "</tr>";
                                    }             
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        }
                        ?>
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
include "footer.php";
?>



