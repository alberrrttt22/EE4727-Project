<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ Clinic - Our Doctors</title>
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
            background: url('bb.jpg') repeat center center fixed;
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
            padding: 20px;
            font-weight: bold;
            background-color: #f4f4f4;
            border-bottom: 1px solid #ccc;
            position: relative;
            z-index: 2; /* Ensure it appears above the overlay */
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
            margin-right: 20px;
            text-decoration: none;
            color: black;
        }

        .sign-in {
            padding: 5px 15px;
            text-decoration: none;
            color: black;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: black;
            background-color: white;
        }

        /* Main content styling */
        .doctors-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            flex-grow: 1;
            position: relative;
            z-index: 2; /* Ensure it appears above the overlay */
        }
        .doctor-card a:hover {
            color: grey; /* Change to blue on hover */
        }

        /* Doctors grid styling */
        .doctors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            width: 80%;
            max-width: 1000px;
        }

        .doctor-card {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);    
            margin-bottom: 10px;
        }

        .doctor-card img {
            width: 100px;
            height: 100px;
            background-color: black;
            margin-bottom: 10px;
            border-radius: 50%;
        }

        .doctor-card h3 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        .doctor-card a {
            color: #555;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        /* Footer styling */
        footer {
            background-color: #f4f4f4;
            padding: 20px 0;
            text-align: center;
            position: relative;
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

    <!-- Doctors Section -->
    <div class="doctors-container">
        <h2>Our Doctors</h2>
        <div class="doctors-grid">
            <!-- Doctor 1 -->
            <div class="doctor-card">
                <img src="drpic/TAS.jpg" alt="Doctor Profile Image">                
                <h3>Dr Tan Ah Seng</h3><br>
                <p style="text-align: justify;">Dr. Tan is a dedicated general dentist with over a decade of experience in family dentistry. He specializes in preventive care, restorative dentistry, and cosmetic procedures, using the latest techniques and technologies to ensure his patients achieve optimal oral health. He is passionate about educating her patients on good dental hygiene practices and creating personalized treatment plans that meet their unique needs.</p><br>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
                    echo '<a href="SCHEDULES/TASS.php">See More ></a>';
                } else{
                    echo '<a href="loginform.php">Sign in to book an appointment! ></a>';
                }; ?>
            </div>
            <!-- Doctor 2 -->
            <div class="doctor-card">
                <img src="drpic/WXM.jpg" alt="Doctor Profile Image">
                <h3>Dr Wong Xiao Ming</h3><br>
                <p style="text-align: justify;">Dr. Wong is a compassionate pediatric dentist known for his gentle approach to treating young patients. He pursued a specialization in pediatric dentistry, focusing on the unique dental needs of children and adolescents. Dr. Wong creates a welcoming and playful atmosphere in his clinic, helping children feel at ease during their visits. He emphasizes the importance of preventive care and teaches kids about maintaining good oral health in a fun and engaging way.</p><br>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
                    echo '<a href="SCHEDULES/WXMS.php">See More ></a>';
                } else{
                    echo '<a href="loginform.php">Sign in to book an appointment! ></a>';
                }; ?>
            </div>
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

    <!-- Logout Button (only displayed if logged in) -->
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <div class="logout-button-container">
            <a href="files/php/logout.php" id="logout-btn">Logout</a>
        </div>
    <?php endif; ?>

</body>
</html>
