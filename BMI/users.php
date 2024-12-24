<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bmi_calculator";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch users from the database
$sql = "SELECT name, age, weight, height, bmi, bmi_category, date_recorded FROM users";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .back-link {
            margin-top: 20px;
            display: inline-block;
            color: #007BFF;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Users List</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Weight (kg)</th>
                    <th>Height (m)</th>
                    <th>BMI</th>
                    <th>BMI Category</th>
                    <th>Date Recorded</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['weight']; ?></td>
                        <td><?php echo $row['height']; ?></td>
                        <td><?php echo round($row['bmi'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['bmi_category']); ?></td>
                        <td><?php echo $row['date_recorded']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users have calculated their BMI yet.</p>
    <?php endif; ?>

    <a href="index.html" class="back-link">Go back to BMI Calculator</a>

    <?php $conn->close(); ?>
</body>
</html>
