<ol class="breadcrumb">
    <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Areas", array('controller' => 'areas',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Tipos", array('controller' => 'areastypes',  'action' => 'index')); ?></li>
  <li class="active">Crear Tipo de Area</li>
  
</ol>



<?php   echo $this->Form->create('AreasType', array('class' => 'form-horizontal')); ?>  
 <h3> Crear Area o Dependencia</h3>
 <br>
<div class="form-group">
  <label for="name" class="col-lg-2 control-label">Nombre</label>
  <div class="col-lg-10">
   <?php echo $this->Form->textarea('name', array('label'=> false, 'rows' => '1', 'cols' => '140')); ?>
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



<?php


echo $this->Session->flash();
echo $this->Session->read();
print_r($this->Session->read());



echo "<br> el  nombre del usuario es ".$user;


?>