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
$id=$_GET["id"];
$full_name="";
$bill_type="";
$date = "";
$bill_no = "";
$res = mysqli_query($link, "select * from billing_header where id='$id'");
while($row=mysqli_fetch_array($res)){
    $full_name=$row["full_name"];
    $bill_type=$row["bill_type"];
    $date = $row["date"];
    $bill_no = $row["bill_no"];
}
?>
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Detailed Bills</a></div>
    </div>
   
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <center>
                <h5>Detailed Bills</h5>
            </center>

            <table>
                <tr>
                    <td>Bill No:</td>
                    <td><?php echo $bill_no;?></td>
                </tr>
                <tr>
                    <td>Full Name:</td>
                    <td><?php echo $full_name;?></td>
                </tr>
                <tr>
                    <td>Bill Type:</td>
                    <td><?php echo $bill_type;?></td>
                </tr>
                <tr>
                    <td>Bill Date:</td>
                    <td><?php echo $date;?></td>
                </tr>
            </table>
            <br>
            <table class="table table-bordered">
                <tr>
                    <th>Suppliers Company</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Packing Size</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>VAT 12%</th>
                    <th>Total</th>
                    <th>Return</th>
                </tr>
                <?php
                $res = mysqli_query($link, "select * from billing_details where bill_id=$id");
                $total = 0;
                while($row=mysqli_fetch_array($res)){
                    echo "<tr>";
                    echo "<td>"; echo $row["product_company"]; echo "</td>";
                    echo "<td>"; echo $row["product_name"]; echo "</td>";
                    echo "<td>"; echo $row["product_parts"]; echo "</td>";
                    echo "<td>"; echo $row["packing_size"]; echo "</td>";
                    echo "<td>&#8369;"; echo $row["price"]; echo "</td>";
                    echo "<td>"; echo $row["qty"]; echo "</td>";
                    echo "<td>&#8369;"; echo $row["VAT"]; echo "</td>";     
                    echo "<td>&#8369;"; echo ($row["price"]*$row["qty"])-$row["VAT"]; echo "</td>";
                    echo "<td>";  ?><a href ="return.php?id=<?php echo $row["id"];?>" style="color:red" >Return</a>  <?php echo "</td>";
                    echo "</tr>";
                    $total = $total+(($row["price"]*$row["qty"])-$row["VAT"]); 
                }
                ?>
            </table>
            <div style="float: right"><span style="float:left;">Total:&#8369;</span><span style="float: left" id="totalbill"><?php echo $total;?></span>
        </div>

    </div>
</div>

<?php
include "footer.php";
?>



