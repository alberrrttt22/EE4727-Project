<?php
	if (isset($_GET['message']) && $_GET['message'] == 'success') {
		echo "<script> window.onload = function()  {
                alert('Signed up successfully!');";
		        echo "window.location.href = 'loginform.php';}; </script>";
	} else if (isset($_GET['message']) && $_GET['message'] == 'fail'){
		echo "<script> window.onload = function() {
                alert('There is already an account with that email');";
		        echo "window.location.href = 'signupform.php';}; </script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ Clinic - Registration</title>
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
            background: url('bgg.jpg') repeat center center fixed;
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
            background: rgba(255, 255, 255, 0.8); /* Light overlay */
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


        /* Registration form container */
        .registration-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 40px 0;
            z-index: 2; /* Ensure it appears above the overlay */
        }

        /* Form content layout */
        .registration-content {
            display: flex;
            width: 30%;
            align-items: center;
            flex-wrap: wrap;
        }

        .form-section, .image-section {
            padding: 40px;
            flex: 1; /* Ensures both sections take up equal space */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .form-section {
            background-color: #f4f4f4;
            border-radius: 8px;
        }

        .form-section h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-section label {
            display: block;
            margin: 10px 0 5px;
            font-size: 14px;
            color: #333;
        }

        .form-section input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-section button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-section button:hover {
            background-color: #555;
        }

        .form-section p {
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }

        .form-section p a {
            color: #555;
            text-decoration: underline;
        }

        .image-section {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-placeholder {
            width: 150px;
            height: 150px;
            background-color: white;
            border-radius: 5px;
        }

        /* Footer styling */
        footer {
            background-color: #f4f4f4;
            padding: 20px 0;
            text-align: center;
            border-top: 1px solid #ccc;
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

        .footer-bottom {
            font-size: 14px;
            color: black;
            margin-top: 10px;
        }

        /* Responsive Design for Smaller Screens */
        @media (max-width: 768px) {
            .form-section, .image-section {
                flex: 1 1 100%; /* Full width on smaller screens */
                padding: 20px;
            }

            .footer-content .separator {
                display: none;
            }
        }

        .errors {
            color: red;
            font-size: 14px;
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
            <a href="loginform.php" class="sign-in">Sign In</a>
        </nav>
    </header>

    <!-- Registration Content Container -->
    <div class="registration-container">
        <div class="registration-content">
            <!-- Form Section -->
            <div class="form-section">
                <h2>Sign Up</h2>
                <form id="signup-form" action="files/php/signup.php" method="post">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required> <span class="errors" id="name-error"></span>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required> <span class="errors" id="email-error"></span>
                    
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" required> <span class="errors" id="phone-error"></span>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><span class="errors" id="password-error"></span>
                    <div id="requirements" class="requirements" style = "display:none;">
                        <h4>Password Requirements:</h4>
                        <ul>
                            <li>At least 8 characters long</li>
                            <li>Must contain at least 1 special character</li>
                            <li>Must contain at least 1 uppercase letter</li>
                        </ul>
                    </div>
                    <label for="confirm-password">Confirm Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required><span class="errors" id="cfm-pw-error"></span>

                    <button type="submit">Sign up</button>
                </form>
                <p>Already have an account? <a href="loginform.php">Sign in</a></p>
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
    <script type="text/javascript" src="files/javascript/formValidation.js"></script>
</body>
</html>
