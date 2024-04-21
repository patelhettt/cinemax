<?php
    ob_start();
    include_once('connection.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/styles.css">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="_.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <header></header>
    <div class="container">
    <h1 class="text-center mb-4">Login</h1>

        <div class="row">
            <div class="col-md-6 offset-md-3 mt-3 bg-light p-3 border border-secondary">
                <form method="POST">
                    <div class="mb-3">
                        <label for="Username" class="form-label">Your Username</label>
                        <input type="email" class="form-control" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Your Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                    </div>
                </form>
                <?php include_once('login.php'); ?>
            </div>
        </div>
    </div>
    <footer></footer>
    <script src="scripts/jquery-3.3.1.min.js"></script>
    <script src="scripts/owl.carousel.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>