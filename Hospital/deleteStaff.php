<?php

include("navbar.php");

$StaffIDParam=isset($_GET['StaffID']) ? $_GET['StaffID'] : '';
// echo $jobIDParam;

$db = new SQLite3('HospitalSystem.db');

$stmt = $db->prepare("DELETE FROM Staff WHERE `StaffID` = :StaffIDParam");
$stmt->bindValue(':StaffIDParam', $StaffIDParam, SQLITE3_INTEGER);
if ($stmt->execute())
{
    echo 'Staff Deleted Successfully';

    header("Location: viewStaff.php");
    exit(); //making sure no further code is executed
}
else
{
    echo 'Failed to delete Staff';
}
$db->close();
?>