<h1>Administracion de Usuarios</h1>
<p><?php echo $this->Html->link("Add Users", array('action' => 'add')); ?></p>
<table class= "table borderer">
<tr>


<td><?php 
echo $this->Paginator->numbers();

//echo $this->Paginator->sort('User', null, array('nameuser' => 'desc'));  

?></td>
<th>Action</th>
<th>delete</th>
<th>Date create</th>
</tr>

<!-- Here's where we loop through our $Users array, printing out post info -->
<?php foreach ($users as $user):
	
 ?>
<tr>


<td><?php echo $user['User']['id']; ?></td>
<td>
<?php echo $this->Html->link($user['User']['username'], array('action' => 'view',$user['User']['id']));?> </td>
<td>
<?php echo $this->Form->postLink('Delete',array('action' => 'delete', $user['User']['id']),
array('confirm' => 'Are you sure?')
)?>
</td>
<td>
<?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id']));?>
</td>
<td><?php echo $user['User']['created']; ?></td>
</tr>
<?php endforeach; ?>
</table>
<tr>
<div class="pagination">
<ul>
<li><a href="#">
<?php echo $this->Paginator->numbers(); ?>
</li></a>
</ul>
</div>
</tr>
