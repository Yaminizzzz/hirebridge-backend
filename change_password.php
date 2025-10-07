<?php
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

if (isset($_POST['user_id']) && isset($_POST['password'])) {
    $reg_number = $_POST['user_id'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $password, $reg_number);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Password updated successfully!";
    } else {
        $response['success'] = false;
        $response['message'] = "Failed to update password.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request.";
}

echo json_encode($response);
?>
