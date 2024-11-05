<?php
session_start();
include '../files/php/connect.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to the login page if the user is not authenticated
    header("Location: ../loginform.php");
    exit();
}
if (isset($_POST['datePicker'])) {
    $date = $_POST['datePicker'];
} else {
    $date = date("Y-m-d");
}


if (isset($_GET['message']) && $_GET['message'] == 'fail'){
    echo "<script> window.onload = function() {
            alert('Failed to book appointment. Please try again later');";
            echo "window.location.href = 'WXMS.php';}; </script>";
} else if (isset($_GET['message']) && $_GET['message'] == 'success'){
    echo "<script> window.onload = function() {
        alert('Appointment booked. An email reminder has been sent!');";
        echo "window.location.href = 'WXMS.php';}; </script>";
} else if (isset($_GET['message']) && $_GET['message'] == 'invalid'){
    echo "<script> window.onload = function() {
        alert('Unable to book as you are a doctor in the clinic. Please go to the dashboard to edit your appointments');";
        echo "window.location.href = 'WXMS.php';}; </script>";
}

$doctor_id = 2; 

// Define the time slots (in 24-hour format for compatibility with the database)
$time_slots = ['11:30:00', '12:30:00', '13:30:00', '14:30:00', '15:30:00'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ Clinic - Appointment</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 20px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }

        nav a {
            margin-right: 20px;
            text-decoration: none;
            color: black;
        }

        .sign-up {
            padding: 5px 15px;
            border: 1px solid black;
            text-decoration: none;
            color: black;
            border-radius: 5px;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 40px auto;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .filter-section {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-section select, .filter-section input {
            padding: 10px;
            font-size: 16px;
        }

        .filter-section button {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        td {
            background-color: #fafafa;
        }

        .unavailable-slot {
            background-color: #f44336;
            color: white;
            font-weight: bold;
        }

        .available-slot {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: block;
        }

        footer {
            background-color: #f4f4f4;
            padding: 20px 0;
            text-align: center;
            width: 100%;
            margin-top: auto;
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
            color: black;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <div>XYZ CLINIC</div>
        <nav>
            <a href="../dashboard.php">Dashboard</a>
            <a href="../doctors.php">Doctors</a>
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <!-- Display the user's name if logged in -->
            <span>Welcome, <?php echo htmlspecialchars($_SESSION['fullname']); ?>!</span>
            <?php else: ?>
            <!-- Display the Sign In link if not logged in -->
            <a href="loginform.php" class="sign-in">Sign In</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- Appointment Booking Container -->
    <div class="container">
        <h1>Dr Wong Xiao Ming</h1>
        <div class="filter-section">
        <form method="POST" action="TASS.php" id="dateForm">
            <input type="date" name="datePicker" id="datePicker" value="<?php echo htmlspecialchars($date); ?>" onchange="testFunction(this);">
        </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Time</th>
                        <th id="day">
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($time_slots as $time): ?>
                <tr>
                    <td><?= date("g:i A", strtotime($time)) ?></td>
                        <?php
                            $query = ("SELECT appointment_date, appointment_time
                                FROM appointments
                                WHERE doctor_id = '$doctor_id' AND appointment_date = '$date' 
                                AND appointment_time = '$time';");
                            $result = $db->query($query);
                            if ($result && $result->num_rows>0){
                                $is_available = false;
                            } else {
                                $is_available = true;
                            }
                        ?>
                    <td class="<?= $is_available ? 'available-slot' : 'unavailable-slot' ?>">
                        <?php if ($is_available): ?>
                            <!-- Form to send appointment details via POST -->
                            <form id="appointment-form" action="../files/php/set-appointment.php" method="POST" style="display:block;">
                                <input type="hidden" name="date" value="<?= $date ?>">
                                <input type="hidden" name="time" value="<?= $time ?>">
                                <input type="hidden" name="doctor_id" value="<?= $doctor_id ?>">
                                <button type="button" onclick="confirmAlert('<?php echo $time ?>');" class="available-slot" style="background:none; border:none; color:inherit; cursor:pointer; width:100%;">
                                    Available
                                </button>
                            </form>
                        <?php else: ?>
                            X
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
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

    <script>
         function updateDates() {
            const datePicker = document.getElementById('datePicker');
            const date = new Date(datePicker.value);
            const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            document.getElementById('day').textContent = 
            days[date.getDay()] + ' ' + (date.getMonth()+1) + '/' + date.getDate() 
             + '/' + date.getFullYear();
        }

        const dateInput = document.getElementById('datePicker')
        const today = new Date();
        const formattedToday = today.toISOString().split('T')[0];
        dateInput.setAttribute('min', formattedToday);
        dateInput.addEventListener('input', function () {
            const selectedDate = new Date(this.value);
            const day = selectedDate.getUTCDay();

            // Check if the selected day is Saturday (6) or Sunday (0)
            if (day === 6 || day === 0) {
                alert("Weekends are not available. Please choose a weekday.");
                this.value = formattedToday; // Clear the input if a weekend is selected
            }
        });

        function confirmAlert(selectedTime){
            const datePicker = document.getElementById('datePicker');
            const date = new Date(datePicker.value);
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            

            const selectedDate = `${month}/${day}/${year}`
            var confirmation = confirm(`${selectedDate} at ${selectedTime} has been selected for booking. Would you like to continue?`);
            if (confirmation) {
                document.getElementById('appointment-form').submit(); 
            }
        }

        // Initialize table dates on page load
        updateDates();
        function testFunction(datePicker){
            updateDates();
            datePicker.form.submit();
        }
        
        
    </script>
</body>
</html>