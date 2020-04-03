<?php
include('connection.php');
session_start();
include 'engine.php';


if ($_POST) {

	// Handling login
	if (!empty($_POST[username]) and !empty($_POST['pwd'])) {
		
		if (db_get("users",["username",$_POST[username]],["password",$_POST['pwd']])) {

			$_SESSION[username] = $_POST[username];
			$_SESSION[pwd] = $_POST[pwd];


			if (isset($_POST[remember])) {
				setcookie("username", $_POST[username], time()+60*60*24*365);
			}	
			else{
				setcookie("username", $_POST[username], time()-1);
			}





		}


	}


	// Handling post adding
	if (!empty($_POST[title]) and !empty($_POST[body])) {
		
		$date = date("Y:m:d H:i:s");
		$title = $_POST[title];
		$body = $_POST[body];
		$userId = db_get("users", ["username",$_SESSION[username]])[0][id];

		mysqli_query($db, "INSERT INTO posts (title,body,publishdate,userId) VALUES ('$title', '$body', '$date', '$userId')");
		echo "Post is added";

	}








}


if ($_GET[logout]==1) {
	session_destroy();
	header("Location: index.php");
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>My Personal Page</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	
	<body>
		<?php include('header.php'); ?>
		<!-- Show this part if user is not signed in yet -->
		<? if (!isset($_SESSION[username])) { ?>
		<div class="twocols">
			<form action="index.php" method="post" class="twocols_col">
				<ul class="form">
					<li>
						<label for="username">Username</label>
						<input type="text" name="username" id="username" value="<?=!empty($_COOKIE[username]) ? $_COOKIE[username] : '' ?>" />
					</li>
					<li>
						<label for="pwd">Password</label>
						<input type="password" name="pwd" id="pwd" />
					</li>
					<li>
						<label for="remember">Remember Me</label>
						<input type="checkbox" name="remember" id="remember" checked />
					</li>
					<li>
						<input type="submit" value="Submit" /> &nbsp; Not registered? <a href="register.php">Register</a>
					</li>
				</ul>
			</form>
			<div class="twocols_col">
				<h2>About Us</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur libero nostrum consequatur dolor. Nesciunt eos dolorem enim accusantium libero impedit ipsa perspiciatis vel dolore reiciendis ratione quam, non sequi sit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio nobis vero ullam quae. Repellendus dolores quis tenetur enim distinctio, optio vero, cupiditate commodi eligendi similique laboriosam maxime corporis quasi labore!</p>
			</div>
		</div>
	<? } ?>


		
		<!-- Show this part after user signed in successfully -->
		<div class="logout_panel"><a href="register.php">My Profile</a>&nbsp;|&nbsp;<a href="index.php?logout=1">Log Out</a></div>



<? if (isset($_SESSION[username])) { ?>
		<h2>New Post</h2>
		<form action="index.php" method="post">
			<ul class="form">
				<li>
					<label for="title">Title</label>
					<input type="text" name="title" id="title" />
				</li>
				<li>
					<label for="body">Body</label>
					<textarea name="body" id="body" cols="30" rows="10"></textarea>
				</li>
				<li>
					<input type="submit" value="Post" />
				</li>
			</ul>
		</form>
<? } ?>

		<div class="onecol">

			
			<?php 

			$cards = db_get2("posts", "publishdate");
			foreach ($cards as $value) {   ?>

			<div class="card">
				<h2><?=$value[title] ?></h2>
				<h5>Author, <?=$value[publishdate] ?></h5>
				<p><?=$value[body] ?></p>
			</div>
			<?
			}
			 ?>



		</div>
	</body>
</html>