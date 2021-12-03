<?php

const MOVIES_QUERY =
'SELECT DISTINCT m.ID     as movieID,
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

function transformStringToAssocArrayByData(string $originalString, array $dataArray, string $dataKey)
{
	$resultArray = explode(',', $originalString);
	foreach ($resultArray as $key => $value)
	{
		$resultArray[$key] = $dataArray[(int)$value][$dataKey];
	}
	return $resultArray;
}

function getActorsFromDatabase(mysqli $database, string $actors): array
{
	$query = "SELECT * FROM actor WHERE ID IN($actors)";
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
			'NAME' => $row['NAME'],
		];
	}
	return $resultArray;
}

function getMovieById(mysqli $database, int $id): array
{
	$query = MOVIES_QUERY;
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
		$actorsNames = getActorsFromDatabase($database, $row['ACTORS']);

		$resultArray = $row;
		$resultArray['ACTORS'] =
			transformStringToAssocArrayByData($row['ACTORS'], $actorsNames, 'NAME');
	}
	return $resultArray;
}

function getMoviesByGenre(mysqli $database, array $genres, string $genre = ''): array
{
	$query = MOVIES_QUERY;
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
			transformStringToAssocArrayByData($resultArray[(int)$row['movieID']]['GENRES'], $genres, 'NAME');
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
	$query = MOVIES_QUERY;
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
			transformStringToAssocArrayByData($resultArray[(int)$row['movieID']]['GENRES'], $genres, 'NAME');
	}
	return $resultArray;
}

function formatMovieImageUrl(
	string $imagePath, int $movieId, string $imageExtension): string
{
	return $imagePath . $movieId . $imageExtension;
}

function formatMovieTitle(string $movieTitle, int $movieReleaseDate): string
{
	return $movieTitle . ' (' . $movieReleaseDate . ')';
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
	return $movieDuration . ' мин./' . date('H:i', mktime(0, $movieDuration));
}

function formatActorsArray(array $movieGenres): string
{
	return implode(', ', $movieGenres);
}



// function formatActors(string $actors, array $actorsNames): array
// {
// 	$actorsArray = explode(',', $actors);
// 	foreach ($actorsArray as $key => $value)
// 	{
// 		$actorsArray[$key] = $actorsNames[(int)$value]['NAME'];
// 	}
// 	return $actorsArray;
// }
//
// function formatGenres(string $movieGenres, array $genres): array
// {
// 	$result = explode(',', $movieGenres);
// 	foreach ($result as $key => $value)
// 	{
// 		$result[$key] = $genres[(int)$value]['NAME'];
// 	}
// 	return $result;
// }