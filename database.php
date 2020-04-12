<?php
$config=include __DIR__.'/config.php';
if(!isset($_POST['save'])){
    header('Location: '.$config['BASE_URL']);
    exit;
}

$servername = $config['HOST_NAME'];
$username =$config['DB_USER'];
$password = $config['DB_PASSWORD'];
$database = $config['DB_NAME'];
// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
$description=$conn->real_escape_string($_POST['description']);
$sql = "INSERT INTO details (description) VALUES ('$description')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
