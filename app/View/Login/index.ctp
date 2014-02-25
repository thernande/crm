
  <body>    
  
  <div class="container row" style="padding: 100px 0;">
  
      
      <div class=" span1" >
       <p>
      </div> 

      <div class=" span7" >
       <p><?php echo $this->Html->image('image_login.png')?></P>
      </div>  
  
      <div class="span4">
          <p><?php echo $this->Html->image('logo_app.png')?></P>
          
          
          <div class="users form">
              <?php echo $this->Session->flash('auth'); ?>
              <?php echo $this->Form->create('User'); ?>
                  <fieldset>
                      <legend><?php echo __('Please enter your username and password'); ?></legend>
                  <?php
                      echo $this->Form->input('username');
                      echo $this->Form->input('password');
                  ?>
                  </fieldset>
              <?php echo $this->Form->end(__('Login')); ?>
            
          </div>
  


                  
       </div>
 
 </div>
        
        
  

      
</body>
