<?php
        // put your code here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $service = $_POST['service'];

            $con = mysqli_connect("localhost", "root", "Pr@theek08", "sign");
            $query = "INSERT INTO booking(name,email,date,time,service) VALUES('$name','$email','$date','$time','$service')";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo("Booking Successfull");
            } else {
                echo ("Booking Failed");
            }
        }


        ?>

        