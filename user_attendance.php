<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../login_page/login.php');
    exit();
}
include '../admin_panel/db_connection.php';

// Ensure the database connection is active
if (!isset($conn) || !$conn || $conn->connect_error) {
    error_log("Database connection failed or is not initialized: " . ($conn->connect_error ?? 'Unknown error'));
    die("Database connection failed. Please contact the administrator.");
}

function markAttendance($userId, $status) {
    global $conn;
    if (!$conn || $conn->connect_error) {
        error_log("Database connection is not active in markAttendance function.");
        return;
    }
    $date = date('Y-m-d');
    // Check if an attendance record already exists for the user on the same date
    $sql = "SELECT * FROM employee_attendance WHERE employee_id = '$userId' AND date = '$date'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Update the existing record
        $sql = "UPDATE employee_attendance SET status = '$status' WHERE employee_id = '$userId' AND date = '$date'";
    } else {
        // Insert a new record
        $sql = "INSERT INTO employee_attendance (employee_id, date, status) VALUES ('$userId', '$date', '$status')";
    }
    if (!$conn->query($sql)) {
        error_log("Error updating attendance: " . $conn->error);
    }
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
    }
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            flex: 1;
        }
        header, footer {
            background-color:rgb(255, 255, 255);
            padding: 10px 20px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(21, 250, 0, 0.99);
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
            color:rgb(243, 36, 9);
            transition: color 0.3s, background-color 0.3s;
            padding: 5px 10px;
            border-radius: 4px;
        }
        nav a:hover {
            color: #fff;
            background-color:rgb(102, 255, 0);
        }
        main {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        section {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-top: 20px; /* Added margin-top to move section below navbar */
        }
        section:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        h2 {
            margin-top: 0;
        }
        button {
            background-color: rgb(102, 255, 0);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        button:hover {
            background-color: rgb(243, 36, 9);
            transform: scale(1.05);
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: calc(100% - 22px);
            margin-bottom: 10px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
            border-color: rgb(102, 255, 0);
        }
        .fingerprint-gateway {
            display: none;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .fingerprint-gateway img {
            width: 200px;
            height: 200px;
        }
    </style>
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

        function showFingerprintGateway() {
            fetchFingerprint();
        }
    </script>
</head>
<body>
    <header>
        <h1>User Attendance</h1>
        <nav>
            <a href="../home_page/index.php">Home</a>
            <a href="../home_page/bio_about.html">About</a>
            <a href="../home_page/index.php">Services</a>
            <a href="../home_page/index.php">Contact</a>
        </nav>
    </header>
    <div class="container">
        <main>
            <section id="user-attendance">
                <h2>User Attendance</h2>
                <button onclick="showFingerprintGateway()">Mark Attendance</button>
                <?php if (isset($message)): ?>
                    <p><?php echo $message; ?></p>
                <?php endif; ?>
                <div id="error-message" class="error-message"></div> <!-- Error message div -->
            </section>
            <div id="fingerprint-gateway" class="fingerprint-gateway">
                <h2>Fingerprint Gateway</h2>
                <img src="../img/finger.jpg" alt="Fingerprint Image">
                <form id="attendanceForm" method="POST">
                    <input type="hidden" id="fingerprint" name="fingerprint">
                </form>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; 2023 Biometric Admin Panel. All rights reserved.</p>
    </footer>
</body>
</html>
