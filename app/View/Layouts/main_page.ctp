<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', '');

?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $title_for_layout; ?>
    </title>
    <?php
        echo $this->Html->meta('icon');

    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('custom');
    echo $this->Html->css('datepicker');
    echo $this->Html->script('jquery.min');
    echo $this->Html->script('bootstrap-dropdown');
    echo $this->Html->script('bootstrap/bootstrap-collapse');
    
    echo $this->Html->script('cakebootstrap');
    echo $this->Html->script('bootstrap-datepicker');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');


?>
    



</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
    <div class="container">

      <div class="masthead">
        <img src = "img/logo/logo.png"> </img>
        <ul class="nav nav-justified">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Projects</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Downloads</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>


        <div id="content"  class ="wrapper">

        <div class="row">

                <!-- MENU LEFTH -->  

              <div class="col-2 col-sm-2 col-lg-"> 



              <p>
              <?php 

              echo $this->Html->image("banner/menu_admin_banner.png", array(
                      "label" => "Crear Area",

                      'height'=>'45',
                      'width'=>'235',
                      

                  ));
              ?>
              </p>  

               

                      
                             
              <div class="accordion" id="accordion2">
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    Estructura Organizacional
                    </a>
                  </div>
                  <div id="collapseOne" class="accordion-body collapse">
                    <div class="accordion-inner">
                      <p>
                       <button type="button" class="btn btn-link" >
                       <?php echo $this->Html->link("Procesos", array('controller' => 'processes',  'action' => 'index')); ?>   
                       </button>
                       <br>
                       <button type="button" class="btn btn-link">
                       <?php echo $this->Html->link("Areas", array('controller' => 'areas',  'action' => 'index')); ?>   
                       </button>  
                        <ul>
                          <li>
                           <?php echo $this->Html->link(" Tipos de Areas", array('controller' => 'areastypes',  'action' => 'index')); ?>     
                          </li>
                        </ul>    
                       <br>
                                        
                      </p>
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                     Procesos
                    </a>
                  </div>
                  <div id="collapseTwo" class="accordion-body collapse">
                    <div class="accordion-inner">
                    <p>  
                        <button type="button" class="btn btn-link">Mapa de Procesos </button>    
                        <button type="button" class="btn btn-link">Caracterización </button>  
                        <button type="button" class="btn btn-link">Hojear lista de Procesos </button>    
                        <ul>
                          <li>
                          <?php echo $this->Html->link(" Crear Proceso", array('controller' => 'processes',  'action' => 'add')); ?>     
                          </li>
                          <li>
                          <button type="button" class="btn btn-link">Editar Procesos</button>    
                          </li>
                          <li>
                          <button type="button" class="btn btn-link">Borrar Procesos</button>    
                          </li>
                        </ul>
                       <button type="button" class="btn btn-link">Ayuda</button>    
                    </p>  
                    </div>
                  </div>
                </div>
                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                     Usuarios
                    </a>
                  </div>
                  <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">
                    <p>            
                        <button type="button" class="btn btn-link">Perfiles y permisos</button>    
                        <button type="button" class="btn btn-link">Hojear lista de Usuarios </button>    
                        <ul>
                          <li>  
                          <button type="button" class="btn btn-link">Crear Usuario </button>    
                          </li>
                          <li>
                          <button type="button" class="btn btn-link">Editar Usuario</button>    
                          </li>
                          <li>
                          <button type="button" class="btn btn-link">Borrar Usuario</button>    
                          </li>
                        </ul>
                        <button type="button" class="btn btn-link">Ayuda</button>    
                    </p>    
                    </div>
                  </div>
                 </div>
                 
              </div>


            </div>

            <div class="col-12 col-sm-8 col-lg-8 ">

                        <?php echo $this->Session->flash(); ?>

                        <?php echo $this->fetch('content'); ?>

            </div>



            <div class="col-12 col-sm-8 col-lg-8 " align= "center" id="footer">
            <?php echo 'ESU'?>
            </div>


</div> <!-- din container -->
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>





