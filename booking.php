<?php
// Start the session
session_start();

// Check if session ID exists
if (!isset($_SESSION['username'])) {
    // Redirect to signup.php if session ID doesn't exist
    header("Location: signup.php");
    exit; // Make sure to exit after redirection
}
?>

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
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

.booking-container {
    max-width: 800px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.booking-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.booking-header h1 {
    font-size: 24px;
    color: #333;
}

.close-btn {
    background: none;
    border: none;
    font-size: 24px;
    color: #333;
    cursor: pointer;
}

.movie-details {
    display: flex;
    margin-bottom: 20px;
}

.movie-image img {
    width: 200px;
    border-radius: 5px;
}

.movie-info {
    margin-left: 20px;
}

.movie-info h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.info-table {
    border-collapse: collapse;
    margin-bottom: 20px;
}

.info-row {
    display: table-row;
    margin-bottom: 20px;
}

.info-label {
    font-weight: bold;
    margin-right: 10px;
}

.info-value {
    color: #666;
}

.booking-form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
}

.reservation-form select,
.reservation-form input[type="text"],
.reservation-form input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.reservation-form select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
    background-repeat: no-repeat;
    background-position-x: calc(100% - 10px);
    background-position-y: center;
    padding-right: 30px;
}

.reservation-form button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.reservation-form button:hover {
    background-color: #555;
}

.reservation-form button {
    margin-top: 10px;
}
.form-input {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 10px; /* Add some bottom margin for spacing */
    font-size: 16px; /* Adjust font size as needed */
}

.form-input:focus {
    outline: none;
    border-color: #007bff; /* Change border color on focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add a subtle shadow on focus */
}


    </style>
</head>

<body>
    <header></header>
    <div class="booking-container">
        <div class="booking-header">
            <h1>RESERVE YOUR TICKET</h1>
            <button class="close-btn" onclick="window.history.go(-1); return false;"><i class="fas fa-times"></i></button>
        </div>
        <?php
        // Fetch movie details
        $row = null;
        if (isset($_GET['id'])) {
            include "connection.php";
            $id = $_GET['id'];
            $movieQuery = "SELECT * FROM movieTable WHERE movieID = $id";
            $movieImageById = mysqli_query($con, $movieQuery);
            $row = mysqli_fetch_array($movieImageById);
        }
        ?>
        <div class="movie-details">
            <?php if ($row) : ?>
                <div class="movie-image">
                    <img src="<?php echo $row['movieImg']; ?>" alt="<?php echo $row['movieTitle']; ?>">
                </div>
                <div class="movie-info">
                    <h2><?php echo $row['movieTitle']; ?></h2> <br>
                    <div class="info-table">
                        <div class="info-row">
                            <span class="info-label">GENRE:</span>
                            <span class="info-value"><?php echo $row['movieGenre']; ?></span>
                        </div>
                        <br>
                        <div class="info-row">
                            <span class="info-label">DURATION:</span>
                            <span class="info-value"><?php echo $row['movieDuration']; ?></span>
                        </div>
                        <br>
                        <div class="info-row">
                            <span class="info-label">RELEASE DATE:</span>
                            <span class="info-value"><?php echo $row['movieRelDate']; ?></span>
                        </div>
                        <br>
                        <div class="info-row">
                            <span class="info-label">DIRECTOR:</span>
                            <span class="info-value"><?php echo $row['movieDirector']; ?></span>
                        </div>
                        <br>
                        <div class="info-row">
                            <span class="info-label">ACTORS:</span>
                            <span class="info-value"><?php echo $row['movieActors']; ?></span>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <p>No movie details found.</p>
            <?php endif; ?>
        </div>
        <div class="booking-form">
    <form action="verify.php" method="POST" class="reservation-form">
        <select name="theatre" required class="form-select">
            <option value="" disabled selected>THEATRE</option>
            <option value="main-hall">Main Hall</option>
            <option value="vip-hall">VIP Hall</option>
            <option value="private-hall">Private Hall</option>
        </select>

        <select name="type" required class="form-select">
            <option value="" disabled selected>TYPE</option>
            <option value="3d">3D</option>
            <option value="2d">2D</option>
            <option value="imax">IMAX</option>
            <option value="7d">7D</option>
        </select>

        <div class="form-group">
            <label for="datetime">Date and Time:</label><br>
            <input type="datetime-local" id="datetime" name="datetime" required class="form-input">
        </div>

        
        <input placeholder="First Name" type="text" name="fName" required class="form-input">
        <input placeholder="Last Name" type="text" name="lName" class="form-input">
        <input placeholder="Phone Number" type="text" name="pNumber" required class="form-input">
        <input placeholder="email" type="email" name="email" required class="form-input">
        <input type="hidden" name="movie_id" value="<?php echo $id; ?>">
        
        <button type="submit" value="save" name="submit" class="form-btn">Book a seat</button>
    </form>
</div>

    </div>
    <footer></footer>
    <script src="scripts/jquery-3.3.1.min.js"></script>
    <script src="scripts/owl.carousel.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>