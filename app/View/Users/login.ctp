
  <body>    

  <div class="row" style="padding: 100px 0;">
  
      
       <div class="col-6 col-sm-4 col-lg-4" >
       <p></P>
      </div> 
      <div class="col-6 col-sm-4 col-lg-4" >
       <img class="img-responsive"  ><?php echo $this->Html->image('logo/image_login.png')?></img>
      </div>  
  
      <div class="col-6 col-sm-4 col-lg-4">
            
          <a class="img-responsive" alt="Responsive image" ><?php echo $this->Html->image('logo/logo_app.png')?></a>
          
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
            <?php echo $this->Html->link("Recuperar Contraseña",array("controller"=>"users","action"=>"forgetpass")); ?>
          </div>
  


                  
       </div>
 
 </div>
        
        
  

          <footer class ="footer" >
            <div class="container" align = "center">
              <p>Empresa para la Seguridad Urbana</p>
            </div>
          </footer>

    
</body>
