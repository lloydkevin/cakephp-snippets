<div class="widgets view">
<h2><?php  __('Widget');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widget['Widget']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widget['Widget']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Part No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widget['Widget']['part_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Quantity'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $widget['Widget']['quantity']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Widget', true), array('action'=>'edit', $widget['Widget']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Widget', true), array('action'=>'delete', $widget['Widget']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $widget['Widget']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Widgets', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Widget', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
