<?php
//require the AES 256 functions
require_once("/etc/apache2/data-design/encrypted-config.php");

//bring in/require the class being tested (Employer)
require_once("employer.php");

try {
	//  $config = readConfig("/etc/apache2/data-design/database-config.ini");
	$config = readConfig("/etc/apache2/data-design/ehaines.ini");

	//create a data connection string (DSN) & specify the user name and password
	$dsn = "mysql:host=" . $config["hostname"] . ";dbname=" . $config["database"];

	// enable UTF-8 (Unicode) text handling
	$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

	// connect to MYsql via pdo
	$pdo = new PDO($dsn, $config["username"], $config["password"], $options);

	//have PDO throw exceptions whenever possible
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//insert a new employer into mySQL
	$employer = new Employer("ABCD123", "http://ellahaines.net", "google.com", "SprocketRockets Inc.");
	$employer->insert($pdo);

	//change and update in mySQL
	$employer->setName("We Sell Stuffs");
	$employer->update($pdo);

	//select from mySQL
	$selectedPdoEmployer = Employer::getEmployerByPrimaryKey($pdo, "ABC123");

	//delete the Employer from mySQL and show that it is gone
	$employer->delete($pdo);
	$selectedPdoEmployer = Employer::getEmployerByPrimaryKey($pdo, "ABC123");
} catch(PDOException $pdoException) {
		echo "Exception: " . $pdoException->getMessage();
}
//  NOTE: Jason removed the "?[NO_SPACE>" php closing tag as it was identified as redundant by phpStorm and Dylan confirmed it's been essentially deprecated.

?>