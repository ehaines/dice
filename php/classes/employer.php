<?php
/**
 * This class is for the objects representing the Employer table in the Dice.com database.
 *
 * @author Ella Haines
 */

class Employer {
	/**
	 * diceId for the employer - this is the primary key
	 * @var String $diceID
	 */
	protected $diceId;

	/**
	 *url link to the company's logo
	 * @var String $logo
	 */
	protected $logo;

	/**
	 * url to company website
	 * @var String website
	 */
	protected $website;

	/**
	 * name of the company/employer
	 * @var String name
	 */
	protected $name;


	/**
	 * Constructor for this employer object.
	 * @param $newDiceId String id of this employer as primary key or null if new Employer object
	 * @param $newLogo String url <300 chars linking to logo image
	 * @param $newWebsite String url <300 chars linking to corporate website
	 * @throws InvalidArgumentException if urls are not valid
	 * @throws LengthException if length of string is too long for SQL field
	 */
	public function __construct($newDiceId, $newLogo, $newWebsite, $newName) {
		try {
			$this->setDiceId($newDiceId);
			$this->setLogo($newLogo);
			$this->setWebsite($newWebsite);
			$this->setName($newName);
		} catch(InvalidArgumentException $invalidArgument) {
			//rethrow exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(), $invalidArgument));
		} catch(LengthException $length) {
			//rethrow exception to the caller
			throw (new LengthException($length->getMessage(), $length));
		}
	}
		/**
		 * accessor method for diceId
		 *
		 * @return String value of diceId
		 */
	public function getDiceId() {
		return ($this->diceId);
	}

	/**
	 * mutator method for diceId
	 * @param String for new value of diceId
	 * @throws LengthException if length of String is too long for the mySQL diceId field
	 */
	public function setDiceId($newDiceId) {
		//base case - if the primary key/diceId is null, this is a new employer and mySQL hasn't assigned an id yet
		if($newDiceId === null) {
			$this->diceId = null;
			return;
		}

		//make sure the string is clean and hasn't been maliciously altered
		$newDiceId = filter_var($newDiceId, FILTER_SANITIZE_STRING);

		//check that the length of the id is not too long
		if(strlen($newDiceId) > 15) {
			throw new LengthException("The diceId is too long for the mySQL field");
		}

		//store the diceId in the member variable
		$this->diceId = $newDiceId;
	}

	/**
	 * accessor method for logo string
	 *
	 * @return String value of logo url
	 */
	public function getLogo() {
		return ($this->logo);
	}

	/**
	 * mutator method for logo string
	 *
	 * @param $newLogo String for url linking to logo image
	 * @throws InvalidArgumentException if url is not valid
	 * @throws LengthException if length of string is too long for SQL field
	 */
	public function setLogo($newLogo) {
		//make sure the url string is clean and hasn't been maliciously altered
		$newLogo = filter_var($newLogo, FILTER_SANITIZE_URL);

		//make sure the url for the logo is valid
		$newLogo = filter_var($newLogo, FILTER_VALIDATE_URL);
		if($newLogo === false) {
			throw new InvalidArgumentException("The logo url is invalid");
		}

		//check that the length of the url is not too long
		if(strlen($newLogo) > 300) {
			throw new LengthException("The logo url is too long for the mySQL field (>300 characters)");
		}

		//store the logo URL in the member variable
		$this->logo = $newLogo;
	}

	/**
	 * accessor method for link to website
	 *
	 * @return String value of website url
	 */
	public function getWebsite() {
		return ($this->website);
	}
	/**
	 * mutator method for link to website
	 *
	 * @param String URL of company website
	 * @throws InvalidArgumentException if url is not valid
	 * @throws LengthException if length of string is too long for SQL field
	 */
	public function setWebsite($newWebsite) {
		//make sure the url string is clean and hasn't been maliciously altered
		$newWebsite = filter_var($newWebsite, FILTER_SANITIZE_URL);

		//make sure the url for the logo is valid
		$newWebsite = filter_var($newWebsite, FILTER_VALIDATE_URL);
		if($newWebsite === false) {
			throw new InvalidArgumentException("The website url is invalid");
		}

		//check that the length of the url is not too long
		if(strlen($newWebsite) > 300) {
			throw new LengthException("The website url is too long for the mySQL field (>300 characters)");
		}

		//store the logo URL in the member variable
		$this->website = $newWebsite;
	}
	public function getName() {
		return ($this->$name);
	}

	public function setName($newName) {
		//make sure the string is clean and hasn't been maliciously altered
		$newName = filter_var($newName, FILTER_SANITIZE_STRING);

		//check that the length of the id is not too long
		if(strlen($newName) > 100) {
			throw new LengthException("The employer name is too long for the mySQL field");
		}

		//store the name in the member variable
		$this->name = $newName;
	}

	/**
	 * inserts this employer into mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @throws PDOException when employer already exists in the system
	 */
	public function insert(PDO &$pdo) {
		if ($this->diceId !== null){
			throw (new PDOException("This employer already exists in the system."));
		}

		//create query template
		$query = "INSERT INTO employer(diceId, logo, website, name) VALUES (:diceId, :logo, :website, :name)";

		$statement = $pdo->prepare($query);

		//bind the member variables to the placeholders in the query, getting the diceId primary key from the constructor
		//instead of having SQL generate it like with an integer
		$parameters = array("diceId" => $this.diceId, "logo" => $this.logo,
			"website" => $this.website, "name" => $this.name);

		//run the query
		$statement->execute($parameters);

	}

	/**
	 * Updates the employer row in mySQL
	 *
	 * @param PDO $pdo pointer to the PDO connection, by reference
	 * @throws PDOException when the employer diceID is null
	 */
	public function update(PDO &$pdo) {
		//don't update a null employer that isn't in the database (this prevents superfluous traffic to the server).
		if($this->diceId === null) {
			throw (new PDOException("unable to update an employer that doesn't exist"));
		}

		//create query template
		$query = "UPDATE employer SET diceId = :diceId, logo = :logo,
 			website = :website, name = :name WHERE diceId = :diceId";

		//put query into pdo object
		$statement = $pdo->prepare($query);

		//bind member variables to the placeholders in the query template
		$parameters = array("diceId" => $this.diceId, "logo" => $this.logo,
			"website" => $this.website, "name" => $this.name);

		$statement->execute($parameters);
	}

	/**
	 * Deletes employer from the database
	 * @param PDO $pdo pointer to PDO connection, by reference
	 * @throws PDOException when employer doesn't exist in the first place
	 */
	public function delete(PDO &$pdo) {
		//checks that the employer exists
		if($this->diceId === null) {
			throw (new PDOException("unable to delete an employer that doesn't exist"));
		}
		//create a query template and put into pdo object
		$query = "DELETE FROM employer WHERE diceId = :diceId";
		$statement = $pdo->prepare($query);

		//bind member variables to placeholder
		$parameters = array("diceId" => $this.diceId);

		//run the query to delete the row from the database
		$statement->execute($parameters);
	}

	public function getEmployerByPrimaryKey() {

	}
	public function getEmployerByName() {

	}

}

?>