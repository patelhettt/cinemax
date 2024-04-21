<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
include "connection.php"; // Move database connection-related code to the top

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; 

$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); 
if ($isValidChecksum == "TRUE") {
    echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
    if ($_POST["STATUS"] == "TXN_SUCCESS") {
        echo "<b>Transaction status is success</b>" . "<br/>";

        // Sanitize input
        $t1 = mysqli_real_escape_string($con, $_POST['ORDERID']);
        $t2 = mysqli_real_escape_string($con, $_POST['TXNAMOUNT']);

        // Update database
        $qry = "UPDATE bookingtable SET amount='$t2' WHERE ORDERID='$t1'";
        if (mysqli_query($con, $qry)) {
            // Redirect to receipt page
            header('Location: /reciept.php?id=' . $t1);
            exit;
        } else {
            // Handle database error
            echo "Database error: " . mysqli_error($con);
            // Log the error for debugging
        }
    } else {
        echo "<b>Transaction status is failure</b>" . "<br/>";
        header('Location: /fail.html');
        exit;
    }

    // Output all received parameters
    foreach ($_POST as $paramName => $paramValue) {
        echo "<br/>" . $paramName . " = " . $paramValue;
    }
} else {
    echo "<b>Checksum mismatched.</b>";
}
?>
