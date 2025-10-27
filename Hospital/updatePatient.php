<?php
  include("navbar.php");
  // Check if form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $PatientID=$_POST['PatientID'];
    $FName=$_POST['firstName'];
    $LName=$_POST['lastName'];
    $DOB=$_POST['dob'];
    $PhoneNo=$_POST['phoneNo'];
    $Email=$_POST['email'];
    $Gender=$_POST['gender'];
    $Address=$_POST['address'];    

    
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');    
    
    // Prepare an SQL statement
    $stmt = $db->prepare("UPDATE Patient SET 
                          `FName`=:firstName,
                          `LName`=:lastName,
                          `DOB`=:dob,
                          `PhoneNo`=:phoneNo,
                          `Email`=:email,
                          `Gender`=:gender,
                          `Address`=:address
                          WHERE `PatientID`=:patientid
                          ");
    $stmt->bindValue(':patientid', $PatientID, SQLITE3_INTEGER);
    $stmt->bindValue(':firstName', $FName, SQLITE3_TEXT);
    $stmt->bindValue(':lastName', $LName, SQLITE3_TEXT);
    $stmt->bindValue(':dob', $DOB, SQLITE3_TEXT);
    $stmt->bindValue(':phoneNo', $PhoneNo, SQLITE3_TEXT);
    $stmt->bindValue(':email', $Email, SQLITE3_TEXT);
    $stmt->bindValue(':gender', $Gender, SQLITE3_TEXT);
    $stmt->bindValue(':address', $Address, SQLITE3_TEXT);
    

    if($stmt->execute()) {
        header ("Location: viewPatient.php");
        exit();
    } else {
        echo 'Updation failed..';
  }
  $db->close();
}
?>
