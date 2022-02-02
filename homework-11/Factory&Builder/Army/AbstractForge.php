<?php

namespace Army;

abstract class AbstractForge
{
	abstract public function createArcher(): Archer;
	abstract public function createHorseman(): Horseman;
}