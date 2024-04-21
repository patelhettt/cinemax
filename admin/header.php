<?php

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}

?>
<div class="admin-section-header">
    <div class="admin-logo">
        Cinemax Cinema
    </div>
    <div class="admin-login-info">
        <div style="padding: 0 20px;">
            <h2><a href="admin.php">Admin Panel</a></h2>
        </div>
        <form method='post' action="">
            <input type="submit" value="Logout" class="btn btn-outline-warning" name="but_logout">
        </form>
        <img class="admin-user-avatar" src="../img/avatar.png" alt="">
    </div>
</div>