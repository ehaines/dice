<?php
//require the AES 256 functions
require_once("/etc/apache2/data-design/encrypted-config.php");

//bring in/require the class being tested (Employer)
require_once("employer.php");

$config = readConfig("/etc/apache2/data-design/ehaines.ini");

?>