<?php

include("navbar.php");

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $RoomID = $_POST['roomID'];
    $RoomType = $_POST['roomType']; 
    $RoomCapacity = $_POST['roomCapacity'];
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');

    // Prepare an SQL statement

$stmt = $db->prepare("INSERT INTO Patient ('RoomID', 'RoomType', 'RoomCapacity')
                                    VALUES (:roomID, :roomType, :roomCapacity)");
$stmt->bindValue(':roomID', $RoomID, SQLITE3_TEXT);
$stmt->bindValue(':roomType', $RoomType, SQLITE3_TEXT);
$stmt->bindValue(':roomCapacity', $RoomCapacity, SQLITE3_TEXT);

// Execute the statement and check for success
if ($stmt->execute()) {
echo "A new Room created successfully!";
} else {
echo "Failed to create Room record.";
}
$db->close();
}
?>