<?php
session_start();
include_once 'db_connection.php';
if (!isset($_SESSION['name']))
{
	header("Location: http://localhost/home.php");
}
if (isset($_POST['upload']))
{
	$sql = "insert into build (id, name, description, sex, sign, race, prefattr1, prefattr2, str, endu, agi, spd, per,
	intel, wis, lck, majskill1, majskill2, majskill3, majskill4, majskill5, minskill1, minskill2, minskill3, minskill4,
	minskill5, heavyarm, mediumarm, spear, acrobatics, armorer, axe, blunt, longblade, block, lightarm, marksman, sneak,
	athletics, handtohand, shortblade, unarmored, illusion, mercantile, speechcraft, alchemy, conjuration, enchant, secur,
	alteration, destruction, mysticism, restoration) values (null, :name, :desc, :sex, :sign, :race, :attr1, :attr2, :str,
	:endu, :agi, :spd, :per, :intel, :wis, :lck, :maj1, :maj2, :maj3, :maj4, :maj5, :min1, :min2, :min3, :min4, :min5, :s0,
	:s1, :s2, :s3, :s4, :s5, :s6, :s7, :s8, :s9, :s10, :s11, :s12, :s13, :s14, :s15, :s16, :s17, :s18, :s19, :s20, :s21, :s22,
	:s23, :s24, :s25, :s26)";
	$connectionInfo = new Connection();
	$con = $connectionInfo->openConnection();
	$statement = $con->prepare($sql);
	
	$statement->bindvalue(":name", $_SESSION['name']);
	$statement->bindvalue(":desc", $_SESSION['description']);
	$statement->bindvalue(":sex", $_SESSION['sex']);
	$statement->bindvalue(":sign", $_SESSION['sign']);
	$statement->bindvalue(":race", $_SESSION['race']);
	$statement->bindvalue(":attr1", $_SESSION['prefattr1']);
	$statement->bindvalue(":attr2", $_SESSION['prefattr2']);
	$statement->bindvalue(":str", $_SESSION['attrval'][0]);
	$statement->bindvalue(":endu", $_SESSION['attrval'][1]);
	$statement->bindvalue(":agi", $_SESSION['attrval'][2]);
	$statement->bindvalue(":spd", $_SESSION['attrval'][3]);
	$statement->bindvalue(":per", $_SESSION['attrval'][4]);
	$statement->bindvalue(":intel", $_SESSION['attrval'][5]);
	$statement->bindvalue(":wis", $_SESSION['attrval'][6]);
	$statement->bindvalue(":lck", $_SESSION['attrval'][7]);
	$statement->bindvalue(":maj1", $_SESSION['majskill1']);
	$statement->bindvalue(":maj2", $_SESSION['majskill2']);
	$statement->bindvalue(":maj3", $_SESSION['majskill3']);
	$statement->bindvalue(":maj4", $_SESSION['majskill4']);
	$statement->bindvalue(":maj5", $_SESSION['majskill5']);
	$statement->bindvalue(":min1", $_SESSION['minskill1']);
	$statement->bindvalue(":min2", $_SESSION['minskill2']);
	$statement->bindvalue(":min3", $_SESSION['minskill3']);
	$statement->bindvalue(":min4", $_SESSION['minskill4']);
	$statement->bindvalue(":min5", $_SESSION['minskill5']);
	
	for ($i = 0; $i < 27; $i++)
	{
		$bind = "s";
		$bind = $bind . $i;
		$statement->bindvalue($bind, $_SESSION['skillval'][$i]);
	}
	
	$statement->execute();
	session_unset();
	header("Location: http://localhost/browse.php");
}
elseif(isset($_POST['back']))
{
	header("Location: http://localhost/makecharacter.php");
}
?>

