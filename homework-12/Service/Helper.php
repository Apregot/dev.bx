<?php

namespace Service;

use Entity\Advertisement;

class Helper
{
	public static function runVkAdvertisement(Advertisement $advertisement)
	{
		$vkProvider = new VkProvider((new \Service\Formatting\PlainTextFormatter()));
		$vkProvider->check($advertisement);
		$vkProvider->calculateDuration($advertisement);
		$vkProvider->prepare($advertisement);
		$vkProvider->publicate($advertisement);
	}
	public static function runYtAdvertisement(Advertisement $advertisement)
	{
		$ytProvider = new YouTubeProvider(new \Service\Formatting\HtmlTextFormatter());
		$ytProvider->check($advertisement);
		$ytProvider->calculateDuration($advertisement);
		$ytProvider->prepare($advertisement);
		$ytProvider->publicate($advertisement);
	}
}