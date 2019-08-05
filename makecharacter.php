<?php
session_start();

function checkSkillsAndAttr()
{
	if ($_POST['prefattr1'] == $_POST['prefattr2'])
	{
		return false;
	}
	else
	{
		for ($i = 0; $i < 2; $i++)
		{
			$check;
			
			for ($j = 1; $j <=5; $j++)
			{
				if ($i == 0)
				{
					$check = "majskill".$j;
				}
				else
				{
					$check = "minskill".$j;
				}
				for($k = 1; $k <= 5; $k++)
				{
					if (!($j == $k && $i==0))
					{
						if ($_POST[$check] == $_POST['majskill'.$k])
						{
							return false;
						}
					}
				}
				for($k = 1; $k <= 5; $k++)
				{
					if (!($j == $k && $i==1))
					{
						if ($_POST[$check] == $_POST['minskill'.$k])
						{
							return false;
						}
					}
				}
			}
		}
	}
	return true;
}

if (isset($_POST['submit']))
{
	if(strlen($_POST['name']) > 1 && preg_match('/^[a-zA-Z ]+$/', $_POST['name']) && 
	((preg_match('/^[a-zA-Z0-9 !.:,]+$/', $_POST['description']) && strlen($_POST['description']) > 0) || strlen($_POST['description']) == 0) &&
	isset($_POST['sex']) && checkSkillsAndAttr())
	{
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['description'] = $_POST['description'];
		$_SESSION['sex'] = $_POST['sex'];
		$_SESSION['race'] = $_POST['race'];
		$_SESSION['specialization'] = $_POST['specialization'];
		$_SESSION['prefattr1'] = $_POST['prefattr1'];
		$_SESSION['prefattr2'] = $_POST['prefattr2'];
		$_SESSION['majskill1'] = $_POST['majskill1'];
		$_SESSION['majskill2'] = $_POST['majskill2'];
		$_SESSION['majskill3'] = $_POST['majskill3'];
		$_SESSION['majskill4'] = $_POST['majskill4'];
		$_SESSION['majskill5'] = $_POST['majskill5'];
		$_SESSION['minskill1'] = $_POST['minskill1'];
		$_SESSION['minskill2'] = $_POST['minskill2'];
		$_SESSION['minskill3'] = $_POST['minskill3'];
		$_SESSION['minskill4'] = $_POST['minskill4'];
		$_SESSION['minskill5'] = $_POST['minskill5'];
		$_SESSION['sign'] = $_POST['sign'];
		header("Location: http://localhost/preview.php");
	}
}


?>

