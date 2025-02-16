<?php

use Twig\Environment;

if (!defined('_PS_VERSION_')) {
    exit;
}
require_once _PS_MODULE_DIR_.'bwlauncher'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

class Bwlauncher extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'bwlauncher';
        $this->version = '1.0.0';

        $this->author = 'Bwlab.it';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('Prestashop Launcher', [], 'Modules.Bwlauncher.Admin');
        $this->description = $this->trans(
            'Navigate in Prestashop Backoffice via Launcher',
            [],
            'Modules.Bwlauncher.Admin'
        );
        $this->confirmUninstall = $this->trans('Are you sure?', [], 'Modules.Bwlauncher.Admin');

        $this->ps_versions_compliancy = array('min' => '1.7.8', 'max' => _PS_VERSION_);
    }

    public function getContent()
    {
        Tools::redirectAdmin(
            $this->context->link->getAdminLink(
                'AdminBwlauncher',
                true,
                ['route' => 'admin_bwlauncher_configuration']
            )
        );
    }

    public function hookDisplayAdminAfterHeader($params)
    {
        /** @var Environment $twig */
        $twig = $this->get('twig');
        $masterTab = Db::getInstance()->executeS(
            'SELECT id_tab  FROM '._DB_PREFIX_.'tab where id_parent = 0 '
        );
        $mainTabs = [];
        foreach ($masterTab as $master) {
            $subTabs = Db::getInstance()->executeS(
                'select id_tab from '._DB_PREFIX_.'tab where id_parent = '.$master['id_tab']
            );
            foreach ($subTabs as $subTab) {
                $mainTabs[] = $subTab['id_tab'];
            }
        }
        $tabs = [];
        foreach ($mainTabs as $mainTab) {
            $tabs = array_merge($tabs, Tab::getTabs($this->context->language->id, $mainTab));
        }
        $dataJson = [];
        foreach ($tabs as $tab) {
            $dataJson[] = [
                'name' => $tab['name'].' - '.$tab['wording'],
                'url' => $this->context->link->getTabLink($tab),
            ];
        }

        return $twig->render(
            '@Modules/bwlauncher/views/templates/hook/display_admin_after_header.html.twig',
            [
                'data_json' => json_encode($dataJson),
            ]
        );
    }

    public function hookDisplayBackOfficeHeader()
    {
        $this->context->controller->addCSS('modules/'.$this->name.'/views/css/launcher.css');
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayAdminAfterHeader')
            && $this->registerHook('displayBackOfficeHeader')
            && $this->registerHook('dashboardZoneOne');
    }

    public function hookDashboardZoneOne($params)
    {
        

    }
    public function isUsingNewTranslationSystem()
    {
        return true;
    }

    public function uninstall()
    {
        return parent::uninstall();
    }
}
