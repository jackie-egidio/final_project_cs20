<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
		<style>
			.signup-successful {
				padding: 340px;
				color: #7D3C98;
				text-align: center;
				font-size: 42px;
			}

			.signup-successful a {
				text-decoration: none;
				color: #DCD0EA;
			}

			.signup-successful a:hover {
				text-decoration: none;
				color: #DCD0EA;
				background-color: #7D3C98;
			}
		</style>
	</head>
    <body>
        <div class="head">
			<div class="head-content">
				<div class="head-text">
					<strong>Personal Diary App</strong>
				</div>
			</div>
		</div>
		<div class="nav" id="nav">
			<a href="https://jacquelinee.sgedu.site/final_project/index.html">Home</a>
			<a href="https://jacquelinee.sgedu.site/final_project/contactus.html">Contact Us</a>
			<a href="https://jacquelinee.sgedu.site/final_project/signup.html" style="float: right">Signup</a>
			<a href="https://jacquelinee.sgedu.site/final_project/login.php" style="float: right">Login</a>
		</div>
		<?php
			// SERVER-SIDE VALIDATION
			// name validation
			if (empty($_POST['fname']) || empty($_POST['lname'])) {
				die("Must enter a first and last name");
			}

			// email validation
			if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				die("Must enter a valid email address");
			}

			// password validation
			if (strlen($_POST['pass']) < 8) {
				die("Must be at least 8 characters");
			}
			if ($_POST['pass'] != $_POST['pass_confirm']) {
				die("Passwords entered do not match");
			}

			// protects password from being stored raw in the database
			$password_hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);

			// connect to server using contents of database.php file
			$mysqli = require __DIR__ . "/login_database.php";
			
			// POST TO DATABASE
			$sql = "INSERT INTO login_info (fname, lname, username, password, email)
					VALUES (?, ?, ?, ?, ?)";

            $stmt = $mysqli->stmt_init();

            if ( ! $stmt->prepare($sql)) {
                die("SQL error: " . $mysqli->error);
            }

            $stmt->bind_param("sssss", $_POST['fname'], $_POST['lname'], $_POST['uname'], $password_hash, $_POST['email']);
            $stmt->execute();

			$conn->close();
		?>
		<div class="signup-successful">
			Signed up successfully! You can now <a href="https://jacquelinee.sgedu.site/final_project/login.php">log in</a>.
		</div>
        <div class="footer">
			<a href="https://jacquelinee.sgedu.site/final_project/index.html">Home</a>
			<a href="https://jacquelinee.sgedu.site/final_project/contactus.html">Contact Us</a>
			<a href="https://jacquelinee.sgedu.site/final_project/signup.html">Signup</a>
			<a href="https://jacquelinee.sgedu.site/final_project/login.php">Login</a>
		</div>
    </body>
</html>
