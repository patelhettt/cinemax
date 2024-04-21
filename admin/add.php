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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Entry</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php
    $link = mysqli_connect("localhost", "root", "", "cinema_db");
    $sql = "SELECT * FROM bookingTable";
    $bookingsNo = mysqli_num_rows(mysqli_query($link, $sql));
    $messagesNo = mysqli_num_rows(mysqli_query($link, "SELECT * FROM feedbackTable"));
    $moviesNo = mysqli_num_rows(mysqli_query($link, "SELECT * FROM movieTable"));
    ?>
    <?php include('header.php'); ?>
    
    <div class="admin-container">
        <?php include('sidebar.php'); ?>
        <div class="admin-section admin-section2">
            <div class="admin-section-column">
                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>ADD ENTRY</h2>
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                    </div>
                    <div class="booking-form-container">
                    <form action="spot.php" method="POST">
    
                        <select name="theatre" required>
                            <option value="" disabled selected>THEATRE</option>
                            <option value="main-hall">Main Hall</option>
                            <option value="vip-hall">VIP Hall</option>
                            <option value="private-hall">Private Hall</option>
                        </select>

                        <select name="type" required>
                            <option value="" disabled selected>TYPE</option>
                            <option value="3d">3D</option>
                            <option value="2d">2D</option>
                            <option value="imax">IMAX</option>
                            <option value="7d">7D</option>
                        </select>

                        <input type="datetime-local" id="datetime" name="datetime"><br><br>


                        <input placeholder="First Name" type="text" name="fName" required>

                        <input placeholder="Last Name" type="text" name="lName">

                        <input placeholder="Phone Number" type="text" name="pNumber" required>
                        <input placeholder="email" type="email" name="email" required>
                        <input placeholder="Movie ID" type="text" name="movie_id">

                        <input placeholder="Amount" type="text" name="cash" required>

                        <button type="submit" value="submit" name="submit" class="form-btn">ADD ENTRY</button>

                    </form>
                </div>
            </div>

        <div class="admin-section-panel admin-section-panel2">
            <div class="admin-panel-section-header">
                <h2>MOVIE TABLE</h2>
                <i class="fas fa-film" style="background-color: #4547cf"></i>
            </div>
            <div class="movie-table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Movie ID</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Duration</th>
                            <th>Release Date</th>
                            <th>Director</th>
                            <th>Actors</th>
                            <th>Vip Hall</th>
                            <th>Private Hall</th>
                            <th>Main Hall</th>
                            <th>Thumbmail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $con = mysqli_connect("localhost", "root", "", "cinema_db");
                        $result = mysqli_query($con, "SELECT * FROM movieTable");
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['movieID'] . "</td>";
                            echo "<td>" . $row['movieTitle'] . "</td>";
                            echo "<td>" . $row['movieGenre'] . "</td>";
                            echo "<td>" . $row['movieDuration'] . "</td>";
                            echo "<td>" . $row['movieRelDate'] . "</td>";
                            echo "<td>" . $row['movieDirector'] . "</td>";
                            echo "<td>" . $row['movieActors'] . "</td>";
                            echo "<td>" . $row['viphall'] . "</td>";
                            echo "<td>" . $row['privatehall'] . "</td>";
                            echo "<td>" . $row['mainhall'] . "</td>";
                            echo "<td>" . $row['movieImg'] . "</td>";
                        
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    

    <script src="../scripts/jquery-3.3.1.min.js "></script>
    <script src="../scripts/owl.carousel.min.js "></script>
    <script src="../scripts/script.js "></script>
</body>

</html>