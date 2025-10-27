<?php

include("navbar.php");

$ContactUsParam=isset($_GET['ContactUs']) ? $_GET['ContactUs'] : '';
// echo $jobIDParam;

$db = new SQLite3('HospitalSystem.db');

$stmt = $db->prepare("DELETE FROM ContactUs WHERE `ContactUs` = :ContactUsParam");
$stmt->bindValue(':ContactUsParam', $ContactUsParam, SQLITE3_INTEGER);
if ($stmt->execute())
{
    echo 'ContactUs Log Deleted Successfully';

    header("Location: viewContactUs.php");
    exit(); //making sure no further code is executed
}
else
{
    echo 'Failed to delete ContactUs Log';
}
$db->close();
?>