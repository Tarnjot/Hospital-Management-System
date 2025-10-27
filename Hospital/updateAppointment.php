<?php
  include("navbar.php");
  // Check if form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $AppointmentID=$_POST['AppointmentID'];
    $RoomID=$_POST['roomID'];
    $PatientID=$_POST['patientID'];
    $StaffID=$_POST['staffID'];
    $AppointmentTime=$_POST['appointmentTime'];
    $AppointmentDate=$_POST['AppointmentDate'];
    $ExtraNotes=$_POST['extraNotes'];  

    
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');    
    
    // Prepare an SQL statement
    $stmt = $db->prepare("UPDATE Appointment SET 
                          `RoomID`=:roomID,
                          `PatientID`=:patientID,
                          `StaffID`=:staffID,
                          `AppointmentTime`=:appointmentTime,
                          `AppointmentDate`=:AppointmentDate,
                          `ExtraNotes`=:extraNotes
                          WHERE `AppointmentID`=:appointmentID
                          ");
    $stmt->bindValue(':appointmentID', $AppointmentID, SQLITE3_INTEGER);
    $stmt->bindValue(':roomID', $RoomID, SQLITE3_TEXT);
    $stmt->bindValue(':patientID', $PatientID, SQLITE3_TEXT);
    $stmt->bindValue(':staffID', $StaffID, SQLITE3_TEXT);
    $stmt->bindValue(':appointmentTime', $AppointmentTime, SQLITE3_TEXT);
    $stmt->bindValue(':AppointmentDate', $AppointmentDate, SQLITE3_TEXT);
    $stmt->bindValue(':extraNotes', $ExtraNotes, SQLITE3_TEXT);
    

    if($stmt->execute()) {
      header ("Location: viewAppointment.php");
      exit();
  } else {
      echo 'Updation failed..';
}
$db->close();
  }
?>
