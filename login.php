<?php
	//create login cookie
	date_default_timezone_set('America/Los_Angeles');
	setcookie("time", date("D d M y, g:i:s a"));
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Log In Page</title>
		<script src='js/jquery-1.11.1.min.js'></script>
		<script src='js/todo.client.js'></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript">			
			function post(location, parameters, type) {
			   	type = type;
			    var form = document.createElement("form");
			    form.setAttribute("method", type);
			    form.setAttribute("action", location);
			    for(var key in parameters) {
			        if(parameters.hasOwnProperty(key)) {
			            var hiddenField = document.createElement("input");
			            hiddenField.setAttribute("type", "hidden");
			            hiddenField.setAttribute("name", key);
			            hiddenField.setAttribute("value", parameters[key]);
			            form.appendChild(hiddenField);
			         }
			    }
			    document.body.appendChild(form);
			    form.submit();
			}
		</script>
	</head>
	<body>
	</body>
</html>	
<?php 
	$email;
	$password;

	//Checks if requested information is provided from new or returning user before going to todolist.php
	if (isset($_POST["email"]) and isset($_POST["password"])) { #checks if post data was sent
		$email = $_POST["email"];
		$password = $_POST["password"];
		echo "<script>post(\"todolist.php\", {email: \"$email\", password: \"$password\"}, \"POST\");</script>";
	} else if (isset($_POST["new_email"]) and isset($_POST["new_password"])) {
		$email = $_POST["new_email"];
		$password = $_POST["new_password"];
		echo "<script>post(\"todolist.php\", {new_email: \"$email\", new_password: \"$password\"}, \"POST\");</script>";
	} 

	//if not the login cookie is removed and user is returned to start.php
	unset($_COOKIE['time']);
	echo "<script> window.location.href = 'http://students.washington.edu/hmcd311/public/start.php'; </script>";
?>

