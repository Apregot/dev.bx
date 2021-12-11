<?php

namespace Decorator;

use Service\Wrapper;

class BodyWrapDecorator extends AbstractTextDecorator
{
	public function wrap(): Wrapper
	{
		$this->wrappedText = "<h1>Внимание</h1> " . $this->wrapper->getWrappedText() . " <h4>Ждём вас</h4>";
		return $this;
	}

	public function getWrappedText(): string
	{
		return $this->wrappedText;
	}
}