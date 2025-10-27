<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Connection</title>
</head>
<body>
    <!-- This is PDO Connection Set up for easy DB connection plug in -->
    <?php
    function getPDOConnection() {
        try {
            $db = new PDO('sqlite:HospitalSystem.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            die("Failed to connect to the database: " . $e->getMessage());
        }
    }



    ?>
</body>
</html>