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
    <title>Update Appointment</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
  <?php

    include("navbar.php");
    
    $AppointmentIDParam=isset($_GET['AppointmentID']) ? $_GET['AppointmentID'] : '';
    $db = new SQLite3('HospitalSystem.db');
    $stmt = $db->prepare("SELECT * FROM Appointment WHERE \"AppointmentID\" = :AppointmentID");
    $stmt->bindValue(':AppointmentID', $AppointmentIDParam, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);

    

    $AppointmentID = $row['AppointmentID'];
    $RoomID = $row['RoomID'];
    $PatientID = $row['PatientID'];
    $StaffID = $row['StaffID'];
    $AppointmentTime = $row['AppointmentTime'];
    $AppointmentDate = $row['AppointmentDate'];
    $ExtraNotes = $row['ExtraNotes'];
    if ($AppointmentDate) {
      
      $AppointmentDateFormatted = date("Y-m-d", strtotime($AppointmentDate));
  } else {
      $AppointmentDateFormatted = ''; 
  }             
    $db->close();
  ?>
  <div class="main">
    <form action="updateAppointment.php" method="post">  
    <label for="AppointmentID">Appointment ID</label>
        <input type="number" id="AppointmentID" name="AppointmentID" value="<?php echo $AppointmentID; ?>" placeholder="<?php echo $AppointmentID; ?>" readonly>

        <label for="roomID">Room ID</label>
        <input type="number" id="roomID" name="roomID" value="<?php echo $RoomID; ?>" placeholder="<?php echo $RoomID; ?>" required>

        <label for="patientID">Patient ID</label>
        <input type="number" id="patientID" name="patientID" value="<?php echo $PatientID; ?>" placeholder="<?php echo $PatientID; ?>">

        <label for="staffID">Staff ID</label>
        <input type="number" id="staffID" name="staffID" value="<?php echo $StaffID; ?>" placeholder="<?php echo $StaffID; ?>">

        
        <label for="appointmentTime">Appointment Time</label>
        <select id="appointmentTime" name="appointmentTime" required>
            <option value="">Select a Time</option>
            <option value="09:00" <?php if ($AppointmentTime == "09:00") echo "selected"; ?>>09:00 AM</option>
            <option value="09:30" <?php if ($AppointmentTime == "09:30") echo "selected"; ?>>09:30 AM</option>
            <option value="10:00" <?php if ($AppointmentTime == "10:00") echo "selected"; ?>>10:00 AM</option>
            <option value="10:30" <?php if ($AppointmentTime == "10:30") echo "selected"; ?>>10:30 AM</option>
            <option value="11:00" <?php if ($AppointmentTime == "11:00") echo "selected"; ?>>11:00 AM</option>
            <option value="11:30" <?php if ($AppointmentTime == "11:30") echo "selected"; ?>>11:30 AM</option>
            <option value="12:00" <?php if ($AppointmentTime == "12:00") echo "selected"; ?>>12:00 PM</option>
            <option value="12:30" <?php if ($AppointmentTime == "12:30") echo "selected"; ?>>12:30 PM</option>
            <option value="13:00" <?php if ($AppointmentTime == "13:00") echo "selected"; ?>>01:00 PM</option>
            <option value="13:30" <?php if ($AppointmentTime == "13:30") echo "selected"; ?>>01:30 PM</option>
            <option value="14:00" <?php if ($AppointmentTime == "14:00") echo "selected"; ?>>02:00 PM</option>
            <option value="14:30" <?php if ($AppointmentTime == "14:30") echo "selected"; ?>>02:30 PM</option>
            <option value="15:00" <?php if ($AppointmentTime == "15:00") echo "selected"; ?>>03:00 PM</option>
            <option value="15:30" <?php if ($AppointmentTime == "15:30") echo "selected"; ?>>03:30 PM</option>
            <option value="16:00" <?php if ($AppointmentTime == "16:00") echo "selected"; ?>>04:00 PM</option>
            <option value="16:30" <?php if ($AppointmentTime == "16:30") echo "selected"; ?>>04:30 PM</option>
        </select>
        <label for="AppointmentDate">Appointment Date</label>
        <input type="date" id="AppointmentDate" name="AppointmentDate" value="<?php echo $AppointmentDateFormatted; ?>" required>

        <label for="extraNotes">Extra Notes</label>
        <input type="text" id="extraNotes" name="extraNotes" value="<?php echo $ExtraNotes; ?>" placeholder="<?php echo $ExtraNotes; ?>" required>

           <button type="submit">Update Appointment</button>
    </form>       
    
  </div>    
</body>
</html>