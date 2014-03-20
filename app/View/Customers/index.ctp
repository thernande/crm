<?php 
  echo $this->Html->css('ui.jqgrid'); ?>
<?php  echo $this->Html->css('ui.multiselect');?>
<?php   echo $this->Html->css('jquery-ui-1.9.2.custom');?>

<?php echo $this->Html->script('jqGrid/jquery-1.7.2.min');?>
<?php echo $this->Html->script('jqGrid/grid.locale-en');?>
<?php echo $this->Html->script('jqGrid/jquery.jqGrid.min');?>
<?php echo $this->Html->script('jquery-ui-1.9.2.custom.min');?>

<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'pages',  'action' => 'index')); ?></li>
  <li class="active">Administración de Clientes</li>
</ol>

<h3 class="info">Administración de Clientes </h3>

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

echo $this->Html->link("Nuevo Cliente", array(
		    'action' => 'add'),
		    array('height'=>'15',
		    'width'=>'15',
		    'role' => 'button',
		    'class' => 'btn btn-default')
		);
?>
</p>


<div id="table">
<table id="list"></table>
<div id="page"></div>
  </div>




<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#list").jqGrid({
   	url:'<?php echo $this->Html->url(array("controller" => "Customers", "action" => "showGrid")); ?>',
	datatype: "json",
	mtype: "GET",
   	colNames:['id','Cliente','Telefono','Direccion','Estado','Fecha de Creacion'],
   	colModel:[
		{name:'id',index:'id',width:15},
   		{name:'name',index:'name'},
   		{name:'phone',index:'phone'},
   		{name:'dress',index:'dress'},
   		{name:'state',index:'state',width:50},
   		{name:'created',index:'created'}
   	],
   	rowNum:10,
	rowList : [5,10,15],
	
	rownumWidth: 40,
   	pager: jQuery('#page'),
   	sortname: 'id',
    sortorder: 'asc',
	caption: "Administracion de Cliente",
	height:"auto",
     autowidth: true,
     viewrecords: true,
     ondblClickRow: function (rowid) {
        var rowData = $(this).getRowData(rowid);
        document.location.href = "customers/view/" + rowData['id'];
    }
	});
    jQuery("#list").navGrid("#page",{del:true,add:false,edit:true,search:false});	
    jQuery("#list").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});
});

</script>

