<?php
session_start();
include_once 'db_connection.php';
?>

<!DOCTYPE html>
<html>
	
	
	<head>
	<title>Goldy's Morrowind Character Creator | Make Character</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./browse.css"/>
	<link rel="stylesheet" type="text/css" href="./general.css" />
	</head>
	
	<body>
		<nav id="navig" class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="/home.php">Goldy's<a/>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="/home.php">Home</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="/browse.php">Browse</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/makecharacter.php">Make Your Own!</a>
					</li>
					
				</ul>
			
			</div>	
		</nav>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>

<?php

echo "<div class=\"container text-center\">";
	echo"<h1 class=\"my-2\">Browse the Community!</h1>";
$sql = "SELECT name, description, race, sex, sign from build";
$connectionInfo = new Connection();
$con = $connectionInfo->openConnection();
$i = 0;
foreach($con->query($sql) as $row)
{
	$i++;
	echo "<a href=\"./article.php?id=".$i."\">";
	echo "<div class=\"row forumlink my-2 py-2 px-2\">";
		echo "<div class=\"col\">";
		echo "<h2 class=\"title\">".$row['name']."</h2>";
			echo "<div class=\"text-left\">";
				echo "<p>Description: ".$row['description']."</p>";
				echo "<p>Race: ".$row['race']."</p>";
				echo "<p>Sex: ".$row['sex']."</p>";
				echo "<p>Birthsign: The ".$row['sign']."</p>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	echo "</a>";
}
echo "</div>";




?>