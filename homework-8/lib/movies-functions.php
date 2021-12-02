<?php

function getMoviesQuery(): string
{
	return 'SELECT DISTINCT m.ID     as movieID,
       TITLE,
       ORIGINAL_TITLE,
       DESCRIPTION,
       DURATION,
       AGE_RESTRICTION,
       RELEASE_DATE,
       RATING,
       d.NAME                       as DIRECTOR,
       (SELECT GROUP_CONCAT(GENRE_ID)
        FROM movie_genre
        where movieID = MOVIE_ID) as GENRES,
       (SELECT GROUP_CONCAT(ACTOR_ID)
        FROM movie_actor
        where movieID = MOVIE_ID) as ACTORS
FROM movie m
         INNER JOIN director d on m.DIRECTOR_ID = d.ID';
}

function formatActors(array $actorsArray, array $actorsNames): array
{
	foreach ($actorsArray as $key => $value)
	{
		$actorsArray[$key] = $actorsNames[(int)$value]['NAME'];
	}
	return $actorsArray;
}

function getMovieById(mysqli $database, int $id): array
{
	$query = getMoviesQuery();
	$query .= " WHERE m.ID = '$id'";

	$result = mysqli_query($database, $query);
	if (!$result)
	{
		$error = mysqli_errno($database) . ": " . mysqli_error($database);
		trigger_error($error, E_USER_ERROR);
	}
	$resultArray = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		$actorsArray = explode(',', $row['ACTORS']);
		$actorsNames = getActorsFromDatabase($database, $actorsArray);

		$resultArray = $row;
		$resultArray['ACTORS'] =
			formatActors($actorsArray, $actorsNames);
	}
	return $resultArray;
}

function formatGenres(string $movieGenres, array $genres): array
{
	$result = explode(',', $movieGenres);
	foreach ($result as $key => $value)
	{
		$result[$key] = $genres[(int)$value]['NAME'];
	}
	return $result;
}

function getMoviesByGenre(mysqli $database, array $genres, string $genre = ''): array
{
	$query = getMoviesQuery();
	$genre = mysqli_real_escape_string($database, $genre);
	if ($genre !== '')
	{
		$query .= " LEFT JOIN movie_genre mg on m.ID = mg.MOVIE_ID
                   INNER JOIN genre g on g.ID = mg.GENRE_ID
		           WHERE g.CODE = '$genre'";
	}

	$result = mysqli_query($database, $query);
	if (!$result)
	{
		$error = mysqli_errno($database) . ": " . mysqli_error($database);
		trigger_error($error, E_USER_ERROR);
	}

	$resultArray = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		$resultArray[(int)$row['movieID']] = $row;
		$resultArray[(int)$row['movieID']]['GENRES'] =
			formatGenres($resultArray[(int)$row['movieID']]['GENRES'], $genres);
	}
	return $resultArray;
}

function getActorsFromDatabase(mysqli $database, array $actors): array
{
	$query = 'SELECT * FROM actor';
	$result = mysqli_query($database, $query);
	if (!$result)
	{
		$error = mysqli_errno($database) . ": " . mysqli_error($database);
		trigger_error($error, E_USER_ERROR);
	}

	$resultArray = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		if (in_array($row['ID'], $actors, true))
		{
			$resultArray[(int)$row['ID']] = [
				'NAME' => $row['NAME'],
			];
		}
	}
	return $resultArray;
}

function getGenresFromDatabase(mysqli $database): array
{
	$query = 'SELECT * FROM genre';
	$result = mysqli_query($database, $query);
	if (!$result)
	{
		$error = mysqli_errno($database) . ": " . mysqli_error($database);
		trigger_error($error, E_USER_ERROR);
	}

	$resultArray = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		$resultArray[(int)$row['ID']] = [
			'CODE' => $row['CODE'],
			'NAME' => $row['NAME'],
		];
	}
	return $resultArray;
}

function getMoviesByName(mysqli $database, array $genres, string $searchRequest): array
{
	$query = getMoviesQuery();
	$searchRequest = mysqli_real_escape_string($database, $searchRequest);
	$query .= " WHERE m.TITLE LIKE '%$searchRequest%' 
				OR m.ORIGINAL_TITLE LIKE '%$searchRequest%'";

	$result = mysqli_query($database, $query);
	if (!$result)
	{
		$error = mysqli_errno($database) . ": " . mysqli_error($database);
		trigger_error($error, E_USER_ERROR);
	}

	$resultArray = [];
	while ($row = mysqli_fetch_assoc($result))
	{
		$resultArray[(int)$row['movieID']] = $row;
		$resultArray[(int)$row['movieID']]['GENRES'] =
			formatGenres($resultArray[(int)$row['movieID']]['GENRES'], $genres);
	}
	return $resultArray;
}

function formatMovieImageUrl(
	string $imagePath, int $movieId, string $imageExtension): string
{
	return $imagePath . (string)$movieId . $imageExtension;
}

function formatMovieTitle(string $movieTitle, int $movieReleaseDate): string
{
	return $movieTitle . ' (' . (string)$movieReleaseDate . ')';
}

function formatMovieDescription(string $movieTitle, string $movieDescription): string
{
	$descriptionLength = 180;
	if (mb_strlen($movieTitle) >= 20)
	{
		$descriptionLength = 120;
	}

	if (mb_strlen($movieDescription) >= mb_strlen($descriptionLength))
	{
		$result = mb_substr($movieDescription, 0, $descriptionLength);
		return trim(mb_substr($result, 0, mb_strrpos($result, " "))) . '...';
	}
	return $movieDescription;
}

function formatMovieTime(int $movieDuration): string
{
	return (string)$movieDuration . ' мин./' . date('H:i', mktime(0, $movieDuration));
}

function formatArray(array $movieGenres): string
{
	return implode(', ', $movieGenres);
}