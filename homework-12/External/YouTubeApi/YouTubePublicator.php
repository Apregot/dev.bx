<?php

namespace External\YouTubeApi;

class YouTubePublicator
{
	public function publicate(YouTubeAdvertisement $advertisement): YouTubeAdvertisementResult
	{
		//...

		return (new YouTubeAdvertisementResult())->setTargetingName("response");
	}
}