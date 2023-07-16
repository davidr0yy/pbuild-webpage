<?php
session_start();

// Check if the user is logged in
function checkAuthentication()
{
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header('Location: login.php');
        exit;
    }
}

// Check if the user is already logged in
function checkLoggedIn()
{
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        header('Location: home.php');
        exit;
    }
}

// Handle user login
function loginUser($email, $password)
{
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

    // Prepare the SQL statement to retrieve user from the database
    $sql = "SELECT * FROM `user` WHERE `email` = ?";

    // Prepare the statement
    $stmt = $connection->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (sha1($password) === $row['password']) {
            // Successful login
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['id']; // Store the user's ID in the session
            $_SESSION['username'] = $row['username'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['mname'] = $row['mname'];
            $_SESSION['lname'] = $row['lname'];
            echo "Login successful!";
            // Redirect to a logged-in page
            header("Location: home.php");
            exit();
        }
    }

    // Invalid login
    echo "Invalid email or password.";

    $stmt->close();
    $connection->close();
}

// Handle user logout
function logoutUser()
{
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

// Handle project submission
function submitProject($title, $description, $file)
{
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

    // Retrieve user ID from session or wherever it is stored
    $userId = $_SESSION['id']; // Update this line
    $username = $_SESSION['username'];
    // Sanitize and escape input data
    $title = $connection->real_escape_string($title);
    $description = $connection->real_escape_string($description);

    // Prepare the SQL statement
    $stmt = $connection->prepare("INSERT INTO `jobs` (`user_id`, `title`, `description`) VALUES (?, ?, ?)");

    // Bind the parameters
    $stmt->bind_param("iss", $userId, $title, $description);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<script>alert("Project Submitted!");</script>';
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}

// HTML form handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        loginUser($username,$email, $password,);
    } elseif (isset($_POST['logout'])) {
        logoutUser();
    } elseif (isset($_POST['submit_project'])) {
        checkAuthentication();
        $title = $_POST['title'];
        $description = $_POST['description'];
        $file = $_FILES['file'];
        submitProject($title, $description, $file);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Construction Project Submission</title>
    <link rel="stylesheet" type="text/css" href="main1.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: inline-block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 15px;
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

        .logout-btn {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="logo container">
						<div>
							<h1><a href="home.php" id="logo">PBUILD</a></h1>
							<p></p>
						</div>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) { ?>
        <h1>Welcome, <?php echo $_SESSION['fname']; ?>!</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="title">Project Title:</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Project Description:</label>
            <textarea name="description" id="description" required></textarea>

            <label for="file">Upload Photo/Video:</label>
            <input type="file" name="file" id="file" accept="image/*,video/*" required>

            <input type="submit" name="submit_project" value="Submit Project">
        </form>
        <a href="logout.php" class="logout-btn">Logout</a>
        
    <?php } else { ?>
        <h1>Login</h1>
        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" name="login" value="Login">
        </form>
        
    <?php } ?>
</body>
</html>
