<div class="widgets form">
<?php echo $form->create('Widget');?>
	<fieldset>
 		<legend><?php __('Edit Widget');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('part_no');
		echo $form->input('quantity');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Widget.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Widget.id'))); ?></li>
		<li><?php echo $html->link(__('List Widgets', true), array('action'=>'index'));?></li>
	</ul>
</div>
