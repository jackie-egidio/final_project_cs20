<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>My Diary</title>
		<link href="styles.css" rel="stylesheet">
		<style>
			html, body {
				margin: 0;
				padding: 0;
				font-family: sans-serif;
			}

			.head {
                background-color: #DCD0EA;
            }

            .head-content {
                padding: 16px;
            }

            .head-text {
                font-family: sans-serif;
                color: white;
                font-size: 30px;
                text-align: center; 
                padding: 20px;
            }

			.footer, .nav {
				padding: 2px;
			}

			.nav a:hover {
				color: #F2BFD7;
			}

			.nav {
				background-color: #7D3C98;
			}

			.footer {
				background-color: #DCD0EA;
			}

			.footer li, .nav li {
				display: inline;
			}

			.footer a, .nav a {
				padding-right: 30px;
				text-decoration: none;
			}

			.footer a {
				color: #7D3C98;
			}

			.nav a {
				color: white;
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
		<div class="nav">
			<ul>
				<li><a href="https://jacquelinee.sgedu.site/final_project/index.html">Home</a></li>
				<li><a href="https://jacquelinee.sgedu.site/final_project/contactus.html">Contact Us</a></li>
				<li><a href="https://jacquelinee.sgedu.site/final_project/diaryform.html">Diary</a>
				<li style="float: right"><a href="https://jacquelinee.sgedu.site/final_project/signup.html">Signup</a></li>
				<li style="float: right"><a href="https://jacquelinee.sgedu.site/final_project/login.html">Login</a></li>
			</ul>
		</div>
		<?php
            $mysqli = require __DIR__ . "/diary_database.php";
            echo "connected successfully";
            
			// FORM ACCESS
			// grabs all elements from HTML form
			$title = $_POST["title"];
			$date = $_POST["date"];
			$entry = $_POST["description"];

			if ($title == NULL || $entry == NULL) {
				die("You must input both a title and an entry");
			}

			// POST TO DATABASE
			$sql = "INSERT INTO diary (title, date, entry)
					VALUES (?, ?, ?)";

			// protects against attacks to SQL string
			$stmt = mysqli_stmt_init($conn);

			if ( ! mysqli_stmt_prepare($stmt, $sql)) {
				die(mysqli_error($conn));
			}

			mysqli_stmt_bind_param($stmt, "sss", $title, $date, $entry);
			mysqli_stmt_execute($stmt);

			//close the connection 
			$conn->close();
		?>
		<div class="footer">
			<ul>
				<li><a href="https://jacquelinee.sgedu.site/final_project/index.html">Home</a></li>
				<li><a href="https://jacquelinee.sgedu.site/final_project/contactus.html">Contact Us</a></li>
				<li><a href="https://jacquelinee.sgedu.site/final_project/signup.html">Signup</a></li>
				<li><a href="https://jacquelinee.sgedu.site/final_project/login.html">Login</a></li>
			</ul>
		</div>
	</body>
</html>
