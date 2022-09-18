<?php
	session_start();
	require_once 'connection.php';
 
	if(isset($_POST['submit'])){
		if($_POST['username'] != "" || $_POST['password'] != ""){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT * FROM `user` WHERE `username`=? AND `password`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($username,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				$_SESSION['user'] = $fetch['id'];
				if (isset($_POST['checkbox'])) {
					// set up cookie
					setcookie("username", $username, time() + (86400 * 30));
					setcookie("password", $password , time() + (86400 * 30));
				} else {
					//expired cookie
					setcookie("username", $username, time() - (86400 * 30));
					setcookie("password", $password , time() - (86400 * 30));
				}
				header("location: contact.html");
			} else{
				echo "
				<script>alert('Invalid username or password')</script>
				<script>window.location = 'index.php'</script>
				";
			}
		}else{
			echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
		}
	}
?>