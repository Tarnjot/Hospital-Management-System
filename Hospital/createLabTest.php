<?php

include("navbar.php");

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $PatientID = $_POST['patientID'];
    $TestName = $_POST['testName']; 
    $TestDescription = $_POST['testDescription'];
    $TestDate = $_POST['testDate'];
    $TestStatus = $_POST['testStatus'];
    $TestResult = $_POST['testResult'];
    $TestComment = $_POST['testComment'];
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');

    // Prepare an SQL statement

$stmt = $db->prepare("INSERT INTO LabTests ('PatientID', 'TestName', 'TestDescription', 'TestDate', 'TestStatus', 'TestResult', 'TestComment')
                                    VALUES (:patientID, :testName, :testDescription, :testDate, :testStatus, :testResult, :testComment)");
$stmt->bindValue(':patientID', $PatientID, SQLITE3_TEXT);
$stmt->bindValue(':testName', $TestName, SQLITE3_TEXT);
$stmt->bindValue(':testDescription', $TestDescription, SQLITE3_TEXT);
$stmt->bindValue(':testDate', $TestDate, SQLITE3_TEXT);
$stmt->bindValue(':testStatus', $TestStatus, SQLITE3_TEXT);
$stmt->bindValue(':testResult', $TestResult, SQLITE3_TEXT);
$stmt->bindValue(':testComment', $TestComment, SQLITE3_TEXT);

// Execute the statement and check for success
if ($stmt->execute()) {
echo "A new lab test created successfully!";
} else {
echo "Failed to create lab test record.";
}
$db->close();
}
?>