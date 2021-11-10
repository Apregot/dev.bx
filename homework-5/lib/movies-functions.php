<?php

function formatMovieImageUrl(
	string $imagePath, int $movieId, string $imageExtenion): string
{
	return $imagePath . (string)$movieId . $imageExtenion;
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

function getMoviesByName(array $movies, string $searchRequest): array
{
	return array_filter($movies, function ($movie) use ($searchRequest) {
		return (stripos(mb_strtolower($movie['title']), mb_strtolower(rawurldecode($searchRequest)))) !== false
			|| (stripos(mb_strtolower($movie['original-title']), mb_strtolower(rawurldecode($searchRequest))))
			!== false;
	});
}

function getMoviesByGenre(array $movies, string $genreFilter): array
{
	return array_filter($movies, function ($movie) use ($genreFilter) {
		return in_array($genreFilter, $movie['genres'], true);
	});
}