<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: index.php"); // Redirect to index.php after logout
exit();
?>
