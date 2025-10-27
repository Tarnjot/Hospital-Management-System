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
    <title>Update Staff</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
  <?php

    include("navbar.php");
    
    $StaffIDParam=isset($_GET['StaffID']) ? $_GET['StaffID'] : '';
    $db = new SQLite3('HospitalSystem.db');
    $stmt = $db->prepare("SELECT * FROM Staff WHERE \"StaffID\" = :StaffID");
    $stmt->bindValue(':StaffID', $StaffIDParam, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);
    $StaffID = $row['StaffID'];
    $FName = $row['FName'];
    $LName = $row['LName'];
    $DOB = $row['DOB'];
    $PhoneNo = $row['PhoneNo'];
    $Email = $row['Email'];
    $Gender = $row['Gender'];
    if ($DOB) {
      
      $DOBFormatted = date("Y-m-d", strtotime($DOB));
  } else {
      $DOBFormatted = ''; 
  }             
    $db->close();
  ?>
  <div class="main">
    <form action="updateStaff.php" method="post">  
    <label for="StaffID">Staff ID</label>
        <input type="number" id="StaffID" name="StaffID" value="<?php echo $StaffID; ?>" placeholder="<?php echo $StaffID; ?>" readonly>
        <label for="firstName">First Name</label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $FName; ?>" placeholder="<?php echo $FName; ?>" required>
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $LName; ?>" placeholder="<?php echo $LName; ?>">
        <label for="dob">DOB</label>
        <input type="text" id="dob" name="dob" value="<?php echo $DOBFormatted; ?>" required> 
        <label for="phoneNo">Phone Number</label>
        <input type="tel" id="phoneNo" name="phoneNo" value="<?php echo $PhoneNo; ?>" placeholder="<?php echo $PhoneNo; ?>" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $Email; ?>" placeholder="<?php echo $Email; ?>" required>
        <label for="gender">Gender</label>
        <input type="text" id="gender" name="gender" value="<?php echo $Gender; ?>" placeholder="<?php echo $Gender; ?>" required>
        <label for="address">Address</label>            

           <button type="submit">Update Staff</button>
    </form>       
    
  </div>    
</body>
</html>