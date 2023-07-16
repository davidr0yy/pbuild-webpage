<!DOCTYPE HTML>
<html>
<head>
    <title>Registration</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="main1.css" />
    <style>
        body {
            background-color: #f3f3f3;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 450px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: grid;
            margin-bottom: 5px;
            color: #777;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 70%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 5px;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
            color: #777;
        }


    </style>
</head>

<body>

<?php
    $hostname = "localhost";
    $userdb = "root";
    $passdb = "";
    $dbname = "pbuild";

    $conn = new mysqli($hostname, $userdb, $passdb, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $first_name = $_POST["firstName"];
        $last_name = $_POST["lastName"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $email = $_POST["email"];
        $contact_no = $_POST["contactNumber"];
        $username = $_POST["username"];

        if ($password !== $confirmPassword) {
            echo "Error: Passwords do not match.";
            exit();
        }

        $sql = "INSERT INTO user (email, password, fname, lname, mname, user_status)
                VALUES ('$email', SHA1('$password'), '$first_name', '$last_name', '', 1)";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
            // Redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    ?>

    <div class="container">
        <h2>Register</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="contactNumber">Contact Number:</label>
            <input type="text" id="contactNumber" name="contactNumber" required>

            <input type="submit" value="Register">

            <div class="login-link">
                Already have an account? <a href="login.php">Login here</a>.
            </div>
        </form>
    </div>
</body>
</html>
