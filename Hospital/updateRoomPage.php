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
    <title>Update Room</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
  <?php

    include("navbar.php");
    
    $RoomIDParam=isset($_GET['RoomID']) ? $_GET['RoomID'] : '';
    $db = new SQLite3('HospitalSystem.db');
    $stmt = $db->prepare("SELECT * FROM Room WHERE \"RoomID\" = :RoomID");
    $stmt->bindValue(':RoomID', $RoomIDParam, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $RoomID = $row['RoomID'];
    $RoomType = $row['RoomType'];
    $RoomCapacity = $row['RoomCapacity'];
                 
    $db->close();
  ?>
  <div class="main">
    <form action="updateRoom.php" method="post">  
    <label for="RoomID">Patient ID</label>
        <input type="number" id="RoomID" name="RoomID" value="<?php echo $RoomID; ?>" placeholder="<?php echo $RoomID; ?>" readonly>

        <label for="roomType">Room Type</label>
        <input type="text" id="roomType" name="roomType" value="<?php echo $RoomType; ?>" placeholder="<?php echo $RoomType; ?>" required>

        <label for="roomCapacity">Room Capacity</label>
        <input type="number" id="roomCapacity" name="roomCapacity" value="<?php echo $RoomCapacity; ?>" placeholder="<?php echo $RoomCapacity; ?>">

           <button type="submit">Update Room</button>
    </form>       
    
  </div>    
</body>
</html>