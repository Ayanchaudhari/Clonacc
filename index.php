<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biometric Attendance System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #6df072;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50px;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #FFD700;
        }

        .hero {
            position: relative;
            text-align: center;
            padding: 50px;
            background: url('../img/Bag2.jpg') no-repeat center center/cover; /* Updated background image */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 465px;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 20px;
            z-index: 1;
        }

        .hero h2, .hero p, .hero button {
            position: relative;
            z-index: 2;
        }

        .hero h2:hover {
            color: #FFD700;
            transform: scale(1.1);
            transition: color 0.3s, transform 0.3s;
        }

        .hero button {
            background-color: #FFD700;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .hero button:hover {
            background-color: #FFA500;
            transform: scale(1.1);
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
        }

        .feature {
            flex: 1 1 calc(33.33% - 40px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 20px;
            text-align: center;
            background-color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .feature {
                flex: 1 1 calc(100% - 40px);
            }
        }

        .about {
            padding: 40px 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .about h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        .about-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .about-text {
            flex: 1 1 45%;
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
        }

        .about-images {
            flex: 1 1 45%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .about-images img {
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Add smooth transition effect for the entire page */
        * {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    <header>
        <h1>Biometric Attendance System</h1>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="../home_page/bio_about.html">About</a></li>
                <li><a href="../login_page/login.php" id="login" class="nav-item nav-link">Login</a></li>
                <li id="username-display" style="display: none;"></li> <!-- Added username display -->
                <li id="logout" style="display: none;"><a href="../login_page/logout.php">Logout</a></li> <!-- Added logout link -->
            </ul>
        </nav>
    </header>

    <section class="hero">
        <!--<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQb254Y9j8HubI3jcyFfEfuI3U8GtUsco-UhQ&s" alt="Biometric Attendance System">-->
        <h2>Welcome to the Future of Attendance Management</h2>
        <p>Accurate, Secure, and Effortless.</p>
        <button onclick="location.href='bio_about.html'">Learn More</button>

    </section>

    <section id="features" class="features">
        <div class="feature" onclick="location.href='../home_page/user_attendance.php'">
            <h3>Mark Attendance</h3>
            <p>Secure biometric authentication.</p>
        </div>
        <div class="feature" onclick="location.href='../home_page/check_attendance_form.php'">
            <h3>Check Attendance</h3>
            <p>Real-time attendance tracking.</p>
        </div>
        <div class="feature" onclick="location.href='../home_page/leave_request_form.php'">
            <h3>Request For Leave</h3>
            <p>Submit your leave request.</p>
        </div>
    </section>

    <section class="about">
        <h2>About Biometric Attendance System</h2>
        <div class="about-content">
            <div class="about-text">
                <p>The Biometric Attendance System is a revolutionary solution for managing attendance with precision and security. By leveraging biometric technology, it eliminates the chances of proxy attendance and ensures accurate tracking of employee presence.</p>
                <p>Our system is designed to be user-friendly, efficient, and reliable, making it the perfect choice for organizations of all sizes. Experience the future of attendance management today!</p>
            </div>
            <div class="about-images">
                <div>
                    <img src="../img/bio_2.jpg" alt="Biometric Scanner" class="fade-in">
                    <p>Biometric scanners ensure secure and accurate attendance tracking.</p>
                </div>
                <div>
                    <img src="../img/Bag.jpg" alt="Attendance Dashboard" class="fade-in">
                    <p>The attendance dashboard provides real-time insights and analytics.</p>
                </div>
            </div>
        </div>
    </section>

    <div id="attendance-form" style="display: none; text-align: center; margin: 20px;">
        <h3>Check Your Attendance</h3>
        <form action="../home_page/check_attendance.php" method="post">
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" required>
            <button type="submit">Check Attendance</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Biometric Attendance System. All rights reserved.</p>
    </footer>

    <script>
        function displayAlert() {
            alert("Welcome to the Biometric Attendance System! Stay tuned for more features.");
        }

        document.querySelectorAll('nav ul li a').forEach(link => {
            link.addEventListener('click', function(event) {
                const href = this.getAttribute('href');
                if (href.startsWith('#')) {
                    event.preventDefault();
                    const sectionId = href.substring(1);
                    const section = document.getElementById(sectionId);
                    if (section) {
                        section.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });

        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.backgroundColor = '#3e8e41';
            } else {
                header.style.backgroundColor = '#4CAF50';
            }
        });

        // Check if the user is logged in and display the username and logout link
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($_SESSION['username'])): ?>
                var username = "<?php echo $_SESSION['username']; ?>";
                var usernameDisplay = document.getElementById("username-display");
                var logoutLink = document.getElementById("logout");
                var loginLink = document.getElementById("login");
                usernameDisplay.style.display = "inline";
                usernameDisplay.textContent = "Welcome, " + username;
                logoutLink.style.display = "inline";
                loginLink.style.display = "none";
            <?php else: ?>
                var loginLink = document.getElementById("login");
                var logoutLink = document.getElementById("logout");
                loginLink.style.display = "inline";
                logoutLink.style.display = "none";

                // Redirect to login page if trying to access features without being logged in
                document.querySelectorAll('.feature').forEach(feature => {
                    feature.addEventListener('click', function(event) {
                        event.preventDefault();
                        alert("Please log in to access this feature.");
                        window.location.href = '../login_page/login.php';
                    });
                });
            <?php endif; ?>
        });

        function showAttendanceForm() {
            <?php if (isset($_SESSION['username'])): ?>
                document.getElementById('attendance-form').style.display = 'block';
            <?php else: ?>
                alert("Please log in to access this feature.");
                window.location.href = '../login_page/login.php';
            <?php endif; ?>
        }

        // Add fade-in effect for images
        document.addEventListener("DOMContentLoaded", function () {
            const images = document.querySelectorAll(".about-images img");
            images.forEach((img, index) => {
                img.style.animationDelay = `${index * 0.3}s`;
            });
        });
    </script>
</body>
</html>
