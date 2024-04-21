<?php
// array of valid coupon codes
$validCoupons = array("HETXASH", "KHANJUDIKRI", "ANSHBABES", "MADANYUVEER", "VRAJAASTHA");

// Check if the submitted coupon code is in the array of valid codes
if (in_array($_POST['coupon_code'], $validCoupons)) {

    echo "valid";

} else if(in_array($_POST['KHANJUDIKRI'], $validCoupons)) {

    echo "KHANJAN WILL PAY THE BILL";

} else if(in_array($_POST['MADANYUVEER'], $validCoupons)) {

    echo "VEER WILL PAY THE BILL";

} else if(in_array($_POST['ANSHBABES'], $validCoupons)) {

    echo "ANSH WILL PAY THE BILL";

} else if(in_array($_POST['MADANYUVEER'], $validCoupons)) {

    echo "VEER WILL PAY THE BILL";

} else if(in_array($_POST['VRAJAASTHA'], $validCoupons)) {

    echo "VRAJ WILL PAY THE BILL";

}

else {

    echo "invalid";

}
?>
