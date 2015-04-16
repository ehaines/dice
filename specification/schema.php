<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dice.com Job Listing Schema</title>
		<style>
			body {color: white;
				background-color: cornflowerblue;
				font-family: sans-serif;}
			body figcaption {font-weight: bold;
				font-style: italic}
		</style>
	</head>
	<body>
		<h1>Dice.com Job Listing Schema</h1>
		<h2>Strong Entities:</h2>
		<h3>Employer</h3>
		<ul>
			<li>Primary Key: diceID</li>
			<li>logo</li>
			<li>link to website</li>
		</ul>
		<h3>Job Description</h3>
		<ul>
			<li>Primary Key: positionID</li>
			<li>salary</li>
			<li>travel required</li>
			<li>date and time posted</li>
			<li>text</li>
			<li>hours</li>
		</ul>
		<h3>Tag</h3>
		<ul>
			<li>Tag Name</li>
			<li>Tag ID</li>
		</ul>
		<h3>Location</h3>
		<figure>
			<img src="../img/Dice_ERD.svg" alt="An Entity Relationship Diagram for a Dice.com Job Listing" />
			<figcaption>An Entity-Relationship Diagram for a single Dice.com Job Listing Page. <br />
				Made with <a href="http://www.yworks.com/en/products/yfiles/yed/">yEd Graph Editor.</a>
			</figcaption>
		</figure>
	</body>
</html> 