
<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
   <li><?php echo $this->Html->link("Areas", array('controller' => 'areas',  'action' => 'index')); ?></li>
  <li class="active"> Ver Area o Dependencia </li>
</ol>

  


  <h3>Descripcion del Area o Dependencia</h3>
 
 <table class ="borderer">
  <div class="form-group">
    <label for="" class="control-label">Nombre: </label>
    <div class="alert-control">
     <?php echo $Area['Area']['name'] ?>
    </div>
  </div>

  <div class="form-group">
    <label for="" class="control-label">Proceso al cual pertenece:</label>
    <div class="control">
    <?php echo $Area['Process']['name'] ?>
    </div>
  </div>

  <div class="form-group">
    <label for="" class="control-label">Tipo:</label>
    <div class="control">
       <?php echo $Area['Areastype']['name'] ?>
     </div>
  </div> 



  <div class="form-group">
    <label for="" class="control-label">Estado:</label>
    <div class="control">
      <?php echo $Area['Area']['state'] ?>
     </div>
  </div> 


 
 </table>