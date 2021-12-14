<?php

namespace Helper;

class Subscriber
{
	public static function onUserAdd($data)
	{
		echo $data->getId() . PHP_EOL;
	}
	public static function onUserUpdate($data)
	{
		echo $data->getName() . PHP_EOL;
	}
}