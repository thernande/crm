<?php echo $this->Html->script('bootstrap/bootstrap-tab'); ?>
<?php echo $this->Html->script('bootstrap/bootstrap-modal'); ?>
<?php echo $this->Html->css('ui.jqgrid'); ?>
<?php echo $this->Html->css('ui.multiselect');?>
<?php echo $this->Html->css('jquery-ui-1.9.2.custom');?>
<?php echo $this->Html->script('jquery-1.7.2.min');?>
<?php echo $this->Html->script('jqGrid/grid.locale-es');?>
<?php echo $this->Html->script('jqGrid/jquery.jqGrid.min');?>
<?php echo $this->Html->script('jquery-ui-1.9.2.custom.min');?>
<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
   <li><?php echo $this->Html->link("Clientes", array('controller' => 'Customers',  'action' => 'index')); ?></li>
  <li class="active"> Ver detalle de Cliente </li>
</ol>


<!-- Modal form add contact -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Registrar Nuevo Contacto</h4>
      </div>

      <div class="modal-body">
      <?php echo $this->Form->create('Contact',array( 'url' => array('controller' => 'contacts', 'action' => 'add'), 'class' => 'form-horizontal' )  ); ?>  
           
      
      <?php echo $this->Form->input('customer_id', array( 'type' => 'hidden', 'value' =>  $customer_id )); ?> 
      
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Nombre</label>
        <div class="col-lg-10">
         <?php echo $this->Form->input('name', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
        </div>
      </div>
      
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Telefono</label>
        <div class="col-lg-10">
         <?php echo $this->Form->input('phone', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
        </div>
      </div>

      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
         <?php echo $this->Form->input('email', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
        </div>
      </div>
<?php echo $this->Form->input('state', array( 'type' => 'hidden', 'value' =>  'Activo' )); ?>
        <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
              <?php echo $this->Form->end(__('Salvar')); ?>
          </div>
        </div>

       
       </div>
       <div class="modal-footer">
        <a class="img-responsive" alt="Responsive image" ><?php echo $this->Html->image('logo/logo.png')?></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class ="container">


  <h3>Detalle del Cliente</h3>
 
 

  <div id="content">
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#data" data-toggle="tab">Datos Basicos</a></li>
        <li><a href="#note" data-toggle="tab" >Notas</a></li>
        <li><a href="#contact" data-toggle="tab" >Contactos</a></li>
    </ul>
    
    
    <div id="my-tab-content" class="tab-content">
        
        <!-- tab 1-->
        <div class="tab-pane active " id="data">
        
        <h2><span class="label label-warning">Datos </span></h2>      
           <div class="form-group">
           <label for="" class="control-label">Nombre : </label>
           <?php echo $Customer['Customer']['name'] ?>
          </div>


        <div class="form-group">
          <label for="" class="control-label">Telefonos:</label>
          <?php echo $Customer['Customer']['phone'] ?>
        </div>

        <div class="form-group">
          <label for="" class="control-label">Dirección : </label>
          <?php echo $Customer['Customer']['dress'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">Municipio : </label>
          <?php echo $Customer['Municipality']['name'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">Email : </label>
          <?php echo $Customer['Customer']['email'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">Estado : </label>
          <?php echo $Customer['Customer']['state'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">Funcionario responsable : </label>
          <?php echo $Customer['User']['name'] ?>
        </div> 

        </div>
        <!-- tab 2-->
        <div class="tab-pane " id="note">
            
            <h2><span class="label label-warning">Notas</span></h2>
                <div class="form-group">
                  <div class ="success">
                  <?php echo $Customer['Customer']['note'] ?>
                  </div>
                </div> 

        </div>
        <!-- tab 3-->
        <div class="tab-pane " id="contact">
           
                      <h2><span class="label label-warning">Contactos</span></h2>

                        <br>
                        <a href="#myModal" role="button" class="btn btn-default" data-toggle="modal" > Crear Nuevo Contacto</a>
                        <br>
                        
                        
                        <br>
           				<div id="table">
							<table id="list"></table>
							<div id="page"></div>
  						</div>
                      <!-- <table class="table table-bordered">

                        <tr >
                        <th class="headerlist" align="center" width = "40%" >Nombre</th>
                        <th class="headerlist" align="center" width = "20%" >Telefono</th>
                        <th class="headerlist" align="center" width = "10%" >Email</th>
                        <th class="headerlist" align="center" width = "10%" >Estado</th>
                        <th class="headerlist" align="center" width = "10%" >Fecha de Creación</th>
                        <td class="headerlist" width = "10%"colspan ="2" align ="center">Accion</td>
                        
                        </tr>
                        
                              <?php foreach ($Contacts as $Contact): ?>
                              
                              
                              <td><?php echo $Contact['Contact']['name'];?></td>
                              <td><?php echo $Contact['Contact']['phone']; ?></td>    
                              <td><?php echo $Contact['Contact']['email']; ?></td>
                              <td><?php echo $Contact['Contact']['state']; ?></td>
                              <td><?php echo $Contact['Contact']['created']; ?></td>
                              <td align="center">
                              <?php 

                              echo $this->Html->image("icon/edit.png", array(
                                  "tittle" => "Editar",

                                  'height'=>'15',
                                  'width'=>'15',
                                  'url' => array('controller' => 'Contacts','action' => 'edit', $Contact['Contact']['id']),
                              ));

                              ?>
                              </td>
                              <td align="center">
                              <?php 
                              echo $this->Form->postLink(
                                  $this->Html->image('icon/trash.png', array('alt' => __('Effacer'), 'height'=>'15',
                                  'width'=>'15')), //le image
                                  array( 'controller' => 'contacts','action' => 'delete',$Contact['Contact']['id'] ), //le url
                                  array('escape' => false), //le escape
                                  __('Esta seguro de borrar', $Contact['Contact']['id']) //le confirm
                                );
                              ?>
                              </td>
                              </tr>
                              <?php endforeach; ?>
                          
                            </table> -->
                            



        </div>
 

            
        </div>

        
    </div>





</div> <!-- container -->

<script type="text/javascript">
    jQuery(document).ready(function () {
        
        $("#list").jqGrid({
        	url:'<?php echo $this->Html->url(array("controller" => "contacts", "action" => "showGridContact", $Customer["Customer"]["id"])); ?>',
        	datatype:"json",
        	mtype:"GET",
        	colNames:['id', 'Nombre', 'Telefono', 'Email', 'Estado', 'Fecha de Creacion', 'Acciones'],
        	colModel:[
        		{name:'id',index:'id',hidden:true,width:10},
   				{name:'name',index:'name',editable:true},
   				{name:'phone',index:'phone',editable:true},
   				{name:'email',index:'email',editable:true},
   				{name:'state',index:'state',width:50},
   				{name:'created',index:'created'},
   				{name: 'action', width:70, fixed:true, sortable:false,formatter:'actions', resize:false, formatoptions:{editbutton:true,delbutton:true,keys:true,delOptions:{
       url:'<?php echo $this->Html->url(array("controller" => "Contacts", "action" => "delete"));?>',
        mtype: "POST",
                      onclickSubmit :function(params, postdata) {
                        params.url = '<?php echo $this->Html->url(array("controller" => "Contacts", "action" => "delete"));?>'+'/'+postdata ;
                      }
        }          
              
        }}
        	],
        rowNum:10,
		rowList : [5,10,15],
		editurl:'<?php echo $this->Html->url(array("controller" => "Contacts", "action" => "edit"));?>',
		rownumWidth: 40,
   		pager: jQuery('#page'),
   		sortname: 'id',
   	 	sortorder: 'asc',
    	loadonce: true,
		caption: "Contactos",
		height:"auto",
		autowidth: true,
        
		viewrecords: true
        });
        jQuery("#list").navGrid("#page",{del:true,add:false,edit:false,search:false});
    });


</script>    

