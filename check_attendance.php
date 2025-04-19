<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login_page/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'biometric_system_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM employee_attendance WHERE employee_id = ? AND date BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $employee_id, $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Attendance Records</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                background-color: #f4f4f4;
            }

            .container {
                max-width: 800px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                text-align: center;
            }

            h3 {
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: center;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                echo "<h3>Attendance Records for Employee ID: $employee_id from $start_date to $end_date</h3>";
                echo "<table>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['date'] . "</td>
                            <td>" . $row['status'] . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>No attendance records found for Employee ID: $employee_id from $start_date to $end_date</h3>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
    </body>
    </html>
    <?php
}
?>
