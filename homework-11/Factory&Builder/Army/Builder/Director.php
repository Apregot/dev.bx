<?php

namespace Army\Builder;

use Army\WarriorTemplate;
use Weapon\Bow;

class Director
{
	public static function build(WarriorBuilder $warriorBuilder): WarriorTemplate
	{
		return $warriorBuilder
			->createWarriorTemplate()
			->addLeftHandArmor()
			->addLeftHandWeapon()
			->addRightHandWeapon()
			->getWarrior()
		;
	}
}