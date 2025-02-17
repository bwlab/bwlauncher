<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
$_SERVER['REQUEST_METHOD'] = 'POST';
define('_PS_ROOT_DIR_', __DIR__ . '/../../../..');
if (!defined('_PS_ADMIN_DIR_')) {
    define('_PS_ADMIN_DIR_', _PS_ROOT_DIR_ . ADMIN_FOLDER_NAME);
}

if (!defined('PS_ADMIN_DIR')) {
    define('PS_ADMIN_DIR', _PS_ADMIN_DIR_);
}

require_once __DIR__ . '/../../../../config/config.inc.php';
require_once __DIR__ . '/../../../../init.php';

require_once _PS_ROOT_DIR_ . '/app/AppKernel.php';
$kernel = new \AppKernel(_PS_ENV_, _PS_DEBUG_);
$kernel->boot();

// define('_NEW_COOKIE_KEY_', PhpEncryption::createNewRandomKey());
