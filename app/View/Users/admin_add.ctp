<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Usuarios", array('controller' => 'users',  'action' => 'index')); ?></li>
  <li class="active"> Crear Usuario</li>
</ol>

<?php   echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>  
   <h3> Crear Usuario</h3>
   <br>
<div class="form-group">  
    <label for="name" class="col-lg-2 control-label">Email</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('email', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Nombre</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('name', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
    </div>
  </div>

  <div class="form-group">  
    <label for="name" class="col-lg-2 control-label">Apellido</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('lastname', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
    </div>
  </div>


  

  <div class="form-group">  
    <label for="name" class="col-lg-2 control-label">Clave</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('password', array('label'=> false, 'type'=>'key', 'class' =>'form-control')); ?>
    </div>
  </div>


  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Grupo</label>
    <div class="col-lg-10">
    <?php

     echo $this->Form->input("group_id", array('label' => false, 'options' => $Groups, 'empty' => '-- Seleccione el grupo de usuario --')); 
    
     ?>  
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Area a la cual pertenece</label>
    <div class="col-lg-10">
    <?php
      
    echo $this->Form->input("area_id", array('label' => false, 'options' => $Areas, 'empty' => '-- Seleccione el proceso --')); 

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
