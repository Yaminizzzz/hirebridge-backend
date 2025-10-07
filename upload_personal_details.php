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


$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$gender = $_POST['gender'];
$languages = $_POST['languages'];
$college = $_POST['college'];
$cgpa = $_POST['cgpa'];
$domain = $_POST['domain'];

$resumePath = "";
if (isset($_FILES['resume'])) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $resumePath = $targetDir . basename($_FILES['resume']['name']);
    move_uploaded_file($_FILES['resume']['tmp_name'], $resumePath);
}

$query = "UPDATE users SET 
            username='$username',
            email='$email',
            phone='$phone',
            location='$location',
            gender='$gender',
            languages='$languages',
            college='$college',
            cgpa='$cgpa',
            domain='$domain',
            resume='$resumePath',
            details_filled=1
          WHERE email='$email'";

if (mysqli_query($conn, $query)) {
    echo json_encode(["success" => true, "message" => "Personal details updated successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Error updating details"]);
}
?>
