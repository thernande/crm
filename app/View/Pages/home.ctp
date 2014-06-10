<?php
echo $this->Html->script('bootstrap/bootstrap-carousel.js');
echo $this->Html->script('bootstrap/bootstrap-modal'); 
?>

  <body>

 

    
      <div class="jumbotron">
        <h1>Control de Propuestas Comerciales!</h1>
        <p class="lead">
        Registro de Oportunidaddes de Negocio, propuestas comerciales y control de vencimiento de contratos   
        </p>
        
      </div>

	<script type="text/javascript">
  		document.getElementById('username').innerHTML = "<?php echo $_COOKIE['username']; ?>";
	</script>
 <!-- Button trigger modal -->


   <!--
      <div class="row">
        <div class="col-lg-4">

          <h2>Propuestas</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#">View details »</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Oportunidades</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#">View details »</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Contratos</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
          <p><a class="btn btn-primary" href="#">View details »</a></p>
        </div>
      </div>

    -->
    <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  

</body></html>