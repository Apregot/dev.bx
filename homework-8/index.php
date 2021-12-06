<?php
declare(strict_types = 1);
/** @var array $config */
require_once "./config/app.php";
require_once "./lib/template-functions.php";
require_once "./lib/movies-functions.php";
require_once "./lib/helper-functions.php";
require_once "./lib/db-connect-functions.php";


$database = connectDatabase($config['db']);
$genres = getGenresFromDatabase($database);
$movies = [];

$currentPage = getFileName(__FILE__);

if (isset($_GET['search']) && $_GET['search'] !== "")
{
	$movies = getMoviesByName($database, $genres, $_GET['search']);
}
else if (isset($_GET['genre']) && in_array($_GET['genre'], array_column($genres, 'CODE'), true))
{
	$movies = getMoviesByGenre($database, $genres, $_GET['genre']);
	$currentPage = $_GET['genre'];
}
else
{
	$movies = getMoviesByGenre($database, $genres);
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