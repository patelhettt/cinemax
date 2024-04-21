<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/styles.css">
    <title>Schedule</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="_.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

.movie-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

.movie {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.movie h2 {
    margin-top: 0;
    font-size: 18px;
    margin-bottom: 10px;
}

.movie p {
    margin-bottom: 0;
    color: #777;
}

.movie img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 10px;
}

form {
    margin-top: 20px;
    text-align: center;
}

form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

form input[type="date"] {
    margin-bottom: 10px;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

form button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #0056b3;
}

footer {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}

</style>
</head>
<body>
    <header></header>
    <div style="text-align: center; margin-top: 20px;">
        <form action="" method="GET">
            <label for="search_date">Select Date:</label>
            <input type="date" id="search_date" name="date" required>
            <button type="submit">Search</button>
        </form>
    </div>
    <?php
    // Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cinema_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get current date from header
    $date = $_GET['date'] ?? ''; // Get date from URL parameter

    if ($date === '') {
        // Default to 31/03/2024
        $date = date('2024-03-31');
    }

    $sql = "SELECT * FROM movietable WHERE movieRelDate = '$date'";
    $result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<div class='movie-grid'>";
    while($row = $result->fetch_assoc()) {
        $movieID = $row["movieID"]; 
        echo "<div class='movie'>";
        echo "<img src='" . $row["movieImg"] . "' alt='" . $row["movieTitle"] . "'>";
        echo "<h2>" . $row["movieTitle"] . "</h2><br>";
        echo "<p>" . $row["movieGenre"] . "</p><br>";
        echo "<div class='hall-timings'>";
        echo "<h3>Schedule in Cinema<br></h3>";
        
        $scheduleSql = "SELECT * FROM schedule WHERE movieID = '$movieID'";
        $scheduleResult = $conn->query($scheduleSql);
        if ($scheduleResult->num_rows > 0) {
            while ($scheduleRow = $scheduleResult->fetch_assoc()) {
                echo "<div class='hall-type'>";
                echo "<h4>" . $scheduleRow["hallType"] . "</h4>";
                echo "<ul>";
                echo "<br><li>" . date("h:i A", strtotime($scheduleRow["timing1"])) . "</li><br>";
                echo "<li>" . date("h:i A", strtotime($scheduleRow["timing2"])) . "</li><br>";
                echo "<br><li>" . date("h:i A", strtotime($scheduleRow["timing3"])) . "</li><br>";
                echo "<li>" . date("h:i A", strtotime($scheduleRow["timing4"])) . "</li><br>";
                echo "</ul>";
                echo "</div>";
            }
        } else {
            echo "No schedule available";
        }
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "0 results";
}
$conn->close();
?>
    <footer></footer>
    <script src="scripts/jquery-3.3.1.min.js"></script>
    <script src="scripts/owl.carousel.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>
