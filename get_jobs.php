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


$sql = "SELECT * FROM jobs ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

$jobs = array();
while($row = mysqli_fetch_assoc($result)) {
    $jobs[] = $row;
}

echo json_encode($jobs);
?>
