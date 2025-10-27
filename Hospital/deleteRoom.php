<?php

include("navbar.php");

$StaffIDParam=isset($_GET['RoomID']) ? $_GET['RoomID'] : '';
// echo $jobIDParam;

$db = new SQLite3('HospitalSystem.db');

$stmt = $db->prepare("DELETE FROM Room WHERE `RoomID` = :RoomIDParam");
$stmt->bindValue(':RoomIDParam', $RoomIDParam, SQLITE3_INTEGER);
if ($stmt->execute())
{
    echo 'Room Deleted Successfully';

    header("Location: viewRoom.php");
    exit(); //making sure no further code is executed
}
else
{
    echo 'Failed to delete Room';
}
$db->close();
?>