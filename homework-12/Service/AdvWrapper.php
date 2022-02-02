<?php

namespace Service;

use Entity\Advertisement;

class AdvWrapper implements Wrapper
{

	private $wrappedText;
	private $advertisement;

	/**
	 * @param Advertisement $advertisement
	 */
	public function __construct(Advertisement $advertisement)
	{
		$this->advertisement = $advertisement;
	}

	public function wrap(): Wrapper
	{
		$this->wrappedText = $this->advertisement->getBody();

		return $this;
	}

	public function getWrappedText(): string
	{
		return $this->wrappedText;
	}
}