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
// Preventing the page from being cached
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
    $stmt = $pdo->prepare("Select Count(*) as total FROM LabTests WHERE PatientID LIKE :search");
    $stmt->execute(['search' => "%$searchTerm%"]);
}   else {
    //if there is no search term available then it will count all of the records
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM LabTests");
}

$total_row = $stmt->fetch(PDO::FETCH_ASSOC); //Grabbing the total row count
$total_records = $total_row['total']; // Will store all of the records found
$total_pages = ceil($total_records / $records_per_page); //This will calculate the total number of pages based on record per page

// Just fetching the LabTests records based on current page now. this is with or without the search term
if ($searchTerm !== '') {
    $stmt = $pdo->prepare("SELECT * FROM LabTests WHERE PatientID Like :search LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':search', "%$searchTerm%", PDO::PARAM_STR); //Line used for binding the search term parameter
    $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT); //Line used for binding Limit parameter. How many records to fetch.
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT); //Line used for binding the offset parameter which is where to start fetching those records.
    $stmt->execute(); 
} else {
    $stmt = $pdo->prepare("SELECT * FROM LabTests LIMIT :limit OFFSET :offset"); 
    $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT); //Line used to bind the limit parameter
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT); //Line used to bind offset parameter
    $stmt->execute(); 
}

$labTests = $stmt->fetchALL(PDO::FETCH_ASSOC); //This will fetch all of the LabTests records as a associative array

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Lab Tests</title>
    <link rel="stylesheet" href="loginstyle.css" />
</head>

<body>
        <?php
            include("navbar.php");           
        ?>
    <div>
        <h2 class="centered-header">List Of Lab Tests</h2>
    </div>

    <!-- Search Form -->

    <form class="SearchForm" method="GET" action="">
            <input id="SearchBar" type="text" name="search" placeholder="Search LabTests..." value="<?=htmlspecialchars($_GET['search'] ?? '') ?>">
            <button id="SearchButton" type="submit">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>

        <!-- LabTests Table -->
    <div>
      <?php
       
                
        echo "<table>";
        echo "<tr> <th>LabTest ID</th> <th>Patient ID</th> <th>Test Name</th> <th>Test Description</th><th>Test Date</th><th>Test Status</th> <th>Test Result</th> <th>Test Comment</th><th>Actions</th></tr>";

        foreach ($labTests as $row) {
            $LabTestID = htmlspecialchars($row['LabTestID']);
            $PatientID = htmlspecialchars($row['PatientID']);
            $TestName = htmlspecialchars($row['TestName']);
            $TestDescription = htmlspecialchars($row['TestDescription']);
            $TestDate = htmlspecialchars($row['TestDate']);
            $TestStatus = htmlspecialchars($row['TestStatus']);
            $TestResult = htmlspecialchars($row['TestResult']);
            $TestComment = htmlspecialchars($row['TestComment']);
       
           
           echo "<tr> 
                  <td>$LabTestID</td> 
                  <td>$PatientID</td>
                  <td>$TestName</td>
                  <td>$TestDescription</td>
                  <td>$TestDate</td>
                  <td>$TestStatus</td>
                  <td>$TestResult</td>
                  <td>$TestComment</td>
                  <td> 
                   <a href='updateLabTestPage.php ?LabTestID=$LabTestID'> Update </a> &nbsp;&nbsp;
                   <a href='deleteLabTest.php?LabTestID=$LabTestID' onclick='return confirm(\"Are you sure you would like to delete this record?\");' class='action-link delete'>Delete</a>
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