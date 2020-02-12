<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $items["product_name"] ?></title>
        <link href='../product-detail/product-detail.css' rel="stylesheet" type="text/css">
        <link href='../product-selection/queryProduct.css' rel="stylesheet" type="text/css"/>
    </head>
<body>
<?php
session_start();
if(!empty($_SESSION['new'])):
?>
<center>
<div class="center" style="align-content: center;">
    <h3 style="font-size: 13px">Error 404! Please return to fill out the delivery form</h3>
    
    <table>
        <tr>
            <td colspan="2" width="50%" border="0">
                <input type="submit" value="Cancel" class="cancel-button" href="../product-detail/product_detail.html "  target="productDetailFrame" onclick="{if(confirm('Do you want to cancel your order? ')) {cancel();return true; } return false;<?php session_destroy();?>}">
            </td>
            <td colspan="2" width="50%" border="0" >
                <input type="submit" value="Checkout" class="checkout-button" href="../product-detail/product_detail2.html" target="productDetailFrame" onclick="{alert('Please click checkout to pay the bill and fill out delivery form or click Cancel to continue shopping.')}">
            </td>
        </tr>
    </table>

</div>
</center>
    <?php
    else:
    include '../../connection/databaseCon.php';

    $product_id = $_GET['product_id'];
    $query_string = "select * from products where product_id = " . $product_id;

    $result = mysqli_query($connection, $query_string);
    $num_rows = mysqli_num_rows($result);
    $items = mysqli_fetch_assoc($result);
    ?>
    <h1 style="text-align: center">Product Detail</h1>
<div class="center">
    
    <table class="table" >
        <tr>
            <td class="highlight" style="font-weight: bold; font-size: 14px;">Product Name</td>
            <td class="highlight" style="font-weight: bold; font-size: 14px;">Price</td>
            <td class="highlight" style="font-weight: bold; font-size: 14px;">Unit_Quantity</td>
            <td class="highlight" style="font-weight: bold; font-size: 14px;">Select Quantity:</td>
            
        </tr>

<?php

print "
<tr>
    <td style='font-size: 12px'>" .$items["product_name"] . "</td>
    <td style='font-size: 12px'>$" .$items["unit_price"]. "</td>
    <td style='font-size: 12px'>" .$items["unit_quantity"]. "</td>
    <td >
        <form name='addProdcut' id='addProduct' action='../product-detail/addToCart.php?product_id=" . $product_id . "' method='post' target='shoppingCartFrame' style='font-size: 18px;margin-top: 5%;'>
            <input type='number' max='20' min='1' name='selected_quantity' value='1' required class='qty' style='font-size: 12px'> 
            <text style='font-size:12px; '> / " . $items["in_stock"] . " available" . " </text>
    </form></td>
</tr>

<tr>
</tr>

";

print "</table>";

print "<center>


<input type='submit' value='Add to cart' class='addToCart-button' form='addProduct'>
</center>
</div>
</body>
</html>";


mysqli_close($connection);endif;