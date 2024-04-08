<?php
session_start();
require_once 'connection.php';

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $loginText = "Logout"; // Change the login button text to "Logout"
    $loginLink = "logout.php"; // Set the logout link
} else {
    $loginText = "Login"; // Set the login button text to "Login"
    $loginLink = "login.php"; // Set the login link
}
?>

<nav class="navbar navbar-expand-lg">
    <!-- Your existing navbar content -->
    <ul class="navbar-nav ml-auto">
        <!-- Other navbar items -->
        <li class="nav-item">
            <!-- Display login/logout button -->
            <a class="nav-link" href="<?php echo $loginLink; ?>"><?php echo $loginText; ?></a>
        </li>
    </ul>
</nav>
