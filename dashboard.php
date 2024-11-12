<?php 
include 'files/php/connect.php';
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to the login page if the user is not authenticated
    header("Location: loginform.php");
    exit();
}

if ($_SESSION['id'] == 1 || $_SESSION['id'] == 2){
    header("Location: dr-dashboard.php");
}

$patientID = $_SESSION['id'];
$query = ("SELECT 
    a.*, 
    u1.fullname AS patient_name, 
    u1.phone_no AS patient_phone,
    u2.fullname AS doctor_name,
    u2.phone_no AS doctor_phone
    FROM appointments a 
    JOIN users u1 ON a.patient_id = u1.id 
    JOIN users u2 ON a.doctor_id = u2.id 
    WHERE a.patient_id = '$patientID';");

$result = $db->query($query);

$appointments = [];
while ($row = $result->fetch_assoc()){
    $appointments[] = $row;
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
            justify-content: space-between; /* Ensure footer stays at the bottom */
            min-height: 100vh;
            background: url('b.webp') repeat center center fixed;
            background-repeat: repeat; /* Repeat the background image */
            background-size: auto; /* Maintain original resolution */
            background-position: top left; Positioning the repeated image

        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9); /* Light overlay */
            z-index: 1;
        }
        /* Header styling */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #f4f4f4;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            z-index: 2; /* Ensure it appears above the overlay */

        }

        .header-logo {
            font-size: 20px;
        }

        /* Division links */
        div a {
            text-decoration: none;
            color: black;
        }
        a:visited {
        color: rgb(0, 0, 0);
        }

        a:hover {
        color: grey;
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
            margin-left: 20px;
            z-index: 5000; /* Ensure it appears above the overlay */
            font-weight: bold;
        }

        /* Main content styling */
        .dashboard-container {
            padding: 40px 20px;
            width: 80%;
            margin: 0 auto;
            z-index: 1; /* Ensure it appears above the overlay */

        }

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            z-index: 2; /* Ensure it appears above the overlay */
            border-radius: 8px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            z-index: 1; /* Ensure it appears above the overlay */

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
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
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
            transition: all 0.3s ease;
        }

        .edit-button:hover {
            background-color: #0073e6;
            color: #fff;
        }

        /* Logout button container styling */
        .logout-button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            z-index: 2; /* Ensure it appears above the overlay */

        }

        /* Logout button styling */
        #logout-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background-color: #ff6b6b;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.3);

        }

        #logout-btn:hover {
            background-color: #ff5252;
            box-shadow: 0 6px 14px rgba(255, 82, 82, 0.4);
        }

        /* Footer styling */
        footer {
            background-color: #f4f4f4;
            padding: 20px 0;
            text-align: center;
            z-index: 1; /* Ensure it appears above the overlay */
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

        .footer-content p {
            font-size: 14px;
            color: black;
            line-height: 1.5;
        }

        /* Bold styling for "Contact us" and "Location" */
        .footer-content p strong {
            font-weight: bold;
        }

        .footer-bottom {
            font-size: 14px;
            color: black;
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
<div class="overlay"></div>

    <!-- Header Section -->
    <header>
    <div><a class="index-link" href="index.html">XYZ CLINIC</a></div>
    <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="doctors.php">Doctors</a>
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
    <h2><?php echo "Welcome to your dashboard, " . htmlspecialchars($_SESSION['fullname']) . "!"; ?></h2>
        <h2>My Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Location</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Phone No.</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($appointments)): ?>
        <tr>
            <td colspan="6">No appointments found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($appointments as $index=>$appointment): ?>
            <tr>
                <td><?php 
                if ($appointment['doctor_id'] == 1){
                    echo htmlspecialchars('Dr Tan Ah Seng');
                } else if ($appointment['doctor_id'] == 2){
                    echo htmlspecialchars('Dr Wong Xiao Ming');
                }
                ?>
                </td>     
                <td><?php echo htmlspecialchars("Nanyang Heights"); ?></td>
                <td><?php echo date("l, d F Y", strtotime($appointment['appointment_date'])); ?></td>
                <td><?php echo date("g:iA", strtotime($appointment['appointment_time'])); ?></td>
                <td><?php echo $appointment['doctor_phone'] ?></td>
                <td><form action="files/php/reschedule-handler.php" id="reschedule-form-<?php echo $index;?>" method="POST">
                    <input type="hidden" name="doctor_id" value="<?= $appointment['doctor_id'] ?>">
                    <input type="hidden" name="date" value="<?= $appointment['appointment_date'] ?>"> 
                    <input type="hidden" name="time" value="<?= $appointment['appointment_time'] ?>">
                    <button onclick="confirmAlert(<?php echo $index; ?>);" type="button" id="reschedule-button" class="edit-button">Reschedule/Cancel</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="logout-button-container">
        <a href="files/php/logout.php" id="logout-btn">Log Out</a>
    </div>
    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <div>
                <p>XYZ CLINIC</p>
            </div>
            <div class="separator"></div>
            <div>
                <p><strong>Contact Us</strong><br>81234567</p>
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
    <script>
        function confirmAlert(index){
            var confirmation = confirm('This will cancel your current appointment and redirect you to the doctor\'s booking page. Are you sure you want to continue?')
            if (confirmation){
                document.getElementById('reschedule-form-' + index).submit();
            }
        }
    </script>
</body>
</html>