<DOCTYPE! html>
<html>
	<head>
		<title>Goldy's Morrowind Character Creator | Preview</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="./general.css" />
		<link rel="stylesheet" type="text/css" href="./preview.css" />
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
					<li class="nav-item">
						<a class="nav-link" href="/browse.php">Browse</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="/makecharacter.php">Make Your Own!</a>
					</li>
					
				</ul>
			
			</div>
		
		</nav>
		<div class="container text-center">
		<h1>Character Preview</h1>
		<?php
			//attributes
			$attr = ['Strength', 'Endurance', 'Agility', 'Speed', 'Personality', 'Intelligence', 'Willpower', 'Luck'];
			$attrval = [0,0,0,0,0,0,0,40];
			//skills
			$skill=['Heavy Armor', 'Medium Armor', 'Spear', 'Acrobatics', 'Armorer', 'Axe', 'Blunt', 'Long Blade', 'Block', 'Light Armor',
			'Marksman', 'Sneak', 'Athletics', 'Hand To Hand', 'Short Blade', 'Unarmored', 'Illusion', 'Mercantile', 'Speechcraft', 'Alchemy',
			'Conjuration', 'Enchant', 'Security', 'Alteration', 'Destruction', 'Mysticism', 'Restoration'];
			$skillval=[5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5];
			if ($_SESSION['race'] == 'High Elf')
			{
				$attrval[0] = 30;
				$attrval[2] = 40;
				$attrval[4] = 40;
				$attrval[5] = 50;
				$attrval[6] = 40;
				$skillval[19]+=10;
				$skillval[23]+=5;
				$skillval[20]+=5;
				$skillval[24]+=10;
				$skillval[21]+=10;
				$skillval[16]+=5;
				if($_SESSION['sex'] == 'male')
				{
					$attrval[3] = 30;
					$attrval[1] = 40;
				}
				else
				{
					$attrval[3] = 40;
					$attrval[1] = 30;
				}
			}
			elseif ($_SESSION['race'] == 'Wood Elf')
			{
				$attrval[0] = 30;
				$attrval[5] = 40;
				$attrval[6] = 30;
				$attrval[3] = 50;
				$attrval[2] = 50;
				$attrval[1] = 30;
				$attrval[4] = 40;
				$skillval[3]+=5;
				$skillval[19]+=5;
				$skillval[9]+=10;
				$skillval[10]+=15;
				$skillval[11]+=10;
			}
			elseif ($_SESSION['race'] == 'Argonian')
			{
				$attrval[0] = 40;
				$attrval[1] = 30;
				$attrval[4] = 30;
				$skillval[19]+=5;
				$skillval[12]+=15;
				$skillval[16]+=5;
				$skillval[1]+=5;
				$skillval[25]+=5;
				$skillval[2]+=5;
				$skillval[15]+=5;
				if($_SESSION['sex'] == 'male')
				{
					$attrval[6] = 30;
					$attrval[5] = 40;
					$attrval[3] = 50;
					$attrval[2] = 50;
				}
				else
				{
					$attrval[6] = 40;
					$attrval[5] = 50;
					$attrval[3] = 40;
					$attrval[2] = 40;
				}
			}
			elseif ($_SESSION['race'] == 'Breton')
			{
				
				$attrval[1] = 30;
				$attrval[4] = 40;
				$attrval[6] = 50;
				$attrval[5] = 50;
				$attrval[2] = 30;
				$skillval[19]+=5;
				$skillval[23]+=5;
				$skillval[20]+=10;
				$skillval[16]+=5;
				$skillval[25]+=10;
				$skillval[26]+=10;
				if($_SESSION['sex'] == 'male')
				{
					$attrval[0] = 40;
					$attrval[3] = 30;
				}
				else
				{
					$attrval[3] = 40;
					$attrval[0] = 30;
				}
			}
			elseif ($_SESSION['race'] == 'Dark Elf')
			{
				$attrval[0] = 40;
				$attrval[3] = 50;
				$attrval[6] = 30;
				$attrval[5] = 40;
				$attrval[2] = 40;
				$skillval[12]+=5;
				$skillval[24]+=10;
				$skillval[9]+=5;
				$skillval[7]+=5;
				$skillval[10]+=5;
				$skillval[25]+=5;
				$skillval[14]+=10;
				if($_SESSION['sex'] == 'male')
				{
					$attrval[1] = 40;
					$attrval[4] = 30;
				}
				else
				{
					$attrval[1] = 30;
					$attrval[4] = 40;
				}
			}
			elseif ($_SESSION['race'] == 'Imperial')
			{
				$attrval[0] = 40;
				$attrval[1] = 40;
				$attrval[4] = 50;
				$attrval[5] = 40;
				$attrval[2] = 30;
				$skillval[6]+=5;
				$skillval[13]+=5;
				$skillval[9]+=5;
				$skillval[7]+=10;
				$skillval[17]+=10;
				$skillval[18]+=10;
				if($_SESSION['sex'] == 'male')
				{
					$attrval[3] = 40;
					$attrval[6] = 30;
				}
				else
				{
					$attrval[3] = 30;
					$attrval[6] = 40;
				}
			}
			elseif ($_SESSION['race'] == 'Khajiit')
			{
				$attrval[3] = 40;
				$attrval[6] = 30;
				$attrval[4] = 40;
				$attrval[5] = 40;
				$attrval[2] = 50;
				$skillval[13]+=5;
				$skillval[3]+=15;
				$skillval[12]+=5;
				$skillval[9]+=5;
				$skillval[22]+=5;
				$skillval[14]+=5;
				$skillval[11]+=5;
				
				if($_SESSION['sex'] == 'male')
				{
					$attrval[0] = 40;
					$attrval[1] = 30;
				}
				else
				{
					$attrval[0] = 30;
					$attrval[1] = 40;
				}
			}
			elseif ($_SESSION['race'] == 'Nord')
			{
				$attrval[3] = 40;
				$attrval[4] = 30;
				$attrval[5] = 30;
				$attrval[2] = 30;
				$attrval[0] = 50;
				$skillval[5]+=10;
				$skillval[6]+=10;
				$skillval[0]+=5;
				$skillval[7]+=5;
				$skillval[1]+=10;
				$skillval[2]+=5;
				if($_SESSION['sex'] == 'male')
				{
					$attrval[1] = 50;
					$attrval[6] = 40;
				}
				else
				{
					$attrval[1] = 40;
					$attrval[6] = 50;
				}
			}
			elseif ($_SESSION['race'] == 'Orc')
			{
				$attrval[3] = 30;
				$attrval[2] = 35;
				$attrval[0] = 45;
				$attrval[1] = 50;
				$skillval[4]+=10;
				$skillval[5]+=5;
				$skillval[8]+=10;
				$skillval[0]+=10;
				$skillval[1]+=10;
				if($_SESSION['sex'] == 'male')
				{
					$attrval[4] = 30;
					$attrval[5] = 30;
					$attrval[6] = 50;
				}
				else
				{
					$attrval[4] = 25;
					$attrval[5] = 40;
					$attrval[6] = 45;
				}
			}
			elseif ($_SESSION['race'] == 'Redguard')
			{
				$attrval[3] = 40;
				$attrval[2] = 40;
				$attrval[1] = 50;
				$attrval[5] = 30;
				$attrval[6] = 30;
				$skillval[12]+=5;
				$skillval[5]+=5;
				$skillval[6]+=5;
				$skillval[0]+=5;
				$skillval[7]+=15;
				$skillval[1]+=5;
				$skillval[14]+=5;
				if($_SESSION['sex'] == 'male')
				{
					$attrval[0] = 50;
					$attrval[4] = 30;
				}
				else
				{
					$attrval[0] = 40;
					$attrval[4] = 40;
				}
			}
			//now onto preferred attributes!
			
			for ($i = 0; $i < 8; $i++)
			{
				if ($_SESSION['prefattr1'] == $attr[$i] || $_SESSION['prefattr2'] == $attr[$i])
				{
					$attrval[$i] += 10;
				}
			}
			//Specialization messing with skills
			if ($_SESSION['specialization'] == 'Combat')
			{
				$skillval[0]+=5;
				$skillval[1]+=5;
				$skillval[2]+=5;
				$skillval[4]+=5;
				$skillval[5]+=5;
				$skillval[6]+=5;
				$skillval[7]+=5;
				$skillval[8]+=5;
				$skillval[12]+=5;
			}
			elseif ($_SESSION['specialization'] == 'Stealth')
			{
				$skillval[3]+=5;
				$skillval[9]+=5;
				$skillval[10]+=5;
				$skillval[11]+=5;
				$skillval[13]+=5;
				$skillval[14]+=5;
				$skillval[17]+=5;
				$skillval[18]+=5;
				$skillval[22]+=5;
			}
			else
			{
				$skillval[15]+=5;
				$skillval[16]+=5;
				$skillval[19]+=5;
				$skillval[20]+=5;
				$skillval[21]+=5;
				$skillval[23]+=5;
				$skillval[24]+=5;
				$skillval[25]+=5;
				$skillval[26]+=5;
			}
			
			//dealing with major and minor skills
			
			//major skills
			for ($i = 0; $i < 27; $i++)
			{
				if ($skill[$i] == $_SESSION['majskill1'] || $skill[$i] == $_SESSION['majskill2'] || $skill[$i] == $_SESSION['majskill3'] ||
				$skill[$i] == $_SESSION['majskill4'] || $skill[$i] == $_SESSION['majskill5'])
				{
					$skillval[$i] += 25;
				}
			}
			
			//minor skills
			for ($i = 0; $i < 27; $i++)
			{
				if ($skill[$i] == $_SESSION['minskill1'] || $skill[$i] == $_SESSION['minskill2'] || $skill[$i] == $_SESSION['minskill3'] ||
				$skill[$i] == $_SESSION['minskill4'] || $skill[$i] == $_SESSION['minskill5'])
				{
					$skillval[$i] += 10;
				}
			}
			
			//LASTLY if your sign affects a stat
			
			if ($_SESSION['sign'] == 'Lady')
			{
				$attrval[4]+=25;
				$attrval[1]+=25;
			}
			elseif ($_SESSION['sign'] == 'Steed')
			{
				$attrval[3]+=25;
			}
			elseif($_SESSION['sign'] == 'Lover')
			{
				$attrval[2]+=25;
			}
			
			$_SESSION['attrval'] = $attrval;
			$_SESSION['skillval'] = $skillval;
			
			echo "<div class=\"row justify-content-around\">";
				echo "<div class=\"col-xs-12 col-md-6 text-left\">";
				echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">About</h5>";
					echo "<p class=\"my-0 mx-2\">Name: ".$_SESSION['name']."</p>";
					echo "<p class=\"my-0 mx-2\">Sex: ".$_SESSION['sex']."</p>";
					echo "<p class=\"my-0 mx-2\">Race: ".$_SESSION['race']."</p>";
					echo "<p class=\"my-0 mx-2\">Birthsign: The ".$_SESSION['sign']."</p>";
					echo "<p class=\"my-0 mx-2\">Description: ".$_SESSION['description']."</p>";
					
					echo "</div>";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">Favored Attributes</h5>";
					for ($i = 0; $i < 8; $i++)
					{
						if ($attr[$i] == $_SESSION['prefattr1'] || $attr[$i] == $_SESSION['prefattr2'])
						{
							echo "<p class=\"my-0 mx-2\">".$attr[$i].": ".$attrval[$i]."</p>";
						}
					}
					echo "</div>";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">Other Attributes</h5>";
					for ($i = 0; $i < 8; $i++)
					{
						if (!($attr[$i] == $_SESSION['prefattr1']) && !($attr[$i] == $_SESSION['prefattr2']))
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
						if ($skill[$i] == $_SESSION['majskill1'] || $skill[$i] == $_SESSION['majskill2'] || $skill[$i] == $_SESSION['majskill3'] ||
						$skill[$i] == $_SESSION['majskill4'] ||$skill[$i] == $_SESSION['majskill5'])
						{
							echo "<p class=\"my-0 mx-2\">".$skill[$i].": ".$skillval[$i]."</p>";
						}
					}
					echo "</div>";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">Minor Skills</h5>";
					for ($i = 0; $i < 27; $i++)
					{
						if ($skill[$i] == $_SESSION['minskill1'] || $skill[$i] == $_SESSION['minskill2'] || $skill[$i] == $_SESSION['minskill3'] ||
						$skill[$i] == $_SESSION['minskill4'] ||$skill[$i] == $_SESSION['minskill5'])
						{
							echo "<p class=\"my-0 mx-2\">".$skill[$i].": ".$skillval[$i]."</p>";
						}
					}
					echo "</div>";
					echo "<div class=\"section\">";
					echo "<h5 class=\"my-1 mx-2\">Miscellaneous Skills</h5>";
					for ($i = 0; $i < 27; $i++)
					{
						if (!($skill[$i] == $_SESSION['majskill1']) && !($skill[$i] == $_SESSION['majskill2']) && !($skill[$i] == $_SESSION['majskill3']) &&
						!($skill[$i] == $_SESSION['majskill4']) && !($skill[$i] == $_SESSION['majskill5']) && !($skill[$i] == $_SESSION['minskill1']) &&
						!($skill[$i] == $_SESSION['minskill2']) && !($skill[$i] == $_SESSION['minskill3']) && !($skill[$i] == $_SESSION['minskill4']) &&
						!($skill[$i] == $_SESSION['minskill5']))
						{
							echo "<p class=\"my-0 mx-2\">".$skill[$i].": ".$skillval[$i]."</p>";
						}
					}
					echo "</div>";
				echo "</div>";
			echo "</div>";
		?>
		
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<button id="back" name="back" type="submit" class="btn btn-primary">Go Back</button>
				<button id="upload" name="upload" type="submit" class="btn btn-primary">Upload</button>
		</form>
		</div>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
	</body>
</html>