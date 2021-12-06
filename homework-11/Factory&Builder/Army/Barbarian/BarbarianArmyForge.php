<?php

namespace Army\Barbarian;

use Army\AbstractForge;
use Army\Archer;
use Army\Horseman;
class BarbarianArmyForge extends AbstractForge
{

	public function createArcher(): Archer
	{
		return new BarbarianArcher();
	}

	public function createHorseman(): Horseman
	{
		return new BarbarianHorseman();
	}
}