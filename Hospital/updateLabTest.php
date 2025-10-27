<?php
  include("navbar.php");
  // Check if form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $LabTestID=$_POST['LabTestID'];
    $PatientID=$_POST['patientID'];
    $TestName=$_POST['testName'];
    $TestDescription=$_POST['testDescription'];
    $TestDate=$_POST['testDate'];
    $TestStatus=$_POST['testStatus'];
    $TestResult=$_POST['testResult'];
    $TestComment=$_POST['testComment'];

    
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');    
    
    // Prepare an SQL statement
    $stmt = $db->prepare("UPDATE LabTests SET 
                          `PatientID`=:patientID,
                          `TestName`=:testName,
                          `TestDescription`=:testDescription,
                          `TestDate`=:testDate,
                          `TestStatus`=:testStatus,
                          `TestResult`=:testResult,
                          `TestComment`=:testComment
                          WHERE `LabTestID`=:LabTestID
                          ");
    $stmt->bindValue(':patientID', $PatientID, SQLITE3_INTEGER);
    $stmt->bindValue(':testName', $TestName, SQLITE3_TEXT);
    $stmt->bindValue(':testDescription', $TestDescription, SQLITE3_TEXT);
    $stmt->bindValue(':testDate', $TestDate, SQLITE3_TEXT);
    $stmt->bindValue(':testStatus', $TestStatus, SQLITE3_TEXT);
    $stmt->bindValue(':testResult', $TestResult, SQLITE3_TEXT);
    $stmt->bindValue(':testComment', $TestComment, SQLITE3_TEXT);
    

    if($stmt->execute()) {
        header ("Location: viewLabTest.php");
        exit();
    } else {
        echo 'Updation failed..';
  }
  $db->close();
}
?>
