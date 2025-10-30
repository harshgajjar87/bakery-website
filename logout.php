<?php
session_start();
$name = $_SESSION['user_name'] ?? 'User';
session_destroy();
session_start();
$_SESSION['success_message'] = "Goodbye, $name! You have successfully logged out.";
header("Location: index.php");
exit;
?>
