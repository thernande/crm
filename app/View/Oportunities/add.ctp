
<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'pages',  'action' => 'home')); ?></li>
  <li><?php echo $this->Html->link("Oportunidades de Negocio", array('controller' => 'oportunities',  'action' => 'index')); ?></li>
  <li class="active"> Registrar Nueva Oportunidad de Negocio</li>
</ol>

<?php 
   		echo $this->Form->create('Oportunity', array('class' => 'form-horizontal')); ?>  
   <h3>Registrar Oportunidad de Negocio</h3>
   <br>


 <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Cliente</label>
    <div class="col-lg-4">
    <?php

	   	echo $this->Form->input('customer_id', array( 'options' => $customers, 'value' => $customer_id, 'empty' => '--Seleccion El Cliente--', 'label' => false, 'class' => 'form-control'));

     ?>  
    </div>
  </div>

  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Línea de Negocio</label>
    <div class="col-lg-4">
    
    <?php
      echo $this->Form->input('LineModeOportunity.0.line_id', array('class' =>'form-control','label' => false, 'empty' => '-Seleccione la linea-',
                              'options' => array($line)));
     ?>  
     
     </div>
    
  </div>
  <div class="form-group">
   
    <label for="name" class="col-lg-2 control-label">Modalidad</label>
    <div class="col-lg-4">
    <?php
      echo $this->Form->input('LineModeOportunity.0.mode_id', array('class'=>'form-control','label' => false,'empty' => '-Seleccione la modalidad-', 
                              'options' => array($mode)));
     ?>  
     <br/>
     <a id="agregarLinea" class="btn btn-info" href="#">+ Linea de Negocio</a>
     <br/>
     <div id="con_Line">
    </div>
    
  </div>
  
</div>

<div class="form-group">
    <label for="name" class="col-lg-2 control-label">Linea de Negocio (otro) :</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('Line.line', array('label'=> false, 'type'=>'text', 'class' =>'form-control')); ?>
    </div>
  </div>
  
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Modalidad (otro) :</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('Mode.mode', array('label'=> false, 'type'=>'text', 'class' =>'form-control')); ?>
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
   
    
 $(document).ready(function() {

    var MaxInputs       = 5; //Número Maximo de Campos
    var contenedor       = $("#con_Line"); //ID del contenedor
    var AddButton = $("#agregarLinea"); //ID del Botón Agregar

    //var x = número de campos existentes en el contenedor
    var x = $("#con_Line td").length + 1;
    var FieldCount = x-1; //para el seguimiento de los campos

    $(AddButton).click(function (e) {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            //agregar campo
            $(contenedor).append('<div><br/><tr><td><select class="form-control" name="data[LineModeOportunity]['+x+'][line_id]" id="LineModeOportunity['+x+']line_id"><option>-Seleccione la linea-</option> <?php foreach($line as $lin): ?> <option value="<?php echo array_search($lin,$line); ?>"><?php echo $lin; ?></option> <?php endforeach; ?> </select><a href="#" class="eliminar">&times;</a></td></tr><br/><br/><tr><td><select class="form-control" name="data[LineModeOportunity]['+x+'][mode_id]" id="LineModeOportunity['+x+']mode_id"><option>-Seleccione la modalidad-</option> <?php foreach($mode as $mod): ?> <option value="<?php echo array_search($mod,$mode); ?>"><?php echo $mod; ?></option> <?php endforeach; ?> </select></td></tr></div>');
            x++; //text box increment
        }
        return false;
    });

    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).closest('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
});







 </script>
   
