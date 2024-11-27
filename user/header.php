<?php
include "../connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inventory Management System</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="css/fullcalendar.css"/>
    <link rel="stylesheet" href="css/matrix-style.css"/>
    <link rel="stylesheet" href="css/matrix-media.css"/>
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/jquery.gritter.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

<div id="header">

    <h4 style="color: white;position: absolute">
        <a href="dashboard.html" style="color:white; margin-left: 50px; margin-top: 40px" >INVENTORY</a>
        <br>
        <a href="dashboard.html" style="color:white; margin-left: 10px; margin-top: 40px" >Managment System</a>
    </h4>
</div>




<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li class="dropdown" id="profile-messages">
            <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i
                    class="icon icon-user"></i> <span class="text"></span><?php echo $_SESSION["user"]; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="logout.php"><i class="icon-key"></i> Log Out</a></li>
            </ul>
        </li>


    </ul>
</div>

<!--sidebar-menu-->
<div id="sidebar">
    <ul>
        <li class="active">
            </i><a href="dashboard.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span>Dashboard</span></a>
        </li>

        <li>
            <a href="search.php"><i class="fa fa-search" aria-hidden="true"></i><span>Search</span></a>
        </li>

        <li>
            <a href="purchase_master.php"><i class="fa fa-cart-plus" aria-hidden="true"></i><span>Purchase Manager</span></a>
        </li>
       
        <li>
            <a href="sales_master.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Sales Manager</span></a>
        </li>

        <li>
            <a href="view_bills.php"><i class="fa fa-credit-card-alt" aria-hidden="true"></i><span> View Bills</span></a>
        </li>
        <li>
            <a href="stock_master.php"><i class="fa fa-database" aria-hidden="true"></i><span>    Stocks Report</span></a>
        </li>
               
        <li>
            <a href="return_product_list.php"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span> Return Products</span><span
                    class="label label-important"></span></a>
        </li>

    

    </ul>
</div>
<!--sidebar-menu-->
<div id="search">

        <a href="logout.php" style="color:white"><i class="icon icon-share-alt"></i><span>LogOut</span></a>

</div>