<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>To-do List</title>
		<link href="style.css" type="text/css" rel="stylesheet" />
		<script src="todo.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src='js/jquery-1.11.1.min.js'></script>
		<script src='js/todo.client.js'></script>
		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  		<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
	</head>

	<body>
		<div id="all">
			<div>
				<h1>
					Your To-do List
				</h1>
			</div>


			<div id="container"> 
				<div id="main">
				</div>

				<ul id="submitNew">
					<li>
						<input id="desc" name="description" type="text" size="25" autofocus="autofocus" />
						<button value="Add" id="addButton">Add</button>
					</li>
				</ul> 
			</div>
			<div id="logoutDiv">
				<button id="logout"><strong>Log Out</strong></button>
				<em>(logged in since <?=$_COOKIE["time"]?>)</em>
			</div>
		</div>
	</body>
</html>
<?php
	if (isset($_POST["new_email"]) and isset($_POST["new_password"])) {
		$email = $_POST["new_email"];
		$password = $_POST["new_password"];
		echo "<script> xhrNewUser(\"$email\", \"$password\"); </script>;";
	} else if (isset($_POST["email"]) and isset($_POST["password"])) { #checks if post data was sent
		$email = $_POST["email"];
		$password = $_POST["password"];
		echo "<script> xhrLogin(\"$email\", \"$password\"); </script>";
	} else {
		echo "<script> window.location.href = 'http://students.washington.edu/hmcd311/public/start.php'; </script>";
	}
?>