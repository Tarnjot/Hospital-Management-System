<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />

<?php
session_start(); 

// this is simply checking if the user is logged in or not
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: loginform.php"); 
    exit;
}
?>
<!DOCTYPE html>
<?php
// Prevent the page from being cached
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Upcoming Appointment</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
        <?php
            include("navbar.php");           
        ?>
    <div>
        <h2 class="centered-header">List Of Upcoming Appointment</h2>
    </div>


    <div>
      <?php
        $db = new SQLite3('HospitalSystem.db');

        $CurrentTime = date('Y-m-d H:i:s');

        $query = "SELECT AppointmentID, RoomID, PatientID, StaffID, AppointmentTime, AppointmentDate FROM Appointment WHERE AppointmentDate > :currentDate ORDER BY AppointmentID ASC";

        $stmt = $db->prepare($query);

        $stmt->bindvalue(':currentDate', $CurrentTime, SQLITE3_TEXT);

        $result = $stmt->execute();

        echo "<table>";
        echo "<tr> <th>Appointment ID</th> <th>Room ID</th> <th>Patient ID</th> <th>Staff ID</th><th>Appointment Time</th><th>Appointment Date</th> </tr>";

                
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>
            <td>" . htmlspecialchars($row['AppointmentID']) . "</td>
            <td>" . htmlspecialchars($row['RoomID']) . "</td>
            <td>" . htmlspecialchars($row['PatientID']) . "</td>
            <td>" . htmlspecialchars($row['StaffID']) . "</td>
            <td>" . htmlspecialchars($row['AppointmentTime']) . "</td>
            <td>" . htmlspecialchars($row['AppointmentDate']) . "</td>
        </tr>";
        }

        
        $db->close();

        echo "</table>";
     ?>
    
        <!-- Search Form -->

        <form class="SearchForm" method="GET" action="">
            <input id="SearchBar" type="text" name="search" placeholder="Search UpcomingAppointments..." value="<?=htmlspecialchars($_GET['search'] ?? '') ?>">
            <button id="SearchButton" type="submit">
                <span class="material-symbols-outlined">search</span>
            </buttom>
        </form>
        
        <style>
            .SearchForm {
                display: flex;
                flex-direction: row;
                position: fixed;
                Margin-top: 0px;
                top: 90px;
                right: 10px;
                padding: 0px;
                background: white;
            }

            #SearchBar {
                width: 80%;
                border: 1px solid,rgb(0, 0, 0);
                border-radius: 10px 0px 0px 10px;
            }

            #SearchButton {
                width: 20%;
                padding: 0px;
                margin-bottom: 10px;
                border: 1px solid,rgb(0, 0, 0);
                border-radius: 0px 10px 10px 0px;
            }

        </style>


    </div>

</body>

</html>