<?php
/** @var array $movies */
require "./movies/movies.php";
require "./movies/movies-functions.php";
require "functions.php";

$age = inputAge();
printAvailableMovies($movies, $age);