<?php
session_start();
session_destroy();
setcookie('login', '');
$_SESSION['logout_message'] = "Logout berhasil."; // Add a success message to the session
header("Location: login.php?logout=1");
?>