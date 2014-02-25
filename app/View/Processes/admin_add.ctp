<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Procesos", array('controller' => 'processes',  'action' => 'index')); ?></li>
  <li class="active"> Crear Proceso</li>
</ol>

  <?php   echo $this->Form->create('Process', array('class' => 'form-horizontal'));
   
  ?>  
   <h3> Crear Proceso</h3>
   
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Nombre del Proceso</label>
    <div class="col-lg-10">
     <?php echo $this->Form->textarea('name', array('label'=> false, 'rows' => '1', 'cols' => '140')); ?>
    </div>
  </div>
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Tipo</label>
    <div class="col-lg-10">
    <?php
      echo $this->Form->input('type', array('label' => false, 
                              'options' => array('Estrategico' => 'Estrategico', 'Misional' => 'Misional','Apoyo' => 'Apoyo','Evaluacion' => 'Evaluacion')));
     ?>  
    </div>
  </div>
  <div class="form-group">
    <label for="target" class="col-lg-2 control-label">Objetivo</label>
    <div class="col-lg-10">
      <?php echo $this->Form->textarea('target', array('label'=> false, 'rows' => '5', 'cols' => '140')); ?>
     </div>
  </div> 
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <?php echo $this->Form->end(__('Salvar')); ?>
    </div>
  </div>


 