<?php
include('database/db_connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Children Information</title>
    <link rel="stylesheet" href="child.css">
    <style>
        
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 5%;
    padding: 0;
    display: block;
    justify-content: center;
    align-items: center;
    height: 50vh;
    width: 75%;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

input, select {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
    box-sizing: border-box;
}

button {
    background-color: #3e403e;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
    </style>
</head>
<body>
    <h1>Enter Childrens Information</h1>
    <form action="child_process.php" methos="POST">
        <label for="name">Name:</label>
        <input type="text" id="parent_id" name="name" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="placeOfBirth">Place of Birth:</label>
        <input type="text" id="placeOfBirth" name="placeOfBirth" required>

        <label for="dateOfBirth">Date of Birth:</label>
        <input type="date" id="child_dob" name="dateOfBirth" required>

        <button type="button" onclick="addRow()">Add to Table</button>
        <a href="http://localhost/Group 12/reg.php">
            <button type="button">Done</button>
        </a>
        
    </form>

    <table id="childTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Place of Birth</th>
                <th>Date of Birth</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be added dynamically -->
        </tbody>
    </table>

    <script>
        function addRow() {
            var form = document.getElementById('childForm');
            var table = document.getElementById('childTable').getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.rows.length);
            var cells = [];

            for (var i = 0; i < 4; i++) {
                cells[i] = newRow.insertCell(i);
                cells[i].innerHTML = form.elements[i].value;
            }

            // Clear the form after adding a row
            form.reset();
        }
    </script>

</body>
</html>

