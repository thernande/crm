<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link("Procesos", array('controller' => 'processes',  'action' => 'index')); ?></li>
  <li class="active"> Ver Proceso</li>
</ol>


  <h3>Descripcion de Proceso</h3>
  <br>
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Nombre del Proceso :</label>
    <div class="alert-control">
     <?php echo $process['Process']['name'] ?>
    </div>
  </div>
  <div class="form-group">
    <label for="name" class="col-lg-2 control-label">Tipo :</label>
    <div class="control">
    <?php echo $process['Process']['type'] ?>
    </div>
  </div>
  <div class="form-group">
    <label for="target" class="col-lg-2 control-label">Objetivo :</label>
    <div class="control">
      <?php echo $process['Process']['target'] ?>
     </div>
  </div> 
  
