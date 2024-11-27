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
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Add New Purchase</a></div>
    </div>
   
    <div class="container-fluid">
      <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Add New Purchase</h5>
            </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">


            <div class="control-group">
            <label class="control-label">Select Suppliers :</label>
                <div class="controls">
                <select class="span11" id="company_name" name ="company_name" onchange="select_company(this.value)">
                    <option >Select</option>
                    <?php
                    $res=mysqli_query($link, "select * from company_name");
                    while($row=mysqli_fetch_array($res)){
                        echo "<option>";
                        echo $row["company_name"];
                        echo "</option>";
                    }
                    ?>
                </select>
                </div>
            </div>

            <div class="control-group">
            <label class="control-label">Select Product Category :</label>
                <div class="controls" id = "parts_div">
                <select class="span11" name = "parts">
                    <option>Select</option>
                </select>
                </div>
            </div>

           <div class="control-group">
           <label class="control-label">Select Product Name :</label>
                <div class="controls" id="product_name_div" >
                    <select class ="span11" name="product_name">
                        <option>Select</option>
                    </select>
                
                </div>
            </div>

            <div class="control-group">
            <label class="control-label">Enter Packing Size :</label>
                <div class="controls" id="packing_size_div" >
                <select class ="span11" name="packing_size">
                        <option>Select</option>
                    </select>
                
                </div>
            </div>


            <div class="control-group">
            <label class="control-label">Enter Quantity :</label>
                <div class="controls" >
                    <input type="text" name="qty" value="0" class="span11">
                
                </div>
            </div>

            <div class="control-group">
            <label class="control-label">Cost Price :</label>
                <div class="controls" >
                    <input type="text" name="cost_price" value="0" class="span11">
                
                </div>
            </div>
            
            <div class="control-group">
            <label class="control-label">Select Purchase Type :</label>
                <div class="controls" >
                <select class ="span11" name = "purchase_type">
                        <option>Cash</option>
                        <option>Debit</option>
                    </select>
                
                </div>
            </div>

            <div class="control-group">
            <label class="control-label">Date :</label>
                <div class="controls" >
                    <input type="text" name="dt" id="dt" class="span11" placeholder="YY-MM-DD" required pattern = "\d{4}-\d{2}-\d{2}">
                    
                </div>
            </div>




          <div class="form-actions">
            <button type="submit" name="submit1" class="btn btn-success">Purchase Now</button>
          </div>

          <div class="alert alert-success" id="success" style="display:none">
            Purchase has inserted successfully!
          </div>
         
        </form>
      </div>
    </div>

    </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function select_company(company_name) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status==200){
            document.getElementById("parts_div").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "forajax/load_parts_using_company.php?company_name="+company_name, true);
        xmlhttp.send();      
    }

    function select_parts(parts, company_name){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status==200){
            document.getElementById("product_name_div").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "forajax/load_products_using_parts.php?parts="+parts+" & company_name="+company_name, true);
        xmlhttp.send();   
    }

    function select_product(product_name, parts, company_name){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status==200){
            document.getElementById("packing_size_div").innerHTML=xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "forajax/load_packingsize_using_products.php?product_name="+product_name+" & parts="+parts+" & company_name="+company_name, true);
        xmlhttp.send();   
    }
</script>

<?php
if(isset($_POST['submit1'])){
    $today_date = date("Y-m-d");
    $month = idate("m");
    $totalcost = (int)$_POST["cost_price"]*(int)$_POST["qty"];
    $product = $_POST["product_name"];
    mysqli_query($link, "update sales_report set totalcost=totalcost+$totalcost where id='$month'");
    mysqli_query($link, "update products set cost_price = cost_price+$totalcost where product_name = '$product'");
    mysqli_query($link,"insert into purchase values(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[parts]','$_POST[packing_size]','$_POST[qty]','$_POST[cost_price]','$_POST[purchase_type]','$today_date','$_SESSION[admin]')") or die(mysqli_error($link));
    $count = 0;
    $res = mysqli_query($link,"select * from stock_master where product_company='$_POST[company_name]' && product_name='$_POST[product_name]' && product_parts='$_POST[parts]'");
    $count = mysqli_num_rows($res); 
    if($count==0){
        mysqli_query($link,"insert into stock_master values(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[packing_size]','$_POST[parts]','$_POST[qty]','0','$_POST[cost_price]')") or die(mysqli_error($link)); 
    }
    else{
        mysqli_query($link,"update stock_master set product_qty=product_qty+$_POST[qty] where product_company='$_POST[company_name]' && product_name='$_POST[product_name]' && product_parts='$_POST[parts]'") or die(mysqli_error($link));
    }
    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block"; 
        </script>
    <?php
}
?>
<?php
include "footer.php";
?>



