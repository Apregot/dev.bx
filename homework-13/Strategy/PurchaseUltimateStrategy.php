<?php

namespace Strategy;

use Entity\Service;
use Event\EventBus;

class PurchaseUltimateStrategy implements PurchaseStrategy
{

	public function purchase(): Service
	{
		// take money
		$service = new Service();

		$service->setActivatedUntil((new \DateTime())->modify("+ 720 days"));
		$service->setType(Service::TYPES['ultimate']);
		return $service;
	}
}