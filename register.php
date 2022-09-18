<?php
	session_start();
	require_once 'connection.php';
 
	if(isset($_POST['submit'])){
		if($_POST['email'] != "" || $_POST['username'] != "" || $_POST['password'] != ""){
			try{
				$num = $_POST['num'];
				$username = $_POST['username'];
				$email = $_POST['email'];
				// md5 encrypted
				// $password = md5($_POST['password']);
				$password = $_POST['password'];
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO user VALUES ('', '$username', '$password', '$email', '$num')";
				$conn->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
			$conn = null;
			header('location: ../index.php');
		}else{
			echo "
				<script>alert('Please fill up the required field!')</script>
				<script>window.location = 'signup.php'</script>
			";
		}
	}
?>