<?php
  include("navbar.php");
  // Check if form was submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $RoomID=$_POST['RoomID'];
    $RoomType=$_POST['roomType'];
    $RoomCapacity=$_POST['roomCapacity'];  
    
    // Connect to SQLite3 database
    $db = new SQLite3('HospitalSystem.db');    
    
    // Prepare an SQL statement
    $stmt = $db->prepare("UPDATE Room SET 
                          `RoomType`=:roomType,
                          `RoomCapacity`=:roomCapacity
                          WHERE `RoomID`=:roomID
                          ");
    $stmt->bindValue(':roomID', $RoomID, SQLITE3_INTEGER);
    $stmt->bindValue(':roomType', $RoomType, SQLITE3_TEXT);
    $stmt->bindValue(':roomCapacity', $RoomCapacity, SQLITE3_TEXT);
    
    if($stmt->execute()) {
      header ("Location: viewRoom.php");
      exit();
  } else {
      echo 'Updation failed..';
}
$db->close();
  }
?>
