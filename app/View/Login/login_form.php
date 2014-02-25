<fieldset class="user_form">
  
  <div class="control-group">
  <?php
   echo $this->Form->input('name', array('label' => false, 'div' => array('class' => 'controls')));
  ?>
  </div>
  
  <div class="control-group">
  <?php
  echo $this->Form->label('description', 'Descripción', array('class' => 'control-label'));
  echo $this->Form->input('description', array('label' => false, 'div' => array('class' => 'controls')));
  ?>
  </div>
    
</fieldset>
