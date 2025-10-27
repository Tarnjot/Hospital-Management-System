<?php

include("navbar.php");

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $RoomID = $_POST['roomID']; 
    $PatientID = $_POST['patientID'];
    $StaffID = $_POST['staffID'];
    $AppointmentTime = $_POST['appointmentTime'];
    $AppointmentDate = $_POST['appointmentDate'];
    $ExtraNotes = $_POST['extraNotes'];
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');

    // Prepare an SQL statement

$stmt = $db->prepare("INSERT INTO Appointment (RoomID, PatientID, StaffID, AppointmentTime, AppointmentDate, ExtraNotes)
                            VALUES (:roomID, :patientID, :staffID, :appointmentTime, :appointmentDate, :extraNotes)");
$stmt->bindValue(':roomID', $RoomID, SQLITE3_TEXT);
$stmt->bindValue(':patientID', $PatientID, SQLITE3_TEXT);
$stmt->bindValue(':staffID', $StaffID, SQLITE3_TEXT);
$stmt->bindValue(':appointmentTime', $AppointmentTime, SQLITE3_TEXT);
$stmt->bindValue(':appointmentDate', $AppointmentDate, SQLITE3_TEXT);
$stmt->bindValue(':extraNotes', $ExtraNotes, SQLITE3_TEXT);

// Execute the statement and check for success
if ($stmt->execute()) {
echo "Appointment created successfully!";
} else {
echo "Failed to create Appointment record.";
}
$db->close();
}
?>