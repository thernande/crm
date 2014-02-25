<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li class="active">Configuración de la Estructura Organizacional</li>
</ol>



<h3 >Administración de Areas</h3>

<div class="well">
Cree cada una de las areas definidas en la empresa.
</div>	



<p class ="">

</p>	

<p>
<?php 

echo $this->Html->image("icon/btn_plus.png", array(
		    "label" => "Crear Area",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'add'),

		)).' Crear Area';
?>
</p>
</br>
<div class="table-responsive">
  <table class="table table-bordered">

		<tr>
		<td  class="headerlist" whidth = "5%" align="center" >Id</td>
		<td class="headerlist" whidtd = "30%" align="center" >Area</td>
		<td class="headerlist" whidtd = "30%" align="center">Proceso al cual pertence</td>
		<td class="headerlist" whidtd = "15%" align="center" >Estado</td>
		<td class="headerlist" whidtd = "5%"  align="center">Fecha de Creación</td>
		<td class="headerlist" whidtd = "15%"colspan ="2" align ="center">Accion</td>
		
		</tr>
		
		<?php foreach ($Areas as $Area): ?>
		
		<tr>
		<td align="center"><?php echo $Area['Area']['id']; ?></td>
		<td align="center"><?php echo $this->Html->link($Area['Area']['name'], array('action' => 'view',$Area['Area']['id']));?></td>
		<td align="center"><?php echo $Area['Process']['name']; ?></td>
		<td align="center"><?php echo $Area['Area']['state']; ?></td>
		<td align="center"><?php echo $Area['Area']['created']; ?></td>
		<td align="center">
		<?php 

		echo $this->Html->image("icon/edit.png", array(
		    "tittle" => "Editar",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'edit', $Area['Area']['id']),
		));

		?>
		</td>
		<td align="center">
		<?php 
		echo $this->Form->postLink(
			  $this->Html->image('icon/trash.png', array('alt' => __('Effacer'), 'height'=>'15',
		    'width'=>'15')), //le image
			  array('action' => 'delete',$Area['Area']['id'] ), //le url
			  array('escape' => false), //le escape
			  __('Esta seguro de borrar', $Area['Area']['id']) //le confirm
			);
		?>
		</td>
		
		</tr>
		<?php endforeach; ?>
	</table>
</div>


