<?php

namespace Decorator;

use Service\Wrapper;

abstract class AbstractTextDecorator implements Wrapper
{
	protected $wrapper;
	protected $wrappedText;

	/**
	 * @param Wrapper $wrapper
	 */
	public function __construct(Wrapper $wrapper)
	{
		$this->wrapper = $wrapper;
	}
}