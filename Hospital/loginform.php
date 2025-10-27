<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)
{
    header("Location: HomePage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="loginpagestyle.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <a class="not-registered" href="registrationForm.php">Not Registered?</a>

            <button type="submit">Login</button>

        </form>

        <div class="Home"> 
        <a class="home" href="MainPage.php">Home</a>
        </div>

        <?php
        if (isset($_SESSION['error']))
        {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
    </div>
</body>
</html>
