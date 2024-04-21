<?php
include "connection.php";

if (!isset($_POST['ORDER_ID']) || !isset($_POST['CUST_ID']) || !isset($_POST['TXN_AMOUNT'])) {
    echo "<script>alert('You are not supposed to come here directly.'); window.location.href='index.php';</script>";
    exit;
}

$order_id = $_POST['ORDER_ID'];
$cust_id = $_POST['CUST_ID'];
$txn_amount = $_POST['TXN_AMOUNT'];
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
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 40vh;
        margin-bottom: 130px;
    }

    .payment-table {
        width: 400px;
        border-collapse: collapse;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        margin-left: 50px;

    }

    .payment-table th,
    .payment-table td {
        padding: 20px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .payment-table th {
        background-color: #f2f2f2;
    }

    .payment-table td {
        background-color: #fff;
    }

    .payment-options {
        margin-top: 20px;
        margin-bottom: 30px;
        margin-left: 50px;

    }

    .payment-options h3 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .payment-options input[type="radio"] {
        margin-right: 10px;
    }

    .payment-options input[type="submit"] {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .payment-options input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
    <h2>Payment Details</h2>
    <div class="payment-info">
        <table class="payment-table">
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
            <tr>
                <td><strong>UPI QR Code:</strong></td>
                <td><img src="img\upi_qr_code.png" alt="UPI QR Code" style="width: 200px; height: 200px;"></td> <!-- Replace "upi_qr_code.png" with the actual filename of your QR code image -->
            </tr>
        </table>

        <div class="payment-options">
            <h3>Select Payment Method:</h3>
            <form action="process_payment.php" method="post">
                <input type="hidden" name="ORDER_ID" value="<?php echo $order_id; ?>">
                <input type="hidden" name="CUST_ID" value="<?php echo $cust_id; ?>">
                <input type="hidden" name="TXN_AMOUNT" value="<?php echo $txn_amount; ?>">

                <input type="radio" id="credit_card" name="payment_method" value="Credit Card" checked>
                <label for="credit_card">Credit Card</label><br>

                <input type="radio" id="paypal" name="payment_method" value="PayPal">
                <label for="paypal">PayPal</label><br>

                <input type="radio" id="upi" name="payment_method" value="upi">
                <label for="upi">UPI</label><br><br>

                <input type="submit" value="Proceed to Payment">
            </form>
        </div>
    </div>
</div>
<footer></footer>
    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/script.js "></script>
</body>
</html>
