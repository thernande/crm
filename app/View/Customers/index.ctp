<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'pages',  'action' => 'index')); ?></li>
  <li class="active">Administración de Clientes</li>
</ol>

<h3 class "info">Administración de Clientes </h3>

<div class="container well">


	<ul class="nav nav-pills nav-stacked">
	  <li class="active">
	    <a><span class="badge pull-right"><?php echo  $total_cust_ant ?></span>Número de Clientes  en Antioquia </a>
	  </li>
	  <li class="active">
	    <a><span class="badge pull-right"><?php echo  $total_customer - $total_cust_ant ?></span>Número de Clientes  en Otros Departamentos </a>
	  </li>
	  <li class="active">
	    <a><span class="badge pull-right"><?php echo  $total_customer ?></span>Total Clientes</a>
	  </li>
			


	</ul>

</div>


<p>
<?php 

echo $this->Html->image("icon/btn_plus.png", array(
		    "label" => "Crear nuevo usuario",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'add'),

		)).' Crear Nuevo Cliente';
?>
</p>
</br>



<div class="table-responsive">
  <table class="table table-bordered">

		<tr >
		<th class="headerlist" align="center" whidth = "40%" >Cliente</th>
		<th class="headerlist" align="center" whidth = "20%" >Telefono</th>
		<th class="headerlist" align="center" whidth = "10%" >Dirección</th>
		<th class="headerlist" align="center" whidth = "10%" >Estado</th>
		<th class="headerlist" align="center" whidth = "10%" >Fecha de Creación</th>
		<td class="headerlist" whidtd = "10%"colspan ="2" align ="center">Accion</td>
		
		</tr>
		
		<?php foreach ($Customers as $customer): ?>
		
		<tr>
		<td><?php echo $this->Html->link($customer['Customer']['name'], array('action' => 'view',$customer['Customer']['id']));?></td>
		<td><?php echo $customer['Customer']['phone']; ?></td>		
		<td><?php echo $customer['Customer']['dress']; ?></td>
		<td><?php echo $customer['Customer']['state']; ?></td>
		<td><?php echo $customer['Customer']['created']; ?></td>
		<td align="center">
		<?php 

		echo $this->Html->image("icon/edit.png", array(
		    "tittle" => "Editar",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'edit', $customer['Customer']['id']),
		));

		?>
		</td>
		<td align="center">
		<?php 
		echo $this->Form->postLink(
			  $this->Html->image('icon/trash.png', array('alt' => __('Effacer'), 'height'=>'15',
		    'width'=>'15')), //le image
			  array('action' => 'delete',$customer['Customer']['id'] ), //le url
			  array('escape' => false), //le escape
			  __('Esta seguro de borrar', $customer['Customer']['id']) //le confirm
			);
		?>
		</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>


