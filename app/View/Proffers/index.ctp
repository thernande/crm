<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'pages',  'action' => 'index')); ?></li>
  <li class="active">Seguimiento a las Propuestas Comerciales</li>
</ol>

<h3 class "info">Seguimiento a las Propuestas Comerciales</h3>

<div class="container well ">


	<ul class="col-md-4 nav nav-pills nav-stacked ">
	  <li class="active">
	    <a><span class="badge pull-right"><?php echo  $total_Opp_seg ?></span>En Seguimiento</a>
	  </li>
	  <li class="active">
	    <a><span class="badge pull-right"><?php echo  $total_Opp_cerrok ?></span>Efectivas</a>
	  </li>

	   <li class="active">
	    <a><span class="badge pull-right"><?php echo  $total_Opp_cerr ?></span>No Efectivas</a>
	  </li>

	  <li class="active">
	    <a><span class="badge pull-right"><?php echo  $total_Proffer ?></span>Total Oportunidades de Negocio </a>
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

		)).' Crear Nueva!';
?>
</p>
</br>



<div class="table-responsive">
  <table class="table table-bordered">

		<tr >
		<th class="headerlist" align="center" whidth = "10%" >Id</th>
		<th class="headerlist" align="center" whidth = "10%" >Cliente</th>
		<th class="headerlist" align="center" whidth = "40%" >Descripcion</th>		
		<th class="headerlist" align="center" whidth = "10%" >Estado</th>
		<th class="headerlist" align="center" whidth = "15%" >Fecha de Creación</th>
		<td class="headerlist" whidtd = "5%"colspan ="4" align ="center">Accion</td>
		
		</tr>
		
		<?php foreach ($Proffers as $Proffer): ?>
		
		<tr>
		<td><?php echo $Proffer['Proffer']['id']; ?></td>			
		<td><?php echo $Proffer['Customer']['name']; ?></td>
		<td><?php echo $this->Html->link($Proffer['Proffer']['description'], array('action' => 'view',$Proffer['Proffer']['id']));?></td>
		<td><?php echo $Proffer['Proffer']['state']; ?></td>
		<td><?php echo $Proffer['Proffer']['created']; ?></td>
		
		<td align="center">
		<?php 

		echo $this->Html->image("icon/btn_ok_w.png", array(
		    "tittle" => "Anexar documento",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'state', $Proffer['Proffer']['id']),
		));

		?>

		</td>

		<td align="center">
		<?php 

		echo $this->Html->image("icon/new.png", array(
		    "tittle" => "Anexar documento",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'docs', $Proffer['Proffer']['id']),
		));

		?>

		</td>
		
		<td align="center">
		<?php 

		echo $this->Html->image("icon/edit.png", array(
		    "tittle" => "Editar",

		    'height'=>'15',
		    'width'=>'15',
		    'url' => array('action' => 'edit', $Proffer['Proffer']['id']),
		));

		?>
		</td>
		<td align="center">
		<?php 
		echo $this->Form->postLink(
			  $this->Html->image('icon/trash.png', array('alt' => __('Effacer'), 'height'=>'15',
		    'width'=>'15')), //le image
			  array('action' => 'delete',$Proffer['Proffer']['id'] ), //le url
			  array('escape' => false), //le escape
			  __('Esta seguro de borrar', $Proffer['Proffer']['id']) //le confirm
			);
		?>
		</td>
	
		</tr>


		<?php endforeach; ?>
	</table>
</div>


