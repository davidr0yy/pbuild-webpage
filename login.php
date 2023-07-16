<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1.centered {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        form {
            max-width: 300px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
        }
    </style>
    <title>Login</title>
</head>
<body>
    <h1 class="centered">Welcome To Pbuild!</h1>

    <form method="post" action="">
        <input type="text" name="email" placeholder="Email" required>
        <br>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <input type="submit" value="Login" name="login">
    </form>

    <a href="register.php">Create New Account</a>

    <?php
    session_start();

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hostname = "localhost";
        $userdb = "root";
        $passdb = "";
        $dbname = "pbuild";    

        // Connect to the database
        $connection = new mysqli($hostname, $userdb, $passdb, $dbname);

        // Check connection
        if ($connection->connect_errno) {
            echo "Failed to connect to MySQL: " . $connection->connect_error;
            exit();
        }

        // Retrieve user from the database
        $sql = "SELECT * FROM user WHERE email='$email'";

        $result = $connection->query($sql);

        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify password
            if (sha1($password) === $row['password']) {
                // Successful login
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['mname'] = $row['mname'];
                $_SESSION['lname'] = $row['lname'];
                echo "Login successful!";
                // Redirect to a logged-in page
                header("Location: home.php");
                exit();
            } else {
                // Invalid password
                echo '<script>alert("Invalid password!");</script>';
            }
        } else {
            // Invalid login
            echo '<script>alert("Invalid Username or Password");</script>';
        }

        $connection->close();
    }
    ?>
</body>
</html>
