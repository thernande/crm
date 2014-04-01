<?php echo $this->Html->script('bootstrap/bootstrap-modal'); ?>
<?php echo $this->Html->css('ui.jqgrid'); ?>
<?php  echo $this->Html->css('ui.multiselect');?>
<?php   echo $this->Html->css('jquery-ui-1.9.2.custom');?>
<?php echo $this->Html->script('jquery-1.7.2.min');?>
<?php echo $this->Html->script('jqGrid/grid.locale-es');?>
<?php echo $this->Html->script('jqGrid/jquery.jqGrid.min');?>
<?php echo $this->Html->script('jquery-ui-1.9.2.custom.min');?>
<ol class="breadcrumb">
	<li>
		<?php echo $this->Html->link("Home", array('controller'=> 'pages','action'    => 'index')); ?>
	</li>
	<li class="active">
		Seguimiento a las Propuestas Comerciales
	</li>
</ol>

<h3 class = "info">
	Seguimiento a las Propuestas Comerciales
</h3>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					Cambiar el estado
				</h4>
			</div>

			<div class="modal-body">
				<?php echo $this->Form->create('Proffer',array('url' => array('action'=> 'state','class' => 'form-horizontal' ) ) ); ?>
				<?php echo $this->Form->select('state',array('aprobado', 'rechazado', 'activo')); ?>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<div class="container well ">


	<ul class="col-md-4 nav nav-pills nav-stacked ">
		<li class="active">
			<a>
				<span class="badge pull-right">
					<?php echo  $total_Opp_seg ?>
				</span>En Seguimiento
			</a>
		</li>
		<li class="active">
			<a>
				<span class="badge pull-right">
					<?php echo  $total_Opp_cerrok ?>
				</span>Efectivas
			</a>
		</li>

		<li class="active">
			<a>
				<span class="badge pull-right">
					<?php echo  $total_Opp_cerr ?>
				</span>No Efectivas
			</a>
		</li>

		<li class="active">
			<a>
				<span class="badge pull-right">
					<?php echo  $total_Proffer ?>
				</span>Total Oportunidades de Negocio
			</a>
		</li>
	</ul>

</div>


<p>
	<?php

	echo $this->Html->link("Crear Nueva Propuesta", array(
			'action' => 'add'), array(
			'height'=>'15',
			'width' =>'15',
			'url'    => array('action'=> 'add'),
			'class' => 'btn btn-default',
			'role' => 'button'
		));
	?>
</p>
</br>



  <div class="table-responsive">
	<!--<table class="table table-bordered">

		<tr >
			<th class="headerlist" align="center" width = "10%" >
				Id
			</th>
			<th class="headerlist" align="center" width = "10%" >
				Cliente
			</th>
			<th class="headerlist" align="center" width = "40%" >
				Descripcion
			</th>
			<th class="headerlist" align="center" width = "10%" >
				Estado
			</th>
			<th class="headerlist" align="center" width = "15%" >
				Fecha de Creación
			</th>
			<td class="headerlist" width = "5%"colspan ="4" align ="center">
				Accion
			</td>

		</tr>

		<?php
		foreach($Proffers as $Proffer): ?>

		<tr>
			<td>
				<?php echo $Proffer['Proffer']['id']; ?>
			</td>
			<td>
				<?php echo $Proffer['Customer']['name']; ?>
			</td>
			<td>
				<?php echo $this->Html->link($Proffer['Proffer']['description'], array('action'=> 'view',$Proffer['Proffer']['id']));?>
			</td>
			<td>
				<?php echo $Proffer['Proffer']['state']; ?>
			</td>
			<td>
				<?php echo $Proffer['Proffer']['created']; ?>
			</td>

			<td align="center">
				<?php

				echo $this->Html->image("icon/btn_ok_w.png", array(
						"tittle"=> "Anexar documento",

						'height'=>'15',
						'width' =>'15',
						'url'    => array('action'=> 'state',$Proffer['Proffer']['id']),
					));

				?>

			</td>

			<td align="center">
				<?php

				echo $this->Html->image("icon/edit.png", array(
						"tittle"=> "Editar",

						'height'=>'15',
						'width' =>'15',
						'url'    => array('action'=> 'edit',$Proffer['Proffer']['id']),
					));

				?>
			</td>
			<td align="center">
				<?php
				echo $this->Form->postLink(
					$this->Html->image('icon/trash.png', array('alt'   => __('Effacer'),'height'=>'15',
							'width' =>'15')), //le image
					array('action'=> 'delete',$Proffer['Proffer']['id'] ), //le url
					array('escape'=> false), //le escape
					__('Esta seguro de borrar', $Proffer['Proffer']['id']) //le confirm
				);
				?>
			</td>

		</tr>


		<?php endforeach; ?>
	</table>
	
	-->
	<table id="list"></table>
	<div id="page"></div>
	
