<?php

namespace Weapon;

abstract class AbstractWeaponFactory
{
	abstract public function createBow(): Bow;
	abstract public function createKnife(): Knife;
}