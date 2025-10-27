<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

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

// Prevent the page from being cached
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Past Appointment Patient POV</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
        <?php
            include("navbar.php");           
        ?>
    <div>
        <h2 class="centered-header">List Of Your Past Appointment</h2>
    </div>


    <div>
      <?php
        $db = new SQLite3('HospitalSystem.db');

        $CurrentDate = date('Y-m-d');

        $query = "SELECT AppointmentID, RoomID, PatientID, StaffID, AppointmentTime, AppointmentDate FROM Appointment 
                WHERE PatientID = :patientid AND AppointmentDate < :currentDate 
                ORDER BY AppointmentDate ASC, AppointmentTime ASC";

        $stmt = $db->prepare($query);
        $stmt->bindvalue(':patientid', $patientid, SQLITE3_INTEGER);
        $stmt->bindvalue(':currentDate', $CurrentDate, SQLITE3_TEXT);

        $result = $stmt->execute();

        echo "<table>";
        echo "<tr> <th>Appointment ID</th> <th>Room ID</th> <th>Staff ID</th><th>Appointment Time</th><th>Appointment Date</th> </tr>";

        $hasAppointments = false;
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>
            <td>" . htmlspecialchars($row['AppointmentID']) . "</td>
            <td>" . htmlspecialchars($row['RoomID']) . "</td>
            <td>" . htmlspecialchars($row['StaffID']) . "</td>
            <td>" . htmlspecialchars($row['AppointmentTime']) . "</td>
            <td>" . htmlspecialchars($row['AppointmentDate']) . "</td>
        </tr>";
        }

        echo "</table>";

        if (!$hasAppointments) {
            echo "<p class='centered-header'>No Further Past Appointments Found.</p>";
        }

        $db->close();
     ?>
    
    


    </div>

</body>

</html>