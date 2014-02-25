
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Contacto </label>
    <div class="col-lg-4">
    <?php

     //echo $this->Form->input("contact_id", array('label' => false, 'options' => $Contacts, 'empty' => '-- Seleccione el contacto a cargo --')); 
      
      echo $this->Form->input('contact_id', array('options' => $contacts, 'value' => $contact_id, 'empty' => '--', 'label' => false, 'div' => array('class' => 'controls')));       
     
     ECHO  'LOS CONTACTOS SON '.$contacts; 
     ?>  
     
    </div>
  </div>