<?php
session_start();
include "connection.php";

$order_id = $_POST['ORDER_ID'];
$cust_id = $_POST['CUST_ID'];
$txn_amount = $_POST['TXN_AMOUNT'];

$_SESSION['ORDER_ID'] = $order_id;
$_SESSION['CUST_ID'] = $cust_id;
$_SESSION['TXN_AMOUNT'] = $txn_amount;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/styles.css">
    <title>Movie Seat Payment</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="_.js "></script>
</head>
<style>
    body {
        background-color: lightgoldenrodyellow;
    }
    .payment-info {
        text-align: center; 
    }
    .payment-info table {
        border-collapse: collapse;
        width: 70%;
        margin: auto; 
        border-radius: 10px; 
        overflow: hidden; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .payment-info th, .payment-info td {
        padding: 10px;
        border: 1px solid #ddd;
    }
    .payment-info th {
        background-color: #f2f2f2;
    }
    .payment-info img {
        border-radius: 10px;
    }
</style>
<style>
    body {
        background-color: lightgoldenrodyellow; 
    }
</style>
</head>
<body>
<?php include 'includes/header.php'; ?>

<div class="payment-info">
        <p style="font-weight: bold; color: green;">Booking Details Confirmed</p>
        <table>
            <tr>
                <th>Label</th>
                <th>Value</th>
            </tr>
            <tr>
                <td><strong>Order ID:</strong></td>
                <td><?php echo $order_id; ?></td>
            </tr>
            <tr>
                <td><strong>Customer ID:</strong></td>
                <td><?php echo $cust_id; ?></td>
            </tr>
            <tr>
                <td><strong>Transaction Amount:</strong></td>
                <td>$<?php echo $txn_amount; ?></td>
            </tr>
        </table>
    </div>
</div>

<footer></footer>
    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/script.js "></script>
</body>
</html>
