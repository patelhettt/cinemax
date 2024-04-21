<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon" type="image/png" href="img/logo.png">
<link rel="stylesheet" href="style/styles.css">
<title>Our Team</title>
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<script src="_.js"></script>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    text-align: center; /* Center align the content */
    border: 1px solid black;
    padding: 20px;
    border-radius: 10px;
    overflow: hidden;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Responsive grid */
    grid-gap: 30px; /* Add a little gap between grid items */
}

.team-member {
    display: flex;
    flex-direction: column;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
}

.team-member-img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.team-member-details {
    padding: 10px;
}

.team-member-name {
    font-size: 18px;
    margin-bottom: 5px;
}

.team-member-description {
    font-size: 14px;
    color: #666;
}
</style>
</head>
<body>
<header></header>
<div class="container">
    <h1>Our Team</h1>
    <div class="team-grid">
        <div class="team-member">
            <img src="img/11.jpg" class="team-member-img" alt="Het Patel">
            <div class="team-member-details">
                <h3 class="team-member-name">Het Patel</h3>
                <p class="team-member-description">Second Year Student currently pursuing Information Technology at BVM college, Anand.</p>
            </div>
        </div>
        <div class="team-member">
            <img src="img/11.png" class="team-member-img" alt="Veer Vora">
            <div class="team-member-details">
                <h3 class="team-member-name">Veer Vora</h3>
                <p class="team-member-description">Second Year Student currently pursuing Information Technology at BVM college, Anand.</p>
            </div>
        </div>
    </div>
</div>
<footer></footer>
<script src="scripts/jquery-3.3.1.min.js"></script>
<script src="scripts/owl.carousel.min.js"></script>
<script src="scripts/script.js"></script>
</body>
</html>
