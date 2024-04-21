<?php
include "config.php";

// Check user login or not
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
    exit; // Add exit to stop further execution
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
    exit; // Add exit to stop further execution
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $movieID = $_POST['movieID'];
    $hallType = $_POST['hallType'];
    $timing1 = $_POST['timing1'];
    $timing2 = $_POST['timing2'];
    $timing3 = $_POST['timing3'];
    $timing4 = $_POST['timing4'];

    // Check if the connection is successful
    if ($con) {
        // Insert into schedule table
        $sql = "INSERT INTO schedule (movieID, hallType, timing1, timing2, timing3, timing4) 
                VALUES ('$movieID', '$hallType', '$timing1', '$timing2', '$timing3', '$timing4')";

        if (mysqli_query($con, $sql)) {
            // Schedule added successfully, show popup
            echo '<script>alert("Schedule added successfully.");</script>';
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Error: Failed to connect to the database.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Schedule</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    .booking-form-container {
    margin-top: 20px;
}

.schedule-table {
    width: 100%;
}

.schedule-table td {
    padding: 5px;
}

.schedule-table label {
    display: inline-block;
    width: 120px; /* Adjust as needed */
}

.schedule-table select,
.schedule-table input[type="text"],
.schedule-table input[type="time"] {
    width: 200px; /* Adjust as needed */
}

    </style>
</head>
<body>
    <?php include('header.php'); ?>
    
    <div class="admin-container">
        <?php include('sidebar.php'); ?>
        <div class="admin-section admin-section2">
            <div class="admin-section-column">
                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>ADD SCHEDULE</h2>
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                    </div>
                    <div class="booking-form-container">
    <form action="" method="POST">
        <table class="schedule-table">
            <tr>
                <td><label for="movieID">Movie ID:</label></td>
                <td><input type="text" id="movieID" name="movieID" required></td>
            </tr>
            <tr>
                <td><label for="hallType">Hall Type:</label></td>
                <td>
                    <select id="hallType" name="hallType" required>
                        <option value="mainhall">Main Hall</option>
                        <option value="viphall">VIP Hall</option>
                        <option value="privatehall">Private Hall</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="timing1">Timing 1:</label></td>
                <td><input type="time" id="timing1" name="timing1" required></td>
            </tr>
            <tr>
                <td><label for="timing2">Timing 2:</label></td>
                <td><input type="time" id="timing2" name="timing2" required></td>
            </tr>
            <tr>
                <td><label for="timing3">Timing 3:</label></td>
                <td><input type="time" id="timing3" name="timing3" required></td>
            </tr>
            <tr>
                <td><label for="timing4">Timing 4:</label></td>
                <td><input type="time" id="timing4" name="timing4" required></td>
            </tr>
        </table>

        <button type="submit" value="submit" name="submit" class="form-btn">ADD ENTRY</button>
    </form>
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
