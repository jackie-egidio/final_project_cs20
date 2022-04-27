<?php
    $is_invalid = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mysqli = require __DIR__ . "/login_database.php";

        $sql = sprintf("SELECT * FROM login_info WHERE username = '%s'", $_POST["uname"]);

        $result = $mysqli->query($sql);

        $user = $result->fetch_assoc();

        if ($user) {
            if (password_verify($_POST["pass"], $user["password"])) {
                session_start();

                session_regenerate_id();

                $_SESSION["user_id"] = $user["id"];

                header("Location: https://jacquelinee.sgedu.site/final_project/diaryform.html");
                exit;
            }
        }

        $is_invalid = true;
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="form_style.css">
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
		<div class="form">
			<h1>
				Log in Here
			</h1>
            <?php if($is_invalid): ?>
                <em style="color: #7D3C98">Invalid Login</em>
            <?php endif; ?>
			<form method="post">
				<div>
					<label for="uname">Username</label>
					<input type="text" id="uname" name="uname" />
				</div>
				<div>
					<label for="pass">Password</label>
					<input type="password" id="pass" name="pass" />
				</div>
				<br />
				<div style="text-align: center;">
					<input type="submit" value="Log In">
				</div>
			</form>
		</div>
		<div class="footer">
			<a href="https://jacquelinee.sgedu.site/final_project/index.html">Home</a>
			<a href="https://jacquelinee.sgedu.site/final_project/contactus.html">Contact Us</a>
			<a href="https://jacquelinee.sgedu.site/final_project/signup.html">Signup</a>
			<a href="https://jacquelinee.sgedu.site/final_project/login.php">Login</a>
		</div>
	</body>
</html>
