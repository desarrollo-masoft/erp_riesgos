<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ERP-RIESGOS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="view/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="view/bootstrap/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="view/bootstrap/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="view/bootstrap/dist/css/AdminLTE.min.css">
  
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">    
  </head>

  <body class="hold-transition lockscreen">
  
  
  <div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="<?php echo $helper->url("Usuarios","Inicio"); ?>"><b>ERP</b>RIESGOS</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">Recuperar Clave</div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="view/images/logo.png" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
  
       <form class="lockscreen-credentials" action="<?php echo $helper->url("Usuarios","resetear_clave_inicio"); ?>" method="post" ">
         
      <div class="input-group">
        <input id="cedula_usuarios" name="cedula_usuarios" type="number" class="form-control" placeholder="cedula..">
         <div id="mensaje_cedula_usuarios" class="errores"></div>
             
        <div class="input-group-btn">
          <button type="submit" id="Guardar" name="Guardar" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
        
          
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Ingrese su cedula para recuperar su clave
  </div>
  <div class="text-center">
    <a href="<?php echo $helper->url("Usuarios","Inicio"); ?>">Volver</a>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2020-2021 <b><a href="https://www.fcpcgadpp.com.ec" class="text-black">ERP RIESGOS</a></b><br>
    All rights reserved
  </div>
</div>
  
    
    <!-- /.center -->

<!-- jQuery 3 -->
<script src="view/bootstrap/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="view/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
       <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var cedula_usuarios = $("#cedula_usuarios").val();
		    	
		    	
		    	if (cedula_usuarios == "")
		    	{
		    		 $("#cedula_usuarios").notify("Ingrese Cedula",{ position:"buttom left", autoHideDelay: 2000});
	    				return false; 
		    		   
			    }
		    	else 
		    	{
		    		
				}    
				
		    	
		    					    

			}); 

				    
		}); 

	</script>

</body>
</html>
