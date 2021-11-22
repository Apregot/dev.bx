<?php
function getFileName($path): string
{
	return basename($path, ".php");
}