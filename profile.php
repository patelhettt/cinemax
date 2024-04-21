<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: home.php');
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: home.php");
    exit();
}

include 'connection.php';

$username = $_SESSION['username'];
$query = "SELECT name, booking_count, profile_photo, phone FROM users WHERE username = '$username'";
$result = mysqli_query($con, $query);

if (!$result) {
    echo "Error: " . mysqli_error($con);
} else {
    $row = mysqli_fetch_assoc($result);
    $booking_count = $row['booking_count'];
    $name= $row['name'];
    $profile_photo = $row['profile_photo'];
    $phone = $row['phone'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_name'])) {
        $new_name = $_POST['new_name'];
        $update_query = "UPDATE users SET name = '$new_name' WHERE username = '$username'";
        if (mysqli_query($con, $update_query)) {
            $name = $new_name;
        } else {
            echo "Error updating name: " . mysqli_error($con);
        }
    }

    if (isset($_POST['update_username'])) {
        $new_username = $_POST['new_username'];
        $update_query = "UPDATE users SET username = '$new_username' WHERE username = '$username'";
        if (mysqli_query($con, $update_query)) {
            $_SESSION['username'] = $new_username; // Update session with new username
            $username = $new_username;
        } else {
            echo "Error updating username: " . mysqli_error($con);
        }
    }

    if (isset($_POST['update_phone'])) {
        $new_phone = $_POST['new_phone'];
        $update_query = "UPDATE users SET phone = '$new_phone' WHERE username = '$username'";
        if (mysqli_query($con, $update_query)) {
            $phone = $new_phone;
        } else {
            echo "Error updating phone: " . mysqli_error($con);
        }
    }

    if (isset($_POST['update_password'])) {
        $new_password = $_POST['new_password'];
        $update_query = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
        if (mysqli_query($con, $update_query)) {
            echo "Password updated successfully.";
        } else {
            echo "Error updating password: " . mysqli_error($con);
        }
    }

    if (isset($_FILES['profile_photo'])) {
        $file = $_FILES['profile_photo'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            $filename = uniqid() . '_' . $file['name'];
            $destination = 'uploads/' . $filename;
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $update_query = "UPDATE users SET profile_photo = '$filename' WHERE username = '$username'";
                if (mysqli_query($con, $update_query)) {
                    $profile_photo = $filename;
                } else {
                    echo "Error updating profile photo: " . mysqli_error($con);
                }
            } else {
                echo "Error moving uploaded file to destination.";
            }
        } else {
            echo "Error during file upload: " . $file['error'];
        }
    }
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>User Profile</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 800px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                
            }

            h1 {
                text-align: center;
                color: #333;
            }

            .profile-info {
                margin-top: 30px;
                display: flex;
                align-items: center;
            }

            .profile-info img {
                width: 200px;
                height: 200px;
                border-radius: 10%;
                margin-right: 5px;
                margin-left: 15px;
                margin-bottom: 15px;

            }

            .profile-details {
                flex: 1;
                padding-left: 5%;
            }

            .profile-details p {
                margin: 5px 0; /* Adjusted margin */
                font-size: 18px;
                color: #555;
            }

            .profile-details label {
                font-weight: bold;
            }

            .profile-info .btn-logout {
                display: block;
                width: 100%;
                max-width: 200px;
                margin-top: 20px;
                padding: 10px;
                background-color: #007bff;
                color: #fff;
                text-align: center;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .profile-info .btn-logout:hover {
                background-color: #0056b3;
            }

            .error-message {
                color: red;
                font-weight: bold;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            table, th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            /* Hide the update section by default */
            #update-section {
                display: none;
            }

            /* Update section style */
            #update-section form {
                margin-top: 20px;
            }

            #update-section form input,
            #update-section form button {
                margin-bottom: 10px;
            }

            #update-section table {
                width: 100%;
                border-collapse: collapse;
            }

            #update-section th,
            #update-section td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

            #update-section th {
                text-align: left;
                background-color: #f2f2f2;
            }

            #update-section td input[type="text"],
            #update-section td input[type="email"],
            #update-section td input[type="password"],
            #update-section td input[type="file"] {
                width: 100%;
                padding: 8px;
                box-sizing: border-box;
            }

            #update-section td button {
                padding: 8px 16px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            #update-section td button:hover {
                background-color: #0056b3;
            }
            .btn-upload {
                display: block;
                width: 200px;
                padding: 10px;
                margin: 20px auto;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .btn-upload:hover {
                background-color: #0056b3;
            }

        </style>
    </head>
    <body>
        <header></header>
        <div class="container">
            <h1>User Profile</h1>
            <div class="profile-info" id="profile-section">
            <?php if (!empty($profile_photo)) : ?>
                <img src="uploads/<?php echo $profile_photo; ?>" alt="Profile Photo">
            <?php else : ?>
                <img src="default-profile-photo.jpg" alt="Default Profile Photo">
            <?php endif; ?>
            <div class="profile-details">
                <p><label>Name:</label> <?php echo $name; ?></p>
                <p><label>Email:</label> <?php echo $_SESSION['username']; ?></p>
                <p><label>Phone:</label> <?php echo $phone; ?></p>
                <p><label>Total Lifetime Bookings:</label> <?php echo isset($booking_count) ? $booking_count : 'N/A'; ?></p>
                <a href="logout.php" class="btn-logout">Logout</a>

            </div>
        </div>
            <?php if (isset($_SESSION['bookings'])) : ?>
                <h2>Bookings</h2>
            <?php endif; ?>
        </div>

        <!-- Button to show update section -->
        <button onclick="showUpdateSection()" class="btn-upload" id="btn-upload">Update Information</button>


        <!-- Update section -->
        <div class="container" id="update-section">
        <h2>Update Information</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table>
                <tr>
                    <td><label for="new_name">Change Name:</label></td>
                    <td><input type="text" name="new_name" id="new_name"></td>
                    <td><button type="submit" name="update_name">Update Name</button></td>
                </tr>
                <tr>
                    <td><label for="new_username">Change Email:</label></td>
                    <td><input type="email" name="new_username" id="new_username"></td>
                    <td><button type="submit" name="update_username">Update Email</button></td>
                </tr>
                <tr>
                    <td><label for="new_phone">Change Phone Number:</label></td>
                    <td><input type="text" name="new_phone" id="new_phone"></td>
                    <td><button type="submit" name="update_phone">Update Phone</button></td>
                </tr>
                <tr>
                    <td><label for="new_password">New Password:</label></td>
                    <td><input type="password" name="new_password" id="new_password"></td>
                    <td><button type="submit" name="update_password">Update Password</button></td>
                </tr>
                <tr>
                    <td><label for="profile_photo">Change Profile Photo:</label></td>
                    <td colspan="2">
                        <input type="file" name="profile_photo" id="profile_photo">
                        <button type="submit" class="btn-upload">Upload</button>
                    </td>
                </tr>
                <!-- Repeat for same pattern for other input fields and buttons -->
            </table>
        </form>
    </div>


        <script>
            function showUpdateSection() {
                document.getElementById("btn-upload").style.display = "none";
                document.getElementById("profile-section").style.display = "none";
                document.getElementById("update-section").style.display = "block";
            }
        </script>

        <footer></footer>
        <script src="scripts/jquery-3.3.1.min.js"></script>
        <script src="scripts/owl.carousel.min.js"></script>
        <script src="scripts/script.js"></script>
    </body>
</html>
