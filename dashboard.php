<?php 
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to the login page if the user is not authenticated
    header("Location: loginform.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ Clinic - Dashboard</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header styling */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .header-logo {
            font-size: 20px;
        }

        /* Navigation links */
        nav a {
            margin-left: 20px;
            text-decoration: none;
            color: #333;
        }

        .sign-in {
            padding: 5px 15px;
            border: 1px solid #333;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
        }

        nav span{
            color:blue;
            margin-left: 20px;
        }

        /* Main content styling */
        .dashboard-container {
            padding: 40px 20px;
            width: 80%;
            margin: 0 auto;
        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        /* Edit button styling */
        .edit-button {
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid #0073e6;
            color: #0073e6;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Footer styling */
        footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #ddd;
        }

        .footer-content {
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 800px;
            margin: 0 auto;
            flex-wrap: wrap;
        }

        .footer-content div {
            margin: 0 20px;
            text-align: center;
        }

        .footer-content .separator {
            border-left: 1px solid #333;
            height: 40px;
            margin: 0 20px;
        }

        .footer-bottom {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-content .separator {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="header-logo">XYZ CLINIC</div>
        <nav>
            <a href="Dashboard.html">Dashboard</a>
            <a href="Doctors.html">Doctors</a>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <!-- Display the user's name if logged in -->
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</span>
            <?php else: ?>
            <!-- Display the Sign In link if not logged in -->
            <a href="loginform.php" class="sign-in">Sign In</a>
            <?php endif; ?>
            
        </nav>
    </header>

    <!-- Dashboard Section -->
    <div class="dashboard-container">
        <?php echo "Welcome to your dashboard, " . htmlspecialchars($_SESSION['fullname']) . "!"; ?>
        <h2>My Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2024</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2025</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2026</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2027</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2028</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2024</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2025</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2026</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2027</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2028</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2024</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2025</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2026</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2027</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
                <tr>
                    <td>Dr Tan Ah Seng</td>
                    <td>Nanyang Heights</td>
                    <td>Friday, 20 September 2028</td>
                    <td>4pm - 5pm</td>
                    <td><a href="#" class="edit-button">Edit</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <div>
                <p>XYZ CLINIC</p>
            </div>
            <div class="separator"></div>
            <div>
                <p><strong>Contact us</strong><br>81234567</p>
            </div>
            <div class="separator"></div>
            <div>
                <p><strong>Location</strong><br>Singapore 812345<br>Nanyang Heights</p>
            </div>
        </div>
        <div class="footer-bottom">
            © 2010 — 2020 Privacy — Terms
        </div>
    </footer>

</body>
</html>
