# 1. Вывести список фильмов, в которых снимались одновременно Арнольд Шварценеггер* и Линда Хэмилтон*.
#   Формат: ID фильма, Название на русском языке, Имя режиссёра.
SELECT
	m.ID,
	mt.TITLE,
	d.NAME
FROM movie m
INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID AND mt.LANGUAGE_ID = 'ru'
INNER JOIN movie_actor ma on m.ID = ma.MOVIE_ID
INNER JOIN director d on d.ID = m.DIRECTOR_ID
WHERE ACTOR_ID IN (1,3)
GROUP BY 1, 2, 3
HAVING COUNT(m.ID) = 2;


# 2. Вывести список названий фильмов на англйском языке с "откатом" на русский,
#    в случае если название на английском не задано.
#    Формат: ID фильма, Название.

SELECT
	TITLE,
	MOVIE_ID
from movie_title where LANGUAGE_ID = 'en'
UNION
SELECT
	TITLE,
	MOVIE_ID
FROM movie m
INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID
WHERE NOT EXISTS(SELECT 'x' from movie_title WHERE MOVIE_ID = m.ID and LANGUAGE_ID = 'en');



# 3. Вывести самый длительный фильм Джеймса Кэмерона*.
#  Формат: ID фильма, Название на русском языке, Длительность.
# (Бонус – без использования подзапросов)
SELECT
	m.ID,
	mt.TITLE,
	m.LENGTH
FROM movie m
INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID
WHERE LENGTH = (SELECT MAX(LENGTH) FROM movie m WHERE DIRECTOR_ID = 1 AND mt.LANGUAGE_ID = 'ru' );

# 4. ** Вывести список фильмов с названием, сокращённым до 10 символов.
#   Если название короче 10 символов – оставляем как есть. Если длиннее – сокращаем до 10 символов и добавляем многоточие.
#  Формат: ID фильма, сокращённое название
SELECT
	m.ID,
	mt.TITLE
from movie m
INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID
WHERE (CHAR_LENGTH(mt.TITLE)<=10)
UNION
SELECT
	m.ID,
	CONCAT(RTRIM(SUBSTRING(mt.TITLE,1,10)), '...')
from movie m
		 INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID
where (CHAR_LENGTH(mt.TITLE)>10);



# 5. Вывести количество фильмов, в которых снимался каждый актёр.
#    Формат: Имя актёра, Количество фильмов актёра.
SELECT
	a.NAME,
	COUNT(*)
FROM actor a
INNER JOIN movie_actor ma on a.ID = ma.ACTOR_ID
GROUP BY 1;


# 6. Вывести жанры, в которых никогда не снимался Арнольд Шварценеггер*.
#   Формат: ID жанра, название
SELECT DISTINCT
	g.ID,
	g.NAME
FROM genre g
INNER JOIN movie_genre mg on g.ID = mg.GENRE_ID
WHERE GENRE_ID NOT IN
	(SELECT
		GENRE_ID
	FROM movie_genre mg
	INNER JOIN movie_actor ma on mg.MOVIE_ID = ma.MOVIE_ID
	WHERE ACTOR_ID = 1
	);


# 7. Вывести список фильмов, у которых больше 3-х жанров.
#   Формат: ID фильма, название на русском языке
SELECT
	m.ID,
	mt.TITLE
FROM movie m
INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID
INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
WHERE mt.LANGUAGE_ID = 'ru'
GROUP BY 1, 2
HAVING COUNT(GENRE_ID) > 3;


# 8. Вывести самый популярный жанр для каждого актёра.
#   Формат вывода: Имя актёра, Жанр, в котором у актёра больше всего фильмов.
SELECT genre_count.a_name actor_name, MAX(genre_count.g_name) genre
FROM (SELECT a.NAME a_name, g.NAME g_name, COUNT(*) count
	  FROM genre g
		INNER JOIN movie_genre mg on g.ID = mg.GENRE_ID
		INNER JOIN movie_actor ma on mg.MOVIE_ID = ma.MOVIE_ID
		INNER JOIN actor a on ma.ACTOR_ID = a.ID
	  GROUP BY 1, 2) genre_count
		 INNER JOIN (SELECT a_name, MAX(count) max
					 FROM (SELECT a.NAME a_name, g.NAME g_name, COUNT(*) count
						   FROM genre g
								INNER JOIN movie_genre mg on g.ID = mg.GENRE_ID
								INNER JOIN movie_actor ma on mg.MOVIE_ID = ma.MOVIE_ID
								INNER JOIN actor a on ma.ACTOR_ID = a.ID
						   GROUP BY 1, 2) count
					 GROUP BY 1) max on max.a_name = genre_count.a_name
WHERE max.max = genre_count.count
GROUP BY 1