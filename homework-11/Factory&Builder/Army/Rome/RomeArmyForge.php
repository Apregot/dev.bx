<?php

namespace Army\Rome;

use Army\AbstractForge;
use Army\Archer;
use Army\Horseman;
class RomeArmyForge extends AbstractForge
{

	public function createArcher(): Archer
	{
		return new RomeArcher();
	}

	public function createHorseman(): Horseman
	{
		return new RomeHorseman();
	}
}