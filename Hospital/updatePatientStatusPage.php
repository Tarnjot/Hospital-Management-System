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
    <title>Update Patient Status</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
  <?php

    include("navbar.php");
    
    $PatientIDParam=isset($_GET['PatientID']) ? $_GET['PatientID'] : '';
    $db = new SQLite3('HospitalSystem.db');
    $stmt = $db->prepare("SELECT * FROM Patient WHERE \"PatientID\" = :PatientID");
    $stmt->bindValue(':PatientID', $PatientIDParam, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $PatientID = $row['PatientID'];
    $FName = $row['FName'];
    $LName = $row['LName'];
    $Gender = $row['Gender'];
    $Status = $row['Status'];
                 
    $db->close();
  ?>
  <div class="main">
    <form action="updatePatientStatus.php" method="post">  
    <label for="PatientID">Patient ID</label>
        <input type="number" id="PatientID" name="PatientID" value="<?php echo $PatientID; ?>" placeholder="<?php echo $PatientID; ?>" readonly>
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $FName; ?>" placeholder="<?php echo $FName; ?>" readonly>
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $LName; ?>" placeholder="<?php echo $LName; ?>" readonly> 
        <label for="gender">Gender</label>
        <input type="text" id="gender" name="gender" value="<?php echo $Gender; ?>" placeholder="<?php echo $Gender; ?>" readonly>
        <label for="status">Status </label>            
        <select type="text" id="status" name="status" value="<?php echo $Status; ?> <?php echo $Status; ?>" required>
            <option value="" disabled selected>Choose Status Of Patient</option>
            <option value="Ongoing">Ongoing</option>
            <option value="Completed">Completed</option>
            <option value="Discharged">Discharged</option>
            <option value="Paused">Paused</option>
        </select>

        <button type="submit">Update Patient Status</button>
    </form>       
    
  </div>    
</body>
</html>