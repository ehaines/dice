DROP TABLE IF EXISTS employer;
DROP TABLE IF EXISTS jobDescription;
DROP TABLE IF EXISTS location;
DROP TABLE IF EXISTS jobLocation;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS jobTag;

CREATE TABLE employer (
	diceID VARCHAR(15),
	logo VARCHAR(300),
	website VARCHAR(300),
	name VARCHAR(100),
	PRIMARY KEY (diceID)
);

CREATE TABLE jobDescription (
	positionID INT UNSIGNED AUTO_INCREMENT NOT NULL,
	travelRequired BOOLEAN,
	salary INT UNSIGNED,
	dateTimePosted DATETIME NOT NULL,
	text TEXT,
	hours VARCHAR(15),
	PRIMARY KEY(positionID)
);

CREATE TABLE location (
	locationID INT UNSIGNED NOT NULL,
	name VARCHAR(300),
	PRIMARY KEY(locationID)
);

CREATE TABLE tag(
	tagID INT UNSIGNED NOT NULL AUTO_INCREMENT,
	tagName VARCHAR(255),
	PRIMARY KEY(tagID)
);

CREATE TABLE jobLocation (
	locationID INT UNSIGNED NOT NULL,
	positionID INT UNSIGNED NOT NULL,
	INDEX(locationID),
	INDEX(positionID),
	FOREIGN KEY(locationID) REFERENCES location(locationID),
	FOREIGN KEY(positionID) REFERENCES jobDescription(positionID),
	PRIMARY KEY(locationID, positionID)
);

CREATE TABLE jobTag (
	tagID INT UNSIGNED NOT NULL,
	positionID INT UNSIGNED NOT NULL,
	INDEX(tagID),
	INDEX(positionID),
	FOREIGN KEY(tagID) REFERENCES tag(tagID),
	FOREIGN KEY(positionID) REFERENCES jobDescription(positionID),
	PRIMARY KEY(tagID, positionID)
);