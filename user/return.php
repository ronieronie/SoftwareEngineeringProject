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
include "../user/connection.php";
$id = $_GET["id"];
$bill_id = "";
$product_company = "";
$product_name = "";
$product_parts = "";
$packing_size = ""; 
$price = "";
$qty = "";
$total = 0;

$res = mysqli_query($link, "select * from billing_details where id =$id");
while($row = mysqli_fetch_array($res)){
    $bill_id = $row["bill_id"];
    $product_company = $row["product_company"];
    $product_name = $row["product_name"];
    $product_parts = $row["product_parts"];
    $packing_size = $row["packing_size"];
    $price = $row["price"];
    $qty = $row["qty"];
    $vat = $row["VAT"];
    $total = ($price*$qty)-$vat;
    $total1 = (int)$price*(int)$qty;
}
$bill_no ="";
$res2 = mysqli_query($link, "select * from billing_header where id='$bill_id'");
while($row2=mysqli_fetch_array($res2)){
    $bill_no = $row2["bill_no"];
}

$profit = "";
$costprice = "";
$res3 = mysqli_query($link,"select * from stock_master where product_name='$product_name'");
while($row3 = mysqli_fetch_array($res3)){
   $costprice = $row3["cost_price"];
}
$totalcost = $costprice*$qty;
$profit = $total - $totalcost;

$today_date = date('Y-m-d');
mysqli_query($link, "insert into return_products values(NULL,'$bill_no','$today_date','$product_company','$product_name','$product_parts','$packing_size','$price','$qty','$total','$vat')");
mysqli_query($link, "update stock_master set product_qty=product_qty+$qty where product_company='$product_company' && product_name='$product_name' && packing_size='$packing_size' && product_parts='$product_parts'");
mysqli_query($link, "delete from billing_details where id = '$id'");
$month = idate('m');
mysqli_query($link, "update sales_report set total = total-$total where id = $month");
mysqli_query($link, "update sales_report set gross_sales = gross_sales-$total1 where id = $month");
mysqli_query($link, "update sales_report set deductions=deductions-$vat where id = $month");
mysqli_query($link, "update sales_report set refund=refund+$total where id = $month");
mysqli_query($link, "update products set product_sales = product_sales-$total where product_name='$product_name'");
mysqli_query($link, "update products set gross_sales = gross_sales-$total1 where product_name='$product_name'");
mysqli_query($link, "update products set deductions = deductions-$vat where product_name='$product_name'");
mysqli_query($link, "update products set qty = qty-$qty where product_name='$product_name'");
mysqli_query($link, "update products set returned = returned+$qty where product_name='$product_name'");
mysqli_query($link, "update products set refund = refund+$total where product_name='$product_name'");

?>
<script type="text/javascript">
    alert("Product Take as  A Return Successfully!");
    window.location = "view_bill_details.php?id=<?php echo $bill_id; ?>";
</script>

<?php


