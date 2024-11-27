<?php
include "../../user/connection.php";
session_start();
?>
<?php
$qty_found=0;
$qty_session=0;
$max = 0;

if(isset($_SESSION['cart'])){
    $max = sizeof($_SESSION['cart']);
}

for($i=0;$i<$max;$i++){
    $company_name_session = "";
    $product_name_session = "";
    $parts_session = "";
    $packing_size_session = "";
    $price_session = "";

    if(isset($_SESSION['cart'][$i])){
        foreach($_SESSION['cart'][$i] as $key =>$val){
            if($key=="company_name"){
                $company_name_session = $val;
            }
            else if($key=="product_name"){
                $product_name_session = $val;
            }
            else if($key=="parts"){
                $parts_session = $val;
            }
            else if($key=="packing_size"){
                $packing_size_session = $val;
            }
            else if($key=="qty"){
                $qty_session = $val;
            }
            else if($key=="price"){
                $price_session = $val;
            }
        } 
        if($company_name_session!=""){
            $vat = ($qty_session*$price_session)*0.12;
        ?>
        <div>
            <div>Suppliers Company: <?php echo $company_name_session; ?><div>
            <div>Product Name: <?php echo $product_name_session; ?></div>
            <div>Product Category: <?php echo $parts_session; ?></div>
            <div>Package Size: <?php echo $packing_size_session; ?></div>
            <div>Price: &#8369;<?php echo $price_session; ?></div>  
            <div>Quantity: <input type="text" id="tt<?php echo $i;?>" value="<?php echo $qty_session;?>">&nbsp; <i class="fa fa-refresh" style="font-size:24px" onclick="edit_qty(document.getElementById('tt<?php echo $i;?>').value, '<?php echo $company_name_session;?>', '<?php echo $product_name_session;?>', '<?php echo $parts_session;?>', '<?php echo $packing_size_session;?>', '<?php echo $price_session;?>')"></i></td> 
            <div>VAT: &#8369;<?php echo $vat;?></td>
            <div>Total:&#8369; <?php echo ($qty_session*$price_session)-$vat; ?></div>  
            <div style="color:red; cursor: pointer" onclick="delete_qty('<?php echo $i;?>')">Delete</div>
        </div>
        <?php  
        } 
    }
}
?>


</table>