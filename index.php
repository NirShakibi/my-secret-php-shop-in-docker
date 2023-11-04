<?php

$connect = mysqli_connect("localhost", "root", "", "testing");

session_start();

if (isset($_SESSION["username"])) {
	header("location:profile.php");
}

if (isset($_POST["register"])) {
	$username = mysqli_real_escape_string($connect, $_POST["username"]);
	$password = mysqli_real_escape_string($connect, $_POST["password"]);
	$password = md5($password);
	$query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
	if (mysqli_query($connect, $query)) {
		echo "success!";
	}
}

if (isset($_POST["login"])) {
	$username = mysqli_real_escape_string($connect, $_POST["username"]);
	$password = mysqli_real_escape_string($connect, $_POST["password"]);
	$password = md5($password);
	$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($connect, $query);
	if (mysqli_num_rows($result) > 0) {
		$_SESSION['username'] = $username;
		$row = $result->fetch_assoc();
		$userId = $row['id'];
		$_SESSION['id'] = $userId;
		header("location:profile.php");
	} else {
		echo "wrong login details!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> PIMP | Pentest In My Pussy</title>
</head>

<body>
	<h1>register</h1>
	<form action="index.php" method="post">
		<input type="text" name="username" placeholder="your username..." />
		<input type="password" name="password" placeholder="your password..." />
		<input type="submit" name="register" value="register" />
	</form>

	<h1>login</h1>
	<form action="index.php" method="post">
		<input type="text" name="username" placeholder="your username..." />
		<input type="password" name="password" placeholder="your password..." />
		<input type="submit" name="login" value="login" />
	</form>
</body>

</html>