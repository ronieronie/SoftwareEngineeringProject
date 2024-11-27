 <?php
 session_start();
 $sessionid=$_GET["sessionid"];
 $b = array("company_name"=>"", "product_name"=>"", "parts"=>"", "packing_size"=>"", "price"=>"", "qty"=>"");
 $_SESSION["cart"][$sessionid]=$b;
 ?>  