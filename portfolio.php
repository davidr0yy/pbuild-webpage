<?php
session_start();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fullName = $_POST['fullName'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $experiences = $_POST['experiences'];
    $training = $_POST['training'];
    $expertise = $_POST['expertise'];

    // Validate and sanitize input data (perform additional checks as needed)
    $fullName = htmlspecialchars($fullName);
    $age = (int)$age;
    $address = htmlspecialchars($address);
    $experiences = htmlspecialchars($experiences);
    $training = htmlspecialchars($training);
    $expertise = htmlspecialchars($expertise);

    $hostname = "localhost";
    $userdb = "root";
    $passdb = "";
    $dbname = "pbuild";

    // Create a connection to the database
    $conn = new mysqli($hostname, $userdb, $passdb, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert the form data into the database
    $sql = "INSERT INTO workers (fullName, age, address, experiences, training, expertise) 
            VALUES ('$fullName', $age, '$address', '$experiences', '$training', '$expertise')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Form Data Submitted Successfully!");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Worker Form</title>
    <link rel="stylesheet" type="text/css" href="main1.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 100;
            padding: 40;
        }

        h2 {
            color: #333;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        textarea {
            height: 100px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <nav id="nav">
        <ul class="container">
            <li>
                <?php if (!empty($_SESSION['fname'])): ?>
                    <?php echo $_SESSION['fname']; ?>
                <?php endif; ?>
            </li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="home.php">Home</a></li>
        </ul>
    </nav>

    <div class="container">
    
        <h2>Worker Form</h2>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <label for="fullName">Full Name:</label>
    <input type="text" id="fullName" name="fullName" required>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>

    <label for="experiences">Experiences:</label>
    <textarea id="experiences" name="experiences" required></textarea>

    <label for="training">Training:</label>
    <textarea id="training" name="training" required></textarea>

    <label for="expertise">Expertise:</label>
    <textarea id="expertise" name="expertise" required></textarea>

    <input type="submit" value="Submit">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $experiences = $_POST['experiences'];
    $training = $_POST['training'];
    $expertise = $_POST['expertise'];

    echo "<h3>Submitted Data:</h3>";
    echo "Full Name: " . $fullName . "<br>";
    echo "Age: " . $age . "<br>";
    echo "Address: " . $address . "<br>";
    echo "Experiences: " . $experiences . "<br>";
    echo "Training: " . $training . "<br>";
    echo "Expertise: " . $expertise . "<br>";
}
?>

    </div>
</body>
</html>

