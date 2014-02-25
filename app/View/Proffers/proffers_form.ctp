


<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'pages',  'action' => 'home')); ?></li>
  <li><?php echo $this->Html->link("Propuestas de Negocio", array('controller' => 'Proffer',  'action' => 'index')); ?></li>
  <li class="active"> Registrar Nueva Propuesta</li>
</ol>


<?php   echo $this->Form->create('Proffer', array('class' => 'form-horizontal')); ?>  
   <h3>Registrar Oportunidad de Negocio</h3>
   <br>


 <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Cliente</label>
    <div class="col-lg-10">
    <?php

       //echo $this->Form->input('customer_id', array('label' => false, 'options' => $Customers,  'empty' => 'selecione elc cliente' ));   
      echo $this->Form->input('customer_id', array('onchange' => 'getContactsByCustomer(this.value)', 'options' => $customers, 'value' => $customer_id, 'empty' => '-Seleccione el cliente-', 'label' => false, 'div' => array('class' => 'controls')));  
     ?>  
    </div>
  </div>

  <div class="form-group">
    <label for="contact" class="col-lg-2 control-label">Contacto </label>
    <div class="col-lg-4">
    <?php

          
     echo $this->Form->input('contact_id', array('options' => $contacts, 'value' => $contact_id, 'empty' => '-Seleccione el Contacto-', 'label' => false, 'div' => array('class' => 'controls')));       
     ?>  
     
    </div>
  </div>
 
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Línea de Negocio</label>
    <div class="col-lg-10">
    <?php
      echo $this->Form->input('line', array('label' => false, 'empty' => '-Seleccione la linea-',
                              'options' => array('Combustible' => 'Combustible', 'Contratación de Personal' => 'Contratación de Personal', 'Logistica' => 'Logistica','SIS' => 'SIS', 'Vigilancia' => 'Vigilancia' )));
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


 <!--
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Hacer seguimiento en </label>
    <div class="col-lg-10">
    <?php

      //echo $this->Form->input('expired', array('label'=> false, 'type'=>'"text', 'class' =>'datepicker',   'data-date-format' => "mm/dd/yy", 'placeholder' =>"mm/dd/yy"  )); 

      ?>     
    </div>
  </div>
  -->




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

    function getContactsByCustomer(customerId) {
      jQuery.ajax({
      type: "POST",
      url: "<?php echo $this->Html->url(array('controller' => 'contacts', 'action' => 'html_contacts_by_customer')); ?>/" + customerId,

      success: function(data) {
        //console.log(data);

        $("#ProfferContactId").html(data);
        
      },
      dataType: "html"
    });

    }

  $(document ).ready(function() {
   var calendar = jQuery('#ProfferExpired').datepicker({
    'format': 'yyyy-mm-dd',
  }).on('changeDate', function(ev){
    //calendar.hide();
    calendar.datepicker('hide');
  });

  });  
   
    








 </script>