<?php

spl_autoload_register(function ($class) {
	include __DIR__ . '/' . str_replace("\\", "/",  $class) . '.php';
});

$advertisement = (new \Entity\Advertisement())
	->setBody("test")
	->setTitle("test")
	->setDuration(10);

$wrapper = new \Service\AdvWrapper($advertisement);
$wrapper->wrap();

$wrapper = new \Decorator\BodyWrapDecorator($wrapper);
print (PHP_EOL);
$advertisement->setBody($wrapper->wrap()->getWrappedText());
\Service\Helper::runYtAdvertisement($advertisement);