<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cinema_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $usertype = $_POST['usertype'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $phone = $_POST['phone'];
    $profile_photo = isset($_FILES['profile_photo']['name']) ? $_FILES['profile_photo']['name'] : '';
    $tmp_name = isset($_FILES['profile_photo']['tmp_name']) ? $_FILES['profile_photo']['tmp_name'] : '';

    if (!empty($profile_photo)) {
        move_uploaded_file($tmp_name, "uploads/$profile_photo");
    }

    $sql = "INSERT INTO users (usertype, name, username, password, profile_photo, phone)
    VALUES ('$usertype', '$uname', '$email', '$pwd', '$profile_photo', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
?>
<?php
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/styles.css">
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <script src="_.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
    }

    table tr {
        margin-bottom: 20px;
    }

    table td {
        padding: 10px;
    }

    table input[type="text"],
    table input[type="email"],
    table input[type="password"],
    table select,
    table input[type="file"],
    table input[type="submit"] {
        width: calc(100% - 6px);
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    table input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin-top: 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    table input[type="submit"]:hover {
        background-color: #45a049;
    }

</style>
</head>
<body>
    <header></header>
<div class="container">
    <h2>Signup Form</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="usertype">User Type:</label></td>
                <td>
                    <select id="usertype" name="usertype">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="uname">Username:</label></td>
                <td><input type="text" id="uname" name="uname"></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email"></td>
            </tr>
            <tr>
                <td><label for="phone">Phone number:</label></td>
                <td><input type="text" id="phone" name="phone"></td>
            </tr>
            <tr>
                <td><label for="pwd">Password:</label></td>
                <td><input type="password" id="pwd" name="pwd"></td>
            </tr>
            <tr>
                <td><label for="profile_photo">Profile Photo:</label></td>
                <td><input type="file" id="profile_photo" name="profile_photo"></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Submit"></td>
            </tr>
            <tr>
                <td><a href="home.php">Already a Cinemax Member? Login Here !</a></td>
            </tr>
        </table>
    </form>
</div>
<footer></footer>
    <script src="scripts/jquery-3.3.1.min.js"></script>
    <script src="scripts/owl.carousel.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>
