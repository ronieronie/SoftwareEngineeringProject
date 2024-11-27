<?php
include "../../user/connection.php";
$company_name = $_GET["company_name"];
$res = mysqli_query($link, "select * from parts where company_name = '$company_name'");
?>

<select class="span11" name="parts" id="parts" onchange="select_parts(this.value,'<?php echo $company_name; ?>')">
    <option>Select</option>
    <?php
    while($row=mysqli_fetch_array($res)){
        echo "<option>";
        echo $row["parts"];
        echo "</option>";
    }
echo "</select>";
?>