<?php
	$email = $_POST['email'];
	$psw = $_POST['psw'];
	$pswRepeat = $_POST['pswRepeat'];

	// Database connection
	$conn = new mysqli('localhost','root','Pr@theek08','sign up');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into signUp(email, psw, pswRepeat) values(?, ?, ?)");
		$stmt->bind_param("sss", $email, $psw, $pswRepeat);
		$execval = $stmt->execute();
		echo $execval;
		echo "Sign up successfully...";
		$stmt->close();
		$conn->close();
	}
?>