<?php

include '../../connection/databaseCon.php';

$product_id = $_GET["product_id"];
$selected_quantity = $_POST["selected_quantity"];

$query_string = "select * from products where product_id = " . $product_id;
$result = mysqli_query($connection, $query_string);
$num_rows = mysqli_num_rows($result);

$items = mysqli_fetch_assoc($result);

$product_name = $items["product_name"];
$product_unit_quantity = $items["unit_quantity"];
$product_unit_price = $items["unit_price"];
$product_total_price = $selected_quantity * $product_unit_price;

$product_detail = array(
    "product_name" => $product_name,
    "product_unit_quantity" => $product_unit_quantity,
    "product_unit_price" => $product_unit_price,
    "selected_quantity" => $selected_quantity,
    "total_price" => $product_total_price
);

session_start();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array($product_id => $product_detail);
} else {
    if (!isset($_SESSION["cart"][$product_id])) {
        // add the product to shopping cart array
        $_SESSION["cart"][$product_id] = $product_detail;
    } else {
        // update the cart if the more products are added
        $_SESSION["cart"][$product_id]["selected_quantity"] += $selected_quantity;
        $_SESSION["cart"][$product_id]["total_price"] += $product_total_price;
    }
}

?>

<!--return cart.html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link href='../product-detail/addToCart.css' rel="stylesheet" type="text/css"/>
</head>
<body>
<h1>Shopping Cart</h1>
<table class="table">
    <tbody>
    <tr style="margin-bottom: 1%;">
        
        <td class="highlight"><b>Product</b></td>
        <td class="highlight"><b>Price</b></td>
        <td class="highlight"><b>Quantity</b></td>
        <td class="highlight"><b>Total</b></td>
    </tr>
    <form id='products' action='../shopping-cart/deleteFromCart.php' target='shoppingCartFrame' method='post'>

        <?php
        $total_quantity = 0;
        $total_price = 0;

        foreach ($_SESSION["cart"] as $product_id => $item) {
            print "  
        <tr>
            
            <td>" . $item["product_name"] . "</td>
            <td>$" . $item["product_unit_price"] . "</td>
            <td>" . $item["selected_quantity"] . "</td>
            <td>$" . $item["total_price"] . "</td>
        </tr>
        <tr>
            <td style='color: gray'>" . $item["product_unit_quantity"] . "</td>
</tr>";
            $total_quantity += $item["selected_quantity"];
            $total_price += $item["total_price"];
            

        }
        ?>

    </form>

    <tr style="margin-top: 1%;">
        <td colspan="4" class="topline"></td>
        <td class="subtotal-text"><span style="font-weight: bold; font-size: 17px "><br>Subtotal: </span><span>$<?php echo $total_price ?></span></td>
    </tr>
    </tbody>
</table>


<input type="submit" value="Clear" class="clear-button" form="clearFromCart"
           onclick="{return confirm('Are you sure you want to clear the shopping cart?')}">

<input type="submit" name="submit" value="Checkout" class="submit-button" form="checkout" onclick="
                const quantity = Number(document.getElementById('number of products').innerHTML);
                if (quantity > 0) {
                    return true;
                } else {
                    alert('No products have been added!');
                    return false;
                }">


<span id="number of products" style="visibility: hidden"><?php echo $total_quantity ?></span>
<form id="clearFromCart" action='../shopping-cart/clearFromCart.php' method="post" target='shoppingCartFrame'></form>
<form id="checkout" action='../checkout/checkout.php' method="post" target='_blank'></form>
</body>
</html>