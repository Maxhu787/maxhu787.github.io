Starting Mysql with MAMP (Macintosh):

/Applications/MAMP/Library/bin/mysql -u root -p  (enter root when prompted)

Starting MySql with XAMPP (Windows):

c:\xampp\mysql\bin\mysql.exe -u root -p

Starting MySQL in linux:

mysql -u root -p

CREATE DATABASE People DEFAULT CHARACTER SET utf8;

 USE People; (Command line only)

CREATE TABLE Users (
  name VARCHAR(128), 
  email VARCHAR(128)
);

DESCRIBE Users;

INSERT INTO Users (name, email) VALUES ('Chuck', 'csev@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Sally', 'sally@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Somesh', 'somesh@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Caitlin', 'cait@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Ted', 'ted@umich.edu') ;

DELETE FROM Users WHERE email='ted@umich.edu';

UPDATE Users SET name='Charles' WHERE email='csev@umich.edu';

SELECT * FROM Users;

SELECT * FROM Users WHERE email='csev@umich.edu';

SELECT * FROM Users ORDER BY email;

SELECT * FROM Users WHERE name LIKE '%e%';

SELECT * FROM Users ORDER BY email DESC LIMIT 2;

SELECT * FROM Users ORDER BY email LIMIT 1,2;

CREATE TABLE Users (
  user_id INT UNSIGNED NOT NULL AUTO_INCREMENT, 
  name VARCHAR(128), 
  email VARCHAR(128),
  PRIMARY KEY(user_id),
  INDEX ( name )
);

To add the index after the table was created:

ALTER TABLE Users ADD INDEX ( name );

INSERT INTO Users (name, email) VALUES ('Chuck', 'csev@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Sally', 'sally@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Somesh', 'somesh@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Caitlin', 'cait@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Ted', 'ted@umich.edu') ;

/*_______________________________________________________________________________*/

CREATE TABLE Ages ( 
  name VARCHAR(128), 
  age INTEGER
)

DELETE FROM Ages;
INSERT INTO Ages (name, age) VALUES ('Ada', 38);
INSERT INTO Ages (name, age) VALUES ('Richey', 39);
INSERT INTO Ages (name, age) VALUES ('Issiaka', 24);
INSERT INTO Ages (name, age) VALUES ('Jayse', 16);
INSERT INTO Ages (name, age) VALUES ('Marla', 23);
INSERT INTO Ages (name, age) VALUES ('Meron', 22);

SELECT sha1(CONCAT(name,age)) AS X FROM Ages ORDER BY X

/*____________________________________________________________________________________________*/
CREATE DATABASE Music DEFAULT CHARACTER SET utf8;

USE Music;  (Command line only)

CREATE TABLE Artist (
  artist_id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY(artist_id)
) ENGINE = InnoDB;

