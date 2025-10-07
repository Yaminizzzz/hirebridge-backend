<?php
header('Content-Type: application/json');
$host = "localhost";
$user = "root";
$password = "";
$dbname = "hirebridge";
$port = 3306;

$conn = new mysqli($host, $user, $password, $dbname,$port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // hash password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // check if email already exists
    $check = "SELECT * FROM users WHERE email='$email'";
    $checkResult = mysqli_query($conn, $check);

    if (mysqli_num_rows($checkResult) > 0) {
        $response['success'] = false;
        $response['message'] = "Email already registered";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            $response['success'] = true;
            $response['message'] = "Registration successful";
        } else {
            $response['success'] = false;
            $response['message'] = "Failed to register";
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request";
}

echo json_encode($response);
?>
