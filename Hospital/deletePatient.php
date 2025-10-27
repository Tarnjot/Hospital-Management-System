<?php

include("navbar.php");

$PatientIDParam=isset($_GET['PatientID']) ? $_GET['PatientID'] : '';
// echo $jobIDParam;

$db = new SQLite3('HospitalSystem.db');

$stmt = $db->prepare("DELETE FROM Patient WHERE `PatientID` = :PatientIDParam");
$stmt->bindValue(':PatientIDParam', $PatientIDParam, SQLITE3_INTEGER);
if ($stmt->execute())
{
    echo 'Patient Deleted Successfully';

    header("Location: viewPatient.php");
    exit(); //making sure no further code is executed
}
else
{
    echo 'Failed to delete Patient';
}
$db->close();
?>