<?php echo $this->Html->script('ckeditor/ckeditor'); ?>

<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Clientes", array('controller' => 'customers',  'action' => 'index')); ?></li>
  <li class="active">Editar información del Cliente</li>
</ol>



<div id="container">



        <?php   echo $this->Form->create('Customer', array('action' => 'edit','class' => 'form-horizontal')); ?>

           <h3>Editar información del Cliente</h3>
           <br>
          <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Nombre o Razon Social</label>
            <div class="col-lg-4">
             <?php echo $this->Form->input('Customer.name', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
            </div>
          </div>

         
         <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Telefonos </label>
            <div class="col-lg-4">
             <?php echo $this->Form->input('Customer.phone', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
            </div>
          </div>


          <div class="form-group">  
            <label for="name" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-4">
             <?php echo $this->Form->input('Customer.email', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
            </div>
          </div>


          <div class="form-group">  
            <label for="name" class="col-lg-2 control-label">Dirección</label>
            <div class="col-lg-4">
             <?php echo $this->Form->input('Customer.dress', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
            </div>
          </div>


         <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Departamento</label>
            <div class="col-lg-10">
            <?php

             echo $this->Form->input("Customer.municipality_id", array('label' => false, 'options' => $Municipalities, 'empty' => '-- Seleccione el departamento --')); 
            
             ?>  
            </div>
          </div>


           <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Asignado a </label>
            <div class="col-lg-10">
            <?php

             echo $this->Form->input("Customer.user_id", array('label' => false, 'options' => $Users, 'empty' => '-- Seleccione el funcionario responsable --')); 
            
             ?>  
            </div>
          </div>

           <div class="form-group">
            <label for="name" class="col-lg-2 control-label">Notas</label>
            <div class="col-lg-5">
            <?php
              echo $this->Form->textarea('Customer.note', array(
                    'class' => 'ckeditor' 
              ));
             ?>  
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?php echo $this->Form->end(__('Salvar')); ?>
            </div>
          </div>

   

  </div>  <!-- div container -->
