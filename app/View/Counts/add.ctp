<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('Count',array('role'=> 'form')); ?>
    <fieldset>
        <legend><?php echo __('Crear Cuenta'); ?></legend>
    <?php
        echo $this->Form->input('countname',array('placeholder' => 'asasasa', 'class' =>'form-control' ) );
        echo $this->Form->input('email');
        echo $this->Form->input('password');
  ?>
    
  
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>