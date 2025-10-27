<?php
session_start(); 

// this is simply checking if the user is logged in or not
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginform.php"); 
    exit;
}

//getting the occupation from the session
$occupation = $_SESSION['occupation'];
$username = $_SESSION['username']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="loginstyle.css" />
    <style>
        h1
            {
            font-size: 36px;
            color:rgb(0, 0, 0);
            text-align: center;
            margin-top: 50px;
            font-family: Arial, sans-serif;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2
            {
            font-size: 36px;
            color:rgb(0, 0, 0);
            text-align: center;
            margin-top: 100px;
            font-family: Arial, sans-serif;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
</style>
</head>

<body>
    <?php
        include("navbar.php");
    ?>
    <?php if ($occupation === 'Patient'): ?>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <?php else: ?>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <?php endif; ?>

    <h2>Welcome To Hospital Management Website!</h2>

    <footer>
            <div class=firstfooter>
                &copy; Tarnjot Singh
            </div>
    </footer>
</body>

</html>

