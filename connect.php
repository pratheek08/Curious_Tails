<?php
        // put your code here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $psw = $_POST['psw'];
            $pswRepeat = $_POST['pswRepeat'];

            $con = mysqli_connect("localhost", "root", "Pr@theek08", "sign");
            $query = "INSERT INTO signup(email,psw,pswRepeat) VALUES('$email','$psw','$pswRepeat')";
            $result = mysqli_query($con, $query);
            if ($result) {
                echo("Registeration Successfull");
                header("location:login.html");
            } else {
                echo ("Registeration Failed");
            }
        }
        ?>