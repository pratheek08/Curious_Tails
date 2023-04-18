<!DOCTYPE html>
<html>

<head>
    <!-- <link href="img\cute.jpg" rel="icon"> -->

    <title>Appointment</title>
    <style>
        body {
            background-image: url("C:\xampp\htdocs\petcare\img\cat.jpeg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #333;
            
        }

        form {
            background-color: #B2A4FF;
            border-radius: 10px;
            padding: 20px;
            margin: 50px auto;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Book a Pet Day Care Appointment</h1>


        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="petname">Pet Name</label>
        <input type="text" id="petname" name="petname" required>

        <label for="breed">Breed</label>
        <input type="text" id="breed" name="breed" required>

        <label for="date">Date</label>
        <input type="date" id="date" name="date" required><br /><br />

        <label for="time">Time</label>
        <input type="time" id="time" name="time" required><br /><br />

        <label for="location">Location for Pick Up</label>
        <input type="text" id="location" name="location" required>
        <label for="service">Select your service<label>
                <select class="custom-select border-0 px-4" style="height: 47px;" name="service">
                    <option selected></option>
                    <option value="Pet Boarding">Pet Boarding</option>
                    <option value="Pet Feeding">Pet Feeding</option>
                    <option value="Pet Grooming">Pet Grooming</option>
                    <option value="Pet Training">Pet Training</option>
                    <option value="Pet Exercise">Pet Exercise</option>
                    <option value="Pet Treatment">Pet Treatment</option>
                    
                </select>
<!-- 
                <label for="notes">Notes (optional)</label>
                <textarea id="notes" name="notes" rows="4"></textarea> -->

                <input type="submit" value="Book Now">
    </form>

    <?php
    // Create database connection
    $conn = mysqli_connect("localhost", "root", "", "petgrooming");

    // Check if connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Define variables and initialize with empty values
    $servic = $name = $email = $phone = $petname = $breed = $date = $time = $location = $notes = "";
    $name_err = $email_err = $phone_err = $petname_err = $breed_err = $date_err = $time_err = $location_err = "";

    // Process form data when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate name
    
        $service = $_POST['service'];


        if (empty($_POST["name"])) {
            $name_err = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $name_err = "Only letters and white space allowed";
            }
        }

        //validate service
        if (empty($_POST["service"])) {
            $service_err = "service is required";
        } else {
            $service = test_input($_POST["service"]);
            if (!filter_var($service, FILTER_SANITIZE_STRING)) {
                $service_err = "Invalid service format";
            }
        }

        // Validate email
        if (empty($_POST["email"])) {
            $email_err = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Invalid email format";
            }
        }

        // Validate phone
        if (empty($_POST["phone"])) {
            $phone_err = "Phone number is required";
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^[0-9]*$/", $phone)) {
                $phone_err = "Only numbers allowed";
            }
        }

        // Validate pet name
        if (empty($_POST["petname"])) {
            $petname_err = "Pet name is required";
        } else {
            $petname = test_input($_POST["petname"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $petname)) {
                $petname_err = "Only letters and white space allowed";
            }
        }

        // Validate breed
        if (empty($_POST["breed"])) {
            $breed_err = "Breed is required";
        } else {
            $breed = test_input($_POST["breed"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $breed)) {
                $breed_err = "Only letters and white space allowed";
            }
        }

        // Validate date
        if (empty($_POST["date"])) {
            $date_err = "Date is required";
        } else {
            $date = test_input($_POST["date"]);
        }

        // Validate time
        if (empty($_POST["time"])) {
            $time_err = "Time is required";
        } else {
            $time = test_input($_POST["time"]);
        }

        // Validate location
        if (empty($_POST["location"])) {
            $location_err = "Location for pick up is required";
        } else {
            $location = test_input($_POST["location"]);
        }

        // Store appointment details in database if there are no errors
        if (empty($name_err) && empty($email_err) && empty($phone_err) && empty($petname_err) && empty($breed_err) && empty($date_err) && empty($time_err) && empty($location_err)) {
            $sql = "INSERT INTO appointments (name,service, email, phone, petname, breed, pickup, time, location, notes) VALUES ('$name','$service', '$email', '$phone', '$petname', '$breed', '$date', '$time','$location', '$notes')";

            if (mysqli_query($conn, $sql)) {
                // Redirect to success page
                header("location: display.php");

            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // Close database connection
            mysqli_close($conn);
        }
    }

    // Function to sanitize input data
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>