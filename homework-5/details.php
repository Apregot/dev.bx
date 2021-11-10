<?php
declare(strict_types = 1);
/** @var array $config */
require_once "./config/app.php";
/** @var array $genres */
/** @var array $movies */
/** @var array $movie */
require_once "./data/movies.php";
require_once "./lib/template-functions.php";
require_once "./lib/movies-functions.php";
require_once "./lib/helper-functions.php";

$bitflixPage = "";

if (isset($_GET['id']) && in_array((int)$_GET['id'], range(1, count($movies)), true))
{
	$movie = $movies[(int)$_GET['id'] - 1];

	$bitflixPage = renderTemplate("./resources/pages/details-content.php", [
		'movie' => $movie,
	]);
}
else
{
	$bitflixPage = renderTemplate("./resources/pages/film-not-found.php");
}

renderLayout($bitflixPage, [
	'config' => $config,
	'genres' => $genres,
	'currentPage' => $currentPage = getFileName(__FILE__),
]);