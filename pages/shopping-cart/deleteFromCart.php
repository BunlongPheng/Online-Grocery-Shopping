<?php

$products_to_delete = $_POST["delete"];
session_start();
foreach ($products_to_delete as $product_id) {
    unset($_SESSION["cart"][$product_id]);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link href='../shopping-cart/shopping-cart.css' rel="stylesheet" type="text/css"/>
</head>
<body>
<h1>Shopping Cart</h1>
<table class="squeeze-table">
    <tbody>
    <tr style="margin-bottom: 1%;">
        <td class="highlight" style="width:40px"></td>
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
            print "  <!--name array in input. get key of array.-->
        <tr><td><input type='checkbox' name='delete[]' value=" . $product_id . "></td>
            <td>" . $item["product_name"] . "</td>
            <td>$" . $item["product_unit_price"] . "</td>
            <td>" . $item["selected_quantity"] . "</td>
            <td>$" . $item["total_price"] . "</td>
        </tr>
        <tr>
        <td></td>
            <td style='color: grey'>" . $item["product_unit_quantity"] . "</td>
</tr>";
            $total_quantity += $item["selected_quantity"];
            $total_price += $item["total_price"];
        }
        ?>

    </form>

    <tr style="margin-top: 1%;">
        <td colspan="4" class="topline"></td>
        <td class="topline"><span style="font-weight: bold;"><br>Subtotal: </span><span>$<?php echo $total_price ?></span></td>
    </tr>
    </tbody>
</table>



    <input type="submit" value="Clear" class="submit-button" form="clearFromCart"
           onclick="{return confirm('Do you want to clear your shopping cart?')}">

    <input type="submit" name="submit" value="Checkout" class="submit-button" form="checkout" onclick="
                const quantity = Number(document.getElementById('number of products').innerHTML);
                if (quantity > 0) {
                    return true;
                } else {
                    alert('No products!');
                    return false;
                }">

    <span id="number of products" style="visibility: hidden"><?php echo $total_quantity ?></span>

<form id="clearFromCart" action='../shopping-cart/clearFromCart.php' method="post" target='shoppingCartFrame'></form>
<form id="checkout" action='../checkout/checkout.php' method="post" target='_blank'></form>

</body>
</html>
