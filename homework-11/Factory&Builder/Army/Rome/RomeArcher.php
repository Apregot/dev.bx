<?php

namespace Army\Rome;

use Army\Archer;

class RomeArcher extends Archer
{
	public function power(): int
	{
		return parent::power() + 2;
	}
}