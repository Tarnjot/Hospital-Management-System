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
    <title>Create New Lab Test</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
    <?php
        include("navbar.php");
    ?>
    <div> <h2 class="centered-header">Create New Lab Test</h2>  </div>
   

    <div class="main">
        <form action="createLabTest.php" method="post">            
            <input type="text" id="patientID" name="patientID" placeholder="Patient ID" required>            
            <input type="text" id="testName" name="testName" placeholder="Test Name" required> 
            <input type="text" id="testDescription" name="testDescription" placeholder="Test Description" required>
            <label for="testDate">Date of The Test</label>            
            <input type="date" id="testDate" name="testDate" required> 
            <select name="testStatus" placeholder="Status Of The Test" required>
            <option value="" disabled selected>Choose Status Of The Test</option>
            <option value="ongoing">Pending</option>
            <option value="completed">Ongoing</option>
            <option value="discharged">Completed</option>
            <option value="paused">Cancelled</option>
            <option value="paused">Reviewed</option>
            </select>
            <input type="text" id="testResult" name="testResult" placeholder="Test Result" required>
            <input type="text" id="testComment" name="testComment" placeholder="Test Comment">
            
            <script>

                var today = new Date().toISOString().split('T')[0];
                document.getElementById("dob").setAttribute("max", today);
            </script>
         
         <button type="submit">Create Lab Test</button>
        </form>
    </div>

</body>

</html>

