
<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
   <li><?php echo $this->Html->link("Propuestas de Negocio", array('controller' => 'Proffers',  'action' => 'index')); ?></li>
  <li class="active"> Ver detalle de Propuesta de Negocio </li>
</ol>




<div class ="container">


  <h3>Detalle de la propuesta de negocio</h3>
 

  <div id="content">
    <div id="my-tab-content" class="tab-content">
        
  
        <h2><span class="label label-warning">Datos </span></h2>      
           <div class="form-group">
           <label for="" class="control-label">Nombre del cliente : </label>
           <?php echo $Proffer['Customer']['name'] ?>
          </div>


        <div class="form-group">
          <label for="" class="control-label">Contacto:</label>
          <?php echo $Proffer['Contact']['name'] ?>
        </div>

        <div class="form-group">
          <label for="" class="control-label">Linea de Negocio : </label>
          <?php echo $Proffer['Proffer']['line'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">Modalidad : </label>
          <?php echo $Proffer['Proffer']['mode'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">Descripcion : </label>
          <?php echo $Proffer['Proffer']['description'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">fecha de creacion : </label>
          <?php echo $Proffer['Proffer']['created'] ?>
        </div> 

        <div class="form-group">
          <label for="" class="control-label">fecha de expiracion : </label>
          <?php echo $Proffer['Proffer']['expired'] ?>
        </div> 

        </div>
 
        
    </div>


</div> <!-- container -->
