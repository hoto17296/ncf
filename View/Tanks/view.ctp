<div class="tanks view">
<h2><?php echo __('Tank'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tank['Tank']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tank['Tank']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tank'), array('action' => 'edit', $tank['Tank']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tank'), array('action' => 'delete', $tank['Tank']['id']), null, __('Are you sure you want to delete # %s?', $tank['Tank']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tanks'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tank'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fish'), array('controller' => 'fish', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fish'), array('controller' => 'fish', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Fish'); ?></h3>
	<?php if (!empty($tank['Fish'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Tank Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tank['Fish'] as $fish): ?>
		<tr>
			<td><?php echo $fish['id']; ?></td>
			<td><?php echo $fish['tank_id']; ?></td>
			<td><?php echo $fish['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'fish', 'action' => 'view', $fish['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'fish', 'action' => 'edit', $fish['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'fish', 'action' => 'delete', $fish['id']), null, __('Are you sure you want to delete # %s?', $fish['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Fish'), array('controller' => 'fish', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
