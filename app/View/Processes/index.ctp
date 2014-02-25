<h1>Admin procesos </h1>
<p><?php echo $this->Html->link("Add Process", array('action' => 'add')); ?></p>
<table>
<tr>
<th>Id</th>
<th>Title</th>
<th>Action</th>
<th>delete</th>
<th>Date create</th>
</tr>

<!-- Here's where we loop through our $posts array, printing out post info -->
<?php foreach ($processes as $process): ?>
<tr>
<td><?php echo $process['Process']['id']; ?></td>
<td>
<?php echo $this->Html->link($process['Process']['name'], array('action' => 'view',$process['Process']['id']));?> </td>
<td>
<?php echo $this->Form->postLink('Delete',array('action' => 'delete', $process['Process']['id']),
array('confirm' => 'Are you sure?')
)?>
</td>
<td>
<?php echo $this->Html->link('Edit', array('action' => 'edit', $process['Process']['id']));?>
</td>
<td><?php echo $process['Process']['created']; ?></td>
</tr>
<?php endforeach; ?>
</table>