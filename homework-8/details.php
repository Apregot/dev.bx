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

$bitflixPage = "";

$movie = [];

if (isset($_GET['id']))
{
	$movie = getMovieById($database, (int)$_GET['id']);
}

if(!empty($movie))
{
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