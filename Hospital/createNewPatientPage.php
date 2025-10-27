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
    <title>Create New Patient</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
    <?php
        include("navbar.php");
    ?>
    <div> <h2 class="centered-header">Create New Patient</h2>  </div>
   

    <div class="main">
        <form action="createNewPatient.php" method="post">            
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required>            
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required> 
            <label for="dob">Date Of Birth</label>            
            <input type="date" id="dob" name="dob" required>  
            <input type="text" id="phoneNo" name="phoneNo" placeholder="Phone Number" required>            
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="text" id="gender" name="gender" placeholder="Gender" required>
            <input type="text" id="address" name="address" placeholder="Address" required>
            <select name="status" placeholder="Choose Status Of Patient" required>
            <option value="" disabled selected>Choose Status Of Patient</option>
            <option value="ongoing">Ongoing</option>
            <option value="completed">Completed</option>
            <option value="discharged">Discharged</option>
            <option value="paused">Paused</option>
            </select>

            <script>

                var today = new Date().toISOString().split('T')[0];
                document.getElementById("dob").setAttribute("max", today);
            </script>
         
         <button type="submit">Create Patient</button>
        </form>
    </div>

</body>

</html>

