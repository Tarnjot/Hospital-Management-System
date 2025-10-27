<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: HomePage.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

/* Already registered users to use instead of registering:
    username: Tarnjot
    password: 12345
    Occupation of this user: Doctor
    
    Username: Larry
    password: 12345
    Occupation of this user: Patient */


$db = new SQLite3('HospitalSystem.db');

$stmt = $db->prepare('SELECT * FROM User Where Username = :username');
$stmt->bindValue(':username', $username, SQLITE3_TEXT);

$result = $stmt->execute();

$user = $result->fetchArray(SQLITE3_ASSOC);

if ($user) {
    if(password_verify($password, $user['Password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['occupation'] = $user['Occupation'];

        $userEmail = $user['Email'];
        $stmt2 = $db->prepare('SELECT PatientID FROM Patient Where Email = :email');
        $stmt2->bindvalue(':email', $userEmail, SQLITE3_TEXT);
        $result2 = $stmt2->execute();
        $patient = $result2->fetchArray(SQLITE3_ASSOC);

        if ($patient) {
            $_SESSION['patient_id'] = $patient['PatientID'];
        } else {
            $_SESSION['patient_id'] = null;
        }

        header("Location: HomePage.php");
        exit;
    } else {
        $error = "Invalid Password!";
        header("Location: loginform.php");
    }
 } else {
    $error = "Invalid username!";
    header("Location: loginform.php");
 }

 $db->close();
}
?>