CREATE TABLE Album (
  album_id INTEGER NOT NULL AUTO_INCREMENT,
  title VARCHAR(255),
  artist_id INTEGER,

  PRIMARY KEY(album_id),
  INDEX USING BTREE (title),

  CONSTRAINT FOREIGN KEY (artist_id)
    REFERENCES Artist (artist_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE Genre (
  genre_id INTEGER NOT NULL AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY(genre_id)
) ENGINE = InnoDB;

CREATE TABLE Track (
  track_id INTEGER NOT NULL AUTO_INCREMENT,
  title VARCHAR(255),
  len INTEGER,
  rating INTEGER,
  count INTEGER,
  album_id INTEGER,
  genre_id INTEGER,

  PRIMARY KEY(track_id),
  INDEX USING BTREE (title),

  CONSTRAINT FOREIGN KEY (album_id) REFERENCES Album (album_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (genre_id) REFERENCES Genre (genre_id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;


INSERT INTO Artist (name) VALUES ('Led Zepplin');
INSERT INTO Artist (name) VALUES ('AC/DC');

INSERT INTO Genre (name) VALUES ('Rock');
INSERT INTO Genre (name) VALUES ('Metal');

INSERT INTO Album (title, artist_id) VALUES ('Who Made Who', 2);
INSERT INTO Album (title, artist_id) VALUES ('IV', 1);

INSERT INTO Track (title, rating, len, count, album_id, genre_id)
    VALUES ('Black Dog', 5, 297, 0, 2, 1);
INSERT INTO Track (title, rating, len, count, album_id, genre_id)
    VALUES ('Stairway', 5, 482, 0, 2, 1);
INSERT INTO Track (title, rating, len, count, album_id, genre_id)
    VALUES ('About to Rock', 5, 313, 0, 1, 2);
INSERT INTO Track (title, rating, len, count, album_id, genre_id)
    VALUES ('Who Made Who', 5, 207, 0, 1, 2);

SELECT Album.title, Artist.name FROM Album JOIN Artist ON
    Album.artist_id = Artist.artist_id

SELECT Album.title, Album.artist_id, Artist.artist_id, Artist.name 
    FROM Album JOIN Artist ON Album.artist_id = Artist.artist_id

SELECT Track.title, Track.genre_id, Genre.genre_id, Genre.name 
    FROM Track JOIN Genre

SELECT Track.title, Genre.name FROM Track JOIN Genre ON 
    Track.genre_id = Genre.genre_id;

SELECT Track.title, Artist.name, Album.title, Genre.name 
    FROM Track JOIN Genre JOIN Album JOIN Artist 
    ON Track.genre_id = Genre.genre_id AND Track.album_id = 
    Album.album_id AND Album.artist_id = Artist.artist_id

DELETE FROM Genre WHERE name = 'Metal'

DROP TABLE Track; DROP TABLE Album; DROP TABLE Genre; DROP TABLE Artist;

Fresh Database...

CREATE DATABASE Learning DEFAULT CHARACTER SET utf8 ;

USE Learning;   (Command line only)

CREATE TABLE Account (
    account_id  INTEGER NOT NULL AUTO_INCREMENT,
    email       VARCHAR(128) UNIQUE,
    name        VARCHAR(128),
    PRIMARY KEY(account_id)
) ENGINE=InnoDB CHARACTER SET=utf8;

CREATE TABLE Course (
    course_id     INTEGER NOT NULL AUTO_INCREMENT,
    title         VARCHAR(128) UNIQUE,
    PRIMARY KEY(course_id)
) ENGINE=InnoDB CHARACTER SET=utf8;

CREATE TABLE Member (
    account_id    INTEGER,
    course_id     INTEGER,
    role          INTEGER,

    CONSTRAINT FOREIGN KEY (account_id) REFERENCES Account (account_id)
      ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course (course_id)
       ON DELETE CASCADE ON UPDATE CASCADE,

    PRIMARY KEY (account_id, course_id)
) ENGINE=InnoDB CHARACTER SET=utf8;

INSERT INTO Account (name, email) VALUES ('Jane', 'jane@tsugi.org');
INSERT INTO Account (name, email) VALUES ('Ed', 'ed@tsugi.org');
INSERT INTO Account (name, email) VALUES ('Sue', 'sue@tsugi.org');

INSERT INTO Course (title) VALUES ('Python');
INSERT INTO Course (title) VALUES ('SQL');
INSERT INTO Course (title) VALUES ('PHP');

INSERT INTO Member (account_id, course_id, role) VALUES (1, 1, 1);
INSERT INTO Member (account_id, course_id, role) VALUES (2, 1, 0);
INSERT INTO Member (account_id, course_id, role) VALUES (3, 1, 0);

INSERT INTO Member (account_id, course_id, role) VALUES (1, 2, 0);
INSERT INTO Member (account_id, course_id, role) VALUES (2, 2, 1);

INSERT INTO Member (account_id, course_id, role) VALUES (2, 3, 1);
INSERT INTO Member (account_id, course_id, role) VALUES (3, 3, 0);

SELECT Account.name, Member.role, Course.title
  FROM Account JOIN Member JOIN Course
  ON Member.account_id = Account.account_id
    AND Member.course_id = Course.course_id
  ORDER BY Course.title, Member.role DESC, Account.name


