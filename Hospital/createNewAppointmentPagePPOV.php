<?php
session_start(); 

// this is simply checking if the user is logged in or not
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginform.php"); 
    exit;
}

$patientid = $_SESSION['patient_id'];

if (!$patientid) {
    echo "No Patient ID found. You might not be logged in as a patient.";
    exit;
}

$db = new SQLite3('HospitalSystem.db');

$staffQuery = "SELECT StaffID FROM Staff ORDER BY RANDOM() LIMIT 1";
$staffResult = $db->query($staffQuery);
$staffID = '';
if ($staffResult) {
    $staffRow = $staffResult->fetchArray(SQLITE3_ASSOC);
    $staffID = $staffRow['StaffID'];
}

$roomQuery = "SELECT RoomID FROM Room ORDER BY RANDOM() LIMIT 1";
$roomResult = $db->query($roomQuery);
$roomID = '';
if ($roomResult) {
    $roomRow = $roomResult->fetchArray(SQLITE3_ASSOC);
    $roomID = $roomRow['RoomID'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Appointment Patient POV</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
    <?php
        include("navbar.php");
    ?>
    <div> <h2 class="centered-header">Create New Appointment</h2>  </div>
   

    <div class="main">
        <form action="createNewAppointmentPPOV.php" method="post">
            <label for="roomID">Room ID</label>
            <input type="text" id="roomID" name="roomID" placeholder="Room ID" value="<?php echo htmlspecialchars($roomID); ?>" readonly>
            <label for="patientID">Patient ID</label>                          
            <input type="text" id="patientID" name="patientID" placeholder="Patient ID" value="<?php echo htmlspecialchars($patientid); ?>" readonly required>
            <label for="staffID">Staff ID</label>
            <input type="text" id="staffID" name="staffID" placeholder="Staff ID" value="<?php echo htmlspecialchars($staffID); ?>" readonly>            
            <label for="appointmentTime">Appointment Time</label>
            <select id="appointmentTime" name="appointmentTime" required>
                <option value="">Select a Time</option>
                <option value="09:00">09:00 AM</option>
                <option value="09:30">09:30 AM</option>
                <option value="10:00">10:00 AM</option>
                <option value="10:30">10:30 AM</option>
                <option value="11:00">11:00 AM</option>
                <option value="11:30">11:30 AM</option>
                <option value="12:00">12:00 PM</option>
                <option value="12:30">12:30 PM</option>
                <option value="13:00">01:00 PM</option>
                <option value="13:30">01:30 PM</option>
                <option value="14:00">02:00 PM</option>
                <option value="14:30">02:30 PM</option>
                <option value="15:00">03:00 PM</option>
                <option value="15:30">03:30 PM</option>
                <option value="16:00">04:00 PM</option>
                <option value="16:30">04:30 PM</option>
            </select>
            <label for="appointmentDate">Appointment Date</label>            
            <input type="date" id="appointmentDate" name="appointmentDate" required>
            <input type="text" id="reason" name="reason" placeholder="Reason For Appointment">            
            
            <script>

                var today = new Date().toISOString().split('T')[0];
                document.getElementById("appointmentDate").setAttribute("min", today);
                document.getElementById("appointmentDate").setAttribute("max", "9999-12-31");
            </script>
         
         <button type="submit">Create Appointment</button>
        </form>
    </div>

</body>

</html>


</body>
</html>