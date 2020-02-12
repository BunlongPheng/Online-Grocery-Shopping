<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Delivery Form</title>
    <link href='../checkout/formDelivery.css' rel="stylesheet" type="text/css"/>
    <link href='../shopping-cart/shopping-cart.css' rel="stylesheet" type="text/css">
    <!-- MDUI -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700">
    <link rel="stylesheet" type="text/css" href="../checkout/checkout.css">
</head>
<body>
<?php
$lastName = $_POST['tLName'];
$firstName = $_POST['tFName'];
$address = $_POST['tAddress'];
$suburb = $_POST['tSuburb'];
$state = $_POST['tState'];
$country = $_POST['countries'];
$postcode = $_POST['tPCode'];
$date = date("Y/m/d");
$time = date("h:i:sa");
?>

<div class="confirmation" style="font-size: 18px;">
    <div class="header"><h1>Digital Reciept from E-Grocery Shop</h1></div>
    <br>
    <div class="container">
    <table class="table" style="width: 700px">
        <tbody>
        <tr style="margin-bottom: 1%;">
            <td class="highlight"><b>Product Name</b></td>
            <td class="highlight"><b>Price</b></td>
            <td class="highlight"><b>Quantity</b></td>
            <td class="highlight"><b>Total</b></td>
        </tr>

        <?php
        $total_quantity = 0;
        $total_price = 0;

        foreach ($_SESSION["cart"] as $product_id => $item) {
            print "  <!--name array in input. get key of array.-->
        <tr>
            <td>" . $item["product_name"] . "</td>
            <td>$" . $item["product_unit_price"] . "</td>
            <td>" . $item["selected_quantity"] . "</td>
            <td>$" . $item["total_price"] . "</td>
        </tr>
        <tr>
            <td style='color: grey'>" . $item["product_unit_quantity"] . "</td>
</tr>";
            $total_quantity += $item["selected_quantity"];
            $total_price += $item["total_price"];
        }

        ?>
    <table class="table" style="margin-left: 25%">
        <tr>
            <td>
                Your Name:
            </td>
            <td>
                <?php
                echo $_POST['tFName'];
                echo ' ';
                echo $_POST['tLName'];
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Your Delivery Address:
            </td>
            <td>
                <?php
                echo $_POST['tAddress'];
                echo ', ';
                echo $_POST['tSuburb'];
                echo ', ';
                echo $_POST['tState'];
                echo ', ';
                echo $country;
                echo ', ';
                echo $_POST['tPCode'];
                ?>
            </td>
        </tr>
        <tr>
            <td>
                Your Email Address:
            </td>
            <td>
                <?php echo $_POST['email']; ?>
            </td>
        </tr>
    </table>
    </div>
</div>
<br>


    <?php

    $to = $_POST['email'];
    $subject = "Your order details";

    $message .= "
<h1>This is a confirmation email of your order.</h1>
<h2>Your order details:</h2>";
    $message.="
    <table class=\"squeeze-table\" style=\"width: 700px\">
        <tbody>
        <tr style=\"margin-bottom: 1%;\">
            <td class=\"highlight\"><b>Product</b></td>
            <td class=\"highlight\"><b>Price</b></td>
            <td class=\"highlight\"><b>Quantity</b></td>
            <td class=\"highlight\"><b>Total</b></td>
        </tr>";

    $message.=   " <tr>";
//     if(isset($_SESSION['new'])):
        $total_price = 0;
        $total_quantity = 0;
         foreach ($_SESSION["cart"] as $product_id => $item) :
         $message.= " <td>" . $item["product_name"] . "</td>
            <td>$" . $item["product_unit_price"] . "</td>
            <td>" . $item["selected_quantity"] . "</td>
            <td>$" . $item["total_price"] . "</td>
        </tr>
        <tr>
        <td></td>
            <td style='color: grey'>" . $item["product_unit_quantity"] . "</td>
</tr>";
$total_quantity += $item["selected_quantity"];
            $total_price += $item["total_price"];endforeach;
       $message.=" <tr style='margin-top: 1%;'>
        <td colspan='3' class='topline'></td>
        <td class='topline'><span style='font-weight: bold;'><br>Subtotal: </span><span>$total_price</span></td>
    </tr>
    </tbody>
</table>";

   $message.="<h2>Your Delivery Details:</h2>
<table class=\"squeeze-table\" style=\"width: 700px\">
    <tr>
        <td>Your Name:</td>
        <td>$firstName $lastName</td>
    </tr>
    <tr>
        <td>Address:</td>
        <td>$address</td>
    </tr>
    <tr>
        <td>Suburb:</td>
        <td>$suburb</td>
    </tr>
    <tr>
        <td>State:</td>
        <td>$state</td>
    </tr>
    <tr>
        <td>Country:</td>
        <td>$country</td>
    </tr>
    <tr>
        <td>Postcode:</td>
        <td>$postcode</td>
    </tr>
</table>
<p>$date, $time</p>";


   
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    //// More headers
    $headers .= 'From: <bunlongpheng@gmail.com>' . "\r\n";
    $header .= "Return-Path: <bunlongpheng@gmail.com>\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";

    mail($to, $subject, $message, $headers);
    ?>
</body>
</html>
 <?php session_destroy(); ?>