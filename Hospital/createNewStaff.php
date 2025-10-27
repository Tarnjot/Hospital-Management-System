<?php

include("navbar.php");

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Fname = $_POST['firstName'];
    $LName = $_POST['lastName']; 
    $DOB = $_POST['dob'];
    $PhoneNo = $_POST['phoneNo'];
    $Email = $_POST['email'];
    $Gender = $_POST['gender'];
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');

    // Prepare an SQL statement

$stmt = $db->prepare("INSERT INTO Staff ('Fname', 'LName', 'DOB', 'PhoneNo', 'Email', 'Gender')
                                    VALUES (:firstName, :lastName, :dob, :phoneNo, :email, :gender)");
$stmt->bindValue(':firstName', $Fname, SQLITE3_TEXT);
$stmt->bindValue(':lastName', $LName, SQLITE3_TEXT);
$stmt->bindValue(':dob', $DOB, SQLITE3_TEXT);
$stmt->bindValue(':phoneNo', $PhoneNo, SQLITE3_TEXT);
$stmt->bindValue(':email', $Email, SQLITE3_TEXT);
$stmt->bindValue(':gender', $Gender, SQLITE3_TEXT);

// Execute the statement and check for success
if ($stmt->execute()) {
echo "A new Guest created successfully!";
} else {
echo "Failed to create Guest record.";
}
$db->close();
}
?>