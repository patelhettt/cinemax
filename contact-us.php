<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
    <?php include "connection.php"; ?>
    <header></header>
    <div class="contact-us-container">
        <div class="contact-us-section contact-us-section1">
            <h1>Contact</h1>
            <p>Feel Free to Contact Us</p>
            <form action="" method="POST">
                <input placeholder="First Name" name="fName" required><br>
                <input placeholder="Last Name" name="lName"><br>
                <input placeholder="E-mail Address" name="eMail" required><br>
                <textarea placeholder="Enter your message!" name="feedback" rows="10" cols="30" required></textarea><br>
                <button type="submit" name="submit" value="submit">Send your Message</button>
                <?php
                if (isset($_POST['submit'])) {
                    $insert_query = "INSERT INTO 
                        feedbackTable (senderfName, senderlName, sendereMail, senderfeedback)
                        VALUES ('" . $_POST["fName"] . "', '" . $_POST["lName"] . "', '" . $_POST["eMail"] . "', '" . $_POST["feedback"] . "')";
                    $add = mysqli_query($con, $insert_query);

                    if ($add) {
                        echo "<script>alert('Successfully Submitted');</script>";
                    }
                }
                ?>
            </form>
        </div>
        <div class="contact-us-section contact-us-section2">
            <h1>Address & Info</h1>
            <h3>Phone Numbers</h3>
            <p><a href="tel:9427186300">+91 9427186300</a><br>
                <a href="tel:7485906699">+91 7485906699</a></p>
            <h3>Address</h3>
            <p>B-401, IT BLOCK, BVM</p>
            <h3>E-mail</h3>
            <p><a href="mailto:awesomehet1@gmail.com">awesomehet1@gmail.com</a></p>
        </div>
        <div class="contact-us-section contact-us-section3">
            <h1>Location:</h1>
            <div class="gmap_canvas">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d273.8681362293188!2d72.92366615549047!3d22.552318604462588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e4e74c03b7749%3A0xab364c66fd4834c!2sBirla%20Vishvakarma%20Mahavidyalaya%20(BVM)!5e0!3m2!1sen!2sin!4v1711892173946!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <footer></footer>
    <script src="scripts/jquery-3.3.1.min.js"></script>
    <script src="scripts/owl.carousel.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>
