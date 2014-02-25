<?php echo $this->Html->script('bootstrap/bootstrap-tab'); ?>
<?php echo $this->Html->script('bootstrap/bootstrap-modal'); ?>
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
      <?php echo $this->Form->create(null,array( 'url' => array('controller' => 'Contacts', 'action' => 'add'), 'class' => 'form-horizontal' )  ); ?>  
           
      
      <?php echo $this->Form->input("Contact.customer_id", array( 'type' => 'hidden', 'value' =>  $customer_id )); ?> 
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Nombre</label>
        <div class="col-lg-10">
         <?php echo $this->Form->input('Contact.name', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
        </div>
      </div>
      
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Telefono</label>
        <div class="col-lg-10">
         <?php echo $this->Form->input('Contact.phone', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
        </div>
      </div>

      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
         <?php echo $this->Form->input('Contact.email', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
        </div>
      </div>

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
                        <a href="#myModal" role="button" class="btn" data-toggle="modal" ><?php echo $this->Html->image("icon/btn_plus.png")?> Crear Nuevo Contacto</a>
                        </br>
                        
                        
                        </br>
           
                        <table class="table table-bordered">

                        <tr >
                        <th class="headerlist" align="center" whidth = "40%" >Nombre</th>
                        <th class="headerlist" align="center" whidth = "20%" >Telefono</th>
                        <th class="headerlist" align="center" whidth = "10%" >Email</th>
                        <th class="headerlist" align="center" whidth = "10%" >Estado</th>
                        <th class="headerlist" align="center" whidth = "10%" >Fecha de Creación</th>
                        <td class="headerlist" whidtd = "10%"colspan ="2" align ="center">Accion</td>
                        
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
                                  'url' => array('action' => 'edit', $Contact['Contact']['id']),
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
                          
                            </table>
        </div>
 

            
        </div>

        
    </div>





</div> <!-- container -->

<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });


</script>    

