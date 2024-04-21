<?php
include "config.php";

if (!isset($_GET['id'])) {
    echo "Booking ID not provided!";
    exit();
}

if (isset($_POST['update'])) {
    $fname = $_POST['first'];
    $lname = $_POST['last'];
    $mobile = $_POST['number'];
    $email = $_POST['email'];
    $id = $_GET['id'];
    $update_query = "UPDATE `bookingtable` SET `bookingFName`='$fname', `bookingLName`='$lname', `bookingPNumber`='$mobile', `bookingEmail`='$email' WHERE `bookingID`='$id'";
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        header("Location: view.php");
        exit();
    } else {
        echo "Error updating booking information: " . mysqli_error($con);
    }
} else {
    $id = $_GET['id'];
    $select_query = "SELECT * FROM `bookingtable` WHERE `bookingID`='$id'";
    $select_result = mysqli_query($con, $select_query);
    $booking_data = mysqli_fetch_assoc($select_result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<style>
.admin-container {
    padding: 0px;
}

.container-lg {
    max-width: 1200px;
    margin: 0 auto;
}

.table-responsive {
    overflow-x: auto;

.table-wrapper {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;

.table-title h2 {
    margin-bottom: 20px;
}

.row {
    margin-right: -15px;
    margin-left: -15px;
}

.col-sm-6 {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
    flex: 0 0 50%;
    max-width: 50%;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

</style>
<body>
<?php include('header.php'); ?>
<div class="admin-container">
    <?php include('sidebar.php'); ?>
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Booking <b>Details</b></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <form method="POST">
                            <input type="text" name="first" value="<?php echo $booking_data['bookingFName']; ?>" placeholder="Enter First Name" required>
                            <input type="text" name="last" value="<?php echo $booking_data['bookingLName']; ?>" placeholder="Enter Last Name" required>
                            <input type="text" name="number" value="<?php echo $booking_data['bookingPNumber']; ?>" placeholder="Enter Phone Number" required>
                            <input type="text" name="email" value="<?php echo $booking_data['bookingEmail']; ?>" placeholder="Enter Email" required>
                            <input type="submit" name="update" class="form-btn" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="../scripts/jquery-3.3.1.min.js "></script>
    <script src="../scripts/owl.carousel.min.js "></script>
    <script src="../scripts/script.js "></script>
</body>

</html>
