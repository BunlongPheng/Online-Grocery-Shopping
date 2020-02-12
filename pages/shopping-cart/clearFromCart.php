<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link href='../shopping-cart/shopping-cart.css' rel="stylesheet" type="text/css"/>
</head>
<body>
<h1>My cart</h1>
<table class="table">
    <tbody>
    <tr>
        
        <td class="highlight"><b>Product</b></td>
        <td class="highlight"><b>Price</b></td>
        <td class="highlight"><b>Quantity</b></td>
        <td class="highlight"><b>Total</b></td>
    </tr>
    <tr><td colspan="5" >Shopping cart is empty.</td></tr>
    <tr style="visibility: hidden">
        <td style="font-weight: bold">Number of products</td>
        <td id="number of products">0</td>
    </tr>

    <tr>
        <td colspan="4" class="topline"></td>
        <td class="topline"><span style="font-weight: bold;"><br>Subtotal: </span><span>$0</span></td>
    </tr>
    </tbody>
</table>


<input type="submit" value="Clear" class="clear-button"
       onclick="{alert('No products!'); return false;}">

<input type="submit" name="submit" value= "Checkout" class="submit-button" onclick="{alert('No products have been added!'); return false;}">

</body>
</html>

<?php

session_start();
session_unset();