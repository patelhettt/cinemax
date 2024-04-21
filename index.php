<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
        crossorigin="anonymous">
    <title>Cinemax Cinema</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <script src="_.js "></script>
    <style>
        .movie-grid-horizontal {
            display: flex;
            overflow-x: auto;
            gap:10px;
        }

        .movie-box {
            flex: 0 0 auto;
            margin-right: 20px;
        }

        .movie-box img {
            height: 300px;
            width: auto;
        }

        .movie-info {
            display: none;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 10px;
        }

        .movie-box:hover .movie-info {
            display: block;
        }

        .book-seats {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        .movie-show-container {
            margin-top: 0;
            padding: 0 10%;
        }

        .movie-show-container > h1 {
            color: #6e5a11;
            text-align: left;
            padding: 0 0 10px 0;
        }

        .movie-show-container > h3 {
            color: #969696;
            text-align: left;
            padding: 0 0 10px 0;
        }

        .movie-show-container > h3:after {
            content: "";
            display: block;
            height: 3px;
            width: 7%;
            background: #6e5a11;
            position: relative;
            bottom: -10px;
        }

        .movies-container {
            display: grid;
            grid-column-gap: 20px; /* Adjust spacing between movies */
            grid-template-columns: auto auto auto auto auto auto;
            padding: 10px 0;
        }

        .movie-box {
            position: relative;
            margin: 10px 0;
        }

        .movie-box img {
            display: block;
            height: 100%;
            width: 100%;
        }

        .movie-box .movie-info {
            padding: 50% 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: 0.7s ease;
            background-color: rgb(0, 0, 0);
        }

        .movie-box:hover .movie-info {
            opacity: 0.8;
        }

        .movie-info > h3 {
            padding: 10px 0;
            color: #fff;
        }

        .movies-container {
          display: grid;
          grid-column-gap: 10px;
          grid-template-columns: auto auto auto auto auto auto;
          padding: 10px 0;
        }

        .movie-info > a {
            display: inline-block;
            padding: 0.35em 1.2em;
            border: 0.1em solid #ffffff;
            border-radius: 0.13em;
            box-sizing: border-box;
            text-decoration: none;
            font-weight: 300;
            color: #ffffff;
            text-align: center;
            transition: all 0.2s;
        }

        .movie-info > a:hover {
            color: #000000;
            background-color: #ffffff;
        }

    </style>
</head>

<body>
    <?php
    include "connection.php";
    $sql = "SELECT * FROM movieTable";
    ?>
    <header></header>
    <div id="home-section-1" class="movie-show-container">
        <h1>Currently Showing</h1>
        <h3>Book a movie now</h3>

        <div class="movies-container">
            <div class="movie-grid-horizontal">
                <?php
                $sql = "SELECT * FROM movietable";
                if ($result = mysqli_query($con, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="movie-box">';
                            echo '<img src="' . $row['movieImg'] . '" alt="' . $row['movieTitle'] . '">';
                            echo '<div class="movie-info">';
                            echo '<h3>' . $row['movieTitle'] . '</h3>';
                            echo '<a href="booking.php?id=' . $row['movieID'] . '" class="book-seats"><i class="fas fa-ticket-alt"></i> Book a seat</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="no-booking">';
                        echo '<h4>No Booking to our movies right now</h4>';
                        echo '</div>';
                    }
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
                }

                // Close connection
                mysqli_close($con);
                ?>
            </div>
        </div>

    </div>

    <div id="home-section-2" class="services-section">
        <h1>How it works</h1>
        <h3>3 Simple steps to book your favorite movie!</h3>

        <div class="services-container">
            <div class="service-item">
                <div class="service-item-icon">
                    <i class="fas fa-4x fa-video"></i>
                </div>
                <h2>1. Choose your favorite movie</h2>
            </div>
            <div class="service-item">
                <div class="service-item-icon">
                    <i class="fas fa-4x fa-credit-card"></i>
                </div>
                <h2>2. Pay for your tickets</h2>
            </div>
            <div class="service-item">
                <div class="service-item-icon">
                    <i class="fas fa-4x fa-theater-masks"></i>
                </div>
                <h2>3. Pick your seats & Enjoy watching</h2>
            </div>
            <div class="service-item"></div>
            <div class="service-item"></div>
        </div>
    </div>
    <div id="home-section-3" class="trailers-section">
        <h1 class="section-title">Explore new movies</h1>
        <h3>Now showing</h3>
        <div class="trailers-grid">
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-1.jpg" alt="">
                <div class="trailer-item-info" data-video="3AuB8RTfBJc?si=xCSz7uePyVsUcC0C">
                    <h3>Yodha</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-2.jpg" alt="">
                <div class="trailer-item-info" data-video="Yxe-mIVIwM4">
                    <h3>Shaaitan</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-3.jpg" alt="">
                <div class="trailer-item-info" data-video="3uvfq4Cu8R8">
                    <h3>Crew</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-4.jpg" alt="">
                <div class="trailer-item-info" data-video="qqrpMRDuPfc">
                    <h3>Godzilla x Kong</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-5.jpg" alt="">
                <div class="trailer-item-info" data-video="_inKs4eeHiI">
                    <h3>Kung fu Panda 4</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
            <div class="trailers-grid-item">
                <img src="img/movie-thumb-6.jpg" alt="">
                <div class="trailer-item-info" data-video="B7VP47oCZfE">
                    <h3>Madgoan Express</h3>
                    <i class="far fa-3x fa-play-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <footer></footer>

    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/script.js "></script>
</body>

</html>
