<?php
header('Content-Type: application/json');

$host = "localhost";
$user = "root";
$password = "";
$dbname = "hirebridge";
$port = 3306;

$conn = new mysqli($host, $user, $password, $dbname, $port);

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $response['success'] = true;
        $response['message'] = "Login successful";
        $response['user'] = array(
            "id" => $row['id'],
            "email" => $row['email'],
            "username" => $row['username'],
            "phone" => $row['phone'],
            "detailsFilled" => ($row['details_filled'] == 1 ? true : false)
        );
    } else {
        $response['success'] = false;
        $response['message'] = "Invalid email or password";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request";
}

echo json_encode($response);
?>