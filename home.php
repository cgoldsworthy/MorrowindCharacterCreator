<?php
session_start();
?>

<!DOCTYPE html>
<html>
	
	
	<head>
	<title>Goldy's Morrowind Character Creator | Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./home.css" />
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
					<li class="nav-item active">
						<a class="nav-link" href="/home.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/browse.php">Browse</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/makecharacter.php">Make Your Own!</a>
					</li>
					
				</ul>
			
			</div>
		
		</nav>
		
		<div class="container text-center">
			<div class="row justify-content-around">
				<div class="col-lg">
					<img src="images/morrowindlogofix.png" class="img-fluid"/>
					<div class="jumbotron" id="jumbo">
						<h1 class="display-5">Welcome to Goldy's Morrowind Character Creator!</h1>
						<p class="lead text-left">Welcome to Goldy's Morrowind character creator! Have you been struggling with the intricate character
						creation system of Morrowind or are just looking for a new way to play the game? Well look no further! Here you can 
						browse the character builds of your fellow Morrowind players or even submit your own builds and get tips on how to tweak them 
						so that you too may become the Nerevarine of legend!</p>
					</div>
				</div>
			</div>
			<div class="row justify-content-around">
				<div class="col-md-6 col-xs-12 my-1">
					<form action="browse.php" method="post">
						<input type="submit" value="Browse the Builds!" class="btn btn-primary"/>
					</form>
				</div>
				<div class="col-md-6 col-xs-12 my-1">
					<form action="makecharacter.php" method="post">
						<input type="submit" value="Make Your Own!" class="btn btn-primary"/>
					</form>
				</div>
			</div>
			<br/>
			<br/>
		</div>
		<script src="formhelp.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	</body>
</html>