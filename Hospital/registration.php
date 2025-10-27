<?php
session_start();
// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    $Occupation = $_POST['occupation'];
    $FName = $_POST['firstName'];
    $LName = $_POST['lastName']; 
    $Email = $_POST['email'];
    $PhoneNo = $_POST['phoneNo'];
    $DOB = $_POST['dob'];
    $Gender = $_POST['gender'];
    $Address = $_POST['address'];

    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');

    // Check if the username already exists
    $stmt = $db->prepare("SELECT * FROM User WHERE Username = :Username");
    $stmt->bindValue(':Username', $Username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $usernameTaken = $result->fetchArray();

    // Check if the email already exists
    $stmt = $db->prepare("SELECT * FROM User WHERE Email = :Email");
    $stmt->bindValue(':Email', $Email, SQLITE3_TEXT);
    $result = $stmt->execute();
    $emailTaken = $result->fetchArray();
    //if the username is taken
    if ($usernameTaken) {
        $_SESSION['error'] = "'$Username' already taken! Please enter a different username!";
        header("Location: registrationForm.php");
        exit();
    //if the email is taken
    } elseif ($emailTaken) {
        $_SESSION['error'] = "'$Email' already in use! Please enter a different email!";
        header("Location: registrationForm.php");
        exit();
    } else {
        // Insert User data into the User table
        $stmt = $db->prepare("INSERT INTO User (Username, Password, Occupation, FName, LName, Email, PhoneNo, DOB, Gender, Address)
                              VALUES (:Username, :Password, :Occupation, :FName, :LName, :Email, :PhoneNo, :DOB, :Gender, :Address)");
        $stmt->bindValue(':Username', $Username, SQLITE3_TEXT);
        $stmt->bindValue(':Password', $hashedPassword, SQLITE3_TEXT);
        $stmt->bindValue(':Occupation', $Occupation, SQLITE3_TEXT);
        $stmt->bindValue(':FName', $FName, SQLITE3_TEXT);
        $stmt->bindValue(':LName', $LName, SQLITE3_TEXT);
        $stmt->bindValue(':Email', $Email, SQLITE3_TEXT);
        $stmt->bindValue(':PhoneNo', $PhoneNo, SQLITE3_TEXT);
        $stmt->bindValue(':DOB', $DOB, SQLITE3_TEXT);
        $stmt->bindValue(':Gender', $Gender, SQLITE3_TEXT);
        $stmt->bindValue(':Address', $Address, SQLITE3_TEXT);

        if ($stmt->execute()) {

            //If the occupation selected is Patient, then a patient record is auto added.
            if ($Occupation == 'Patient') {

                $Status = 'N/A';
                
                $stmt_patient = $db->prepare("INSERT INTO Patient (FName, LName, DOB, PhoneNo, Email, Gender, Address, Status)
                                              VALUES (:FName, :LName, :DOB, :PhoneNo, :Email, :Gender, :Address, :Status)");
                $stmt_patient->bindValue(':FName', $FName, SQLITE3_TEXT);
                $stmt_patient->bindValue(':LName', $LName, SQLITE3_TEXT);
                $stmt_patient->bindValue(':DOB', $DOB, SQLITE3_TEXT);
                $stmt_patient->bindValue(':PhoneNo', $PhoneNo, SQLITE3_TEXT);
                $stmt_patient->bindValue(':Email', $Email, SQLITE3_TEXT);
                $stmt_patient->bindValue(':Gender', $Gender, SQLITE3_TEXT);
                $stmt_patient->bindValue(':Address', $Address, SQLITE3_TEXT);
                $stmt_patient->bindValue(':Status', $Status, SQLITE3_TEXT);

                
                if ($stmt_patient->execute()) {
                    $_SESSION['success'] = "Patient data added successfully!";
                    header("Location: loginform.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Failed to add patient details. Please try again.";
                    header("Location: registrationForm.php");
                    exit();
                }
            } else {
                
                $_SESSION['success'] = "User registered successfully!";
                header("Location: loginform.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Failed to create User record. Please try again.";
            header("Location: registrationForm.php");
            exit();
        }
    }
    $db->close();
}
?>
