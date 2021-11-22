<?php
declare(strict_types = 1);
/** @var array $config */
require_once "./config/app.php";
/** @var array $genres */
/** @var array $movies */
require_once "./data/movies.php";
require_once "./lib/template-functions.php";
require_once "./lib/movies-functions.php";
require_once "./lib/helper-functions.php";

$currentPage = getFileName(__FILE__);
if (isset($_GET['genre']) && in_array($genres[$_GET['genre']], $genres, true))
{
	$movies = getMoviesByGenre($movies, $genres[$_GET['genre']]);
	$currentPage = $_GET['genre'];
}
if (isset($_GET['search']) && $_GET['search'] !== "")
{
	$movies = getMoviesByName($movies, $_GET['search']);
}

$bitflixPage = "";

if (!empty($movies))
{
	$bitflixPage = renderTemplate("./resources/pages/main-content.php", [
		'movies' => $movies,
		'config' => $config,
	]);
}
else
{
	$bitflixPage = renderTemplate("./resources/pages/film-not-found.php");
}

renderLayout($bitflixPage, [
	'config' => $config,
	'genres' => $genres,
	'currentPage' => $currentPage,
]);