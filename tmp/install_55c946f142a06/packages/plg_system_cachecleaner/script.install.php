<?php
/**
 * Install script
 *
 * @package         Cache Cleaner
 * @version         4.0.4
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2015 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/script.install.helper.php';

class PlgSystemCacheCleanerInstallerScript extends PlgSystemCacheCleanerInstallerScriptHelper
{
	public $name = 'CACHE_CLEANER';
	public $alias = 'cachecleaner';
	public $extension_type = 'plugin';

	public function uninstall($adapter)
	{
		$this->uninstallModule($this->extname);
	}
}
