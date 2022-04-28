<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
		<title>Untitled Document</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="form_style.css">
		<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css"> -->
		<script>
            async function fetchQuote() {
                fetch('https://favqs.com/api/qotd')
                  .then(response => response.json())
                  .then(data => console.log(data));
            }

            function getFavQ() {
                // make request
                request = new XMLHttpRequest();
                // console.log("1 - request object created");

                // open request file
                request.open("GET", "https://favqs.com/api/qotd", true);
                // console.log("2 - opened request file");

                // set up event handler/callback
                request.onreadystatechange = function() {
                    // console.log("3 - readystatechange event fired");

                    if (request.readyState == 4 && request.status == 200) {
                        // checks if successful
                        // console.log("5 - response received");
                        result = request.responseText;
                        favQ = JSON.parse(result);

                        document.getElementById("results").innerHTML = "Here's a quote to help get you started!<br />" +
                            "'" + favQ.quote.body + "'<br />By " + favQ.quote.author;
                        fetchQuote();
                    }
                    else if (request.readyState == 4 && request.status != 200) {
                        document.getElementById("results").innerHTML = "Something is wrong";
                    }
                    else if (request.readyState == 3) {
                        document.getElementById("results").innerHTML = "Too soon.";
                    }
                }
                request.send();
                // console.log("4 - request sent");
            }

			const randomWord = () => {
				fetch('https://random-word-api.herokuapp.com/word?number=1')
				.then(response => {
						return response.json();
				})
				.then(response => {
						document.getElementById("results").innerHTML = response;
						// randomDefinition(document.getElementById("results").innerHTML);
				})
				.catch(err => {
						console.log(err);
						return "No Word Available"
				});
			}

			// const randomDefinition = (word) => {
			// 	string = "`https://api.dictionaryapi.dev/api/v2/entries/en/" + word + "`";
			// 	fetch(string)
			// 	.then(response => {
			// 			return response.json();
			// 	})
			// 	.then(response => {
			// 			console.log(response[0].definitions[0]);
			// 			document.getElementById("results").innerHTML = "Definition: " + response[0].definitions[0];
			// 	})
			// 	.catch(err => {
			// 		document.getElementById("results").innerHTML = "No definition";
			// 		//document.querySelector(".d-flex").appendChild(definition);
			// 		//console.log(err);
			// 	})

			// }
        </script>
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
			<div id="results">
				<h1>Click a button below for some inspiration!</h1>
			</div>
			<div class="buttons">
				<input type="button" name="button1" value="Get a Quote!" onclick = "getFavQ()" id="button1">
				<input type="button" name="button2" value="Get a Word!" onclick = "randomWord()" id="button2">
			</div>
			<form action="diary.php" method="post">
				<label for="title">Title:</label><br>
				<input type="text" name="title" /><br><br>
				<label for="date">Date:</label><br>
				<input type="date" id="start" name="date">
				<script>
				document.getElementById('start').valueAsDate = new Date();
				</script>
				<br><br>
				<label for="entry">Entry:</label><br>
				<textarea name="description">
				</textarea><br><br>
				<input type="submit" value="Record Entry">
			</form>
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
			<a href="https://jacquelinee.sgedu.site/final_project/index.html">Home</a>
			<a href="https://jacquelinee.sgedu.site/final_project/contactus.html">Contact Us</a>
			<a href="https://jacquelinee.sgedu.site/final_project/signup.html">Signup</a>
			<a href="https://jacquelinee.sgedu.site/final_project/login.php">Login</a>
		</div>
	</body>
</html>
