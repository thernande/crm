
<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
   <li><?php echo $this->Html->link("Usuarios ", array('controller' => 'Users',  'action' => 'index')); ?></li>
  <li class="active"> Ver detalle de Usuario </li>
</ol>

  


  <h3>Detalle del Usuario</h3>
 
 <table class ="borderer">
  

  <div class="form-group">
    <label for="" class="control-label"> Usuario: </label>
    <div class="alert-control">
     <?php echo $User['User']['username'] ?>
    </div>
  </div>

  <div class="form-group">
    <label for="" class="control-label">Nombre: </label>
    <div class="alert-control">
     <?php echo $User['User']['name'] ?>
    </div>
  </div>


  <div class="form-group">
    <label for="" class="control-label">Apellido:</label>
    <div class="control">
    <?php echo $User['User']['lastname'] ?>
    </div>
  </div>

  <div class="form-group">
    <label for="" class="control-label">Perfil:</label>
    <div class="control">
       <?php echo $User['User']['role'] ?>
     </div>
  </div> 


  <div class="form-group">
    <label for="" class="control-label">Area a la cual pertenece </label>
    <div class="control">
      <?php echo $User['Area']['name'] ?>
     </div>
  </div> 



  <div class="form-group">
    <label for="" class="control-label">Estado </label>
    <div class="control">
      <?php echo $User['User']['state'] ?>
     </div>
  </div> 


 
 </table>