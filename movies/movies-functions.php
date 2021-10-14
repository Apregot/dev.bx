<?php

function printAvailableMovies(array $movies, int $age):void
{
	$num = 1;
	foreach ($movies as $movie)
	{
		if($age >= $movie["age_restriction"])
		{
			printMessage(formatMovie($movie, $num++));
		}
	}
}

function formatMovie($movie, $num):string
{
	return "$num. ${movie["title"]} (${movie["release_year"]}), ${movie["age_restriction"]}+. Rating - ${movie["rating"]}";
}