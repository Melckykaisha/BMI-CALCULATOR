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

// Retrieve form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$height = $_POST['height'];

// Calculate BMI
$bmi = $weight / ($height * $height);

// Determine BMI Category
if ($age < 18) {
    if ($bmi < 18.5) {
        $category = "Underweight (approx.)";
    } elseif ($bmi < 25) {
        $category = "Healthy weight (approx.)";
    } elseif ($bmi < 30) {
        $category = "Overweight (approx.)";
    } else {
        $category = "Obese (approx.)";
    }
} elseif ($age >= 65) {
    if ($bmi < 22) {
        $category = "Underweight";
    } elseif ($bmi < 27) {
        $category = "Healthy weight";
    } elseif ($bmi < 30) {
        $category = "Overweight";
    } else {
        $category = "Obese";
    }
} else {
    if ($bmi < 18.5) {
        $category = "Underweight";
    } elseif ($bmi < 25) {
        $category = "Normal weight";
    } elseif ($bmi < 30) {
        $category = "Overweight";
    } else {
        $category = "Obese";
    }
}

// Insert data into the database
$sql = "INSERT INTO users (name, age, weight, height, bmi, bmi_category) 
        VALUES ('$name', $age, $weight, $height, $bmi, '$category')";

if ($conn->query($sql) === TRUE) {
    echo "BMI data saved successfully!<br>";
    echo "Your BMI Category: <strong>$category</strong><br>";
    echo "<br><a href='index.html'>Go back to Calculator</a>";
    echo "<br><a href='users.php'>View All Users</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>