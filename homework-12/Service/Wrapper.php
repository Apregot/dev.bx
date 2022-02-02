<?php

namespace Service;

interface Wrapper
{
	public function wrap(): Wrapper;
	public function getWrappedText(): string;
}