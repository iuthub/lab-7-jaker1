<?php  

include('connection.php');
include 'engine.php';
session_start();



class User{


	function __construct($id, $username, $pwd, $email, $fullname, $dob){

		$this->$id = $id;
		$this->$username = $username;
		$this->$pwd = $pwd;
		$this->$email = $email;
		$this->$fullname = $fullname;
		$this->$dob = $dob;


	}

}


// Creating user
if (!empty($_SESSION[username]) and !empty($_SESSION[pwd])) {

	$username = $_SESSION[username];
	$pwd = $_SESSION[pwd];

	$user = db_get("users",["username",$username],["password",$pwd])[0];

	$fullname = $user[fullname];
	$id = $user[id];
	$email = $user[email];
	$dob = $user[dob];


	if (!empty($user)) {

		$user = new User( $id, $username, $pwd, $email, $fullname, $dob );

	}

}





if ($_POST) {


	if (!empty($_POST[username]) and !empty($_POST['pwd']) and empty($_SESSION[username])  ) {
		$username = $_POST[username];
		$pwd = $_POST['pwd'];
		$cpwd = $_POST['confirm_pwd'];
		$fname = $_POST['fullname'];
		$email = $_POST['email'];

		


		if ($pwd==$cpwd) {

			$dob = date("Y:m:d H:i:s");
			$sql = "INSERT INTO users (username,password,email,fullname,dob) VALUES ('$username','$pwd','$email','$fname','$dob')";
			mysqli_query($db, $sql);
			header("Location: index.php");

		}



	}

	if (!empty($_POST[username]) and !empty($_POST['pwd']) and !empty($_SESSION[username]) ) {
		$username = $_POST[username];
		$pwd = $_POST[pwd];
		$email = $_POST[email];
		$fullname = $_POST[fullname];

		db_update("users", $user->$id, ["username", $username],["password", $pwd],["email", $email],["fullname", $fullname] );

		if ($user->$password!=$password or $user->username!=$username) {
			$_SESSION[username] = $username;
			$_SESSION[pwd] = $pwd;
		}


		echo "<h1>Your details are updated</h1>";

	}






}








?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Blog - Registration Form</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php include('header.php'); ?>

		<h2>User Details Form</h2>
		<h4>Please, fill below fields correctly</h4>
		<form action="register.php" method="post">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" value="<?=$user->$username ?>" required/>
					</li>
					<li>
						<label for="fullname">Full Name</label>
						<input type="text" name="fullname" id="fullname" value="<?=$user->$fullname ?>" required/>
					</li>
					<li>
						<label for="email">Email</label>
						<input type="email" name="email" id="email" value="<?=$user->$email ?>" />
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" value="<?=$user->$pwd ?>" required/>
					</li>
					<li>
						<label for="confirm_pwd">Confirm Password</label>
						<input type="password" name="confirm_pwd" value="<?=$user->$pwd ?>" id="confirm_pwd" required />
					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Already registered? <a href="index.php">Login</a>
					</li>
				</ul>
		</form>
	</body>
</html>