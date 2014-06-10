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
       $proffer=strpos($_SERVER['REQUEST_URI'],"proffers");
		$oportunity=strpos($_SERVER['REQUEST_URI'],"oportunities");
		$customer=strpos($_SERVER['REQUEST_URI'],"customers");
		
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

    echo $this->Html->css('bootstrap');
    echo $this->Html->css('custom');
    echo $this->Html->css('datepicker');
    echo $this->Html->script('jquery.min');
    echo $this->Html->script('bootstrap-dropdown');    
    echo $this->Html->script('cakebootstrap');
    echo $this->Html->script('bootstrap-datepicker');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');


?>
	



</head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
	<div class = "well" id="container" >
		

	<div class="navbar">
			<div class="navbar-inner-info">
				<div class="container">
					<ul class="nav navbar-nav">
							<li><a class="img-responsive" alt="Responsive image" ><?php echo $this->Html->image('logo/Logo ESU.jpg')?></a></li>	
							<li class="text-center"><a id='username'><?php echo "username" ?></a></li>	  
							<li class="text-center"><a href="#">Home</a></li>
							<li class="text-center"><a <?php if($customer!==false){echo 'class="active"';}?> href="<?php echo $this->Html->url(array('controller' => 'customers', 'action' => 'index')); ?>">Gestión de Clientes</a></li>

							<li class="text-center"><a <?php if($oportunity!==false){echo 'class="active"';}?> href="<?php echo $this->Html->url(array('controller' => 'Oportunities', 'action' => 'index')); ?>">Oportunidad de Negocio</a></li>

							<li class="text-center"><a <?php if($proffer!==false){echo 'class="active"';}?> href="<?php echo $this->Html->url(array('controller' => 'proffers', 'action' => 'index')); ?>">Propuestas Comerciales</a></li>

					        <li class="text-center"><a href="#">Contratos</a></li>
							<li id="fat-menu" >
								<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">Mi cuenta <b class="caret"></b></a>
					                <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
					                  	<li><a href="">Cambiar Contrase&ntildea</a></li>
							            <li class="divider"></li>
							            <li><a href= '#'>Mi Proceso</a></li>
							            <li class="divider"></li>
							            <li><a href="#">Salida Segura</a></li>
				               		</ul>
				              	  </a>
				             </li>
					</ul>	
         		</div>
			</div>
		</div>

		<div id="content"  class ="wrapper">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>



		<div align= "center" id="footer">
			
			<?php echo 'CRM - Software para la Gestión y Control de Propuestas Comerciales '?>
		</div>


	</div> <!-- din container -->
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
