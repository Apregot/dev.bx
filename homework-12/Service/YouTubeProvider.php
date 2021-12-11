<?php

namespace Service;

use Adapter\YouTubeAdvertisementProviderAdapter;
use Entity\Advertisement;
use Entity\AdvertisementResponse;

class YouTubeProvider extends AbstractAdvertisementProvider
{
	public function publicate(Advertisement $advertisement): AdvertisementResponse
	{
		$advertisement->setBody($this->formatter->format($advertisement->getBody()));
		echo $advertisement->getBody();
		return (new YouTubeAdvertisementProviderAdapter())->publicate($advertisement);
	}

	public function prepare(Advertisement $advertisement)
	{
		if (!$advertisement->getTitle())
		{
			$advertisement->setTitle("hello");
		}
	}

	public function check(Advertisement $advertisement)
	{
		// TODO: Implement check() method.
	}

	public function calculateDuration(Advertisement $advertisement)
	{
	}
}