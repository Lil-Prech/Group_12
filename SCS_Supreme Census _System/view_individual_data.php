<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Census Management System</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Personal Census Information</h1>
    <a href='http://localhost/Group 12/login.php'>Logout</a>
    <div class="container">
<?php
include('database/db_connection.php');
session_start();

if (isset($_GET['user_id']) && isset($_SESSION['admin_id'])) {
    $user_id = $_GET['user_id'];
} elseif (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    echo "<p>User not logged in.</p>";
    header("Location: index.php");
    exit();
}

$get_user_data_query = $db->prepare("SELECT * FROM users WHERE id = :user_id");
$get_user_data_query->bindParam(':user_id', $user_id);
$result = $get_user_data_query->execute();

if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    echo "<h2 style='color: darkblue;'>Personal Information</h2>";
    echo "<p>Name: " . $row['names'] . "</p>";
    echo "<p>Date of Birth: " . $row['date_of_birth'] . "</p>";
    echo "<p>Gender: " . $row['gender'] . "</p>";
    echo "<p>Place of Birth: " . $row['place_of_birth'] . "</p>";
    echo "<p>Current Residence: " . $row['current_residence'] . "</p>";
    echo "<p>Region of Residence: " . $row['current_region'] . "</p>";
    echo "<p>Phone Number: " . $row['phone_number'] . "</p>";
?></div><div class="container"><?php
    echo "<h2>Mr(s) " . $row['names'] . "'s Children</h2>";

    echo "<table border='1'>
            <tr>
                <th>Girls less than 21</th>
                <th>Girls greater than 21</th>
                <th>Boys less than 21</th>
                <th>Boys greater than 21</th>
            </tr>";
            echo "<tr>";
                echo "<td>" . $row['girls_under_21'] . "</td>";
                echo "<td>" . $row['girls_above_21'] . "</td>";
                echo "<td>" . $row['boys_under_21'] . "</td>";
                echo "<td>" . $row['boys_above_21'] . "</td>";
            echo "</tr>";
    echo "</table>";

    echo "<p>The information below are for children below 21 only.</p>";
    echo "<a href ='http://localhost/Group 12/add_child.php'>Add another child's information</a>";
    if(!($row['girls_under_21'] == 0 and $row['girls_above_21'] == 0 and $row['boys_under_21'] == 0 and $row['boys_above_21'] == 0)){
        $parent_id = $row['id'];
        $get_child_data_query = $db->prepare("SELECT * FROM children WHERE parent_id = :parent_id");
        $get_child_data_query->bindParam(':parent_id', $parent_id);
        $results = $get_child_data_query->execute();

        echo "<table border='1'>
            <tr>
                <th>Child's Name</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Current Region</th>
                <th>Number of Children</th>
            </tr>";
        if($results) {
            while ($rows = $results->fetchArray(SQLITE3_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $rows['names'] . "</td>";
                echo "<td>" . $rows['date_of_birth'] . "</td>";
                echo "<td>" . $rows['gender'] . "</td>";
                echo "<td>" . $rows['current_region'] . "</td>";
                echo "<td>" . $rows['number_of_children'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No information found about children!<>";
        }
    } else {
        echo "<p>This person doesn't have children!</p>";
    }?></div><?php
} else {
    echo "<p>No data found for the specified user.</p>";
}
?>
</body>
</html>