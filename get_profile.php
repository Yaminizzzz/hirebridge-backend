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

$user_id = $_GET['user_id'];

$query = "SELECT username, college, email, phone, languages FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

$response = array();

if ($row = mysqli_fetch_assoc($result)) {
    $response['username'] = $row['username'];
    $response['college'] = $row['college'];
    $response['email'] = $row['email'];
    $response['phone'] = $row['phone'];
    $response['languages'] = $row['languages'];
}

echo json_encode($response);
?>
