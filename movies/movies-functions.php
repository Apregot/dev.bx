<?php

function printAvailableMovies(array $movies, int $userAge):void
{
	$movieNum = 1;
	foreach ($movies as $movie)
	{
		if($userAge >= $movie["age_restriction"])
		{
			$movieNum++;
			printMessage(formatMovie($movie, $movieNum));
		}
	}
}

function formatMovie($movie, $movieNum):string
{
	return "$movieNum. ${movie["title"]} (${movie["release_year"]}), ${movie["age_restriction"]}+. Rating - ${movie["rating"]}";
}