<?php
include('database/db_connection.php');

$get_totals_query = $db->query("
    SELECT 
        SUM(boys_under_21) AS total_boys_under_21,
        SUM(girls_under_21) AS total_girls_under_21,
        COUNT(*) + SUM(boys_under_21) + SUM(girls_under_21) AS total_registered,
        SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS total_male,
        SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS total_female,
        COUNT(*) AS total_above_21
    FROM users
");

$totals = $get_totals_query->fetchArray(SQLITE3_ASSOC);

$total_boys_under_21 = $totals['total_boys_under_21'];
$total_girls_under_21 = $totals['total_girls_under_21'];
$total_registered = $totals['total_registered'];
$total_male = $totals['total_male'];
$total_female = $totals['total_female'];
$total_above_21 = $totals['total_above_21'];

$total_under_21 = $total_boys_under_21 + $total_girls_under_21;
$percentage_under_21 = ($total_under_21 / $total_registered) * 100;

$percentage_male_above_21 = ($total_male - $total_boys_under_21) / $total_above_21 * 100;
$percentage_female_above_21 = ($total_female - $total_girls_under_21) / $total_above_21 * 100;

$data = [
    ['Statistic', 'Value'],
    ['Total Registered People', $total_registered],
    ['Total Boys Under 21', $total_boys_under_21],
    ['Total Girls Under 21', $total_girls_under_21],
    ['Total People Under 21', $total_under_21 . ' (' . $percentage_under_21 . '%)'],
    ['Total Males', $total_male],
    ['Total Females', $total_female],
    ['Total People Above 21', $total_above_21],
    ['Percentage of Males Above 21', $percentage_male_above_21 . '%'],
    ['Percentage of Females Above 21', $percentage_female_above_21 . '%'],
];

if (isset($_POST['download'])) {
    $filename = 'statistics.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $fp = fopen('php://output', 'w');
    foreach ($data as $row) {
        fputcsv($fp, $row);
    }
    fclose($fp);

    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Census Management System</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Statistics</h1>
    <a href="http://localhost/Group 12/view_data.php">Go back</a>
    <div class="container">
        <p>Total Registered People: <?php echo $total_registered; ?> </p>
        <p>Total Boys Under 21: <?php echo $total_boys_under_21; ?> </p>
        <p>Total Girls Under 21: <?php echo $total_girls_under_21; ?> </p>
        <p>Total People Under 21: <?php echo $total_under_21; ?> (<?php echo $percentage_under_21; ?>%)</p>
        <p>Total Males Under 21: <?php echo $total_male; ?> </p>
        <p>Total Females Under 21: <?php echo $total_female; ?> </p>
        <p>Total People Above 21: <?php echo $total_above_21; ?> </p>
        <p>Percentage of Males Above 21: <?php echo $percentage_male_above_21; ?>%</p>
        <p>Percentage of Females Above 21: <?php echo $percentage_female_above_21; ?>%</p>
    <form method="POST">
        <button type="submit" name="download">Download in CSV file</button>
    </form>    
    </div>
</body>
</html>
