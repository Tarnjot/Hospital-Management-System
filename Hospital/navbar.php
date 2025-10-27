<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$role = $_SESSION['occupation'] ?? null;
?>




<!doctype html>
<html lang="en">
<head>
	<title>Hospital Management System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="loginstyle.css" />
	
</head>

<body class="bgColor">
	<header>
	<div class="header">
      <div>
        <a class="navbar-brand" href="HomePage.php">Home</a>
      </div>

      <?php if ($role !== 'Patient'): ?>
      <div class="dropdown">
        <button class="dropbtn">Patient
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="viewPatient.php">View Patients</a>
          <a href="createNewPatientPage.php">Create Patient</a>
          <a href="viewPatientStatus.php">Patient Status</a>
        </div>
      </div>
      <?php endif; ?>

      <?php if ($role === 'Doctor' || $role === 'Nurse'): ?>
      <div class="dropdown">
        <button class="dropbtn">Staff
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="viewStaff.php">View Staff</a>
          <a href="createNewStaffPage.php">Create Staff</a>
        </div>
      </div>
      

      
      <div class="dropdown">
        <button class="dropbtn">Appointments
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="viewAppointment.php">View Appointments</a>
          <a href="createNewAppointmentPage.php">Create Appointments</a>
          <a href="viewUpcomingAppointment.php">Upcoming Appointments</a>
        </div>
      </div>
      <?php endif; ?>

      <?php if ($role === 'Doctor' || $role === 'Nurse'): ?>
      <div class="dropdown">
        <button class="dropbtn">Room 
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="viewRoom.php">View Rooms</a>  
          <a href="createNewRoomPage.php">Create Room</a>
        </div>
      </div>
      
      
      <div class="dropdown">
        <button class="dropbtn">LabTests 
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="viewLabTest.php">View LabTest</a>  
          <a href="createLabTestPage.php">Create LabTest</a>
        </div>
      </div>

      <div class="dropdown">
        <button class="dropbtn">ContactUs
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="viewContactUs.php">ContactUs Logs</a>
        </div>
      </div>
      <?php endif; ?>

      <?php if ($role === 'Patient'): ?>
      <div class="dropdown">
        <button class="dropbtn">Appointment
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
          <a href="createNewAppointmentPagePPOV.php">Create Appointment</a>
          <a href="viewUpcomingAppointmentsPPOV.php">View Upcoming Appointments</a>
          <a href="viewPastAppointmentsPPOV.php">View Past Appointments</a>
        </div>
      </div>
      <?php endif; ?>

      <div class="login">
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)
        {
          echo '<a href="logout.php">Logout</a>';
        }
        else
        {
          echo '<a href="loginform.php">Login</a>';
        }
        ?>
        </div>
    </div>
	</header>
</body>