<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li class="active">Configuración de la Estructura Organizacional</li>
</ol>

<h3 class "info">Administración de Procesos </h3>

<div class="well">
 Cree los procesos relacionados en el mapa de procesos de la empresa
</div>


<p>
<?php 

echo $this->Html->image("icon/btn_plus.png", array(
		    "label" => "Crear Area",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'add'),

		)).' Crear Proceso';
?>
</p>
</br>



<div class="table-responsive">
  <table class="table table-bordered">

		<tr >
		<th class="headerlist" align="center" whidth = "5%" >Id</th>
		<th class="headerlist" align="center" whidth = "20%" >Proceso</th>
		<th class="headerlist" align="center" whidth = "55%" >Objetivo</th>
		<th class="headerlist" align="center" whidth = "5%" >Fecha de Creación</th>
		<td class="headerlist" whidtd = "15%"colspan ="2" align ="center">Accion</td>
		
		</tr>
		
		<?php foreach ($processes as $process): ?>
		
		<tr>
		<td><?php echo $process['Process']['id']; ?></td>
		<td><?php echo $this->Html->link($process['Process']['name'], array('action' => 'view',$process['Process']['id']));?></td>
		<td><?php echo $process['Process']['target']; ?></td>
		<td><?php echo $process['Process']['created']; ?></td>
		<td align="center">
		<?php 

		echo $this->Html->image("icon/edit.png", array(
		    "tittle" => "Editar",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'edit', $process['Process']['id']),
		));

		?>
		</td>
		<td align="center">
		<?php 
		echo $this->Form->postLink(
			  $this->Html->image('icon/trash.png', array('alt' => __('Effacer'), 'height'=>'15',
		    'width'=>'15')), //le image
			  array('action' => 'delete',$process['Process']['id'] ), //le url
			  array('escape' => false), //le escape
			  __('Esta seguro de borrar', $process['Process']['id']) //le confirm
			);
		?>
		</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>


