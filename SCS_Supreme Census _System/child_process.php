<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Census Management System</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php
include('database/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $parent_id = $_POST['parent_id'];
    $name = $_POST['child_name'];
    $dateOfBirth = $_POST['child_dob'];
    $address = $_POST['address'];

    $error = false;

    if (empty($parent_id) || empty($child_name) || empty($child_dob) || empty($gender) || empty($current_region)) {
        $error = true;
    } else {
        $current_date = new DateTime();
        $birthday = new DateTime($child_dob);
        $current_year = $current_date->format('Y');
        $birth_year = $birthday->format('Y');
    
        if(($current_year - $birth_year)<21) {
            $insert_child_query = $db->prepare("INSERT INTO children (parent_id, names, date_of_birth, gender, current_region, number_of_children) VALUES (:parent_id, :child_name, :child_dob, :child_gender, :child_current_region, :child_num_children)");

            $insert_child_query->bindParam(':parent_id', $parent_id);
            $insert_child_query->bindParam(':child_name', $child_name);
            $insert_child_query->bindParam(':child_dob', $child_dob);
            $insert_child_query->bindParam(':address', $address);
            $result = $insert_child_query->execute();

            if ($result) {
                header("Location: view_individual_data.php");
                exit();
            } else {
                echo "<h1>Failed to add child information.</h1><a href='http://localhost/Group 12/child.html'>Go back</a>";
            }
        } else {
            header("Location: reg.php");
        }
    }
    if ($error) {
        header("Location: child.php");
        exit();
    }
}
?>
</body>
</html>