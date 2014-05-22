<?php echo $this->Html->script('bootstrap/bootstrap-tab'); ?>
<?php echo $this->Html->script('bootstrap/bootstrap-modal'); ?>
<?php echo $this->Html->css('ui.jqgrid'); ?>
<?php  echo $this->Html->css('ui.multiselect');?>
<?php   echo $this->Html->css('jquery-ui-1.9.2.custom');?>
<?php echo $this->Html->script('jquery-1.7.2.min');?>
<?php echo $this->Html->script('jqGrid/grid.locale-es');?>
<?php echo $this->Html->script('jqGrid/jquery.jqGrid.min');?>
<?php echo $this->Html->script('jquery-ui-1.9.2.custom.min');?>
<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
   <li><?php echo $this->Html->link("Propuestas de Negocio", array('controller' => 'Proffers',  'action' => 'index')); ?></li>
  <li class="active"> Ver detalle de Propuesta de Negocio </li>
</ol>
<div class ="container">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Subir Documento</h4>
      </div>
	<!-- formulario para la subir los archivos(oculto hasta que se oprime el boton subir archivo) -->
      <div class="modal-body">
      <?php echo $this->Form->create('File',array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'controller' => 'Files', 'action' => 'add')  ); ?>  
           
      
      <?php echo $this->Form->input("customer", array( 'type' => 'hidden', 'value' =>  $Proffer['Customer']['name'] )); ?> 
      <?php echo $this->Form->input("customer_id", array( 'type' => 'hidden', 'value' =>  $Proffer['Customer']['id'] )); ?> 
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">descripcion</label>
        <div class="col-lg-10">
         <?php echo $this->Form->textarea('description', array('class' => 'ckeditor', 'cols' => '50', 'rows' => '5')); ?>
        </div>
      </div>
      
      <?php echo $this->Form->input('proffer_id', array('type'=>'hidden', 'value' => $Proffer['Proffer']['id'])); ?>		

      <div class="form-group">
        <div class="col-lg-10">
         <?php echo $this->Form->file('file'); ?>
        </div>
      </div>

        <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
              <?php echo $this->Form->end(__('subir')); ?>
          </div>
        </div>

       
       </div>
       <!-- final del formulario -->
       <div class="modal-footer">
        <a class="img-responsive" alt="Responsive image" ><?php echo $this->Html->image('logo/logo.png')?></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>





  <h3>Detalle de la propuesta de negocio</h3>
 
 <div id="content">
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#data" data-toggle="tab">Datos Basicos</a></li>
        <li><a href="#file" data-toggle="tab" >archivos</a></li>
    </ul>

  <div id="content">
    <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="data">      
           <div class="form-group">
           <label for="" class="control-label">Nombre del cliente : </label>
           <?php echo $Proffer['Customer']['name'] ?>
          </div>


        <?php foreach ($Funcionality as $Functionary): ?>
		
		<div class="form-group">
          <label for="" class="control-label">Funcionario : </label>
          <?php echo $Functionary['Functionary']['name'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">Cargo : </label>
          <?php echo $Functionary['Functionary']['position'] ?>
        </div> 
		
		<?php endforeach; ?>

        <div class="form-group">
          <label for="" class="control-label">Linea de Negocio : </label>
          <?php echo $Proffer['Proffer']['line'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">Modalidad : </label>
          <?php echo $Proffer['Proffer']['mode'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">Descripcion : </label>
          <?php echo $Proffer['Proffer']['description'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">fecha de creacion : </label>
          <?php echo $Proffer['Proffer']['created'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">fecha de expiracion : </label>
          <?php echo $Proffer['Proffer']['expired'] ?>
        </div> 
		</div>
		<div class="tab-pane " id="file">
			<h2><span class="label label-warning">Archivos</span></h2>

                        <br>
                        <a href="#myModal" role="button" class="btn btn-default" data-toggle="modal" >subir archivo</a>
                        </br>
                        
                        <br>
                        </br>
                        
                        <table id="list"></table>
                        <div id="page"></div>
           
                       <!-- <table class="table table-bordered">

                        <tr >
                        <th class="headerlist" align="center" width = "30%" >archivo</th>
                        <th class="headerlist" align="center" width = "60%" >descripcion</th>
                        <th class="headerlist" align="center" width = "10%" >version</th>
                        <th class="headerlist" align="center" width = "10%" >acciones</th>

                        
                        </tr>
                        
                              <?php foreach ($Files as $File): ?>
                              
                              <tr>
                              <td align="center"><?php echo $this->Html->link($File['File']['name'],$File['File']['url']); ?></td>
                              <td><?php echo $File['File']['description'];?></td>
                              <td align="center"><?php echo $File['File']['version'];?></td>
                              <td><?php echo $this->Form->postLink(
                              $this->Html->image("icon/trash.png", array(
                                  "tittle" => "Eliminar",

                                  'height'=>'15',
                                  'width'=>'15')),
                                  array('action' => 'delete', $File['File']['id']),
                                  array('escape'=>false),
                                  __('desea eliminar el archivo?', $File['File']['id'])
                              );?></td>
                              </tr>
                              <?php endforeach;    ?>
                        </table> -->
		</div>
        </div>
 
        
    </div>
	</div>

</div> <!-- container -->

<script type="text/javascript">


	function LinkFormatter(cellvalue, options, rowObject) {
		return '<a href="http:/comercial'+rowObject[1]+'">'+cellvalue+'</a>';
		}
    jQuery(document).ready(function ($) {
        $("#list").jqGrid({
        	url:'<?php echo $this->Html->url(array("controller" => "files", "action" => "showGridFile", $Proffer["Proffer"]["id"])); ?>',
        	datatype:"json",
        	mtype:"POST",
        	colNames:['id', 'url', 'Archivo', 'Descripcion', 'version', 'Acciones'],
        	colModel:[
        		{name:'id',index:'id',hidden:true,width:10},
        		{name:'url',index:'url',hidden:true,width:10},
   				{name:'name',index:'name', formatter:LinkFormatter},
   				{name:'description',index:'description'},
   				{name:'version',index:'version'},
   				{name: 'action', width:70, fixed:true, sortable:false,formatter:'actions', resize:false, formatoptions:{editbutton:false,delbutton:true,keys:true,delOptions:{
       url:'<?php echo $this->Html->url(array("controller" => "Files", "action" => "delete"));?>',
        mtype: "POST",
                      onclickSubmit :function(params, postdata) {
                        params.url = '<?php echo $this->Html->url(array("controller" => "files", "action" => "delete"));?>'+'/'+postdata ;
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
		caption: "Archivos",
		height:"auto",
		width: 1000,
        
		viewrecords: true
        });
		
        jQuery("#list").navGrid("#page",{del:true,add:false,edit:false,search:false});
    });



</script>  