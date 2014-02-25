<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li class="active">Configuración de Usuarios</li>
</ol>

<h3 class "info">Administración de Usuarios </h3>

<div class="well">
 ...
</div>


<p>
<?php 

echo $this->Html->image("icon/btn_plus.png", array(
		    "label" => "Crear nuevo usuario",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'add'),

		)).' Crear nuevo Usuario';
?>
</p>
</br>



<div class="table-responsive">
  <table class="table table-bordered">

		<tr >
		<th class="headerlist" align="center" whidth = "10%" >Usuario</th>
		<th class="headerlist" align="center" whidth = "30%" >Nombre</th>
		<th class="headerlist" align="center" whidth = "15%" >Area</th>
		<th class="headerlist" align="center" whidth = "15%" >Rol</th>
		<th class="headerlist" align="center" whidth = "10%" >Estado</th>
		<th class="headerlist" align="center" whidth = "10%" >Fecha de Creación</th>
		<td class="headerlist" whidtd = "10%"colspan ="2" align ="center">Accion</td>
		
		</tr>
		
		<?php foreach ($users as $user): ?>
		
		<tr>
		<td><?php echo $this->Html->link($user['User']['username'], array('action' => 'view',$user['User']['id']));?></td>
		<td><?php echo $user['User']['name']." ".$user['User']['lastname']; ?></td>		
		<td><?php echo $user['Area']['name']; ?></td>
		<td><?php echo $user['User']['role']; ?></td>
		<td><?php echo $user['User']['state']; ?></td>
		<td><?php echo $user['User']['created']; ?></td>
		<td align="center">
		<?php 

		echo $this->Html->image("icon/edit.png", array(
		    "tittle" => "Editar",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'edit', $user['User']['id']),
		));

		?>
		</td>
		<td align="center">
		<?php 
		echo $this->Form->postLink(
			  $this->Html->image('icon/trash.png', array('alt' => __('Effacer'), 'height'=>'15',
		    'width'=>'15')), //le image
			  array('action' => 'delete',$user['User']['id'] ), //le url
			  array('escape' => false), //le escape
			  __('Esta seguro de borrar', $user['User']['id']) //le confirm
			);
		?>
		</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>


