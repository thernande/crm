<?php echo $this->Html->script('bootstrap/bootstrap-tab'); ?>
<?php echo $this->Html->script('bootstrap/bootstrap-modal'); ?>

<ol class="breadcrumb">
  <li><?php echo $this->Html->link("Home", array('controller' => 'admin',  'action' => 'index')); ?></li>
   <li><?php echo $this->Html->link("Propuestas de Negocio", array('controller' => 'Proffers',  'action' => 'index')); ?></li>
  <li class="active"> Ver Documentos Anexados </li>
</ol>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Subir Documento</h4>
      </div>

      <div class="modal-body">
      <?php echo $this->Form->create('File',array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'action' => 'add')  ); ?>  
           
      
      <?php echo $this->Form->input("customer", array( 'type' => 'hidden', 'value' =>  $Proffer['Customer']['name'] )); ?> 
      <?php echo $this->Form->input("customer_id", array( 'type' => 'hidden', 'value' =>  $Proffer['Customer']['id'] )); ?> 
      <div class="form-group">
        <label for="name" class="col-lg-2 control-label">Nombre</label>
        <div class="col-lg-10">
         <?php echo $this->Form->input('name', array('label'=> false, 'type'=>'"text', 'class' =>'form-control')); ?>
        </div>
      </div>
      
      <?php echo $this->Form->input('proffer_id', array('type'=>'hidden', 'value' => $Proffer['Proffer']['id'])); ?>		
      <?php echo $this->Form->input('url', array('type'=>'hidden', 'value' => '')); ?>

      <div class="form-group">
        <div class="col-lg-10">
         <?php echo $this->Form->file('file'); ?>
        </div>
      </div>

        <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
              <?php echo $this->Form->end(__('Subir')); ?>
          </div>
        </div>

       
       </div>
       <div class="modal-footer">
        <a class="img-responsive" alt="Responsive image" ><?php echo $this->Html->image('logo/logo.png')?></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<div id="content">
	<h2><span class="label label-warning">Archivos</span></h2>

                        <br>
                        <a href="#myModal" role="button" class="btn" data-toggle="modal" ><?php echo $this->Html->image("btn_plus_file.png");?></a>
                        </br>
                        
                        <br>
                        </br>
           
                        <table class="table table-bordered">

                        <tr >
                        <th class="headerlist" align="center" width = "70%" >archivo</th>
                        <th class="headerlist" align="center" width = "30%" >acciones</th>

                        
                        </tr>
                        
                              <?php foreach ($Files as $File): ?>
                              
                              <tr>
                              <td align="center"><?php echo $this->Html->link($File['File']['name'],$File['File']['url']); ?></td>
                              <td><?php echo $this->Html->image("icon/trash.png", array(
                                  "tittle" => "Eliminar",

                                  'height'=>'15',
                                  'width'=>'15',
                                  'url' => array('action' => 'delete', $File['File']['id'])
                              ));?></td>
                              </tr>
                              <?php endforeach;    ?>
                        </table>
</div>