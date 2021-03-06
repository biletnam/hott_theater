<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.framework');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
?>
<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_CONTACT_NO_ARTICLES'); ?>	 </p>
<?php else : ?>

	<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<?php if ($this->params->get('filter_field') != 'hide' || $this->params->get('show_pagination_limit')) :?>
	<fieldset class="filters btn-toolbar">
    	<legend><?php echo JText::_('JGLOBAL_FILTER_LABEL'); ?></legend>
		<?php if ($this->params->get('filter_field') != 'hide') :?>
			<div class="btn-group">
				<label class="filter-search-lbl element-invisible" for="filter-search"><span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span><?php echo JText::_('COM_CONTACT_FILTER_LABEL').'&#160;'; ?></label>
				<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="inputbox" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_CONTACT_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_CONTACT_FILTER_SEARCH_DESC'); ?>" />
			</div>
		<?php endif; ?>

		<?php if ($this->params->get('show_pagination_limit')) : ?>
			<div class="btn-group pull-right">
				<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		<?php endif; ?>
	</fieldset>
	<?php endif; ?>

		<table class="category table table-bordered table-hover table-striped">

        	<?php if ($this->params->get('show_headings')) : ?>
            <thead>
                <tr>
                    <th class="item-title">
						<?php echo JHtml::_('grid.sort', 'COM_CONTACT_CONTACT_EMAIL_NAME_LABEL', 'a.name', $listDirn, $listOrder); ?>
                    </th>
                    <?php if ($this->params->get('show_position_headings')) : ?>
                    <th class="item-position">
                        <?php echo JHtml::_('grid.sort', 'COM_CONTACT_POSITION', 'a.con_position', $listDirn, $listOrder); ?>
                    </th>
                    <?php endif; ?>
                    <?php if ($this->params->get('show_email_headings')) : ?>
                    <th class="item-email">
                        <?php echo JText::_('JGLOBAL_EMAIL'); ?>
                    </th>
                    <?php endif; ?>
                    <?php if ($this->params->get('show_telephone_headings')) : ?>
                    <th class="item-phone">
                        <?php echo JText::_('COM_CONTACT_TELEPHONE'); ?>
                    </th>
                    <?php endif; ?>
        
                    <?php if ($this->params->get('show_mobile_headings')) : ?>
                    <th class="item-phone">
                        <?php echo JText::_('COM_CONTACT_MOBILE'); ?>
                    </th>
                    <?php endif; ?>
        
                    <?php if ($this->params->get('show_fax_headings')) : ?>
                    <th class="item-phone">
                        <?php echo JText::_('COM_CONTACT_FAX'); ?>
                    </th>
                    <?php endif; ?>
        
                    <?php if ($this->params->get('show_suburb_headings')) : ?>
                    <th class="item-suburb">
                        <?php echo JHtml::_('grid.sort', 'COM_CONTACT_SUBURB', 'a.suburb', $listDirn, $listOrder); ?>
                    </th>
                    <?php endif; ?>
        
                    <?php if ($this->params->get('show_state_headings')) : ?>
                    <th class="item-state">
                        <?php echo JHtml::_('grid.sort', 'COM_CONTACT_STATE', 'a.state', $listDirn, $listOrder); ?>
                    </th>
                    <?php endif; ?>
        
                    <?php if ($this->params->get('show_country_headings')) : ?>
                    <th class="item-state">
                        <?php echo JHtml::_('grid.sort', 'COM_CONTACT_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
                    </th>
                    <?php endif; ?>
                </tr>
            </thead>
            <?php endif; ?>
            
            
            <tbody>
			<?php foreach ($this->items as $i => $item) : ?>

				<?php if (in_array($item->access, $this->user->getAuthorisedViewLevels())) : ?>
					<?php if ($this->items[$i]->published == 0) : ?>
						<tr class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
					<?php else: ?>
						<tr class="cat-list-row<?php echo $i % 2; ?>" >
					<?php endif; ?>
                    
						<td class="item-title">
                        	<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($item->slug, $item->catid)); ?>">
								<?php echo $item->name; ?></a>
							<?php if ($this->items[$i]->published == 0) : ?>
								<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
							<?php endif; ?>
                        </td>
                        
                        <?php if ($this->params->get('show_position_headings')) : ?>
                        	<td class="item-position">
								<?php echo $item->con_position; ?>
							</td>
						<?php endif; ?>
                        <?php if ($this->params->get('show_email_headings')) : ?>
							<td class="item-email">
								<?php echo $item->email_to; ?>
                            </td>
						<?php endif; ?>
                        <?php if ($this->params->get('show_telephone_headings')) : ?>
                            <td class="item-phone">
                                <?php echo $item->telephone; ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($this->params->get('show_mobile_headings')) : ?>
                            <td class="item-phone">
                                <?php echo $item->mobile; ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($this->params->get('show_fax_headings')) : ?>
                            <td class="item-phone">
                                <?php echo $item->fax; ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($this->params->get('show_suburb_headings')) : ?>
                            <td class="item-suburb">
                                <?php echo $item->suburb; ?>
                            </td>
                        <?php endif; ?>
                        <?php if ($this->params->get('show_state_headings')) : ?>
                            <td class="item-state">
                                <?php echo $item->state; ?>
                            </td>
                        <?php endif; ?>    
                        <?php if ($this->params->get('show_country_headings')) : ?>
                            <td class="item-state">
                                <?php echo $item->country; ?>
                            </td>
                        <?php endif; ?>               
					</tr>
				<?php endif; ?>
			<?php endforeach; ?>
            
            </tbody>            
		</table>

		<?php if ($this->params->get('show_pagination')) : ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
		<?php endif; ?>
		<div>
			<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
			<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		</div>
</form>
<?php endif; ?>
