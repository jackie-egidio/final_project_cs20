<!DOCTYPE html>
<html>
    <head>
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

			.form {
				width: 50%;
				margin: auto;
				padding: 100px;
			}

			.form-text {
				font-family: sans-serif;
				color: #7D3C98;
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

            // GET DATA FROM HTML FORM
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $username = $_POST['uname'];
            $email = $_POST['email'];
            
            // POST TO DATABASE
            $sql = "INSERT INTO login_info (fname, lname, username, password, email)
                    VALUES (?, ?, ?, ?, ?)";

            // protects against attacks to SQL string
            $stmt = mysqli_stmt_init($conn);

            if ( ! mysqli_stmt_prepare($stmt, $sql)) {
                die(mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $uname, $password_hash, $email);
            mysqli_stmt_execute($stmt);

            header("Location: signup-success.html");

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
