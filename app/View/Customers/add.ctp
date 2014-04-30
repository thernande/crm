<?php echo $this->Html->script('ckeditor/ckeditor'); ?>

<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'page',  'action' => 'home')); ?></li>
  <li><?php echo $this->Html->link("Clientes", array('controller' => 'customers',  'action' => 'index')); ?></li>
  <li class="active"> Crear Nuevo Cliente</li>
</ol>


<?php   echo $this->Form->create('Customer', array('class' => 'form-horizontal')); ?>  
   <h3> Crear Nuevo Cliente</h3>
   <br>
   
   <div class="form-group">  
    <label for="name" class="col-lg-2 control-label">NIT</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('Customer.nit', array('label'=> false, 'type'=>'text', 'class' =>'form-control')); ?>
    </div>
  </div>
  
   
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Nombre o Razon Social</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('Customer.name', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
    </div>
  </div>

    
 

  <div class="form-group">  
    <label for="name" class="col-lg-2 control-label">Dirección</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('Customer.dress', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
    </div>
  </div>
  
  
  <div class="form-group">  
    <label for="name" class="col-lg-2 control-label">Dependencia</label>
    <div class="col-lg-4">
     <?php echo $this->Form->input('Customer.dependency', array('label'=> false, 'type'=>'text', 'class' =>'form-control')); ?>
    </div>
  </div>


 <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Departamento</label>
    <div class="col-lg-10">
    <?php

     echo $this->Form->input("Customer.municipality_id", array('onchange'=>'getCitiesByMunicipality(this.value)' ,'label' => false, 'options' => $Municipalities, 'empty' => '-- Seleccione el departamento --')); 
    
     ?>  
    </div>
  </div>
  
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Ciudad</label>
    <div class="col-lg-10">
    <?php

     echo $this->Form->input("Customer.city_id", array('label' => false, 'options' => '-- Seleccione el departamento --')); 
    
     ?>  
    </div>
  </div>


   <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Funcionario </label>
    <div class="col-lg-7">
   	 	<a id="agregarFuncionario" class="btn btn-info" href="#">Agregar Funcionario</a>
		<div id="con_Fun">
  			<br>
  			<tr>
  				<td><input type="textfield" value="Funcionario" class="form-control"></input></td>
			</tr>
		</div>
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


<script type="text/javascript">
function getCitiesByMunicipality(municipalityId) {
      jQuery.ajax({
      type: "POST",
      url: "<?php echo $this->Html->url(array('controller' => 'cities', 'action' => 'html_cities_by_municipality')); ?>/" + municipalityId,

      success: function(data) {
        //console.log(data);

        $("#CustomerCityId").html(data);
        
      },
      dataType: "html"
    });

    }
    
    $(document).ready(function() {

    var MaxInputs       = 5; //Número Maximo de Campos
    var contenedor       = $("#con_Fun"); //ID del contenedor
    var AddButton = $("#agregarFuncionario"); //ID del Botón Agregar

    //var x = número de campos existentes en el contenedor
    var x = $("#con_Fun td").length + 1;
    var FieldCount = x-1; //para el seguimiento de los campos

    $(AddButton).click(function (e) {
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            //agregar campo
            $(contenedor).append('<td><input type="textfield" class="form-control" id="Customer.functionary'+ FieldCount +'" value="Funcionario '+ FieldCount +'"> <label for ="functionary_' + FieldCount + '"></label><a href="#" class="eliminar">&times;</a></input></input></td>');
            x++; //text box increment
        }
        return false;
    });

    $("body").on("click",".eliminar", function(e){ //click en eliminar campo
        if( x > 1 ) {
            $(this).closest('td').remove(); //eliminar el campo
            x--;
        }
        return false;
    });
});
    
</script>

