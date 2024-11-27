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
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}
</style>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a></div>
    </div>
   
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
              <div class="card" style="width: 220px; float: left; border-width:1px; border-radius: 10px; margin-left: 50px">
              <center><h2>Products</h2></center>
              <center><img src="motorbike.png" alt="Avatar" style="width:50%"></center>
                  <div class="container">
                    <h4><b>Number of Products</b></h4> 
                    <p><?php
                    $count = 0;
                    $res = mysqli_query($link, "select * from products");
                    $count = mysqli_num_rows($res);
                    echo $count;
                    ?></p> 
                  </div>
              </div>

              <div class="card" style="width: 225px; float: left; border-width:1px; border-radius: 10px; margin-left: 50px">
              <center><h2>ORDERS</h2></center>
              <center><img src="empty-cart.png" alt="Avatar" style="width:50%"></center>
                  <div class="container">
                    <h4><b>Number of Orders</b></h4> 
                    <p><?php
                    $count = 0;
                    $res = mysqli_query($link, "select * from billing_header");
                    $count = mysqli_num_rows($res);
                    echo $count;
                    ?></p> 
                  </div>
              </div>

              <div class="card" style="width: 230px; float: left; border-width:1px; border-radius: 10px; margin-left: 50px">
              <center><h2>SUPPLIERS</h2></center>
              <center><img src="company.png" alt="Avatar" style="width:50%"></center>
                  <div class="container">
                    <h4><b>Number of Suppliers</b></h4> 
                    <p><?php
                    $count = 0;
                    $res = mysqli_query($link, "select * from company_name");
                    $count = mysqli_num_rows($res);
                    echo $count;
                    ?></p> 
                  </div>
              </div>

              <div class="card" style="width: 235px; float: left; border-width:1px; border-radius: 10px; margin-left: 50px">
              <center><h2>USERS</h2></center>
              <center><img src="analytics.png" alt="Avatar" style="width:48%"></center>
                  <div class="container">
                    <h4><b>Number of User</b></h4>
                    <p><?php
                    $count = 0;
                    $res = mysqli_query($link, "select * from user_register");
                    $count = mysqli_num_rows($res);
                    echo $count;
                    ?></p> 
                  </div>
              </div>
              
        
                  </div>
              </div>
        </div>
</div>

<?php
include "footer.php";
?>



