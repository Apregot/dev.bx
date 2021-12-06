<?php
declare(strict_types = 1);
/** @var array $config */
require_once "./config/app.php";
/** @var array $genres */
/** @var array $movies */
require_once "./lib/template-functions.php";
require_once "./lib/movies-functions.php";
require_once "./lib/helper-functions.php";
require_once "./lib/db-connect-functions.php";

$database = connectDatabase($config['db']);
$genres = getGenresFromDatabase($database);

$bitflixPage = renderTemplate("./resources/pages/favourites-content.php", [
	'movies' => $movies,
]);

renderLayout($bitflixPage, [
	'config' => $config,
	'genres' => $genres,
	'currentPage' => getFileName(__FILE__),
]);