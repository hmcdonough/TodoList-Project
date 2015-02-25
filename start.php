<?php
	#Harrison McDonough, Section AD,  HW 5 - To-Do List
	#start.php takes a user's login info and directs them to login.php
?>
<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8" />
 			<title>ToDo List</title>
			<link href="style.css" type="text/css" rel="stylesheet" />
			<script src='js/jquery-1.11.1.min.js'></script>
  			<script src='js/todo.client.js'></script>
  			<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
			<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		</head>

		<body>
			<div id="all">
				<div id="start">
					<h1>
						To-do List
					</h1>
				</div>

				<div id="main" class=".container-fluid">

					<p>
						Log in to manage your to-do list.
					</p>

					<form id="logInForm" action="login.php" method="post">
						<div><input name="email" type="text" size="8" autofocus="autofocus" placeholder="Enter email"/> <strong>Email</strong></div>
						<div><input name="password" type="password" size="8" placeholder="Password"/> <strong>Password</strong></div>
						<div><button type="submit" class="btn btn-default">Log in</button></div>
					</form>

					<p>
						If you don't have an account you can sign up here
					</p>

					<form id="signUpForm" action="login.php" method="post">
						<div><input name="new_email" type="text" size="8" autofocus="autofocus" placeholder="Enter email"/> <strong>Email</strong></div>
						<div><input name="new_password" type="password" size="8" placeholder="Password"/> <strong>Password</strong></div>
						<div><button type="submit" class="btn btn-default">Sign Up</button></div>
					</form>
					<?php //checks if cookie is set and displays last login time if so
						if (isset($_COOKIE["time"])) {
					?>
							<p>
								<em>(last login from this computer was <?=$_COOKIE["time"]?>)</em>
							</p>
					<?php
						}
					?>
				</div>	
			</div>
		</body>
	</html>
