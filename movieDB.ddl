# CISC 332 Project
# Group 50

# Chris Gray 10185372 14cmg5
# Alex Huctwith 10138307 13aah12
# Ashley Drouillard 10183354 14aad4

# Delete old database
 Drop database moviedb;
# Build Tables
create database moviedb;
CREATE TABLE Complex
(
	CName			VARCHAR(30)	NOT NULL,
	PhoneNumber		VARCHAR(10)	NOT NULL,
	Street			VARCHAR(20) NOT NULL,
	City			VARCHAR(20) NOT NULL,
	PostalCode		VARCHAR(6)  NOT NULL,		
	PRIMARY KEY(CName)
);

CREATE TABLE Theatre
(
	TheatreNum  	INTEGER NOT NULL,
	Complex 		VARCHAR(30) NOT NULL,
	ScreenSize  	CHAR(1) NOT NULL,
	MaxSeats    	INTEGER NOT NULL,
	PRIMARY KEY(TheatreNum,Complex),
	FOREIGN KEY(Complex) REFERENCES Complex(CName)
);

CREATE TABLE Supplier
(
	Name 			VARCHAR(20) NOT NULL,
	Street 			VARCHAR(20),
	City			VARCHAR(20),
	PostalCode		VARCHAR(6),
	ContactFname	VARCHAR(20),
	ContactLname	VARCHAR(20),
	PhoneNumber 	VARCHAR(10),
	PRIMARY KEY(Name)
);

CREATE TABLE Movie
(
	Title			VARCHAR(35)	NOT NULL,
	RunTime			INTEGER 	NOT NULL,
	Plot			VARCHAR(1000) NOT NULL,
	Supplier 		VARCHAR(20) NOT NULL,
	Production		VARCHAR(20) NOT NULL,
	Rating			VARCHAR(5) NOT NULL,
	PRIMARY KEY(Title),
	FOREIGN KEY(Supplier) REFERENCES Supplier(Name)
);

CREATE TABLE Actors
(
	Title			VARCHAR(35) NOT NULL,
	Fname			VARCHAR(20) NOT NULL,
	Lname			VARCHAR(20) NOT NULL,
	PRIMARY KEY(Title,Fname,Lname),
	FOREIGN KEY(Title) REFERENCES Movie(Title)
);

CREATE TABLE Directors
(
	Title			VARCHAR(35) NOT NULL,
	Fname			VARCHAR(20) NOT NULL,
	Lname			VARCHAR(20) NOT NULL,
	PRIMARY KEY(Title,Fname,Lname),
	FOREIGN KEY(Title) REFERENCES Movie(Title)
);

CREATE TABLE Showing
(
	Complex 		VARCHAR(30) NOT NULL,
	Theatre 		INTEGER NOT NULL,
	StartTime		VARCHAR(5) NOT NULL,
	Day				date NOT NULL,
	NumSeats		INTEGER NOT NULL,
	Movie  			VARCHAR(35) NOT NULL,
	PRIMARY KEY(Complex,Theatre,StartTime,Day),
	FOREIGN KEY(Movie) REFERENCES Movie(Title),
	FOREIGN KEY(Complex) REFERENCES Complex(CName),
	FOREIGN KEY(Theatre) REFERENCES Theatre(TheatreNum)
);

CREATE TABLE Runs
(
	Movie 			VARCHAR(35) NOT NULL,
	Complex 		VARCHAR(30) NOT NULL,
	StartDate 		date NOT NULL,
	EndDate 		date NOT NULL,
	PRIMARY KEY(Movie,Complex),
	FOREIGN KEY(Movie) REFERENCES Movie(Title),
	FOREIGN KEY(Complex) REFERENCES Complex(CName)
);

CREATE TABLE Customer
(
	AccountNumber	INTEGER NOT NULL,
	Password		VARCHAR(20) NOT NULL,
	Fname 			VARCHAR(20) NOT NULL,
	Lname 			VARCHAR(20) NOT NULL,
	PhoneNumber		VARCHAR(10),
	Email			VARCHAR(30),
	CreditCardNum	VARCHAR(12),
	CreditCardExp	date,
	isAdmin			BOOLEAN,
	PRIMARY KEY(AccountNumber)
);

CREATE TABLE Review
(
	AccountNumber	INTEGER NOT NULL,
	Movie 		  	VARCHAR(35) NOT NULL,
	Review		  	INTEGER NOT NULL,
	PRIMARY KEY(AccountNumber,Movie),
	FOREIGN KEy(AccountNumber) REFERENCES Customer(AccountNumber),
	FOREIGN KEY(Movie) REFERENCES Movie(Title)
);

CREATE TABLE Reservation
(
	AccountNumber	INTEGER NOT NULL,
	Complex 		VARCHAR(30) NOT NULL,
	Theatre 		INTEGER NOT NULL,
	StartTime		VARCHAR(5) NOT NULL,
	Day				date NOT NULL,
	NumTickets		INTEGER	NOT NULL,
	PRIMARY KEY(AccountNumber, Complex, Theatre, StartTime, Day),
	FOREIGN KEY(AccountNumber) REFERENCES Customer(AccountNumber),
	FOREIGN KEY(Complex,Theatre,StartTime,Day) REFERENCES Showing(Complex,Theatre,StartTime,Day)
);

# Insert Data

