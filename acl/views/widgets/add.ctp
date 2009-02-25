<div class="widgets form">
<?php echo $form->create('Widget');?>
	<fieldset>
 		<legend><?php __('Add Widget');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('part_no');
		echo $form->input('quantity');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Widgets', true), array('action'=>'index'));?></li>
	</ul>
</div>
