<?php
session_start(); 

// this is simply checking if the user is logged in or not
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginform.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Room</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
    <?php
        include("navbar.php");
    ?>
    <div> <h2 class="centered-header">Create New Room</h2>  </div>
   

    <div class="main">
        <form action="createNewRoom.php" method="post">            
            <input type="text" id="roomType" name="roomType" placeholder="Room Type" required>            
            <input type="text" id="roomCapacity" name="roomCapacity" placeholder="Room Capacity" required> 
         
         <button type="submit">Create Room</button>
        </form>
    </div>

</body>

</html>

