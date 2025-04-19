<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login_page/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = trim($_POST['employee_id']);
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);
    $reason = trim($_POST['reason']);

    // Validate input
    if (empty($employee_id) || empty($start_date) || empty($end_date) || empty($reason)) {
        echo "All fields are required.";
        exit();
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'biometric_system_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert leave request into the database
    $sql = "INSERT INTO leave_requests (employee_id, start_date, end_date, reason, status) VALUES (?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $employee_id, $start_date, $end_date, $reason);
        if ($stmt->execute()) {
            echo "Leave request submitted successfully.";
        } else {
            echo "Error submitting leave request: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
}
?>
