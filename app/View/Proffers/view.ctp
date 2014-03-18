<?php echo $this->Html->script('bootstrap/bootstrap-tab'); ?>
<?php echo $this->Html->script('bootstrap/bootstrap-modal'); ?>

<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
   <li><?php echo $this->Html->link("Propuestas de Negocio", array('controller' => 'Proffers',  'action' => 'index')); ?></li>
  <li class="active"> Ver detalle de Propuesta de Negocio </li>
</ol>
<div class ="container">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Subir Documento</h4>
      </div>
	<!-- formulario para la subir los archivos(oculto hasta que se oprime el boton subir archivo) -->
      <div class="modal-body">
      <?php echo $this->Form->create('File',array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'controller' => 'Files', 'action' => 'add')  ); ?>  
           
      
      <?php echo $this->Form->input("customer", array( 'type' => 'hidden', 'value' =>  $Proffer['Customer']['name'] )); ?> 
      <?php echo $this->Form->input("customer_id", array( 'type' => 'hidden', 'value' =>  $Proffer['Customer']['id'] )); ?> 
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">descripcion</label>
        <div class="col-lg-10">
         <?php echo $this->Form->textarea('description', array('class' => 'ckeditor', 'cols' => '50', 'rows' => '5')); ?>
        </div>
      </div>
      
      <?php echo $this->Form->input('proffer_id', array('type'=>'hidden', 'value' => $Proffer['Proffer']['id'])); ?>		

      <div class="form-group">
        <div class="col-lg-10">
         <?php echo $this->Form->file('file'); ?>
        </div>
      </div>

        <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
              <?php echo $this->Form->end(__('subir')); ?>
          </div>
        </div>

       
       </div>
       <!-- final del formulario -->
       <div class="modal-footer">
        <a class="img-responsive" alt="Responsive image" ><?php echo $this->Html->image('logo/logo.png')?></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>





  <h3>Detalle de la propuesta de negocio</h3>
 
 <div id="content">
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#data" data-toggle="tab">Datos Basicos</a></li>
        <li><a href="#file" data-toggle="tab" >archivos</a></li>
    </ul>

  <div id="content">
    <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="data">      
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
		<div class="tab-pane " id="file">
			<h2><span class="label label-warning">Archivos</span></h2>

                        <br>
                        <a href="#myModal" role="button" class="btn btn-default" data-toggle="modal" >subir archivo</a>
                        </br>
                        
                        <br>
                        </br>
           
                        <table class="table table-bordered">

                        <tr >
                        <th class="headerlist" align="center" width = "30%" >archivo</th>
                        <th class="headerlist" align="center" width = "60%" >descripcion</th>
                        <th class="headerlist" align="center" width = "10%" >version</th>
                        <th class="headerlist" align="center" width = "10%" >acciones</th>

                        
                        </tr>
                        
                              <?php foreach ($Files as $File): ?>
                              
                              <tr>
                              <td align="center"><?php echo $this->Html->link($File['File']['name'],$File['File']['url']); ?></td>
                              <td><?php echo $File['File']['description'];?></td>
                              <td align="center"><?php echo $File['File']['version'];?></td>
                              <td><?php echo $this->Form->postLink(
                              $this->Html->image("icon/trash.png", array(
                                  "tittle" => "Eliminar",

                                  'height'=>'15',
                                  'width'=>'15')),
                                  array('action' => 'delete', $File['File']['id']),
                                  array('escape'=>false),
                                  __('desea eliminar el archivo?', $File['File']['id'])
                              );?></td>
                              </tr>
                              <?php endforeach;    ?>
                        </table>
		</div>
        </div>
 
        
    </div>
	</div>

</div> <!-- container -->
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });


</script>  