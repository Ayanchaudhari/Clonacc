<?php
include '../admin_panel/db_connection.php';
session_start();

function markAttendance($userId, $status) {
    global $conn;
    $date = date('Y-m-d');
    // Check if an attendance record already exists for the user on the same date
    $sql = "SELECT * FROM employee_attendance WHERE employee_id = '$userId' AND date = '$date'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Update the existing record
        $sql = "UPDATE employee_attendance SET status = '$status' WHERE employee_id = '$userId' AND date = '$date'";
    } else {
        // Insert a new record
        $sql = "INSERT INTO employee_attendance (employee_id, date, status) VALUES ('$userId', '$date', '$status')";
    }
    $conn->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['fingerprint']) && isset($_SESSION['user_id'])) {
        $fingerprint = $_POST['fingerprint'];
        $userId = $_SESSION['user_id'];
        if ($fingerprint === 'sample_fingerprint_data') {
            markAttendance($userId, 'Present');
            $message = "Attendance marked as Present for user ID: $userId";
        } else {
            $message = "Fingerprint not recognized.";
        }
    } else {
        $message = "Fingerprint not detected.";
    }
    header("Location: user_attendance.php?message=" . urlencode($message));
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mark Attendance</title>
    <script>
        function fetchFingerprint() {
            // Simulate checking if the user's finger is put on the fingerprint sensor
            const isFingerOnSensor = Math.random() > 0.5; // Simulate a 50% chance
            if (isFingerOnSensor) {
                const fingerprint = 'sample_fingerprint_data';
                document.getElementById('fingerprint').value = fingerprint;
                alert('Fingerprint detected successfully.');
                document.getElementById('attendanceForm').submit();
            } else {
                alert('Fingerprint not detected. Please put your finger on the sensor.');
            }
        }
    </script>
</head>
<body>
    <form id="attendanceForm" method="POST">
        <input type="hidden" id="fingerprint" name="fingerprint">
        <button type="button" onclick="fetchFingerprint()">Mark Attendance</button>
    </form>
</body>
</html>