Insert into Complex values
("Odeplex Cineon","6135551829","14 Doggo Drive","Kingston","K3Z5L4"),
("Mandlark Cinemas","6135553145","72 Birb Boulevard","Kingston","K8M5N8"),
("The Reening Scroom","6135551234","45 Snek Street","Kingston","T6U8O8");

Insert into Supplier values
("Movies R Us",NULL,NULL,NULL,NULL,NULL,NULL),
("Whole Lotta Movies",NULL,NULL,NULL,NULL,NULL,NULL),
("Okay Movies","18 Hollywood Ave","Hollywood", "H1HK26", "George","Brown","9051236565");

Insert into Movie values
("Tammy and the T-Rex",88,
"A teen (Denise Richards) learns that a scientist (Terry Kiser) implanted her dead boyfriend's brain into an animatronic dinosaur.",
"Movies R Us","Greenline Productions","R"),

("Shrek Forever After",83,
"Long-settled into married life and fully domesticated, Shrek (Mike Myers) begins to long for the days when he felt like a real ogre. Duped into signing a contract with devious Rumpelstiltskin, he finds himself in an alternate version of Far Far Away, where ogres are hunted",
"Okay Movies","DreamWorks Animations","G"),

("Monty Python and the Holy Grail",91,
"King Arthur and his knights embark on a low-budget search for the Grail, encountering many, very silly obstacles.",
"Movies R Us","Python (Monty) Pictures","PG");

Insert into Runs values
("Tammy and the T-Rex", "Odeplex Cineon", 1998-11-18, 1999-01-28),
("Tammy and the T-Rex", "Mandlark Cinemas", 1998-11-18, 1999-02-09),
("Tammy and the T-Rex", "The Reening Scroom", 1998-11-18, 1999-02-12),

("Shrek Forever After", "Odeplex Cineon", 2010-08-18, 2010-11-30),
("Shrek Forever After", "Mandlark Cinemas", 2010-08-18, 2010-11-28),
("Shrek Forever After", "The Reening Scroom", 2010-08-18, 2010-11-25),

("Monty Python and the Holy Grail", "Odeplex Cineon", 1975-06-10, 1975-09-10),
("Monty Python and the Holy Grail", "Mandlark Cinemas", 1975-06-10, 1975-09-18),
("Monty Python and the Holy Grail", "The Reening Scroom", 1975-06-10, 1975-09-15);


Insert into Theatre values
(1, "Odeplex Cineon", "S", 30),
(2, "Odeplex Cineon", "M", 40),
(3, "Odeplex Cineon", "L", 50),
(1, "Mandlark Cinemas", "S", 30),
(2, "Mandlark Cinemas", "M", 40),
(3, "Mandlark Cinemas", "L", 50),
(1, "The Reening Scroom", "S", 30),
(2, "The Reening Scroom", "M", 40),
(3, "The Reening Scroom", "L", 50);


Insert into Showing values
("Odeplex Cineon", 1, "5:00pm", 1998-11-18, 28, "Tammy and the T-Rex"),
("Mandlark Cinemas", 1, "5:30pm", 1998-11-18, 28, "Tammy and the T-Rex"),
("The Reening Scroom", 1, "6:00pm", 1998-11-18, 28, "Tammy and the T-Rex"),

("Odeplex Cineon", 2, "7:00pm", 1975-06-10, 40, "Monty Python and the Holy Grail"),
("Mandlark Cinemas", 2, "8:30pm", 1975-06-10, 40, "Monty Python and the Holy Grail"),
("The Reening Scroom", 2, "5:00pm", 1975-06-10, 40, "Monty Python and the Holy Grail"),

("Odeplex Cineon", 3, "12:00pm", 2010-08-18, 50, "Shrek Forever After"),
("Mandlark Cinemas", 3, "3:30pm", 2010-08-18, 50, "Shrek Forever After"),
("The Reening Scroom", 3, "4:00pm", 2010-08-18, 50, "Shrek Forever After");

Insert into Actors values
("Tammy and the T-Rex","Denise","Richards"),
("Tammy and the T-Rex","Theo", "Forsett"),
("Tammy and the T-Rex","Paul","Walker"),

("Monty Python and the Holy Grail","Graham", "Chapman"),
("Monty Python and the Holy Grail","John", "Cleese"),
("Monty Python and the Holy Grail","Eric", "Idle"),
("Monty Python and the Holy Grail","Terry", "Gilliam"),
("Monty Python and the Holy Grail","Terry", "Jones"),
("Monty Python and the Holy Grail","Michael", "Palin"),

("Shrek Forever After","Mike","Myers"),
("Shrek Forever After","Eddie","Murphy"),
("Shrek Forever After","Cameron","Diaz"),
("Shrek Forever After","Antonio","Banderas");

Insert into Directors values
("Tammy and the T-Rex","Stewart","Raffill"),

("Monty Python and the Holy Grail","Terry", "Gilliam"),
("Monty Python and the Holy Grail","Terry", "Jones"),

("Shrek Forever After","Mike","Mitchell");


Insert into Customer values
(10183354, "123abc", "Ashley", "Drouillard", "1234567890", "ashley@email.com", "1234 5677 8900 1234", 2020-08-18,true);

Insert into Review values
(10183354, "Shrek Forever After", 8);

Insert into Reservation values
(10183354, "Mandlark Cinemas", 3, "3:30pm", 2010-08-18, 2);

