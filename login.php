<?php
session_start();
require_once 'connection.php';

// Check if the user is already logged in, redirect to index.php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit();
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = sanitizeData($_POST['email']);
    $password = sanitizeData($_POST['password']);

    $result = login($email, $password);

    if ($result === true) {
        // Login successful, redirect to index.php
        $_SESSION['loggedin'] = true;
        header("Location: index.php");
        exit();
    } else {
        // Login failed, display error message
        $error_message = $result;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Booking.com | Login</title>
</head>
<body>
    <!-- Form box -->
    <div class="form-box">
        <!-- Login and registration forms -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!------------------------------------------------------- Login Page ------------------------------------------------------->
            <div class="container" id="login">
                <div class="top">
                    <span>Don't have an account? <a href="#" onclick="switchForm()">Sign Up</a></span>
                    <header>Login</header>
                </div>
                <div class="input-box">
                    <input type="text" name="email" class="input-field" placeholder="Email">
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" class="input-field" placeholder="Password">
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" name="login" class="submit" value="Sign In">
                </div>
                <div class="error-message"><?php if(isset($error_message)) { echo $error_message; } ?></div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
            </div>
            
            <!------------------------------------------------------- Registration Page ------------------------------------------------------->

            
           
            <div class="container" id="register" style="display: none;">
                <div class="top">
                    <span>Have an account? <a href="#" onclick="switchForm()">Login</a></span>
                    <header>Sign Up</header>
                </div>
                <div class="two-forms">
                    <div class="input-box">
                        <input type="text" name="firstname" class="input-field" placeholder="Firstname">
                        <i class="bx bx-user"></i>
                    </div>
                    <div class="input-box">
                        <input type="text" name="lastname" class="input-field" placeholder="Lastname">
                        <i class="bx bx-user"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input type="text" name="reg_email" class="input-field" placeholder="Email"> <!-- Changed name to 'reg_email' -->
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="reg_password" class="input-field" placeholder="Password"> <!-- Changed name to 'reg_password' -->
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" name="register" class="submit" value="Register">
                </div>
                <div class="error-message"><?php if(isset($error_message)) { echo $error_message; } ?></div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Terms & conditions</a></label>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function switchForm() {
            var loginForm = document.getElementById("login");
            var registerForm = document.getElementById("register");

            if (loginForm.style.display === "block") {
                loginForm.style.display = "none";
                registerForm.style.display = "block";
            } else {
                loginForm.style.display = "block";
                registerForm.style.display = "none";
            }
        }
    </script>
</body>
</html>
