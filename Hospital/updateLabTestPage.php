<?php
session_start(); 

// this is simply checking if the user is logged in or not
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginform.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
  <?php

    include("navbar.php");
    
    $LabTestIDParam=isset($_GET['LabTestID']) ? $_GET['LabTestID'] : '';
    $db = new SQLite3('HospitalSystem.db');
    $stmt = $db->prepare("SELECT * FROM LabTests WHERE \"LabTestID\" = :LabTestID");
    $stmt->bindValue(':LabTestID', $LabTestIDParam, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $LabTestID = $row['LabTestID'];
    $PatientID = $row['PatientID'];
    $TestName = $row['TestName'];
    $TestDescription = $row['TestDescription'];
    $TestDate = $row['TestDate'];
    $TestStatus = $row['TestStatus'];
    $TestResult = $row['TestResult'];
    $TestComment = $row['TestComment'];
    if ($TestDate) {
      
      $DOBFormatted = date("Y-m-d", strtotime($TestDate));
  } else {
      $DOBFormatted = ''; 
  }             
    $db->close();
  ?>
  <div class="main">
    <form action="updateLabTest.php" method="post">  
    <label for="LabTestID">Lab Test ID</label>
        <input type="number" id="LabTestID" name="LabTestID" value="<?php echo $LabTestID; ?>" placeholder="<?php echo $LabTestID; ?>" readonly>
        <label for="patientID">Patient ID</label>
        <input type="number" id="patientID" name="patientID" value="<?php echo $PatientID; ?>" placeholder="<?php echo $PatientID; ?>" required>
        <label for="testName">Test Name</label>
        <input type="text" id="testName" name="testName" value="<?php echo $TestName; ?>" placeholder="<?php echo $TestName; ?>">
        <label for="testDescription">Test Description</label>
        <input type="text" id="testDescription" name="testDescription" value="<?php echo $TestDescription; ?>" placeholder="<?php echo $TestDescription; ?>" required>
        <label for="testDate">Test Date</label>
        <input type="text" id="testDate" name="testDate" value="<?php echo $DOBFormatted; ?>" required>

        <select name="testStatus" required>
        <option value="" disabled selected>Choose Status Of The Test</option>
        <option value="ongoing" <?php echo ($TestStatus == 'ongoing') ? 'selected' : ''; ?>>Ongoing</option>
        <option value="completed" <?php echo ($TestStatus == 'completed') ? 'selected' : ''; ?>>Completed</option>
        <option value="discharged" <?php echo ($TestStatus == 'discharged') ? 'selected' : ''; ?>>Discharged</option>
        <option value="paused" <?php echo ($TestStatus == 'paused') ? 'selected' : ''; ?>>Cancelled</option>
        <option value="reviewed" <?php echo ($TestStatus == 'reviewed') ? 'selected' : ''; ?>>Reviewed</option>
        </select>

        <label for="testResult">Test Result</label>            
        <input type="text" id="testResult" name="testResult" value="<?php echo $TestResult; ?>" placeholder="<?php echo $TestResult; ?>" required>
        <label for="testComment">Test Comment</label>            
        <input type="text" id="testComment" name="testComment" value="<?php echo $TestComment; ?>" placeholder="<?php echo $TestComment; ?>">

           <button type="submit">Update Lab Test</button>
    </form>       
    
  </div>    
</body>
</html>