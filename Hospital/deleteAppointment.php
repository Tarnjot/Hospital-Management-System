<?php

include("navbar.php");

$AppointmentIDParam=isset($_GET['AppointmentID']) ? $_GET['AppointmentID'] : '';
// echo $jobIDParam;

$db = new SQLite3('HospitalSystem.db');

$stmt = $db->prepare("DELETE FROM Appointment WHERE `AppointmentID` = :AppointmentIDParam");
$stmt->bindValue(':AppointmentIDParam', $AppointmentIDParam, SQLITE3_INTEGER);
if ($stmt->execute())
{
    echo 'Appointment Deleted Successfully';

    header("Location: viewAppointment.php");
    exit(); //making sure no further code is executed
}
else
{
    echo 'Failed to delete Appointment';
}
$db->close();
?>