<?php

function connectDatabase(array $settings): mysqli
{
	$database = mysqli_init();
	$connectionResult = mysqli_real_connect(
		$database,
		$settings['host'],
		$settings['username'],
		$settings['password'],
		$settings['dbName']
	);

	if (!$connectionResult)
	{
		$error = mysqli_connect_errno($database) . ": " . mysqli_connect_error($database);
		trigger_error($error, E_USER_ERROR);
	}

	$result = mysqli_set_charset($database, 'utf8');
	if (!$result)
	{
		trigger_error(mysqli_error($database), E_USER_ERROR);
	}

	return $database;
}