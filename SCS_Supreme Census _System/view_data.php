<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Census Management System</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php
include('database/db_connection.php');
session_start();
if(isset($_SESSION['admin_id'])){
    echo "<h1>All Users' Information</h1>";
    echo "<a href='http://localhost/Group 12/register.php'>Log out</a>";
    echo "<div class='container'>
            <h2>Information</h2>
            <table border='1'>
            <tr>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Place of Birth</th>
                <th>Current Residence</th>
                <th>Phone Number</th>
                <th>More info</th>
            </tr>";
    $all_users = $db->prepare("SELECT * FROM users");
    $result = $all_users->execute();
    if ($result) {
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['names'] . "</td>";
            echo "<td>" . $row['date_of_birth'] . "</td>";
            echo "<td>" . $row['place_of_birth'] . "</td>";
            echo "<td>" . $row['current_residence'] . "</td>";
            echo "<td>" . $row['phone_number'] . "</td>";
            echo "<td><a href='http://localhost/Group 12/view_individual_data.php?user_id=" . $row['id'] . "'>Click here for more info</a></td>";
            echo "</tr>";
        }
    } else {
        echo "No user data found.";
    }
    echo "</table><a href='http://localhost/Group 12/statistics.php'>See statistics</a></div>";
} else {
    header("Location: index.php");
    exit();
}
?>
</body>
</html>