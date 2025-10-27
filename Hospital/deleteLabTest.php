<?php

include("navbar.php");

$LabTestIDParam=isset($_GET['LabTestID']) ? $_GET['LabTestID'] : '';
// echo $jobIDParam;

$db = new SQLite3('HospitalSystem.db');

$stmt = $db->prepare("DELETE FROM LabTests WHERE `LabTestID` = :LabTestIDParam");
$stmt->bindValue(':LabTestIDParam', $LabTestIDParam, SQLITE3_INTEGER);
if ($stmt->execute())
{
    echo 'Lab Test Deleted Successfully';

    header("Location: viewLabTest.php");
    exit(); //making sure no further code is executed
}
else
{
    echo 'Failed to delete Lab Test';
}
$db->close();
?>