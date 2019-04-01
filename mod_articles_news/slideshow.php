<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$count = count($list);
?>

<div id="slider" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php for ($i = 0; $i < $count; $i++) : ?>
		<li data-target="#slider" data-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>"></li>
		<?php endfor; ?>
	</ol>
	<div class="carousel-inner">
		<?php for ($i = 0; $i < $count; $i++) : ?>
		<?php $images = json_decode($list[$i]->images); ?>
			<div class="item carousel-item <?php echo $i == 0 ? 'active' : ''; ?>">
				<img class="d-block w-100" src="<?php echo htmlspecialchars($images->image_intro); ?>">
				<div class="carousel-caption d-block">
					<div class="carousel-text">
						<div class="carousel-text-inner">
							<?php if ($params->get('item_title')) : ?>
							<h2><?php echo $list[$i]->title; ?></h2>
							<?php endif; ?>
							<?php echo $list[$i]->introtext; ?>
							<?php if (isset($list[$i]->link) && $list[$i]->readmore != 0 && $params->get('readmore')) : ?>
								<?php echo '<a class="btn btn-primary readmore" href="' . $list[$a]->link . '"><i class="fas fa-chevron-right mr-2"></i>' . $list[$a]->linkText . '</a>'; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endfor; ?>
	</div>
	<a class="carousel-control left" href="#slider" data-slide="prev">&lsaquo;</a>
	<a class="carousel-control right" href="#slider" data-slide="next">&rsaquo;</a>
</div>