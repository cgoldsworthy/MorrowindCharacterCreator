<?php
include_once 'db_connection.php';
if (!isset($_GET['id']))
{
	header("Location: http://localhost/browse.php");
}
?>

<!DOCTYPE html>
<html>
	
	
	<head>
	<title>Goldy's Morrowind Character Creator | Make Character</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="./general.css" />
	<link rel="stylesheet" type="text/css" href="./article.css" />
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
<?php
		if (isset($_POST['comment']))
		{
		if(!preg_match('/^[a-zA-Z0-9 !.:,]+$/', $_POST['text']) && strlen($_POST['text']) > 0)
		{
			echo "<div class=\"alert alert-danger\" role=\"alert\">Comments may only contain letters, numbers, ,s, !s, .s, and :s.</div>";
		}
		else
		{
			$sql = "insert into comment(id, articleid, text) values (null, ". $_GET['id'] .", :text)";
			$connectionInfo = new Connection();
			$con = $connectionInfo->openConnection();
			$statement = $con->prepare($sql);
			$statement->bindValue(":text", $_POST['text']);
			$statement->execute();
		}
		}
?>
		
		<?php


$sql = "SELECT * from build where id = ". $_GET['id'];
$connectionInfo = new Connection();
$con = $connectionInfo->openConnection();
foreach($con->query($sql) as $row)
{
$name = $row['name'];
$description = $row['description'];
$sex = $row['sex'];
$sign = $row['sign'];
$race = $row['race'];
$prefattr1 = $row['prefattr1'];
$prefattr2 = $row['prefattr2'];
$majskill1 = $row['majskill1'];
$majskill2 = $row['majskill2'];
$majskill3 = $row['majskill3'];
$majskill4 = $row['majskill4'];
$majskill5 = $row['majskill5'];
$minskill1 = $row['minskill1'];
$minskill2 = $row['minskill2'];
$minskill3 = $row['minskill3'];
$minskill4 = $row['minskill4'];
$minskill5 = $row['minskill5'];
$attrval = [$row['str'], $row['endu'], $row['agi'], $row['spd'], $row['per'], $row['intel'], $row['wis'], $row['lck']];
$attr = ['Strength', 'Endurance', 'Agility', 'Speed', 'Personality', 'Intelligence', 'Willpower', 'Luck'];
$skill=['Heavy Armor', 'Medium Armor', 'Spear', 'Acrobatics', 'Armorer', 'Axe', 'Blunt', 'Long Blade', 'Block', 'Light Armor',
			'Marksman', 'Sneak', 'Athletics', 'Hand To Hand', 'Short Blade', 'Unarmored', 'Illusion', 'Mercantile', 'Speechcraft', 'Alchemy',
			'Conjuration', 'Enchant', 'Security', 'Alteration', 'Destruction', 'Mysticism', 'Restoration'];
$skillval=[$row['heavyarm'],$row['mediumarm'],$row['spear'],$row['acrobatics'],$row['armorer'],$row['axe'],$row['blunt'],$row['longblade'],
$row['block'],$row['lightarm'],$row['marksman'],$row['sneak'],$row['athletics'],$row['handtohand'],$row['shortblade'],$row['unarmored'],
$row['illusion'],$row['mercantile'],$row['speechcraft'],$row['alchemy'],$row['conjuration'],$row['enchant'],$row['secur'],$row['alteration'],
$row['destruction'],$row['mysticism'],$row['restoration']];
}
echo "<div class=\"container text-center\">";
	echo "<h1 class=\"my-3\">".$name."</h1>";
	echo "<div class=\"row justify-content-around\">";
				echo "<div class=\"col-xs-12 col-md-6 text-left\">";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">About</h5>";
					echo "<p class=\"my-0 mx-2\">Name: ".$name."</p>";
					echo "<p class=\"my-0 mx-2\">Sex: ".$sex."</p>";
					echo "<p class=\"my-0 mx-2\">Race: ".$race."</p>";
					echo "<p class=\"my-0 mx-2\">Birthsign: The ".$sign."</p>";
					echo "<p class=\"my-0 mx-2\">Description: ".$description."</p>";
					echo "</div>";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">Favored Attributes</h5>";
					for ($i = 0; $i < 8; $i++)
					{
						if ($attr[$i] == $prefattr1 || $attr[$i] == $prefattr2)
						{
							echo "<p class=\"my-0 mx-2\">".$attr[$i].": ".$attrval[$i]."</p>";
						}
					}
					echo "</div>";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">Other Attributes</h5>";
					for ($i = 0; $i < 8; $i++)
					{
						if (!($attr[$i] == $prefattr1) && !($attr[$i] == $prefattr2))
						{
							echo "<p class=\"my-0 mx-2\">".$attr[$i].": ".$attrval[$i]."</p>";
						}
					}
					echo "</div>";
				echo "</div>";
				
				echo "<div class=\"col-xs-12 col-md-6 text-left\">";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">Major Skills</h5>";
					for ($i = 0; $i < 27; $i++)
					{
						if ($skill[$i] == $majskill1 || $skill[$i] == $majskill2 || $skill[$i] == $majskill3 ||
						$skill[$i] == $majskill4 || $skill[$i] == $majskill5)
						{
							echo "<p class=\"my-0 mx-2\">".$skill[$i].": ".$skillval[$i]."</p>";
						}
					}
					echo "</div>";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">Minor Skills</h5>";
					for ($i = 0; $i < 27; $i++)
					{
						if ($skill[$i] == $minskill1 || $skill[$i] == $minskill2 || $skill[$i] == $minskill3 ||
						$skill[$i] == $minskill4 ||$skill[$i] == $minskill5)
						{
							echo "<p class=\"my-0 mx-2\">".$skill[$i].": ".$skillval[$i]."</p>";
						}
					}
					echo "</div>";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">Miscellaneous Skills</h5>";
					for ($i = 0; $i < 27; $i++)
					{
						if (!($skill[$i] == $majskill1) && !($skill[$i] == $majskill2) && !($skill[$i] == $majskill3) &&
						!($skill[$i] == $majskill4) && !($skill[$i] == $majskill5) && !($skill[$i] == $minskill1) &&
						!($skill[$i] == $minskill2) && !($skill[$i] == $minskill3) && !($skill[$i] == $minskill4) &&
						!($skill[$i] == $minskill5))
						{
							echo "<p class=\"my-0 mx-2\">".$skill[$i].": ".$skillval[$i]."</p>";
						}
					}
					echo "</div>";
				echo "</div>";
			echo "</div>";
		?>
		
			<form class="text-left" method="post" action="<?php echo "./article.php?id=" . $_GET['id'];?>">
				<textarea class="form-control my-1" name="text" id="text" rows="3"></textarea>
				<button id="submit" name="comment" type="comment" class="btn btn-primary">Comment</button>
				
			</form>
			
<?php
			echo "<div class=\"row justify-content-around text-center\">";
				echo "<div class=\"col\">";
				echo "<h3>Comments!</h3>";
					$commsql = "select text from comment where articleid=".$_GET['id'];
					foreach($con->query($commsql) as $row)
					{
						echo "<div class=\"row my-2 text-left\">";
							echo "<div class=\"col comment\">";
								echo "<span class=\"py-2\">". $row['text']."</span>";
							echo "</div>";
						echo "</div>";
					}
				echo "</div>";
			echo "</div>";
		echo "</div>";
?>
		
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>


			
