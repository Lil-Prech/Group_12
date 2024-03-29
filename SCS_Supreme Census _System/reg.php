<?php
    session_unset();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Population Census</title>
    <link rel="stylesheet" href="./css/reg.css">
</head>
<body>
    <div class="container">
        <h1>Population Census Registration</h1>
        <form id="registrationForm">
            <!-- User Information -->
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <!-- Date of Birth -->
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>

            <!-- Add more fields for address, region, etc. -->

            <!-- Children Information -->
            <label for="maleChildren">Number of Male Children:</label>
            <input type="number" id="maleChildren" name="maleChildren" required>

            <label for="femaleChildren">Number of Female Children:</label>
            <input type="number" id="femaleChildren" name="femaleChildren" required>

            <!-- Children Age Information -->
            <label for="childrenUnder21">Number of Children Under 21:</label>
            <input type="number" id="childrenUnder21" name="childrenUnder21" required>

            <label for="childrenAbove21">Number of Children Above 21:</label>
            <input type="number" id="childrenAbove21" name="childrenAbove21" required>

            <!-- Region Information -->
            <label for="region">Region:</label>
            <select id="region" name="region" required>
                <option value="north">North West</option>
                <option value="south">South West</option>
                <option value="central">Central</option>
                <option value="west">West</option>
            </select>
            <a href="http://localhost/Group 12/child.php">
            Enter Children's Info
            </a>
            <button type="button" onclick="checkAgeAndSubmit()">
            <a href="http://localhost/Group 12/thankyou.php">
            Register
            </button>
            </a> 
            
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
