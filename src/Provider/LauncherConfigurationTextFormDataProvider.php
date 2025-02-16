<?php

namespace Bwlab\Launcher\Provider;

use Bwlab\Launcher\Configuration\LauncherTextDataConfiguration;
use PrestaShop\PrestaShop\Core\Form\FormDataProviderInterface;

class LauncherConfigurationTextFormDataProvider implements FormDataProviderInterface
{
    /**
     * @var LauncherTextDataConfiguration
     */
    private $configurationTextDataConfiguration;

    public function __construct(LauncherTextDataConfiguration $configurationTextDataConfiguration)
    {
        $this->configurationTextDataConfiguration = $configurationTextDataConfiguration;
    }

    public function getData()
    {
        return $this->configurationTextDataConfiguration->getConfiguration();
    }

    public function setData(array $data)
    {
        $this->configurationTextDataConfiguration->updateConfiguration($data);
    }

}