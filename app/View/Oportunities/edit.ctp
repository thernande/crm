
<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'pages',  'action' => 'home')); ?></li>
  <li><?php echo $this->Html->link("Oportunidades de Negocio", array('controller' => 'Oportunity',  'action' => 'index')); ?></li>
  <li class="active"> Modificar Oportunidad de Negocio</li>
</ol>

<?php 
		echo $this->Form->create('Oportunity', array('class' => 'form-horizontal')); ?>
	<h3>Modificar Oportunidad de Negocio</h3>
   <br>


 <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Cliente</label>
    <div class="col-lg-10">
    <?php
	   		echo $this->Form->select('customer_id', array($customers),array('label' => false, 'div' => array('class' => 'controls')));
	   ?>
    </div>
  </div>

  
 
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Línea de Negocio</label>
    <div class="col-lg-10">
    <?php
      echo $this->Form->input('line', array('label' => false, 'empty' => '-Seleccione la linea-',
                              'options' => array('Combustible' => 'Combustible', 'Contratación de Personal' => 'Contratación de Personal', 'Logistica' => 'Logistica','SIS' => 'SIS', 'Vigilancia' => 'Vigilancia' ) ));
     ?>  
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Modalidad</label>
    <div class="col-lg-10">
    <?php
      echo $this->Form->input('mode', array('label' => false,'empty' => '-Seleccione la modalidad-', 
                              'options' => array('ADR' => 'ADR', 'CBS' => 'CBS' )));
     ?>  
    </div>
  </div>


 
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Hacer seguimiento en </label>
    <div class="col-lg-10">
    <?php

      echo $this->Form->input('expired', array('label'=> false, 'type'=>'"text', 'class' =>'datepicker',   'data-date-format' => "mm/dd/yy", 'placeholder' =>"mm/dd/yy"  )); 

      ?>     
    </div>
  </div>
 




  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Descripción</label>
    <div class="col-lg-3">
    <?php
      echo $this->Form->textarea('description', array(
            'rows' => '10', 
            'columns' => '20',
            'class' =>'form-control'
      ));
     ?>  
    </div>
  </div>



    <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
        <?php echo $this->Form->end(__('Salvar')); ?>
    </div>
  </div>




<script type="text/javascript">

  $(document ).ready(function() {
   var calendar = jQuery('#OportunityExpired').datepicker({
    'format': 'yyyy-mm-dd',
  }).on('changeDate', function(ev){
    //calendar.hide();
    calendar.datepicker('hide');
  });

  });  
   
    








 </script>
