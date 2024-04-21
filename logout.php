<?php
session_start();
?>
<?php
if(isset($_SESSION['username'])){
//Remove all session variables
session_unset();
// destroy the session
session_destroy();  
header("location: home.php");
}else{
header("location: home.php");
}
?>