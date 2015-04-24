DROP TABLE IF EXISTS employer;
DROP TABLE IF EXISTS jobDescription;
DROP TABLE IF EXISTS location;
DROP TABLE IF EXISTS jobLocation;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS jobTag;

CREATE TABLE employer (
	diceId VARCHAR(15) NOT NULL ,
	logo VARCHAR(300),
	website VARCHAR(300),
	name VARCHAR(100),
	PRIMARY KEY (diceId)
);

CREATE TABLE jobDescription (
	positionId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	travelRequired BOOLEAN,
	salary INT UNSIGNED,
	dateTimePosted DATETIME NOT NULL,
	text TEXT,
	hours VARCHAR(15),
	PRIMARY KEY(positionId)
);

CREATE TABLE location (
	locationId INT UNSIGNED NOT NULL,
	name VARCHAR(300),
	PRIMARY KEY(locationId)
);

CREATE TABLE tag(
	tagId INT UNSIGNED NOT NULL AUTO_INCREMENT,
	tagName VARCHAR(255),
	PRIMARY KEY(tagId)
);

CREATE TABLE jobLocation (
	locationId INT UNSIGNED NOT NULL,
	positionId INT UNSIGNED NOT NULL,
	INDEX(locationId),
	INDEX(positionId),
	FOREIGN KEY(locationId) REFERENCES location(locationId),
	FOREIGN KEY(positionId) REFERENCES jobDescription(positionId),
	PRIMARY KEY(locationId, positionId)
);

CREATE TABLE jobTag (
	tagId INT UNSIGNED NOT NULL,
	positionId INT UNSIGNED NOT NULL,
	INDEX(tagId),
	INDEX(positionId),
	FOREIGN KEY(tagId) REFERENCES tag(tagId),
	FOREIGN KEY(positionId) REFERENCES jobDescription(positionId),
	PRIMARY KEY(tagId, positionId)
);