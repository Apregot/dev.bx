<?php

namespace Weapon\Barbarian;
use Weapon\AbstractWeaponFactory;
use Weapon\Bow;
use Weapon\Knife;

class BarbarianWeaponFactory extends \Weapon\AbstractWeaponFactory
{

	public function createBow(): \Weapon\Bow
	{
		return new BarbarianBow();
	}

	public function createKnife(): \Weapon\Knife
	{
		return new BarbarianKnife();
	}
}