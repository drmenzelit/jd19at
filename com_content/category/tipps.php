<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

?>
<div id="accordion1"  class="accordion blog<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
		</div>
	<?php endif; ?>

	<?php
	$introcount = count($this->intro_items);
	$counter = 0;
	?>

	<?php if (!empty($this->intro_items)) : ?>
		<?php foreach ($this->intro_items as $key => &$item) : ?>
			<?php $rowcount = ((int) $key % (int) $this->columns) + 1; ?>
			<?php if ($rowcount === 1) : ?>
				<?php $row = $counter / $this->columns; ?>
				<div class="accordion-group items-row cols-<?php echo (int) $this->columns; ?> <?php echo 'row-' . $row; ?> row-fluid clearfix <?php echo $item->state == 0 ? ' system-unpublished' : null; ?>">
			<?php endif; ?>
					<?php
					$this->item = &$item;
					echo $this->loadTemplate('item');
					?>
				<!-- end item -->
				<?php $counter++; ?>
			<?php if (($rowcount == $this->columns) or ($counter == $introcount)) : ?>
				</div><!-- end row -->
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?> </div>
	<?php endif; ?>
</div>
