<?php
include "../../user/connection.php";
$company_name = $_GET["company_name"];
$product_name = $_GET["product_name"];
$parts = $_GET["parts"];
$packing_size = $_GET["packing_size"];

$res=mysqli_query($link, "select * from stock_master where product_company='$company_name' && product_name='$product_name' && product_parts='$parts' && packing_size='$packing_size'");
while($row=mysqli_fetch_array($res)){
    $vat = $row["selling_price"];
    echo $row["selling_price"];
}
?>