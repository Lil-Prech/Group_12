<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration | Census Management System</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php
include('database/db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $names = $_POST['names'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $place_of_birth = $_POST['place_of_birth'];
    $current_residence = $_POST['current_residence'];
    $phone = $_POST['phone'];
    $passwords = $_POST['passwords'];
    $girls_above_21 = $_POST['girls_above_21'];
    $girls_under_21 = $_POST['girls_under_21'];
    $boys_above_21 = $_POST['boys_above_21'];
    $boys_under_21 = $_POST['boys_under_21'];
    $parent_id = 1;

    $current_date = new DateTime();
    $birthday = new DateTime($dob);
    $current_year = $current_date->format('Y');
    $birth_year = $birthday->format('Y');

    if(($current_year - $birth_year)<21){
        echo "<h1>You are not allowed to register because you are less than 21years of age.</h1>";
        echo "<a href = 'http://localhost/Group 12/register.php'>Go back.</a>";
    } elseif (empty($names) || empty($dob) || empty($place_of_birth) || empty($current_residence) || empty($num_children) || empty($phone) || empty($passwords)) {
        echo "<h1>Please fill in all required fields.</h1>";
        echo "<a href = 'http://localhost/Group 12/register.php'>Go back.</a>";
    } else {
        $insert_user_query = $db->prepare("INSERT INTO users (names, date_of_birth, gender, place_of_birth, current_residence, phone_number, passwords, girls_under_21, girls_above_21, boys_under_21, boys_above_21) VALUES (:names, :dob, :place_of_birth, :gender, :current_residence, :phone, :passwords, :girls_under_21, :girls_above_21, :boys_under_21, :boys_above_21)");
        $insert_user_query->bindParam(':names', $names);
        $insert_user_query->bindParam(':dob', $dob);
        $insert_user_query->bindParam(':place_of_birth', $place_of_birth);
        $insert_user_query->bindParam(':gender', $gender);
        $insert_user_query->bindParam(':current_residence', $current_residence);
        $insert_user_query->bindParam(':phone', $phone);
        $insert_user_query->bindParam(':passwords', $passwords);
        $insert_user_query->bindParam(':girls_under_21', $girls_under_21);
        $insert_user_query->bindParam(':girls_above_21', $girls_above_21);
        $insert_user_query->bindParam(':boys_under_21', $boys_under_21);
        $insert_user_query->bindParam(':boys_above_21', $boys_above_21);

        $insert_user_query->execute();

        header("Location: login.php");
    }
}
?>
</body>
</html>
