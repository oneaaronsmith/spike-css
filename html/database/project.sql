DROP TABLE IF EXISTS Genes;
DROP TABLE IF EXISTS Authentication;

CREATE TABLE Authentication (
	username VARCHAR(30) NOT NULL,
	first_name VARCHAR(30),
	last_name VARCHAR(30),
	password VARCHAR(150),
	PRIMARY KEY(username)
);

INSERT INTO Authentication VALUES ('test','Aaron','Smith','pass');

CREATE TABLE Genes (
	username VARCHAR(30),
	reference VARCHAR(20),
	protein VARCHAR(50),
	organism VARCHAR(20),
	taxonomy VARCHAR(30),
	summary TEXT,
	PRIMARY KEY(username,reference),
	FOREIGN KEY (username) REFERENCES Authentication (username)
);

INSERT INTO Genes VALUES ('test','TNF','tumor necrosis factor','human','homo sapien','This gene encodes a multifunctional proinflammatory cytokine that belongs to the tumor necrosis factor (TNF) superfamily.');

