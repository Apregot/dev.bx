CREATE TABLE language
(
	ID varchar(2) not null,
	NAME varchar(32) not null,

	PRIMARY KEY (ID)
);

CREATE TABLE movie_title
(
	MOVIE_ID int not null,
	LANGUAGE_ID varchar(2) not null,
	TITLE varchar(500) not null,

	FOREIGN KEY FK_MT_MOVIE (MOVIE_ID)
		REFERENCES movie(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_MT_LANGUAGE (LANGUAGE_ID)
		REFERENCES language(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

INSERT INTO language (ID, NAME)
VALUES ('ru', 'Русский'),
	   ('en', 'English'),
	   ('de', 'Deutsch'),
	   ('es', 'Español');

INSERT INTO movie_title (MOVIE_ID, LANGUAGE_ID, TITLE)
SELECT movie.ID, language.ID, TITLE
FROM movie, language
WHERE language.ID='ru';

ALTER TABLE movie DROP TITLE;