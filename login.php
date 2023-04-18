<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $psw = $_POST['psw'];

            $con = mysqli_connect("localhost", "root", "Pr@theek08", "sign");
            $stmt = $con->prepare("SELECT * FROM signup WHERE email = ? AND psw = ?");
            $stmt->bind_param('ss', $email, $psw);
            
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                header('location:index.html');
                exit();
            } else {
                echo '<p>Invalid email or password</p>';
            }

            // Close the connection
            $stmt->close();
            $con->close();
        }
?>