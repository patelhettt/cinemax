<?php
include_once "connection.php";
if (isset($_SESSION["username"])) {
    header("location: dashboard.php");
}
if (isset($_SESSION["id"])) {
    header("location: otp-verification.php");
}
?>
<?php date_default_timezone_set("Asia/Calcutta"); ?>
<?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT id, username, name FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result); 
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["id"] = $row["id"];
        $otp = rand(100000, 999999);
        require("PHPMailer/src/PHPMailer.php");
        require("PHPMailer/src/Exception.php");
        require 'vendor/autoload.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $message = "Dear " . $row["name"] . ",<br><br>";
        $message .= "Your one time OTP verification for login is: " . $otp;       
        $message .= "Validity of this OTP is 10 minutes. Do not share with anyone.<br><br>";
        $message .= "(This is an auto-generated email, so please do not reply back.)<br><br>";
        $message .= "<br><br> Regards, Cinemax Team <br><br>";
        $message .= "CONFIDENTIALITY INFORMATION AND DISCLAIMER: ";
        $message .= "This email message may contain confidential, legally privileged information and is intended solely for the use of the individual to whom it is addressed. If you have erroneously received this message, please delete it immediately. If you are not the intended recipient of the email message you should not disseminate, distribute, or copy this e-mail.<br><br>";
        $sender = "hetworkshard@gmail.com";
        $mail->isSMTP(); 
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = $sender;
        $mail->Password = "igsk jaje sqtm libz"; // SMTP password
        $mail->SMTPSecure = "tls"; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to
        $mail->setFrom($sender, "OTP");
        $mail->addAddress($row["username"], $row["username"]); 
        $mail->isHTML(true);
        $mail->Subject = "OTP Verification";
        $mail->Body = $message;
        if (!$mail->send()) {
            echo "Message could not be sent.";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            $currentdatetime = date("Y-m-d H:i:s");
            $sql_otp_update = "UPDATE users SET user_otp_verification = '$otp', user_otp_verification_creation_time = '$currentdatetime' WHERE username = '$username'";
            if (mysqli_query($con, $sql_otp_update)) {
                header("location: otp-verification.php");
                exit(); // Add this line to prevent further execution
            } else {
                echo "Error updating OTP: " . mysqli_error($con);
            }
        }
    } else {
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		?>
		<br>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Record not matching</strong> 
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<?php
		//echo "Record not found";
	}
	
	mysqli_close($con); //close database connection
	
}
?>