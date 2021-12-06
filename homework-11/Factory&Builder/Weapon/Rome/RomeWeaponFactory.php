<?php

namespace Weapon\Rome;
use Weapon\AbstractWeaponFactory;
use Weapon\Bow;
use Weapon\Knife;

class RomeWeaponFactory extends AbstractWeaponFactory
{
	public function createBow(): Bow
	{
		return new RomeBow();
	}

	public function createKnife(): Knife
	{
		return new RomeKnife();
	}
}