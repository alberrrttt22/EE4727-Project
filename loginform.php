<?php
	if (isset($_GET['message']) && $_GET['message'] == 'fail'){
		echo "<script> window.onload = function() {
                alert('Username or password is incorrect!');";
		        echo "window.location.href = 'loginform.php';}; </script>";
	} else if (isset($_GET['message']) && $_GET['message'] == 'resetted'){
        echo "<script> window.onload = function() {
            alert('Password reset successfully!');";
            echo "window.location.href = 'loginform.php';}; </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XYZ Clinic - Login</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* General styling */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: space-between;
        }

        /* Header styling */
        header {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            font-weight: bold;
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
            color: blue;
        }
        
        /* Navigation links */
        nav a {
            margin-right: 20px;
            text-decoration: none;
            color: black;
        }

        .sign-in {
            padding: 5px 15px;
            border: 1px solid black;
            text-decoration: none;
            color: black;
            border-radius: 5px;
        }

        /* Form container */
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }

        /* Login form styling */
        .login-form {
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 5px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-form a {
            color: black;
            text-decoration: none;
            font-size: 14px;
            text-decoration: underline;
        }

        /* Footer styling */
        footer {
            background-color: #f4f4f4;
            padding: 20px 0;
            text-align: center;
        }

        .footer-content {
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 800px;
            margin: 0 auto;
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

        .login-form div {
            color: black;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <div><a class="index-link" href="index.html">XYZ CLINIC</a></div>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="doctors.php">Doctors</a>
            <a href="loginform.php" class="sign-in">Sign In</a>
        </nav>
    </header>

    <div class="login-container">
        <div class="login-form">
            <h2>Sign In</h2>
            <form action="files/php/login.php" method="POST">
                <input type="email" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="email" placeholder="Password" required>
                <button type="submit">Sign In</button>
                <div><br>
                    <a href="pw-reset.php">Forgot password?</a><br>
                    Don't have an account? <a href="signupform.php">Sign up</a>
                </div>
            </form>
        </div>
    </div>

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
