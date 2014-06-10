<?php echo $this->Html->css('ui.jqgrid'); ?>
<?php  echo $this->Html->css('ui.multiselect');?>
<?php   echo $this->Html->css('jquery-ui-1.9.2.custom');?>
<?php echo $this->Html->script('jquery-1.7.2.min');?>
<?php echo $this->Html->script('jqGrid/grid.locale-es');?>
<?php echo $this->Html->script('jqGrid/jquery.jqGrid.min');?>
<?php echo $this->Html->script('jquery-ui-1.9.2.custom.min');?>

<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'pages',  'action' => 'index')); ?></li>
  <li class="active">Administración de Clientes</li>
</ol>

<h3 class="info">Administración de Clientes </h3>
<?php $user = $this->Session->read('User.username');
echo $user; ?>
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
function exportGrid(){
  
}

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
   	url:'<?php echo $this->Html->url(array("controller" => "Customers", "action" => "showGrid")); ?>',
	datatype: "json",
	mtype: "GET",
   	colNames:['id','NIT','Cliente','Direccion','Estado','Fecha de Creacion', 'Fecha de Modificacion', 'log','Acciones'],
   	colModel:[
   	   {name:'id',index:'id',hidden:true,width:10},
   	   {name:'nit',index:'nit',editable:true},
   		{name:'name',index:'name',editable:true},
   		{name:'dress',index:'dress',editable:true},
   		{name:'state',index:'state',width:50},
   		{name:'created',index:'created'},
   		{name:'modified',index:'modified'},
   		{name:'log',index:'log'},
   		{name: 'action', frozen:true, width:100, fixed:true, sortable:false,formatter:'actions', resize:false, formatoptions:{editbutton:false,delbutton:true,keys:true,delOptions:{
       url:'<?php echo $this->Html->url(array("controller" => "Customers", "action" => "delete"));?>',
        mtype: "POST",
                      onclickSubmit :function(params, postdata) {
                        params.url = '<?php echo $this->Html->url(array("controller" => "Customers", "action" => "delete"));?>'+'/'+postdata ;
                      }
        }
       /* editOptions:{
			click: function(e){
     		   document.location.href = "customers/edit/" + $(e.target).closest("tr.jqgrow").attr("id");
			}
		}*/
        }}
   	],
   	rowNum:10,
	rowList : [5,10,15],
	//editurl: '<?php echo $this->html->url(array("controller" => "customers", "action" => "edit")); ?>',
	rownumWidth: 40,
   	pager: jQuery('#page'),
   	sortname: 'id',
    sortorder: 'asc',
    loadonce: true,
	caption: "Administracion de Cliente",
	height:"auto",
     autowidth:true,
     
     subGrid:true,
     subGridRowExpanded: function(subgrid_id, row_id) {
     	var subgrid_table_id, pager_id;
		subgrid_table_id = subgrid_id+"_t";
		pager_id = "p_"+subgrid_table_id;
		$("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>");
		jQuery("#"+subgrid_table_id).jqGrid({
			url:'<?php echo $this->Html->url(array("controller" => "contacts", "action" => "showGridContact"));?>'+'/'+row_id,
			datatype: "json",
			colNames:['id', 'Nombre', 'Telefono', 'Celular', 'Email', 'Linea de Negocio', 'Cargo', 'Estado', 'Comercial', 'Fecha de Creacion', 'Fecha de Modificacion', 'Acciones'],
        	colModel:[
        		{name:'id',index:'id',hidden:true,width:10},
   				{name:'name',index:'name',editable:true},
   				{name:'phone',index:'phone',editable:true},
   				{name:'celphone',index:'celphone',editable:true},
   				{name:'email',index:'email',editable:true},
   				{name:'line',index:'line',editable:true},
   				{name:'position',index:'position',editable:true},
   				{name:'state',index:'state',width:50},
   				{name:'username',index:'username'},
   				{name:'created',index:'created'},
   				{name:'modified',index:'modified'},
   				{name: 'action', frozen:true, width:70, fixed:true, sortable:false,formatter:'actions', resize:false, formatoptions:{editbutton:true,delbutton:true,keys:true,delOptions:{
       url:'<?php echo $this->Html->url(array("controller" => "Contacts", "action" => "delete"));?>',
        mtype: "POST",
                      onclickSubmit :function(params, postdata) {
                        params.url = '<?php echo $this->Html->url(array("controller" => "Contacts", "action" => "delete"));?>'+'/'+postdata ;
                      }
        }          
              
        }}
			],
		   	rowNum:5,
		   	editurl:'<?php echo $this->Html->url(array("controller" => "Contacts", "action" => "edit"));?>',
		   	pager: pager_id,
		   	sortname: 'id',
		    sortorder: "asc",
		    height: 'auto',
		    autowidth:true
		});
		jQuery("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false})
		$(window).bind('resize', function() {
    	$("#"+subgrid_table_id).setGridWidth(($(window).width())-60);
	}).trigger('resize');
     },
     
     loadComplete: function () {
    var grid = $(this),
        iCol = getColumnIndexByName(grid,'action'); // 'act' - name of the actions column
        grid.children("tbody")
        .children("tr.jqgrow")
        .children("td:nth-child("+(iCol+1)+")")
        .each(function() {
            $("<div>",
                {
                    title: "editar cliente seleccionado",
                    mouseover: function() {
                        $(this).addClass('ui-state-hover');
                    },
                    mouseout: function() {
                        $(this).removeClass('ui-state-hover');
                    },
                    click: function(e) {
                        document.location.href = "customers/edit/"+$(e.target).closest("tr.jqgrow").attr("id");
                    }
                }
              ).css({"margin-left": "5px", float:"left"})
               .addClass("ui-pg-div ui-inline-custom")
               .append('<span class="ui-icon ui-icon-pencil"></span>')
               .appendTo($(this).children("div"));
    });
    grid.children("tbody")
        .children("tr.jqgrow")
        .children("td:nth-child("+(iCol+1)+")")
        .each(function() {
            $("<div>",
                {
                    title: "ver cliente seleccionado",
                    mouseover: function() {
                        $(this).addClass('ui-state-hover');
                    },
                    mouseout: function() {
                        $(this).removeClass('ui-state-hover');
                    },
                    click: function(e) {
                        document.location.href = "customers/view/"+$(e.target).closest("tr.jqgrow").attr("id");
                    }
                }
              ).css({"margin-left": "5px", float:"left"})
               .addClass("ui-pg-div ui-inline-custom")
               .append('<span class="ui-icon ui-icon-search"></span>')
               .appendTo($(this).children("div"));
    });
},
     viewrecords: true,
     
	});
    jQuery("#list").navGrid("#page",{del:false,add:false,edit:true,search:false}).navButtonAdd('#page',{ caption:"", buttonicon:'ui-icon-print', onClickButton: function(){
    	var grid = $("#list");
          var id = grid.jqGrid('getGridParam','sortname');
          var or = grid.jqGrid('getGridParam','sortorder');
          var num = grid.jqGrid('getGridParam','rowNum');
          var pag = grid.jqGrid('getGridParam','page');

          document.location.href ="customers/export?id="+id+"&or="+or+"&num="+num+"&pag="+pag;
    	}, position:"last" });	
    jQuery("#list").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false});
    
    $(window).bind('resize', function() {
    	$("#list").setGridWidth(($(window).width())-30);
	}).trigger('resize');
});

</script>