<!DOCTYPE html>
<html>
	
	
	<head>
	<title>Goldy's Morrowind Character Creator | Make Character</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
					<li class="nav-item">
						<a class="nav-link" href="/browse.php">Browse</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="/makecharacter.php">Make Your Own!</a>
					</li>
					
				</ul>
			
			</div>
		
		</nav>
		
		<?php
			$good = false;

			if (isset($_POST['submit']))
			{
			if(strlen($_POST['name']) < 1)
			{
				echo "<div class=\"alert alert-danger\" role=\"alert\">Please enter a name!</div>";
			}
			elseif(!preg_match('/^[a-zA-Z ]+$/', $_POST['name']))
			{
				echo "<div class=\"alert alert-danger\" role=\"alert\">Names may only contain letters and spaces</div>";
			}
			elseif(!preg_match('/^[a-zA-Z0-9 !.:,]+$/', $_POST['description']) && strlen($_POST['description']) > 0)
			{
				echo "<div class=\"alert alert-danger\" role=\"alert\">Descriptions may only contain letters, numbers, ,s, !s, .s, and :s.</div>";
			}
			elseif(!isset($_POST['sex']))
			{
				echo "<div class=\"alert alert-danger\" role=\"alert\">Select a sex</div>";
			}
			elseif(!checkSkillsAndAttr())
			{
				echo "<div class=\"alert alert-danger\" role=\"alert\">All selected preffered attributes, major skills, and minor skills must be different</div>";
			}
			else
			{
				$good = true;
			}
	
			if (!$good)
			{
				echo '<script>fixdropdowns();</script>';
			}
			}


		?>
		
		
		<div class="container">
			<h1 class="text-center">Make Your Own Build!</h1>
			<div class="row">
			<div class="col">
				<form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="form-group">
						<label for="name">Build Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Build Name!" 
						value="<?php 
						if (isset($_SESSION['name']))
						{
							echo $_SESSION['name'];
						}
						elseif(isset($_POST['name']))
							echo $_POST['name'];
						?>"/>
					</div>
					<div class="form-group">
						<label for="description">Brief Description</label>
						<textarea class="form-control" name="description" id="description" rows="3"><?php
						if (isset($_SESSION['description'])) echo $_SESSION['description'];
						elseif (isset($_POST['description'])) echo $_POST['description'];?></textarea>
					</div>
					<div class="row">
					<div class="col-lg-4 col-md-6 col-xs-12">
						<div class="form-group">
							<label for="race">Race</label>
							<select class="form-control" name="race" id="race">
							<option value="Dark Elf" selected="selected">Dark Elf</option>
							<option value="Breton">Breton</option>
							<option value="High Elf">High Elf</option>
							<option value="Wood Elf">Wood Elf</option>
							<option value="Imperial">Imperial</option>
							<option value="Nord">Nord</option>
							<option value="Redguard">Redguard</option>
							<option value="Orc">Orc</option>
							<option value="Argonian">Argonian</option>
							<option value="Khajiit">Khajiit</option>
							</select>
						</div>
					</div>
					</div>
					<div class="form-group">
						<label for="sex">Sex</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="sex" id="male" value="male" 
							<?php 
							if (isset($_SESSION['sex']))
							{
								if ($_SESSION['sex'] == 'male')
								{
									echo 'checked=\"checked\"';
								}
							}
							elseif (isset($_POST['sex']))
							{
								if ($_POST['sex'] == 'male')
								{
									echo 'checked=\"checked\"';
								}
							}
							?>
							>
								<label class="form-check-label" for="male">
									Male
								</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="sex" id="female" value="female" 
							<?php 
							
							if (isset($_SESSION['sex']))
							{
								if ($_SESSION['sex'] == 'female')
								{
									echo 'checked=\"checked\"';
								}
							}
							elseif (isset($_POST['sex']))
							{
								if ($_POST['sex'] == 'female')
								{
									echo 'checked=\"checked\"';
								}
							}
							?>>
								<label class="form-check-label" for="female">
									Female
								</label>
						</div>
					</div>
					<div class="form-row">
						<div class="col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="specialization">Specialization</label>
								<select class="form-control" name="specialization" id="specialization">
								<option selected="selected" value="Combat">Combat</option>
								<option value="Magic">Magic</option>
								<option value="Stealth">Stealth</option>
								</select>
							</div>
							<div class="form-group">
								<label for="prefattr1">Preffered Attributes</label>
								<select class="form-control" name="prefattr1" id="prefattr1" onchange="fixattr(1)">
								<option selected="selected" value="Strength">Strength</option>
								<option value="Endurance">Endurance</option>
								<option value="Agility">Agility</option>
								<option value="Speed">Speed</option>
								<option value="Personality">Personality</option>
								<option value="Intelligence">Intelligence</option>
								<option value="Willpower">Willpower</option>
								<option value="Luck">Luck</option>
								</select>
								<select class="form-control" name="prefattr2" id="prefattr2" onchange="fixattr(2)">
								<option value="Strength">Strength</option>
								<option value="Endurance">Endurance</option>
								<option value="Agility">Agility</option>
								<option value="Speed">Speed</option>
								<option value="Personality">Personality</option>
								<option value="Intelligence" selected="selected">Intelligence</option>
								<option value="Willpower">Willpower</option>
								<option value="Luck">Luck</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="majskill1">Major Skills</label>
								<select class="form-control" name="majskill1" id="majskill1" onchange="fixskill(0);">
								<option value="Block" selected="selected">Block</option>
								<option value="Heavy Armor">Heavy Armor</option>
								<option value="Medium Armor">Medium Armor</option>
								<option value="Spear">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer">Armorer</option>
								<option value="Axe">Axe</option>
								<option value="Blunt">Blunt</option>
								<option value="Long Blade">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
								<select class="form-control" name="majskill2" id="majskill2" onchange="fixskill(1);">
								<option value="Block">Block</option>
								<option value="Heavy Armor">Heavy Armor</option>
								<option value="Medium Armor">Medium Armor</option>
								<option value="Spear">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer" selected="selected">Armorer</option>
								<option value="Axe">Axe</option>
								<option value="Blunt">Blunt</option>
								<option value="Long Blade">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
								<select class="form-control" name="majskill3" id="majskill3" onchange="fixskill(2);">
								<option value="Block">Block</option>
								<option value="Heavy Armor">Heavy Armor</option>
								<option value="Medium Armor" selected="selected">Medium Armor</option>
								<option value="Spear">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer">Armorer</option>
								<option value="Axe">Axe</option>
								<option value="Blunt">Blunt</option>
								<option value="Long Blade">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
								<select class="form-control" name="majskill4" id="majskill4" onchange="fixskill(3);">
								<option value="Block">Block</option>
								<option value="Heavy Armor" selected="selected">Heavy Armor</option>
								<option value="Medium Armor">Medium Armor</option>
								<option value="Spear">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer">Armorer</option>
								<option value="Axe">Axe</option>
								<option value="Blunt">Blunt</option>
								<option value="Long Blade">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
								<select class="form-control" name="majskill5" id="majskill5" onchange="fixskill(4);">
								<option value="Block">Block</option>
								<option value="Heavy Armor">Heavy Armor</option>
								<option value="Medium Armor">Medium Armor</option>
								<option value="Spear">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer">Armorer</option>
								<option value="Axe">Axe</option>
								<option value="Blunt" selected="selected">Blunt</option>
								<option value="Long Blade">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
							</div>
						</div>
						<div class="col-sm-12 col-md-6 col-lg-4">
							<div class="form-group">
								<label for="minskill1">Minor Skills</label>
								<select class="form-control" name="minskill1" id="minskill1" onchange="fixskill(5);">
								<option value="Block">Block</option>
								<option value="Heavy Armor">Heavy Armor</option>
								<option value="Medium Armor">Medium Armor</option>
								<option value="Spear">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer">Armorer</option>
								<option value="Axe">Axe</option>
								<option value="Blunt">Blunt</option>
								<option value="Long Blade" selected="selected">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
								<select class="form-control" name="minskill2" id="minskill2" onchange="fixskill(6);">
								<option value="Block">Block</option>
								<option value="Heavy Armor">Heavy Armor</option>
								<option value="Medium Armor">Medium Armor</option>
								<option value="Spear">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer">Armorer</option>
								<option value="Axe" selected="selected">Axe</option>
								<option value="Blunt">Blunt</option>
								<option value="Long Blade">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
								<select class="form-control" name="minskill3" id="minskill3" onchange="fixskill(7);">
								<option value="Block">Block</option>
								<option value="Heavy Armor">Heavy Armor</option>
								<option value="Medium Armor">Medium Armor</option>
								<option value="Spear" selected="selected">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer">Armorer</option>
								<option value="Axe">Axe</option>
								<option value="Blunt">Blunt</option>
								<option value="Long Blade">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
								<select class="form-control" name="minskill4" id="minskill4" onchange="fixskill(8);">
								<option value="Block">Block</option>
								<option value="Heavy Armor">Heavy Armor</option>
								<option value="Medium Armor">Medium Armor</option>
								<option value="Spear">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer">Armorer</option>
								<option value="Axe">Axe</option>
								<option value="Blunt">Blunt</option>
								<option value="Long Blade">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics" selected="selected">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
								<select class="form-control" name="minskill5" id="minskill5" onchange="fixskill(9);">
								<option value="Block">Block</option>
								<option value="Heavy Armor">Heavy Armor</option>
								<option value="Medium Armor">Medium Armor</option>
								<option value="Spear">Spear</option>
								<option value="Acrobatics">Acrobatics</option>
								<option value="Armorer">Armorer</option>
								<option value="Axe">Axe</option>
								<option value="Blunt">Blunt</option>
								<option value="Long Blade">Long Blade</option>
								<option value="Light Armor">Light Armor</option>
								<option value="Marksman">Marksman</option>
								<option value="Sneak">Sneak</option>
								<option value="Athletics">Athletics</option>
								<option value="Hand To Hand">Hand To Hand</option>
								<option value="Short Blade">Short Blade</option>
								<option value="Unarmored">Unarmored</option>
								<option value="Illusion">Illusion</option>
								<option value="Mercantile">Mercantile</option>
								<option value="Speechcraft">Speechcraft</option>
								<option value="Alchemy">Alchemy</option>
								<option value="Conjuration">Conjuration</option>
								<option value="Enchant" selected="selected">Enchant</option>
								<option value="Security">Security</option>
								<option value="Alteration">Alteration</option>
								<option value="Destruction">Destruction</option>
								<option value="Mysticism">Mysticism</option>
								<option value="Restoration">Restoration</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="col-lg-4 col-md-6 col-xs-12">
						<label for="sign">Birthsign</label>
							<select class="form-control" name="sign" id="sign">
								<option selected="selected" value="Warrior">The Warrior</option>
								<option value="Mage">The Mage</option>
								<option value="Thief">The Thief</option>
								<option value="Serpent">The Serpent</option>
								<option value="Lady">The Lady</option>
								<option value="Steed">The Steed</option>
								<option value="Lord">The Lord</option>
								<option value="Apprentice">The Apprentice</option>
								<option value="Atronach">The Atronach</option>
								<option value="Ritual">The Ritual</option>
								<option value="Lover">The Lover</option>
								<option value="Shadow">The Shadow</option>
								<option value="Tower">The Tower</option>
								</select>
						</div>
					</div>
					<br/>
					<div class="form-row">
						<button id="submit" name="submit" type="submit" class="btn btn-primary">Continue to Preview</button>
					</div>
				</form>
			</div>
			</div>
			<br/>
			<br/>
		</div>
		
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script>
		var prefattr1ind = document.getElementById("prefattr1").index;
		var prefattr2ind = document.getElementById("prefattr2").index;
		var skills = [0, 5, 2, 1, 7, 8, 6, 3, 12, 21];
		
		function fixattr(which)
		{
			indexof1 = document.getElementById("prefattr1").selectedIndex;
			indexof2 = document.getElementById("prefattr2").selectedIndex;
			
			if (which == 1)
			{
				if (indexof1 == indexof2)
				{
					document.getElementById("prefattr2").selectedIndex = prefattr1ind;
					prefattr2ind = prefattr1ind;
				}
				prefattr1ind = indexof1;
			}
			else
			{
				if (indexof1 == indexof2)
				{
					document.getElementById("prefattr1").selectedIndex = prefattr2ind;
					prefattr1ind = prefattr2ind;
				}
				prefattr2ind = indexof2;
			}
		}
		
		function fixskill(which)
		{
			var indexof1 = document.getElementById("majskill1").selectedIndex;
			var indexof2 = document.getElementById("majskill2").selectedIndex;
			var indexof3 = document.getElementById("majskill3").selectedIndex;
			var indexof4 = document.getElementById("majskill4").selectedIndex;
			var indexof5 = document.getElementById("majskill5").selectedIndex;
			var indexof6 = document.getElementById("minskill1").selectedIndex;
			var indexof7 = document.getElementById("minskill2").selectedIndex;
			var indexof8 = document.getElementById("minskill3").selectedIndex;
			var indexof9 = document.getElementById("minskill4").selectedIndex;
			var indexof10 = document.getElementById("minskill5").selectedIndex;
			
			var indextocheck = 0;
			if (which == 0)
			{
				indextocheck = indexof1;
			}
			else if (which == 1)
			{
				indextocheck = indexof2;
			}
			else if (which == 2)
			{
				indextocheck = indexof3;
			}
			else if (which == 3)
			{
				indextocheck = indexof4;
			}
			else if (which == 4)
			{
				indextocheck = indexof5;
			}
			else if (which == 5)
			{
				indextocheck = indexof6;
			}
			else if (which == 6)
			{
				indextocheck = indexof7;
			}
			else if (which == 7)
			{
				indextocheck = indexof8;
			}
			else if (which == 8)
			{
				indextocheck = indexof9;
			}
			else
			{
				indextocheck = indexof10;
			}
			var nameofedit;
			var i;
			for (i = 0; i < 10; i++)
			{
				if (i != which)
				{
					if (indextocheck == skills[i])
					{
						if (i < 5)
						{
							nameofedit="majskill";
							actname = nameofedit + (i+1);
							document.getElementById(actname).selectedIndex = skills[which];
						}
						else
						{
							nameofedit = "minskill";
							actname = nameofedit + (i-4);
							document.getElementById(actname).selectedIndex = skills[which];
						}
						skills[i] = skills[which];
						skills[which] = indextocheck;
					}
				}
			}
			skills[which] = indextocheck;
			
		}
		
		$(document).ready(function fixdropdowns()
		{
			var check = "<?php if (isset($_SESSION['race'])) echo $_SESSION['race'];
			else echo $_POST['race'];?>";
			var i;
			for (i=0; i < 10; i++)
			{
				if (check == document.getElementById("race").options[i].value)
				{
					document.getElementById("race").selectedIndex=i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['specialization'])) echo $_SESSION['specialization'];
			else echo $_POST['specialization'];?>";
			for (i=0; i < 3; i++)
			{
				if (check == document.getElementById("specialization").options[i].value)
				{
					document.getElementById("specialization").selectedIndex=i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['prefattr1'])) echo $_SESSION['prefattr1'];
			else echo $_POST['prefattr1'];?>";
			for (i=0; i < 8; i++)
			{
				if (check == document.getElementById("prefattr1").options[i].value)
				{
					document.getElementById("prefattr1").selectedIndex=i;
					prefattr1ind = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['prefattr2'])) echo $_SESSION['prefattr2'];
			else echo $_POST['prefattr2'];?>";
			for (i=0; i < 8; i++)
			{
				if (check == document.getElementById("prefattr2").options[i].value)
				{
					document.getElementById("prefattr2").selectedIndex=i;
					prefattr2ind = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['majskill1'])) echo $_SESSION['majskill1'];
			else echo $_POST['majskill1'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("majskill1").options[i].value)
				{
					document.getElementById("majskill1").selectedIndex=i;
					skills[0] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['majskill2'])) echo $_SESSION['majskill2'];
			else echo $_POST['majskill2'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("majskill2").options[i].value)
				{
					document.getElementById("majskill2").selectedIndex=i;
					skills[1] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['majskill3'])) echo $_SESSION['majskill3'];
			else echo $_POST['majskill3'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("majskill3").options[i].value)
				{
					document.getElementById("majskill3").selectedIndex=i;
					skills[2] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['majskill4'])) echo $_SESSION['majskill4'];
			else echo $_POST['majskill4'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("majskill4").options[i].value)
				{
					document.getElementById("majskill4").selectedIndex=i;
					skills[3] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['majskill5'])) echo $_SESSION['majskill5'];
			else echo $_POST['majskill5'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("majskill5").options[i].value)
				{
					document.getElementById("majskill5").selectedIndex=i;
					skills[4] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['minskill1'])) echo $_SESSION['minskill1'];
			else echo $_POST['minskill1'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("minskill1").options[i].value)
				{
					document.getElementById("minskill1").selectedIndex=i;
					skills[5] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['minskill2'])) echo $_SESSION['minskill2'];
			else echo $_POST['minskill2'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("minskill2").options[i].value)
				{
					document.getElementById("minskill2").selectedIndex=i;
					skills[6] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['minskill3'])) echo $_SESSION['minskill3'];
			else echo $_POST['minskill3'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("minskill3").options[i].value)
				{
					document.getElementById("minskill3").selectedIndex=i;
					skills[7] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['minskill4'])) echo $_SESSION['minskill4'];
			else echo $_POST['minskill4'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("minskill4").options[i].value)
				{
					document.getElementById("minskill4").selectedIndex=i;
					skills[8] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['minskill5'])) echo $_SESSION['minskill5'];
			else echo $_POST['minskill5'];?>";
			for (i=0; i < 27; i++)
			{
				if (check == document.getElementById("minskill5").options[i].value)
				{
					document.getElementById("minskill5").selectedIndex=i;
					skills[9] = i;
					break;
				}
			}
			check = "<?php if (isset($_SESSION['sign'])) echo $_SESSION['sign'];
			else echo $_POST['sign'];?>";
			for (i=0; i < 13; i++)
			{
				if (check == document.getElementById("sign").options[i].value)
				{
					document.getElementById("sign").selectedIndex=i;
					break;
				}
			}
		});
		
		$(document).ready(fixskill(0));
		$(document).ready(fixattr(0));
		</script>
		
		
	</body>
</html>

