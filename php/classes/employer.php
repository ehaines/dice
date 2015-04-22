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


	public function __construct($newDiceId, $newLogo, $newWebsite) {
		try {
			$this->setDiceId($newDiceId);
			$this->setLogo($newLogo);
			$this->setWebsite($newWebsite);
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
	 *
	 * @param String for new value of diceId
	 */
	public function setDiceId($newDiceId) {
		//base case - if the primary key/diceId is null, this is a new employer and mySQL hasn't assigned an id yet
		if($newDiceId===null) {
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
	 */
	public function setLogo($newLogo) {

		//make sure the url for the logo is valid
		$newLogo = filter_var($newLogo, FILTER_VALIDATE_URL);
		if($newLogo === false) {
			throw new InvalidArgumentException("The logo url is invalid");
		}

		//make sure the url string is clean and hasn't been maliciously altered
		$newLogo = filter_var($newLogo, FILTER_SANITIZE_URL);

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
	 */



}

?>