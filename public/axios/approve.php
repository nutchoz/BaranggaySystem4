<?php
require_once('../../includes/functions.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($id > 0) {
        $response = SQLFunction::updateToApprove($id);
        echo json_encode(['success' => true, 'message' => 'Request updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request ID']);
    }
}
?>