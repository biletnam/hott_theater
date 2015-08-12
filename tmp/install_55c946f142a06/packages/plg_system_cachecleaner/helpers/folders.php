<?php
/**
 * Plugin Helper File: Folders
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

require_once __DIR__ . '/cache.php';

class PlgSystemCacheCleanerHelperFolders extends PlgSystemCacheCleanerHelperCache
{
	public function purge()
	{
		// Empty tmp folder
		if ($this->params->clean_tmp)
		{
			$this->emptyFolder(JPATH_SITE . '/tmp');
		}

	}
}
