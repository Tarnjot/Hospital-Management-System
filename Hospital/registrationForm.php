<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration Page</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>
<?php
session_start(); // Start the session to access the error message
if (isset($_SESSION['error'])) {
    echo '<p class="error">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']); // Clear the error message after displaying it
}
?>
<body>
    
    <div> <h2 class="centered-header">Registration</h2>  </div>
   

    <div class="main">
    
    <?php if (isset($error)) { echo '<p class="error">' . $error . '</p>'; } ?>
        <form action="registration.php" method="post">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="text" id="password" name="password" placeholder="Password" required>
            <label for="occupation"> Choose Your Occupation </label>
            <select type="text" id="occupation" name="occupation" placeholder="Occupation" required>
                <option value="Doctor">Doctor</option>
                <option value="Nurse">Nurse</option> 
                <option value="Patient">Patient</option>
</select>            
            <input type="text" id="firstName" name="firstName" placeholder="First Name" required>            
            <input type="text" id="lastName" name="lastName" placeholder="Last Name">
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="text" id="phoneNo" name="phoneNo" placeholder="Phone Number" required>
            <input type="text" id="address" name="address" placeholder="Address" required>
            <label for="dob">Date Of Birth</label>            
            <input type="date" id="dob" name="dob" required>
            <label for="gender">Pick Your Gender</label>
            <select type="text" id="gender" name="gender" placeholder="Gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option> 
                <option value="Other">Other</option>             
</select>
            
            <script>

                var today = new Date().toISOString().split('T')[0];
                document.getElementById("dob").setAttribute("max", today);
            </script>
         <a class="already-registered" href="loginform.php">Already Registered?
         <button type="submit">Register</button>
         <h3><a href="MainPage.php" id="registration-home-button">Home</a></h3>
        </form>
        <style>

        /* Home button styling */
        #registration-home-button {
            display: inline-block;
            padding: 10px 100px 10px 100px;
            margin-top: 5px;
            margin-left: 10%;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            cursor: pointer;
            border: none;
        }
        
        #registration-home-button:hover {
            background-color: #45a049;
        }
        
        #registration-home-button:focus {
            outline: none;
            box-shadow: 0 0 5px 2px rgba(76, 175, 80, 0.6);
        }
    </style>
    </div>

</body>

</html>

