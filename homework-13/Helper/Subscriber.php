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
	public static function onServicePurchase($service)
	{
		$log = date("F j, Y, g:i a") . " || Purchased subscription: " . $service->getTypeName();
		file_put_contents('log.txt', $log . PHP_EOL, FILE_APPEND);
	}
}