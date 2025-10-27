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
    <title>Create New Staff</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
    <?php
        include("navbar.php");
    ?>
    <div> <h2 class="centered-header">Create New Staff</h2>  </div>
   

    <div class="main">
        <form action="createNewStaff.php" method="post">            
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required>            
            <input type="text" id="lastName" name="lastName" placeholder="Last Name" required> 
            <label for="dob">Date Of Birth</label>            
            <input type="date" id="dob" name="dob" required>  
            <input type="text" id="phoneNo" name="phoneNo" placeholder="Phone Number" required>            
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="text" id="gender" name="gender" placeholder="Gender" required>           
            
            <script>

                var today = new Date().toISOString().split('T')[0];
                document.getElementById("dob").setAttribute("max", today);
            </script>
         
         <button type="submit">Create Staff</button>
        </form>
    </div>

</body>

</html>

