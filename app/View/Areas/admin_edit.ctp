
  <ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Areas", array('controller' => 'areas',  'action' => 'index')); ?></li>
  <li class="active"> Editar Area</li>
  </ol>

  <?php   echo $this->Form->create('Area', array('action' => 'edit','class' => 'form-horizontal')); ?>
   

  <h3>Editar Area</h3>
 
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-10">
     <?php echo $this->Form->textarea('name', array('label'=> false, 'rows' => '1', 'cols' => '140')); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Tipo</label>
    <div class="col-lg-10">
    <?php
      
    echo $this->Form->input("areastype_id", array('label' => false, 'options' => $Areastypes, 'empty' => '-- Seleccione el tipo --')); 

     ?>  
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Proceso al cual pertenece</label>
    <div class="col-lg-10">
    <?php
      
    echo $this->Form->input("Process_id", array('label' => false, 'options' => $Processes, 'empty' => '-- Seleccione el proceso --')); 

     ?>  
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Estado</label>
    <div class="col-lg-10">
    <?php
      echo $this->Form->input('state', array('label' => false, 
                              'options' => array('Activo' => 'Activar', 'Inactivo' => 'Inactivar')));
     ?>  
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <?php echo $this->Form->end(__('Salvar')); ?>
    </div>
  </div>