</div>
<script type="text/javascript">
var getColumnIndexByName = function(grid,columnName) {
        var cm = grid.jqGrid('getGridParam','colModel'), i=0,l=cm.length;
        for (; i<l; i+=1) {
            if (cm[i].name===columnName) {
                return i; // return the index
            }
        }
        return -1;
    };
jQuery(document).ready(function($){
	jQuery("#list").jqGrid({
   	url:'<?php echo $this->Html->url(array("controller" => "Proffers", "action" => "showGridProffer")); ?>',
	datatype: "json",
	mtype: "GET",
   	colNames:['id','Cliente','Descripcion','Estado','Fecha de Expiracion','Acciones'],
   	colModel:[
   	   {name:'id',index:'id',hidden:true,width:10},
   		{name:'name',index:'name',editable:true},
   		{name:'description',index:'description',editable:true},
   		{name:'state',index:'state',width:50},
   		{name:'expired',index:'expired'},
   		{name: 'action', width:70, fixed:true, sortable:false,formatter:'actions', resize:false, formatoptions:{editbutton:false,delbutton:true,keys:true,delOptions:{
       url:'<?php echo $this->Html->url(array("controller" => "Proffers", "action" => "delete"));?>',
        mtype: "POST",
                      onclickSubmit :function(params, postdata) {
                        params.url = '<?php echo $this->Html->url(array("controller" => "Proffers", "action" => "delete"));?>'+'/'+postdata ;
                      }
        }
        }}
   	],
   	rowNum:10,
	rowList : [5,10,15],
	
	rownumWidth: 40,
   	pager: jQuery('#page'),
   	sortname: 'id',
    sortorder: 'asc',
    loadonce: true,
	caption: "Administracion de Propuestas",
	height:"auto",
     autowidth:true,
     loadComplete: function () {
    var grid = $(this),
        iCol = getColumnIndexByName(grid,'action'); // 'act' - name of the actions column
    grid.children("tbody")
        .children("tr.jqgrow")
        .children("td:nth-child("+(iCol+1)+")")
        .each(function() {
            $("<div>",
                {
                    title: "editar la propuesta seleccionado",
                    mouseover: function() {
                        $(this).addClass('ui-state-hover');
                    },
                    mouseout: function() {
                        $(this).removeClass('ui-state-hover');
                    },
                    click: function(e) {
                        document.location.href = "proffers/edit/"+$(e.target).closest("tr.jqgrow").attr("id");
                    }
                }
              ).css({"margin-left": "5px", float:"left"})
               .addClass("ui-pg-div ui-inline-custom")
               .append('<span class="ui-icon ui-icon-pencil"></span>')
               .appendTo($(this).children("div"));
    });
},
     viewrecords: true,
     ondblClickRow: function (rowid) {
        var rowData = $(this).getRowData(rowid);
        document.location.href = "proffers/view/" + rowData['id'];
    }
	});
    jQuery("#list").navGrid("#page",{del:true,add:false,edit:true,search:false});	
    jQuery("#list").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});
    });
</script>