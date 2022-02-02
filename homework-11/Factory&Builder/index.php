<?php

use Army\Archer;

spl_autoload_register(function ($class)
{
	include __DIR__ . '/' . str_replace("\\", "/", $class) . '.php';
});
//
//$armyA = [];
//$armyB = [];
//
//for ($i = 0; $i < 100; $i++)
//{
//	$armyA[] = rand(0, 1) > 0 ? new \Army\Archer() : new \Army\Horseman();
//	$armyB[] = rand(0, 1) > 0 ? new \Army\Archer() : new \Army\Horseman();
//}
//
$calculatePower = function ($sum, $warrior)
{
	$sum += $warrior->power();
	return $sum;
};
//
//$armyPowerA = array_reduce($armyA, $calculatePower);
//$armyPowerB = array_reduce($armyB, $calculatePower);
//
//echo $armyPowerA, PHP_EOL;
//echo $armyPowerB;
//
//$armyA = [];
//$armyB = [];
//
//$forges = [
//	'archer',
//	'horseman',
//];
//
//for ($i = 0; $i < 100; $i++)
//{
//	$armyA[] = \Army\Helper::getForge($forges[rand(0, 1)])->createWarrior();
//	$armyB[] = \Army\Helper::getForge($forges[rand(0, 1)])->createWarrior();
//}
//$armyPowerA = array_reduce($armyA, $calculatePower);
//$armyPowerB = array_reduce($armyB, $calculatePower);
//
//echo $armyPowerA, PHP_EOL;
//echo $armyPowerB;
//
//$romeFactory = new \Army\Rome\RomeArmyForge();
//var_dump($romeFactory->createArcher());
//var_dump($romeFactory->createHorseman());
//
//$barbarianFactory = new \Army\Barbarian\BarbarianArmyForge();
//var_dump($barbarianFactory->createArcher());
//var_dump($barbarianFactory->createHorseman());

$build = new \Army\Builder\ArcherBuilder();
$armory = new \Weapon\Rome\RomeWeaponFactory();
var_dump(\Army\Builder\Director::build($build));

var_dump($build->addLeftHandWeapon($armory->createBow())->getWarrior());