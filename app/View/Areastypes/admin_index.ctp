<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Areas", array('controller' => 'areas',  'action' => 'index')); ?></li>
  <li class="active">Tipos de Areas </li>
</ol>



<h3 >Administración Tipos de Areas </h3>
<div class="alert alert-info">
<strong>Registre </strong> cada uno de los tipos de areas <br> Ejemplos : Area, Centro de Costos, Oficina, Sucursal, Agencia, Dirección
</div>	

<p>
<?php 

echo $this->Html->image("icon/btn_plus.png", array(
		    "label" => "Crear AreaType",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'add'),

		)).' Crear nuevo tipo ';
?>
</p>
</br>
<div class="table-responsive">
  <table class="table table-bordered">

		<tr>
		<td  class="headerlist" whidth = "5%" align="center" >Id</td>
		<td class="headerlist" whidtd = "30%" align="center" >Tipo de Area</td>
		<td class="headerlist" whidtd = "15%" align="center" >Estado</td>
		<td class="headerlist" whidtd = "5%"  align="center">Fecha de Creación</td>
		<td class="headerlist" whidtd = "15%"colspan ="2" align ="center">Accion</td>
		
		</tr>
		
		<?php foreach ($AreasTypes as $AreasType): ?>
		
		<tr>
		<td align="center"><?php echo $AreasType['AreasType']['id']; ?></td>
		<td align="center"><?php echo $this->Html->link($AreasType['AreasType']['name'], array('action' => 'view',$AreasType['AreasType']['id']));?></td>
	
		<td align="center"><?php echo $AreasType['AreasType']['state']; ?></td>
		<td align="center"><?php echo $AreasType['AreasType']['created']; ?></td>
		<td align="center">
		<?php 

		echo $this->Html->image("icon/edit.png", array(
		    "tittle" => "Editar",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'edit', $AreasType['AreasType']['id']),
		));

		?>
		</td>
		<td align="center">
		<?php 
		echo $this->Form->postLink(
			  $this->Html->image('icon/trash.png', array('alt' => __('Effacer'), 'height'=>'15',
		    'width'=>'15')), //le image
			  array('action' => 'delete',$AreasType['AreasType']['id'] ), //le url
			  array('escape' => false), //le escape
			  __('Esta seguro de borrar', $AreasType['AreasType']['id']) //le confirm
			);
		?>
		</td>
		
		</tr>
		<?php endforeach; ?>
	</table>
</div>


