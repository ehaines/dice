DROP TABLE IF EXISTS employer;
DROP TABLE IF EXISTS jobDescription;
DROP TABLE IF EXISTS location;
DROP TABLE IF EXISTS jobLocation;
DROP TABLE IF EXISTS tag;
DROP TABLE IF EXISTS jobTag;

CREATE TABLE employer (
	diceID VARCHAR(12),
	logo TEXT,
	website TEXT,
	PRIMARY KEY (diceID)
);

CREATE TABLE jobDescription (
	positionID INT UNSIGNED NOT NULL,
	travelRequired BOOLEAN,
	salary INT UNSIGNED,
	dateTimePosted DATETIME,
	text TEXT,
	hours VARCHAR(12)
);

CREATE TABLE location (
	locationID INT UNSIGNED NOT NULL
);
