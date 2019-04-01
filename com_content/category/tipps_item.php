<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));

?>
<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
<div class="system-unpublished">
<?php endif; ?>

	<div class="accordion-heading">
		<div class="row-fluid">
		<div class="span4">
			<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
		</div>
 		<div class="span8">
			<h2><a class="accordion-toggle" href="#collapse<?php echo $this->item->id; ?>" data-toggle="collapse" data-parent="#accordion1"><?php echo $this->escape($this->item->title); ?></a></h2>
		</div>
		</div>
    </div>

	<div id="collapse<?php echo $this->item->id; ?>" class="accordion-body collapse">
		<div class="accordion-inner">
			<?php echo $this->item->introtext; ?>
		</div>
    </div>

<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
</div>
<?php endif; ?>
