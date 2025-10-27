<?php
  include("navbar.php");
  // Check if form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $PatientID=$_POST['PatientID'];
    $FName=$_POST['firstName'];
    $LName=$_POST['lastName'];
    $Gender=$_POST['gender'];
    $Status=$_POST['status'];    

    
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');    
    
    // Prepare an SQL statement
    $stmt = $db->prepare("UPDATE Patient SET 
                          `FName`=:firstName,
                          `LName`=:lastName,
                          `Gender`=:gender,
                          `Status`=:status
                          WHERE `PatientID`=:patientid
                          ");
    $stmt->bindValue(':patientid', $PatientID, SQLITE3_INTEGER);
    $stmt->bindValue(':firstName', $FName, SQLITE3_TEXT);
    $stmt->bindValue(':lastName', $LName, SQLITE3_TEXT);
    $stmt->bindValue(':gender', $Gender, SQLITE3_TEXT);
    $stmt->bindValue(':status', $Status, SQLITE3_TEXT);
    

    if($stmt->execute()) {
        header ("Location: viewPatientStatus.php");
        exit();
    } else {
        echo 'Updation failed..';
  }
  $db->close();
}
?>
