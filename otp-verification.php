<?php ob_start(); ?>
<?php include_once "connection.php"; ?>
<?php date_default_timezone_set("Asia/Calcutta"); ?>
<?php
session_start(); // Starting Session
$error = "";
// Variable To Store Error Message
//print_r($_SESSION);
if (isset($_SESSION["username"])) {
    header("location: index.php");
}
if (!isset($_SESSION["id"])) {
    header("location: home.php");
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
    <title>Verification</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="_.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header></header>
<div class="container">
<div class="row">
<div class="col-md-6 offset-md-3 mt-3 bg-light p-3 border border-secondary">
<form method="post" id="myformloginotp">
<div class="mb-3">
<label for="exampleInputEmail1">Enter OTP (Check your email)</label>
<input type="password" class="form-control" placeholder="Enter OTP" name="otpverification" id="otpverification" required>
</div>
<div class="mb-3">
<button type="submit" class="btn btn-primary" name="otpsubmit">Submit</button>
</div>
</form>
<form method="post">
<button onclick="javascript:return confirm('Are you sure you want to generate OTP again?');" type="submit" class="btn btn-link" name="otpagaingeneratesubmit">Generate OTP Again</button>
</form>
<?php
$user_id_login = $_SESSION["id"];
$sql = "SELECT * FROM users WHERE id = '$user_id_login'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if (isset($_POST["otpsubmit"])) {
    $otpverification = $_POST["otpverification"];
    if ($row["user_otp_verification"] == $otpverification) {
        $_SESSION["username"] = $row["username"];
        if (isset($_SESSION["username"])) {
            header("location: home.php");
        }
    } else {
         ?>
<br>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>OTP not matching. Check your email again. and enter the correct OTP to log in. </strong> 
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
}
if (isset($_POST["otpagaingeneratesubmit"])) {
    $my_session_user_id = $_SESSION["id"];
    $otp = rand(100000, 999999);
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/Exception.php";
    require "vendor/autoload.php";
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $message = "Dear " . $row["name"] . ",<br><br>";
    $message .= "Validity of this OTP is 10 minutes. Do not share with anyone.<br><br>";
    $message .= "(This is an auto-generated email, so please do not reply back.)<br><br>";
    $message .= "<br><br> Regards, Cinemax Team <br><br>";
    $message .= "CONFIDENTIALITY INFORMATION AND DISCLAIMER: ";
    $message .= "This email message may contain confidential, legally privileged information and is intended solely for the use of the individual to whom it is addressed. If you have erroneously received this message, please delete it immediately. If you are not the intended recipient of the email message you should not disseminate, distribute, or copy this e-mail.<br><br>";
    $message .= "Your one time OTP verification for login is: " . $otp;       
    $sender = "hetworkshard@gmail.com";
    $mail->isSMTP(); 
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = $sender; // SMTP username
    $mail->Password = "igsk jaje sqtm libz"; // SMTP password
    $mail->SMTPSecure = "tls"; 
    $mail->Port = 587;
    $mail->setFrom($sender, "OTP");
    $mail->addAddress($row["username"], $row["username"]);
    $mail->isHTML(true);
    $mail->Subject = "OTP Verification";
    $mail->Body = $message;
    if (!$mail->send()) {
        echo "Message could not be sent.";
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        //echo $otp;
        $currentdatetime = date("Y-m-d H:i:s");
        $sql_otp_update = "UPDATE users SET user_otp_verification = '$otp', user_otp_verification_creation_time = '$currentdatetime' WHERE id = '$my_session_user_id'";
        if (mysqli_query($con, $sql_otp_update)) { ?>
<br>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>Check your email for OTP again.</strong> 
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } else {echo "Error: " . $sql_otp_update . "<br>" . mysqli_error($conn);}
    }
}
mysqli_close($con);
?>
</div>
</div>
</div>
<footer></footer>
    <script src="scripts/jquery-3.3.1.min.js"></script>
    <script src="scripts/owl.carousel.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>
