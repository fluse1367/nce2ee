<?php

declare(strict_types=1);

// SPDX-FileCopyrightText: 2022 Carl Schwan <carl@carlschwan.eu>
// SPDX-License-Identifier: AGPL-3.0-or-later

namespace OCA\EndToEndEncryption\Settings;

use OCA\EndToEndEncryption\AppInfo\Application;
use OCA\EndToEndEncryption\Config;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Services\IInitialState;
use OCP\Settings\ISettings;

class Admin implements ISettings {
	private Config $config;
	private IInitialState $initialState;

	public function __construct(IInitialState $initialState, Config $config) {
		$this->config = $config;
		$this->initialState = $initialState;
	}

	public function getForm(): TemplateResponse {
		$this->initialState->provideInitialState('allowed_groups', $this->config->getAllowedGroupIds());

		return new TemplateResponse(
			Application::APP_ID,
			'settings-admin',
			[]
		);
	}

	public function getSection(): string {
		return 'security';
	}

	public function getPriority(): int {
		return 90;
	}
}
