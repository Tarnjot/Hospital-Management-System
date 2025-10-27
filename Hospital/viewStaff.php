

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

require 'PDOconnection.php';
$pdo = getPDOConnection();

// This will look for any search terms from the URL
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// This will define the records per page, will grab the current page number from URL as well
$records_per_page = 5; //I have set the records shown on one page here
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1; //Will grab the current page, default to 1

if ($current_page < 1) $current_page = 1; //Just ensure the page doesn't go below 1, if its less than 1, it will set the current page to 1


$offset = ($current_page - 1) * $records_per_page; //This decides how many records to skipp

/* Counting the total records */
if ($searchTerm !== '') {

    //When theres a search term, it will count the matching records for it.
    $stmt = $pdo->prepare("Select Count(*) as total FROM Staff WHERE FName LIKE :search OR LName Like :search");
    $stmt->execute(['search' => "%$searchTerm%"]);
}   else {
    //if there is no search term available then it will count all of the records
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM Staff");
}

$total_row = $stmt->fetch(PDO::FETCH_ASSOC); //Grabbing the total row count
$total_records = $total_row['total']; // Will store all fo the records found
$total_pages = ceil($total_records / $records_per_page); //This will calculate the total number of pages based on record per page

// Just fetching the Staff records based on current page now. this is with or without the search term
if ($searchTerm !== '') {
    $stmt = $pdo->prepare("SELECT * FROM Staff WHERE FName Like :search OR LName LIKE :search LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':search', "%$searchTerm%", PDO::PARAM_STR); //Line used for binding the search term parameter
    $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT); //Line used for binding Limit parameter. How many records to fetch.
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT); //Line used for binding the offset parameter which is where to start fetching those records.
    $stmt->execute(); 
} else {
    $stmt = $pdo->prepare("SELECT * FROM Staff LIMIT :limit OFFSET :offset"); 
    $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT); //Line used to bind the limit parameter
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT); //Line used to bind offset parameter
    $stmt->execute(); 
}

$staffs = $stmt->fetchALL(PDO::FETCH_ASSOC); //This will fetch all fo the Staff records as a associative array

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Staff</title>
    <link rel="stylesheet" href="loginstyle.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>
        <?php
            include("navbar.php");           
        ?>
    <div>
        <h2 class="centered-header">List Of Staff</h2>
    </div>

    <!-- Search Form -->

    <form class="SearchForm" method="GET" action="">
            <input id="SearchBar" type="text" name="search" placeholder="Search Staff..." value="<?=htmlspecialchars($_GET['search'] ?? '') ?>">
            <button id="SearchButton" type="submit">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>

        <!-- Staff Table -->

    <div>
      <?php
        
                
        echo "<table>";
        echo "<tr> <th>Staff ID</th> <th>First Name</th> <th>Last Name</th> <th>Date Of Birth</th><th>PhoneNo</th><th>Email</th> <th>Gender</th><th>Actions</th></tr>";

        foreach ($staffs as $row) {
            $StaffID = htmlspecialchars($row['StaffID']);
            $FName = htmlspecialchars($row['FName']);
            $LName = htmlspecialchars($row['LName']);
            $DOB = htmlspecialchars($row['DOB']);
            $PhoneNo = htmlspecialchars($row['PhoneNo']);
            $Email = htmlspecialchars($row['Email']);
            $Gender = htmlspecialchars($row['Gender']);
       
           
           echo "<tr> 
                  <td>$StaffID</td> 
                  <td>$FName</td>
                  <td>$LName</td>
                  <td>$DOB</td>
                  <td>$PhoneNo</td>
                  <td>$Email</td>
                  <td>$Gender</td>
                  <td> 
                   <a href='updateStaffPage.php?StaffID=$StaffID'> Update </a> &nbsp;&nbsp;
                   <a href='deleteStaff.php?StaffID=$StaffID' onclick='return confirm(\"Are you sure you would like to delete this record?\");' class='action-link delete'>Delete</a>
                   </td>
                </tr>";
        }

        echo "</table>";

        echo "<div class='pagination'>";

        //Adding a query strin if there is a search term involved
        $queryString = '';
        if (!empty($searchTerm)) {
            $queryString = '&search=' .urlencode($searchTerm); //adding search term to pagination links, allowing to keep the search on any page
        }

        // Used for showing the previous page button if we arent on the first page
        if ($current_page > 1) {
            $prev_page = $current_page - 1; 
            echo "<a href='?page=$prev_page$queryString'>Previous</a> "; //Link to the previous page
        }

        // Used for showing the total number of pages from 1.
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                echo "<strong>$i</strong> "; //using strong to display the current page number as bold
            } else {
                echo "<a href='?page=$i$queryString'>$i</a> "; //allows for other pages to be clickable
            }
        }

        //This is showing the next button if we are not on the last page
        if ($current_page < $total_pages) {
            $next_page = $current_page + 1;
            echo "<a href='?page=$next_page$queryString'>Next</a> "; //this is linking to the next page
        }

        echo "</div>";
     ?>
    
        
        
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