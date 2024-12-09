<?php
$host = 'localhost';
$username = 'root';
$password = 'admin';
$dbname = 'baranggaySystem';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $requestId = $_POST['requestId'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];

    $sql = "UPDATE service 
            SET feedback = ?, rating = ?, alreadyFeedback = 1 
            WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssi", $feedback, $rating, $requestId);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Feedback submitted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to submit feedback']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing the SQL query']);
    }
}

$conn->close();
?>