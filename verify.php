<?php
$order = "CINEMAX" . rand(10000, 99999999);
$cust  = "CUST" . rand(1000, 999999);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "connection.php";
    session_start();


    $theatre = $_POST['theatre'];
    $type = $_POST['type'];
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $pNumber = $_POST['pNumber'];
    $email = $_POST['email'];
    $movie_id = $_POST['movie_id'];
    $datetime = $_POST['datetime'];


    $username = $_SESSION['username'];

    // Prepare the SQL statement with a placeholder for the username
    $query = "SELECT usertype FROM users WHERE username = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($con, $query);
    
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $username);
    
    // Execute the statement
    mysqli_stmt_execute($stmt);
    
    // Bind the result variable
    mysqli_stmt_bind_result($stmt, $usertype);
    
    // Fetch the result
    mysqli_stmt_fetch($stmt);
    
    // Close the statement
    mysqli_stmt_close($stmt);

    // Generate booking ID
    $bookingID = "BK" . uniqid();

    // Generate ORDERID
    $orderID = "ORDER" . uniqid();

    // Insert data into the booking table
    $insertQuery = "INSERT INTO bookingtable (bookingID, movieID, bookingTheatre, bookingType, bookingFName, bookingLName, bookingPNumber, bookingEmail, amount, ORDERID, `DATE-TIME`)
    VALUES ('$bookingID', '$movie_id', '$theatre', '$type', '$fName', '$lName', '$pNumber', '$email', 'PAID', '$order', '$datetime')";
    
    if (mysqli_query($con, $insertQuery)) {
        //echo "Booking successful!";
    } else {
        // Error inserting booking
        echo "Error: " . mysqli_error($con);
    }
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/styles.css">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<header></header>
    <div class="container">
        <div class="text-center mt-5">
            <h1>Proceed for Payment</h1>
        </div>
        <form method="post" action="payment.php">
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Label</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td><label>ORDER_ID<span class="text-danger">*</span></label></td>
                    <td>
                        <?php echo $order; ?>
                        <input type="hidden" name="ORDER_ID" value="<?php echo $order; ?>">
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><label>Name</label></td>
                    <td><?php echo $_POST['fName'] . " " . $_POST['lName']; ?></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><label>Website<span class="text-danger">*</span></label></td>
                    <td>CinemaxCinemas</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><label>THEATRE<span class="text-danger">*</span></label></td>
                    <td><?php echo $_POST['theatre']; ?></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><label>TYPE<span class="text-danger">*</span></label></td>
                    <td><?php echo $_POST['type']; ?></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><label>txnAmount*</label></td>
                    <td>
                        <?php
                        if ($theatre == "main-hall") {
                            $ta = 200;
                        } elseif ($theatre == "vip-hall") {
                            $ta = 500;
                        } elseif ($theatre == "private-hall") {
                            $ta = 900;
                        }


                        // Check if the coupon code is valid and apply discount if it is
                        if (isset($_POST['coupon_code'])) { 
                            $ta *= 0.75; // applying 25% discount
                        }

                        ?>
                            <input type="hidden" name="CUST_ID" value="<?php echo $cust; ?>">
                            <input type="hidden" name="INDUSTRY_TYPE_ID" value="retail">
                            <input type="hidden" name="CHANNEL_ID" value="WEB">

                        <input type="text" name="TXN_AMOUNT" value="<?php echo $ta; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td>7</td>
                    <td><label>Discount Code</label></td>
                    <td>
                        <input type="text" name="coupon_code" id="coupon_code">
                        <button type="button" onclick="checkCoupon()">Check</button>
                        <div id="coupon_status"></div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <?php if (isset($_SESSION['usertype']) && $_SESSION['usertype'] === 'admin') { ?>
                            <button type="submit" class="btn btn-danger">Pay Now!</button>
                            <input type="submit" value="CheckOut" class="btn btn-primary">
                        <?php } else { ?>
                            <button type="submit" class="btn btn-danger">Pay Now!</button>
                            <input type="submit" value="CheckOut" class="btn btn-primary">
                        <?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <footer></footer>
    <script>
        function checkCoupon() {
            var couponCode = document.getElementById('coupon_code').value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "coupon.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === "valid") {
                            // Coupon is valid, apply discount
                            var txnAmountInput = document.getElementsByName("TXN_AMOUNT")[0];
                            var originalAmount = parseFloat(txnAmountInput.value);
                            var discountedAmount = originalAmount * 0.75; // Applying 25% discount
                            txnAmountInput.value = discountedAmount.toFixed(2); // Update displayed amount
                            document.getElementById("coupon_status").innerHTML = "Congratulations! Coupon code is valid. Discount applied." ;
                        } else {
                            // Coupon is invalid, do not apply discount
                            document.getElementById("coupon_status").innerHTML = "Coupon code is invalid.";
                        }
                    } else {
                        console.error("Failed to check coupon code.");
                    }
                }
            };
            xhr.send("coupon_code=" + encodeURIComponent(couponCode));
        }
    </script>
    <script src="scripts/jquery-3.3.1.min.js"></script>
    <script src="scripts/owl.carousel.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>
