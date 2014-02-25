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
    <div class = "well" id="container">
        
        <div class="navbar">
            <div class="navbar-inner-info">
                <div class="container">
                    <ul class="nav navbar-nav">
                        <li><a class="img-responsive" alt="Responsive image" ><?php echo $this->Html->image('logo/logo.png')?></a></li>  

                        <li><a class="navbar-brand" ><?php echo 'LAYOUT ADMIN'?></a></li>    
                                        

                        <li>
                          <div class="nav-collapse collapse bs-js-navbar-collapse pull-left">
                              <ul  class="nav navbar-nav navbar-right">
                                  <li id="fat-menu" class="dropdown">
                                    <a href="#" id="drop3" role="button" class="dropdown-toggle pull-right" data-toggle="dropdown">Mi cuenta <b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                                      <li><a href="index.php?KEYTURN=ON">Cambiar Contrase&ntildea</a></li>
                                        <li class="divider"></li>
                                        <li><a id= "perfil" target="_blank" name = "perfil" href= '#'>Mi Proceso</a></li>
                                        <li class="divider"></li>
                                        <li><a id= "close_session" name = "close_session" href="#">Salida Segura</a></li>
                                    </ul>
                                  </li>
                               </ul>
                          </div><!-- /.nav-collapse -->
                         </li> 
                    </ul>   
                </div>
            </div>
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
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                     Usuarios
                    </a>
                  </div>
                  <div id="collapseThree" class="accordion-body collapse">
                    <div class="accordion-inner">
                    <p>            
                        <button type="button" class="btn btn-link">Perfiles y permisos</button>    
                        <button type="button" class="btn btn-link"> 
                        <?php echo $this->Html->link("Administrar Usuarios", array('controller' => 'users',  'action' => 'index')); ?>     
                        </button>    
                    
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





