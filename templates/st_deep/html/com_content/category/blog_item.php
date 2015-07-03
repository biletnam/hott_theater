<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;?>
<?php
// Create a shortcut for params.
$params = $this->item->params;
$images = json_decode($this->item->images);
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$canEdit = $this->item->params->get('access-edit');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');
?>
<?php $layoutPath = str_replace('com_content\category', '', dirname(__FILE__)).'\layouts'; ?>
<?php if ($this->item->state == 0) : ?>
   <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
<?php endif; ?>
<div class="row-fluid">
	<?php echo JLayoutHelper::render('joomla.content.content_intro_image', $this->item); ?>
    
    <?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
      <?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
      <div class="img-intro-<?php echo htmlspecialchars($imgfloat); ?> span3">
        <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
             <img
                <?php if ($images->image_intro_caption):
                    echo 'class="caption"'.' title="' . htmlspecialchars($images->image_intro_caption) . '"';
                 endif; ?>
                src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
         </a>
      </div>
    <?php endif; ?>
    
    <?php if (isset($images->image_intro) && !empty($images->image_intro)) { ?>
    	<div class="span9">
	<?php } else { ?>
		<div class="span12">
	<?php } ?>
    
    <?php if ($params->get('show_title')) : ?>
        <h5 class="avatar-article-heading">
            <?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
                <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
                <?php echo $this->escape($this->item->title); ?></a>
            <?php else : ?>
                <?php echo $this->escape($this->item->title); ?>
            <?php endif; ?>
        </h5>
    <?php endif; ?>
	
    
    <div class="clearfix st-all-categories-meta">
    <?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false), $layoutPath); ?>
    
    <?php // Todo Not that elegant would be nice to group the params ?>
    <?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
       || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') ); ?>
    
    <?php if ($useDefList) : ?>
       <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above'), $layoutPath); ?>
    <?php endif; ?>
    </div>
    
    
    <?php if (!$params->get('show_intro')) : ?>
       <?php echo $this->item->event->afterDisplayTitle; ?>
    <?php endif; ?>
    <?php echo $this->item->event->beforeDisplayContent; ?> <?php echo $this->item->introtext; ?>
    
    <?php if ($useDefList) : ?>
       <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below'), $layoutPath); ?>
    <?php  endif; ?>
    
    <?php if ($params->get('show_readmore') && $this->item->readmore) :
       if ($params->get('access-view')) :
          $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
       else :
          $menu = JFactory::getApplication()->getMenu();
          $active = $menu->getActive();
          $itemId = $active->id;
          $link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
          $returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
          $link = new JURI($link1);
          $link->setVar('return', base64_encode($returnURL));
       endif; ?>
    
       <p class="readmore"><a class="st-readmore" href="<?php echo $link; ?>">
    
       <?php if (!$params->get('access-view')) :
          echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
       elseif ($readmore = $this->item->alternative_readmore) :
          echo $readmore;
          if ($params->get('show_readmore_title', 0) != 0) :
          echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
          endif;
       elseif ($params->get('show_readmore_title', 0) == 0) :
          echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
       else :
          echo JText::_('COM_CONTENT_READ_MORE');
          echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
       endif; ?>
    
       </a></p>
    
    <?php endif; ?>
    </div>
</div>
<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>