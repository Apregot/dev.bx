<?php

use Entity\Service;
use Entity\User;

spl_autoload_register(function ($class) {
	include __DIR__ . '/' . str_replace("\\", "/",  $class) . '.php';
});

\Event\EventBus::getInstance()->subscribe("onServicePurchase", "\\Helper\\Subscriber::onServicePurchase");
//\Event\EventBus::getInstance()->subscribe("onUserUpdate", "\\Helper\\Subscriber::onUserUpdate");
//
//
//$user = new User();
//$user
//	->setId(1)
//	->setName('Ivan')
//	->add()
//	->update()
//;

//$service = new Service();
//$context = new \State\ServiceStateContext(new \State\ActiveState($service));
//
//var_dump($context);
//var_dump($context->changeState());
//var_dump($context->changeState());

//function purchasePremiumLite()
//{
	var_dump(\Strategy\PurchaseServiceContext::purchase(new \Strategy\PurchaseUltimateStrategy()));
//}

//function purchasePremium($type)
//{
	//var_dump(\Strategy\PurchaseServiceContext::purchase(new \Strategy\PurchasePremiumStrategy()));
//}