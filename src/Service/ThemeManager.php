<?php

namespace App\Service;

use App\Repository\SettingsRepository;

class ThemeManager
{
	private $settingsRepository;

	public function __construct(SettingsRepository $settingsRepository)
	{
		$this->settingsRepository = $settingsRepository;
	}

	public function getActiveTheme(): string
	{
		$settings = $this->settingsRepository->findOneBy([]);
		return $settings ? $settings->getThemeCss() : 'default.css';
	}
}
