<?php

namespace External\YouTubeApi;

class YouTubeAdvertisementResult
{
	public $targetingName;

	/**
	 * @return string
	 */
	public function getTargetingName(): string
	{
		return $this->targetingName;
	}

	/**
	 * @param string $targetingName
	 * @return YouTubeAdvertisementResult
	 */
	public function setTargetingName(string $targetingName): YouTubeAdvertisementResult
	{
		$this->targetingName = $targetingName;
		return $this;
	}
}