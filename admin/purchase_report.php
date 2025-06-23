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
            <div id="breadcrumb"><a href="#" class="tip-bottom"><i class="icon-home"></i>
                    Stock Master</a></div>
        </div>
        <!--End-breadcrumbs-->
        <!--Action boxes-->
        <div class="container-fluid">

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
                </form>

                <br>


                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">



                <div class="span12">

                    <div class="widget-content nopadding">
                        <?php
                        if(isset($_POST['submit1'])){
                            ?>
                            <table class = "table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial Number</th>
                                        <th>Purchase By</th>
                                        <th>Suppliers Company</th>
                                        <th>Product Name</th>
                                        <th>Product Parts</th>
                                        <th>Packing Size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Party Name</th>
                                        <th>Purchase Type</th>
                                        <th>Purchase Date</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $res=mysqli_query($link,"select * from purchase where purchase_date>='$_POST[dt]' && purchase_date<='$_POST[dt2]'");
                                    while($row = mysqli_fetch_array($res)){
                                        $count = $count+1;
                                        echo "<tr>";
                                        echo "<td>";  echo $count; echo"</td>";
                                        echo "<td>";  echo $row["username"]; echo "</td>";
                                        echo "<td>";  echo $row["company_name"]; echo "</td>";
                                        echo "<td>";  echo $row["product_name"]; echo "</td>";
                                        echo "<td>";  echo $row["parts"]; echo "</td>";
                                        echo "<td>";  echo $row["packing_size"]; echo "</td>";
                                        echo "<td>";  echo $row["quantity"]; echo "</td>";
                                        echo "<td>&#8369;";  echo $row["price"]; echo "</td>";
                                        echo "<td>";  echo $row["purchase_type"]; echo "</td>";
                                        echo "<td>";  echo $row["purchase_date"]; echo "</td>";
                                        echo "<td>&#8369;";  echo (int)$row["quantity"]*(int)$row["price"]; echo "</td>";
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
                                        <th>Serial Number</th>
                                        <th>Purchase By</th>
                                        <th>Product Company</th>
                                        <th>Product Name</th>
                                        <th>Product Parts</th>
                                        <th>Packing Size</th>
                                        <th>Quantity</th>
                                        <th>Cost Price</th>
                                        <th>Purchase Type</th>
                                        <th>Purchase Date</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $res=mysqli_query($link,"select * from purchase");
                                    while($row = mysqli_fetch_array($res)){
                                        $count = $count+1;
                                        echo "<tr>";
                                        echo "<td>";  echo $count; echo"</td>";
                                        echo "<td>";  echo $row["username"]; echo "</td>";
                                        echo "<td>";  echo $row["company_name"]; echo "</td>";
                                        echo "<td>";  echo $row["product_name"]; echo "</td>";
                                        echo "<td>";  echo $row["parts"]; echo "</td>";
                                        echo "<td>";  echo $row["packing_size"]; echo "</td>";
                                        echo "<td>";  echo $row["quantity"]; echo "</td>";
                                        echo "<td>&#8369;";  echo $row["price"]; echo "</td>";
                                        echo "<td>";  echo $row["purchase_type"]; echo "</td>";
                                        echo "<td>";  echo $row["purchase_date"]; echo "</td>";
                                        echo "<td>&#8369;";  echo (int)$row["quantity"]*(int)$row["price"]; echo"</td>";
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
        </div>

    </div>
<?php
include "footer.php";
?>



