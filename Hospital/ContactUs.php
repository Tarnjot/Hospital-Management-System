<?php

include("navbar.php");

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $FullName = $_POST['fullname']; 
    $Email = $_POST['email'];
    $Message = $_POST['message'];
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');

    // Prepare an SQL statement

$stmt = $db->prepare("INSERT INTO ContactUs ('FullName', 'Email', 'Message')
                                    VALUES (:fullname, :email, :message)");
$stmt->bindValue(':fullname', $FullName, SQLITE3_TEXT);
$stmt->bindValue(':email', $Email, SQLITE3_TEXT);
$stmt->bindValue(':message', $Message, SQLITE3_TEXT);

// Execute the statement and check for success
if ($stmt->execute()) {
echo "A new Contact Log has been created successfully!";
header ("Location: ContactUsPage.php");
} else {
echo "Failed to create Contact Log.";
}
$db->close();
}
?>