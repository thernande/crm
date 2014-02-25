
<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Areas", array('controller' => 'areas',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Tipos", array('controller' => 'areastypes',  'action' => 'index')); ?></li>
  <li class="active"> Ver  Tipo de Area</li>
</ol>

  


  <h3>Descripcion del  Tipo de Area</h3>
 
 <table class ="borderer">
  <div class="form-group">
    <label for="" class="control-label">Nombre: </label>
    <div class="alert-control">
     <?php echo $AreasType['AreasType']['name'] ?>
    </div>
  </div>

 
  <div class="form-group">
    <label for="" class="control-label">Estado:</label>
    <div class="control">
      <?php echo $AreasType['AreasType']['state'] ?>
     </div>
  </div> 



 
 </table>