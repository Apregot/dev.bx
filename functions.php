<?php

function inputAge():int
{
	while(true)
	{
		$input = readline("Input your age: ");
		if(is_numeric($input))
			break;
		printMessage("Wrong age.");
	}
	return $input;
}

function printMessage(string $message):void
{
	echo $message."\n";
}