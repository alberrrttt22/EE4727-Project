<?php
session_start();
include '../files/php/connect.php';

// Set the default time zone
date_default_timezone_set('Singapore'); // Adjust as necessary

if ($_SESSION['id'] > 2){
    $patientID = $_SESSION['id'];
}

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect to the login page if the user is not authenticated
    header("Location: ../loginform.php");
    exit();
}
if (isset($_POST['datePicker'])) {
    $date = $_POST['datePicker'];
    $todayDate = date("Y-m-d");
} else {
    $date = date("Y-m-d");
    $todayDate = date("Y-m-d");
}


if (isset($_GET['message']) && $_GET['message'] == 'fail'){
    echo "<script> window.onload = function() {
            alert('Failed to book appointment. Please try again later');";
            echo "window.location.href = 'TASS.php';}; </script>";
} else if (isset($_GET['message']) && $_GET['message'] == 'success'){
    echo "<script> window.onload = function() {
        alert('Appointment booked. An email reminder has been sent!');";
        echo "window.location.href = 'TASS.php';}; </script>";
} else if (isset($_GET['message']) && $_GET['message'] == 'invalid'){
    echo "<script> window.onload = function() {
        alert('Unable to book as you are a doctor in the clinic. Please go to the dashboard to edit your appointments');";
        echo "window.location.href = 'TASS.php';}; </script>";
}

$doctor_id = 1; 

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
            color: #333;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Ensure footer stays at the bottom */
            min-height: 100vh;
            background: url('../b.webp') repeat center center fixed;
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
            z-index: 2; /* Ensure it appears above the overlay */

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
        
        /* Footer styling */
        footer {
            background-color: #f4f4f4;
            padding: 20px 0;
            text-align: center;
            z-index: 2; /* Ensure it appears above the overlay */

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
            
        footer {
                background-color: #f4f4f4;
                padding: 20px 0;
                text-align: center;
                width: 100%;
                margin-top: auto;
                z-index: 2; /* Ensure it appears above the overlay */

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


        /* Logout button styling */
        

        /* Logout button container styling */
        .logout-button-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
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
    </style>
</head>
<body>
<div class="overlay"></div>
    <!-- Header Section -->
    <header>
    <div><a class="index-link" href="../index.html">XYZ CLINIC</a></div>
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
        <h1>Dr Tan Ah Seng</h1>
        <div class="filter-section">
        <form method="POST" action="TASS.php" id="dateForm">
            <input type="date" name="datePicker" id="datePicker" min="<?php echo htmlspecialchars($todayDate); ?>" value="<?php echo htmlspecialchars($date); ?>" onchange="testFunction(this);">
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
                <?php foreach ($time_slots as $index=>$time): ?>
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
                            <form id="appointment-form-<?php echo $index;?>" action="../files/php/set-appointment.php" method="POST" style="display:block;">
                                <input type="hidden" name="date" value="<?php echo $date ?>">
                                <input type="hidden" name="time" value="<?php echo $time ?>">
                                <input type="hidden" name="doctor_id" value="<?php echo $doctor_id ?>">
                                <button type="button" onclick="confirmAlert('<?php echo $time ?>', '<?php echo $index ?>');" class="available-slot" style="background:none; border:none; color:inherit; cursor:pointer; width:100%;">
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
    <div class="logout-button-container">
        <a href="../files/php/logout.php" id="logout-btn">Logout</a>
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
            days[date.getDay()] + ' ' + date.getDate() + '/' + (date.getMonth()+1)
             + '/' + date.getFullYear();
        }

        const dateInput = document.getElementById('datePicker')
        // const today = new Date();
        // const formattedToday = today.toISOString().split('T')[0];
        // dateInput.setAttribute('min', formattedToday);
        dateInput.addEventListener('input', function () {
            const selectedDate = new Date(this.value);
            const day = selectedDate.getUTCDay();

            // Check if the selected day is Saturday (6) or Sunday (0)
            if (day === 6 || day === 0) {
                alert("Weekends are not available. Please choose a weekday.");
                this.value = "<?= date('Y-m-d', strtotime($todayDate)); ?>"; // Clear the input if a weekend is selected
            }
        });

        function confirmAlert(selectedTime, index){
            const datePicker = document.getElementById('datePicker');
            const date = new Date(datePicker.value);
            const day = date.getDate();
            const month = date.getMonth() + 1;
            const year = date.getFullYear();
            

            const selectedDate = `${month}/${day}/${year}`
            var confirmation = confirm(`${selectedDate} at ${selectedTime} has been selected for booking. Would you like to continue?`);
            
            if (confirmation) {
                document.getElementById('appointment-form-'+ index).submit(); 
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