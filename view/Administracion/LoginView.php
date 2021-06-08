<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>FCPC GADPP</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="view/Administracion/css/login.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
					<img src="view/images/logo.png" class="img-fluid" alt="Responsive image">
			</div>
			<div class="card-body">
				<form action="<?php echo $helper->url("Usuarios","Loguear"); ?>" method="post" >
			
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" id="usuario" name="usuario" class="form-control" placeholder="Cedula..">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" id="clave" name="clave" class="form-control" placeholder="Password..">
					</div>
					
					<div class="form-group">
						<input type="submit" id="Login" value="Ingresar" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center">
					<a href="<?php echo $helper->url("Usuarios","resetear_clave_inicio"); ?>"><span style="color: white;">Olvidó su Contraseña?</span></a>
				</div>
			</div>
		</div>
	</div>
</div>



  <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
       <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Login").click(function() 
			{
		    	
		    	var usuario = $("#usuario").val();
				var clave = $("#clave").val();
		    	
		    	
		    	if (usuario == "")
		    	{
		    		 $("#usuario").notify("Ingrese Cedula",{ position:"buttom left", autoHideDelay: 2000});
	    				return false; 
		    		   
			    }
		    	else 
		    	{
		    		
				}    
				
		    	
		    	if (clave == "")
		    	{
		    		 $("#clave").notify("Ingrese Contraseña",{ position:"buttom left", autoHideDelay: 2000});
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