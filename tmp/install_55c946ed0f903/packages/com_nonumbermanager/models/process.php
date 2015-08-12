<?php
/**
 * @package         NoNumber Extension Manager
 * @version         5.1.1
 *
 * @author          Peter van Westen <peter@nonumber.nl>
 * @link            http://www.nonumber.nl
 * @copyright       Copyright © 2015 NoNumber All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.modelitem');

/**
 * Process Model
 */
class NoNumberManagerModelProcess extends JModelItem
{
	/**
	 * Get the extensions data
	 */
	public function getItems()
	{
		$ids = JFactory::getApplication()->input->get('ids', array(), 'array');
		$urls = JFactory::getApplication()->input->get('urls', array(), 'array');

		if (empty($ids) || empty($urls))
		{
			return array();
		}

		$model = JModelLegacy::getInstance('Default', 'NoNumberManagerModel');
		$this->items = $model->getItems($ids);
		foreach ($ids as $i => $id)
		{
			if (isset($urls[$i]))
			{
				$this->items[$id]->url = $urls[$i];
			}
			else
			{
				unset($this->items[$id]);
			}
		}

		return $this->items;
	}

	/**
	 * Download and install
	 */
	function install($id, $url)
	{
		if (!is_string($url))
		{
			return JText::_('NNEM_ERROR_NO_VALID_URL');
		}

		$url = 'http://' . str_replace('http://', '', $url);

		if (!$target = JInstallerHelper::downloadPackage($url))
		{
			return JText::_('NNEM_ERROR_CANNOT_DOWNLOAD_FILE');
		}

		$target = JFactory::getConfig()->get('tmp_path') . '/' . $target;

		NNFrameworkFunctions::loadLanguage('com_installer', JPATH_ADMINISTRATOR);
		jimport('joomla.installer.installer');
		jimport('joomla.installer.helper');

		// Get an installer instance
		$installer = JInstaller::getInstance();

		// Unpack the package
		$package = JInstallerHelper::unpack($target);

		// Cleanup the install files
		if (!is_file($package['packagefile']))
		{
			$config = JFactory::getConfig();
			$package['packagefile'] = $config->get('tmp_path') . '/' . $package['packagefile'];
		}

		JInstallerHelper::cleanupInstall($package['packagefile'], $package['packagefile']);

		// Install the package
		if (!$installer->install($package['dir']))
		{
			// There was an error installing the package
			return JText::sprintf('COM_INSTALLER_INSTALL_ERROR', JText::_('COM_INSTALLER_TYPE_TYPE_' . strtoupper($package['type'])));
		}

		return true;
	}

	/**
	 * Download and install
	 */
	function uninstall($id)
	{
		$model = JModelLegacy::getInstance('Default', 'NoNumberManagerModel');
		$item = $model->getItems(array($id));
		$item = $item[$id];

		$ids = array();
		foreach ($item->types as $type)
		{
			if ($type->id)
			{
				$ids[] = $type->id;
			}
		}

		require_once JPATH_ADMINISTRATOR . '/components/com_installer/models/manage.php';
		$installer = JModelLegacy::getInstance('Manage', 'InstallerModel');
		$installer->remove($ids);
		echo 1;
	}
}
