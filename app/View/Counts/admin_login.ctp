
  <body>    
  
  <div class="row" style="padding: 100px 0;">
  
    
      <div class="col-6 col-sm-4 col-lg-4">
            
          <a class="img-responsive" alt="Responsive image" ><?php echo $this->Html->image('1logo/logo_app.png')?></a>
          
          <div class="users form">
              <?php echo $this->Session->flash('auth'); ?>
              <?php echo $this->Form->create('User'); ?>
                  <fieldset>
                      <legend><?php echo __('Favor Ingrese su Usuario y Contraseña'); ?></legend>
                  <?php
                      echo $this->Form->input('username');
                      echo $this->Form->input('password');
                  ?>
                  </fieldset>
              <?php echo $this->Form->end(__('Login')); ?>
            
          </div>
  


                  
       </div>
 
 </div>
        
        
  

          <footer class ="footer" >
            <div class="container" align = "center">
              <p>Integral sotf</p>
            </div>
          </footer>

      
</body>
