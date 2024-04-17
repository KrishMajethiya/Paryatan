<?php
$localhost = "localhost";
$user = "root";
$password = "Pr@12444";
$dbname = "SL_project";

// Create connection
$conn = new mysqli($localhost, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data if it's a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['myname1'];
    $email = $_POST['myemail'];
    $phoneNo = $_POST['myphone'];
    $age = $_POST['myage'];
    $gender = $_POST['mygender'];
    $package = $_POST['locations'];
    $plannning_for = $_POST['planning_for'];
    $terms_accepted = isset($_POST['t&c']) ? 1 : 0;

    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO  registrationform (name, email, phoneNo, age, gender, package, planning_for, t_and_c_accepted) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiissii", $name, $email, $phoneNo, $age, $gender, $package, $plannning_for, $terms_accepted);

    // Execute the statement
    if ($stmt->execute()) {
        // echo "You've registered successfully";

        header("Location: http://127.0.0.1:5500//firstflight-travels-main/index.html");
    } else {
        echo "Error occurred while registering";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
