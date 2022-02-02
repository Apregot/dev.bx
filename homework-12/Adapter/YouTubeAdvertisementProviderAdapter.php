<?php

namespace Adapter;

use Entity\Advertisement;
use Entity\AdvertisementResponse;
use External\YouTubeApi\YouTubeAdvertisement;
use External\YouTubeApi\YouTubePublicator;
use Service\AdvertisementProviderInterface;

class YouTubeAdvertisementProviderAdapter implements AdvertisementProviderInterface
{

	public function publicate(Advertisement $advertisement): AdvertisementResponse
	{
		$ytAdvertisement = new YouTubeAdvertisement();

		if (!$advertisement->getTitle())
		{
			$advertisement->setTitle("default");
		}
		$ytAdvertisement
			->setTitle($advertisement->getTitle())
			->setMessageBody($advertisement->getBody())
			->setDuration($advertisement->getDuration())
		;

		$result = (new YouTubePublicator())->publicate($ytAdvertisement);

		return (new AdvertisementResponse())->setTargeting($result->getTargetingName());
	}

	public function prepare(Advertisement $advertisement)
	{
		// TODO: Implement prepare() method.
	}

	public function check(Advertisement $advertisement)
	{
		// TODO: Implement check() method.
	}

	public function calculateDuration(Advertisement $advertisement)
	{
		// TODO: Implement calculateDuration() method.
	}
}