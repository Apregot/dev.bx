<?php

namespace External\YouTubeApi;

class YouTubeAdvertisement
{
	private $title;
	private $messageBody;
	private $duration;
	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return YouTubeAdvertisement
	 */
	public function setTitle(string $title): YouTubeAdvertisement
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessageBody(): string
	{
		return $this->messageBody;
	}

	/**
	 * @param string $messageBody
	 * @return YouTubeAdvertisement
	 */
	public function setMessageBody(string $messageBody): YouTubeAdvertisement
	{
		$this->messageBody = $messageBody;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getDuration(): int
	{
		return $this->duration;
	}

	/**
	 * @param int $duration
	 * @return YouTubeAdvertisement
	 */
	public function setDuration(int $duration): YouTubeAdvertisement
	{
		$this->duration = $duration;
		return $this;
	}
}