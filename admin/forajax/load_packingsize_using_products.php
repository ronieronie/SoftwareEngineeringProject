<?php
include "../../user/connection.php";
$company_name = $_GET["company_name"];
$parts = $_GET["parts"];
$product_name = $_GET["product_name"];
$res = mysqli_query($link, "select * from products where company_name = '$company_name' && parts = '$parts' && product_name='$product_name'");
?>

<select class="span11" name="packing_size" id="packing_size">
    <option>Select</option>
    <?php
    while($row=mysqli_fetch_array($res)){
        echo "<option>";
        echo $row["packing_size"];
        echo "</option>";
    }
echo "</select>";
?>