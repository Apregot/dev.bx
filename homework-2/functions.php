<?php

function inputAge():int
{
	while(true)
	{
		$input = readline("Input your age: ");
		if(is_numeric($input) && $input >=0)
		{
			break;
		}
		printMessage("Wrong age.");
	}
	return (int)$input;
}

function printMessage(string $message):void
{
	echo $message."\n";
}