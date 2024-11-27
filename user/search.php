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

?>
<script>
    document.getElementById("a")class="active";
</script>

<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Search Products</a></div>
    </div>
   
    <div class="container-fluid">
      <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>Search Products</h5>
            </div>

          <div class="widget-content nopadding">
            <form name ="form1" action="" method="post" class="form-horizontal">


            <div class="control-group">
            <label class="control-label">Select Suppliers :</label>
                <div class="controls">
                <select class="span11" id="company_name" name ="product_company" onchange="select_company(this.value)">
                    <option>Select</option>
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
            <label class="control-label">Product Category :</label>
                <div class="controls" id = "parts_div">
                <select class="span11" name = "parts">
                    <option>Select</option>
                </select>
                </div>
            </div>

           <div class="control-group">
            <label class="control-label">Enter Price :</label>
                <div class="controls" >
                    <input type="text" name="price" class="span11">
                
                </div>
            </div>


          <div class="alert alert-danger" id="error" style="display:none">
              No Product availble!
          </div>

          <div class="form-actions">
            <button type="submit" name="submit1" class="btn btn-success">Search</button>
          </div>

          <div class="alert alert-success" id="success" style="display:none">
              Here are the products availble!
          </div>
         
        </form>
      </div>
    </div>

    <!-- table-->
      <div class="widget-content nopadding">
      <?php
if(isset($_POST['submit1'])){
    $prodprice = "";
    $company = "";
    $parts = "";
    $srchprice = $_POST["price"];
    ?>
    <table class="table table-bordered">           
                    <tr>
                        <th>ID</th>
                        <th>Company Name</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Product Price</th>
                    </tr>
                <?php
    $res = mysqli_query($link,"select * from stock_master");
    $count = 0;
    while($row=mysqli_fetch_array($res)){
        $company = $row["product_company"];
        $parts = $row["product_parts"];
        $prodprice = $row["selling_price"];
        if($srchprice>=$prodprice && $parts==$_POST["parts"] && $company==$_POST["product_company"]){
            $count = 1;
            ?> 
                    <tr>
                       <td><?php echo $row["id"];?></td>
                       <td><?php echo $row["product_company"];?></td>
                       <td><?php echo $row["product_name"];?></td>
                       <td><?php echo $row["product_parts"];?></td>
                       <td>&#8369;<?php echo $row["selling_price"];?></td>
                   </tr>
            <?php
        }
    }
    if($count!=1){
        ?>
        <script type="text/javascript">
            document.getElementById("error").style.display="block";
            document.getElementById("success").style.display="none";
        </script>
        
        <?php
    }
}

    ?>
    </table>
    <?php
    ?>
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

</script>


<?php
include "footer.php";
?>



