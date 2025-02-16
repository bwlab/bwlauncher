<?php

namespace Bwlab\Launcher\Configuration;

use PrestaShop\PrestaShop\Core\Configuration\DataConfigurationInterface;
use PrestaShop\PrestaShop\Core\ConfigurationInterface;

class LauncherTextDataConfiguration implements DataConfigurationInterface
{
    public const NEW_URLS = 'BWLAB_LAUNCHER_NEW_URLS';

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration(): array
    {
        $return = [];

        $return[self::NEW_URLS] = $this->configuration->get(static::NEW_URLS);

        return $return;
    }

    public function updateConfiguration(array $configuration): array
    {
        $this->configuration->set(self::NEW_URLS, $configuration[self::NEW_URLS]);

        return [];
    }

    /**
     * Ensure the parameters passed are valid.
     *
     * @return bool Returns true if no exception are thrown
     */
    public function validateConfiguration(array $configuration): bool
    {
        return isset($configuration[self::NEW_URLS]);
    }
}
