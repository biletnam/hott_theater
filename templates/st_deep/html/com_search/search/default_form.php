<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();

JHtml::_('bootstrap.tooltip');
?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search');?>" method="post" class="form-inline">
    
    <fieldset class="word">
    	<label for="search-searchword">Search Keyword: </label>
        <input type="text" name="searchword" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox" />
        <button name="Search" onclick="this.form.submit()" class="btn" title="<?php echo JText::_('COM_SEARCH_SEARCH');?>">Search</button>
        <input type="hidden" name="task" value="search" />
    </fieldset>

	<fieldset class="phrases">		
		</legend>
			<div class="phrases-box">
			<?php echo $this->lists['searchphrase']; ?>
			</div>
			<div class="ordering-box">
			<label for="ordering" class="ordering">
				<?php echo JText::_('COM_SEARCH_ORDERING');?>
			</label>
			<?php echo $this->lists['ordering'];?>
			</div>
	</fieldset>

	<?php if ($this->params->get('search_areas', 1)) : ?>
		<fieldset class="only">
		<p><?php echo JText::_('COM_SEARCH_SEARCH_ONLY');?></p>
		<?php foreach ($this->searchareas['search'] as $val => $txt) :
			$checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : '';
		?>
		<label for="area-<?php echo $val;?>" class="checkbox">
			<input type="checkbox" name="areas[]" value="<?php echo $val;?>" id="area-<?php echo $val;?>" <?php echo $checked;?> >
			<?php echo JText::_($txt); ?>
		</label>
		<?php endforeach; ?>
		</fieldset>
	<?php endif; ?>
	
    <div class="clearafter">
        <div class="searchintro pull-left <?php echo $this->params->get('pageclass_sfx'); ?>">
            <?php if (!empty($this->searchword)):?>
            <p><?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="badge badge-info">'. $this->total. '</span>');?></p>
            <?php endif;?>
        </div>
        <?php if ($this->total > 0) : ?>
        	<div class="form-limit pull-right">
                <label for="limit">
                    <?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
                </label>
                <?php echo $this->pagination->getLimitBox(); ?>
            </div>
        <?php endif; ?>
    </div>
	<?php if ($this->total > 0) : ?>
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
    <?php endif; ?>

</form>