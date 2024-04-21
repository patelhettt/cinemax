<?php
session_start(); // Starting Session
if (!isset($_SESSION["username"])) {
    header("location: home.php");
}
?>
<!doctype html>
<html lang="en">
<head>
<title>Dashboard</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>		
<div class="container">
<div class="row">
<div class="col-md-12">
<?php echo "Welcome " .
    $_SESSION[
        "username"
    ]; ?> <a href="logout.php" onclick="javascript:return confirm('Are you sure you want to logout?');">Logout</a>
</div>
</div>
</div>
</body>
</html>