<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Solicitud Prestaciones - Capremci</title>

	 
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" href="view/css/estilos.css">
		<link rel="stylesheet" href="view/vendors/table-sorter/themes/blue/style.css">
	
	
	
		    <!-- Bootstrap -->
    		<link href="view/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    		<!-- Font Awesome -->
		    <link href="view/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		    <!-- NProgress -->
		    <link href="view/vendors/nprogress/nprogress.css" rel="stylesheet">
		    
		   
		    <!-- Custom Theme Style -->
		    <link href="view/build/css/custom.min.css" rel="stylesheet">
				
			
			<!-- Datatables -->
		    <link href="view/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		    
		   		

			<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script type="text/javascript" src="view/vendors/table-sorter/jquery.tablesorter.js"></script> 
       		 <script src="view/js/jquery.blockUI.js"></script>
            <script src="view/js/jquery.inputmask.bundle.js"></script>
            
            <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
			<script>
			    //webshims.activeLang("en");
			    webshims.setOptions('forms-ext', { datepicker: { dateFormat: 'yy/mm/dd' } });
				webshims.polyfill('forms forms-ext');
			</script>
           
           
       		<script src="view/input-mask/jquery.inputmask.js"></script>
			<script src="view/input-mask/jquery.inputmask.date.extensions.js"></script>
			<script src="view/input-mask/jquery.inputmask.extensions.js"></script>
			
			
			
			     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
                 <script src="view/js/jquery.js"></script>
		         <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
			
        

       
       
			        
    </head>
    
    
    <body class="nav-md">
    
      <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        ?>
    
    
    
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col  menu_fixed">
          <div class="left_col scroll-view">
            <?php include("view/modulos/logo.php"); ?>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <?php include("view/modulos/menu_profile.php"); ?>
            <!-- /menu profile quick info -->

            <br />
			<?php include("view/modulos/menu.php"); ?>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
		<?php include("view/modulos/head.php"); ?>	
        <!-- /top navigation -->

        <!-- page content -->
		<div class="right_col" role="main">        
           
    	<div class="container">
        <section class="content-header">
         <small><?php echo $fecha; ?></small>
         <ol class=" pull-right breadcrumb">
         <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Solicitud Préstaciones</li>
         </ol>
         </section>
       
  
		  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>SOLICITUD<small>Prestaciones</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
            
            <form action="<?php echo $helper->url("SolicitudPrestaciones","InsertarSolicitud"); ?>" method="post" onsubmit="return checkSubmit();" class="col-lg-12 col-md-12 col-xs-12">      
   		 
   		 
   		   <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
         
         
            
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-user'></i> Datos Personales</h4>
	         </div>
	         <div class="panel-body">
	         
	          <div class="row">
	         <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="id_sucursales" class="control-label">Sucursal a Tramitar:</label>
                                                       <select name="id_sucursales" id="id_sucursales"  class="form-control" disabled>
                                                         <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultSucursales as $res) {?>
                        										<option value="<?php echo $res->id_sucursales; ?>" <?php if ($res->id_sucursales == $resEdit->id_sucursales ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_sucursales; ?> </option>
                        							        
                        							        <?php } ?>	
                        							   </select> 
                                                      <div id="mensaje_id_sucursales" class="errores"></div>
                                </div>
                                </div>
	        </div>
   		 
   		 <div class="row">
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="cedula_participes" class="control-label">Cedula:</label>
                    	<input type="text" readonly="readonly" class="form-control" id="cedula_participes" name="cedula_participes" placeholder="C.I." value="<?php echo $cedula[0]?>">
                        <input type="hidden" name="id_solicitud_prestaciones" id="id_solicitud_prestaciones" value="<?php echo $resEdit->id_solicitud_prestaciones; ?>" />
                        <div id="mensaje_cedula_participes" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_solicitud_prestaciones" class="control-label">Nombres:</label>
                    	<input style="text-transform: uppercase;" type="text" class="form-control" id="nombres_solicitud_prestaciones" name="nombres_solicitud_prestaciones" placeholder="Nombres" value="<?php echo $resEdit->nombres_solicitud_prestaciones; ?>">
                        <div id="mensaje_nombres_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_solicitud_prestaciones" class="control-label">Apellidos:</label>
                    	<input style="text-transform: uppercase;" type="text" class="form-control" id="apellidos_solicitud_prestaciones" name="apellidos_solicitud_prestaciones" placeholder="Apellidos" value="<?php echo $resEdit->apellidos_solicitud_prestaciones; ?>">
                        <div id="mensaje_apellidos_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_sexo" class="control-label">Género:</label>
                          <select  class="form-control" id="id_sexo" name="id_sexo">
                          	   <option value="0" selected="selected">--Seleccione--</option>
                        								
                          	 <?php foreach($resultGenero as $res) {?>
                        		<option value="<?php echo $res->id_sexo; ?>" <?php if ($res->id_sexo == $resEdit->id_sexo ){  echo  ' selected="selected" '  ;}  ?>><?php echo $res->nombre_sexo; ?> </option>
                        							        
                        	<?php } ?>
                          	
                          </select>                         
                          <div id="mensaje_id_sexo" class="errores"></div>
                        </div>
                </div>
          	</div>
			 
			 
			 <div class="row">
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="fecha_nacimiento_solicitud_prestaciones" class="control-label">Fecha de Nacimiento:</label>
                    	<input type="date" class="form-control" id="fecha_nacimiento_solicitud_prestaciones" name="fecha_nacimiento_solicitud_prestaciones" value="<?php echo $resEdit->fecha_nacimiento_solicitud_prestaciones; ?>">
                        <div id="mensaje_fecha_nacimiento_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_estado_civil" class="control-label">Estado Civil:</label>
                          <select  class="form-control" id="id_estado_civil" name="id_estado_civil">
                          
                             <option value="0" selected="selected">--Seleccione--</option>
                        								
                          		<?php foreach($resultEstadoCivil as $res) {?>
                        										<option value="<?php echo $res->id_estado_civil; ?>" <?php if ($res->id_estado_civil == $resEdit->id_estado_civil ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_estado_civil; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_estado_civil" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="correo_solicitud_prestaciones" class="control-label">E-mail:</label>
                    	<input type="text" class="form-control" id="correo_solicitud_prestaciones" name="correo_solicitud_prestaciones" placeholder="E-mail" value="<?php echo $resEdit->correo_solicitud_prestaciones; ?>">
                        <div id="mensaje_correo_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nivel_educativo_solicitud_prestaciones" class="control-label">Nivel Educativo:</label>
                    	<select name="nivel_educativo_solicitud_prestaciones" id="nivel_educativo_solicitud_prestaciones"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Primario" <?php if($resEdit->nivel_educativo_solicitud_prestaciones == 'Primario'){echo ' selected="selected" ' ;}else{} ?>>Primario</option>
        							  <option value="Secundario" <?php if($resEdit->nivel_educativo_solicitud_prestaciones == 'Secundario'){echo ' selected="selected" ' ;}else{} ?>>Secundario</option>
        							  <option value="Técnico" <?php if($resEdit->nivel_educativo_solicitud_prestaciones == 'Técnico'){echo ' selected="selected" ' ;}else{} ?>>Técnico</option>
        							  <option value="Universitario" <?php if($resEdit->nivel_educativo_solicitud_prestaciones == 'Universitario'){echo ' selected="selected" ' ;}else{} ?>>Universitario</option>
        							  <option value="Postgrado" <?php if($resEdit->nivel_educativo_solicitud_prestaciones == 'Postgrado'){echo ' selected="selected" ' ;}else{} ?>>Postgrado</option>
                        </select> 
                        <div id="mensaje_nivel_educativo_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
            
          	</div>
          	
          	
          	
  			</div>
  			</div>
  			
  			
  			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i> Datos Exactos Domicilio</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_provincias" class="control-label">Provincias:</label>
                          <select  class="form-control" id="id_provincias" name="id_provincias">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>" <?php if ($res->id_provincias == $resEdit->id_provincias ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_provincias; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_provincias" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_cantones" class="control-label">Cantones:</label>
                          <select  class="form-control" id="id_cantones" name="id_cantones">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultCantones as $res) {?>
                        										<option value="<?php echo $res->id_cantones; ?>" <?php if ($res->id_cantones == $resEdit->id_cantones ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_cantones; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_cantones" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_parroquias" class="control-label">Parroquias:</label>
                          <select  class="form-control" id="id_parroquias" name="id_parroquias">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultParroquias as $res) {?>
                        										<option value="<?php echo $res->id_parroquias; ?>" <?php if ($res->id_parroquias == $resEdit->id_parroquias ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_parroquias; ?> </option>
                        							        
                        							        <?php } ?>
                          	
                          </select>                         
                          <div id="mensaje_id_parroquias" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="barrio_solicitud_prestaciones" class="control-label">Barrio y/o Sector:</label>
                    	<input type="text" class="form-control" id="barrio_solicitud_prestaciones" name="barrio_solicitud_prestaciones" placeholder="Barrio" value="<?php echo $resEdit->barrio_solicitud_prestaciones; ?>">
                        <div id="mensaje_barrio_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
          	</div>
          	
          	
          	<div class="row">
          	
          	<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="ciudadela_solicitud_prestaciones" class="control-label">Ciudadela y/o conjunto/Etapa/Manzana:</label>
                    	<input type="text" class="form-control" id="ciudadela_solicitud_prestaciones" name="ciudadela_solicitud_prestaciones" placeholder="Ciudadela" value="<?php echo $resEdit->ciudadela_solicitud_prestaciones; ?>">
                        <div id="mensaje_ciudadela_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="calle_solicitud_prestaciones" class="control-label">Calle:</label>
                    	<input type="text" class="form-control" id="calle_solicitud_prestaciones" name="calle_solicitud_prestaciones" placeholder="Calle" value="<?php echo $resEdit->calle_solicitud_prestaciones; ?>">
                        <div id="mensaje_calle_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="numero_calle_solicitud_prestaciones" class="control-label">Número de Calle:</label>
                    	<input type="text" class="form-control" id="numero_calle_solicitud_prestaciones" name="numero_calle_solicitud_prestaciones" placeholder="Número de calle" value="<?php echo $resEdit->numero_calle_solicitud_prestaciones; ?>">
                        <div id="mensaje_numero_calle_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
          	
          	</div>
          	
          	<div class="row">
          	
          	
          	<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="interseccion_solicitud_prestaciones" class="control-label">Intersección:</label>
                    	<input type="text" class="form-control" id="interseccion_solicitud_prestaciones" name="interseccion_solicitud_prestaciones" placeholder="Intersección" value="<?php echo $resEdit->interseccion_solicitud_prestaciones; ?>">
                        <div id="mensaje_interseccion_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	
          	
          	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="tipo_vivienda_solicitud_prestaciones" class="control-label">Tipo Vivienda:</label>
                    	<select name="tipo_vivienda_solicitud_prestaciones" id="tipo_vivienda_solicitud_prestaciones"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Propia" <?php if($resEdit->tipo_vivienda_solicitud_prestaciones == 'Propia'){echo ' selected="selected" ' ;}else{} ?>>Propia</option>
        							  <option value="Arrendada" <?php if($resEdit->tipo_vivienda_solicitud_prestaciones == 'Arrendada'){echo ' selected="selected" ' ;}else{} ?>>Arrendada</option>
        							  <option value="Anticresis" <?php if($resEdit->tipo_vivienda_solicitud_prestaciones == 'Anticresis'){echo ' selected="selected" ' ;}else{} ?>>Anticresis</option>
        							  <option value="Vive con Familiares" <?php if($resEdit->tipo_vivienda_solicitud_prestaciones == 'Vive con Familiares'){echo ' selected="selected" ' ;}else{} ?>>Vive con Familiares</option>
        							  <option value="Otra" <?php if($resEdit->tipo_vivienda_solicitud_prestaciones == 'Otra'){echo ' selected="selected" ' ;}else{} ?>>Otra</option>
                        </select> 
                        <div id="mensaje_tipo_vivienda_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="vivienda_hipotecada_solicitud_prestaciones" class="control-label">Vivienda HIPOTECADA:</label>
                    	<select name="vivienda_hipotecada_solicitud_prestaciones" id="vivienda_hipotecada_solicitud_prestaciones"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="SI" <?php if($resEdit->vivienda_hipotecada_solicitud_prestaciones == 'SI'){echo ' selected="selected" ' ;}else{} ?>>SI</option>
        							  <option value="NO" <?php if($resEdit->vivienda_hipotecada_solicitud_prestaciones == 'NO'){echo ' selected="selected" ' ;}else{} ?>>NO</option>
        							 
                        </select> 
                        <div id="mensaje_vivienda_hipotecada_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
          	
          	</div>
			 
		   
			
			<div class="row">
			
			<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="referencia_dir_solicitud_prestaciones" class="control-label">Referencia Domiciliaria:</label>
                    	<input type="text" class="form-control" id="referencia_dir_solicitud_prestaciones" name="referencia_dir_solicitud_prestaciones" placeholder="Referencia" value="<?php echo $resEdit->interseccion_solicitud_prestaciones; ?>">
                        <div id="mensaje_referencia_dir_solicitud_prestaciones" class="errores"></div>
                 	</div>
           </div>
			
			</div> 
			 
  			</div>
  			</div>
            
            <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-phone-alt'></i> Números Telefónicos</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="telefono_solicitud_prestaciones" class="control-label">Teléfono:</label>
                    	<input type="text" class="form-control" onkeypress="return soloNumeros(event);" id="telefono_solicitud_prestaciones" name="telefono_solicitud_prestaciones" placeholder="Teléfono" value="<?php echo $resEdit->telefono_solicitud_prestaciones; ?>">
                        <div id="mensaje_telefono_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="celular_solicitud_prestaciones" class="control-label">Celular:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="celular_solicitud_prestaciones" name="celular_solicitud_prestaciones" placeholder="Celular" value="<?php echo $resEdit->celular_solicitud_prestaciones; ?>" readonly>
                        <div id="mensaje_celular_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-lg-2 col-xs-12 col-md-2">
                 <div class="form-group">
                                                      <label for="numero_codigo_verificacion" class="control-label">Código Verificación:</label>
                                                      <input type="number" class="form-control" id="numero_codigo_verificacion" name="numero_codigo_verificacion"  placeholder="sms.." value="<?php echo $resEdit->numero_codigo_verificacion; ?>" readonly>
                                                      <input type="hidden" class="form-control" id="id_codigo_verificacion" name="id_codigo_verificacion" value="<?php echo $resEdit->id_codigo_verificacion; ?>" readonly>
                                                     
                                                      <div id="mensaje_numero_codigo_verificacion" class="errores"></div>
                </div>
				</div>
				
            					
            					
				<div class="col-lg-4 col-xs-12 col-md-4" style="margin-top: 23px;">
   		   		   <span class="input-group-btn">
	         		<button type="button" id="btn_enviar1" name="btn_enviar1" class="btn btn-primary">Enviar Código</button>
             		<button type="button" id="btn_verificar1" name="btn_verificar1" class="btn btn-info">Verificar Código</button>
	         		</span>
   		  		 </div>
            					
             	
             	
             	
              	</div>
    		  </div>
  			</div>
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-align-justify'></i> Referencias Familiares</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
			 
			 
			 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_referencia_familiar" class="control-label">Nombres:</label>
                    	<input type="text" class="form-control" id="nombres_referencia_familiar" name="nombres_referencia_familiar" placeholder="Nombres" value="<?php echo $resEdit->nombres_referencia_familiar; ?>">
                        <div id="mensaje_nombres_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_referencia_familiar" class="control-label">Apellidos:</label>
                    	<input type="text" class="form-control" id="apellidos_referencia_familiar" name="apellidos_referencia_familiar" placeholder="Apellidos" value="<?php echo $resEdit->apellidos_referencia_familiar; ?>">
                        <div id="mensaje_apellidos_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="parentesco_referencia_familiar" class="control-label">Parentesco:</label>
                    	<select name="parentesco_referencia_familiar" id="parentesco_referencia_familiar"  class="form-control" >
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Primo" <?php if($resEdit->parentesco_referencia_familiar == 'Primo'){echo ' selected="selected" ' ;}else{} ?>>Primo</option>
        							  <option value="Tío" <?php if($resEdit->parentesco_referencia_familiar == 'Tío'){echo ' selected="selected" ' ;}else{} ?>>Tío</option>
        							  <option value="Hermano" <?php if($resEdit->parentesco_referencia_familiar == 'Hermano'){echo ' selected="selected" ' ;}else{} ?>>Hermano</option>
        							  <option value="Sobrino" <?php if($resEdit->parentesco_referencia_familiar == 'Sobrino'){echo ' selected="selected" ' ;}else{} ?>>Sobrino</option>
        							  <option value="Abuelo" <?php if($resEdit->parentesco_referencia_familiar == 'Abuelo'){echo ' selected="selected" ' ;}else{} ?>>Abuelo</option>
        							  <option value="Hijo" <?php if($resEdit->parentesco_referencia_familiar == 'Hijo'){echo ' selected="selected" ' ;}else{} ?>>Hijo</option>
        							  <option value="Madre" <?php if($resEdit->parentesco_referencia_familiar == 'Madre'){echo ' selected="selected" ' ;}else{} ?>>Madre</option>
        							  <option value="Padre" <?php if($resEdit->parentesco_referencia_familiar == 'Padre'){echo ' selected="selected" ' ;}else{} ?>>Padre</option>
        							  <option value="Otro" <?php if($resEdit->parentesco_referencia_familiar == 'Otro'){echo ' selected="selected" ' ;}else{} ?>>Otro</option>
        		           </select> 
                        <div id="mensaje_parentesco_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="primer_telefono_referencia_familiar" class="control-label">Teléfono:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="primer_telefono_referencia_familiar" name="primer_telefono_referencia_familiar" value="<?php echo $resEdit->primer_telefono_referencia_familiar; ?>" placeholder="Teléfono">
                        <div id="mensaje_primer_telefono_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
             	
              	</div>
              	
              <div class="row">
              	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="segundo_telefono_referencia_familiar" class="control-label">Celular:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="segundo_telefono_referencia_familiar" name="segundo_telefono_referencia_familiar" value="<?php echo $resEdit->segundo_telefono_referencia_familiar; ?>" placeholder="Celular">
                        <div id="mensaje_segundo_telefono_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
    		  </div>
    		  </div>
  			</div>
            
            
            <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-align-justify'></i> Referencias Personales</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
			 
			 
			 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_referencia_personal" class="control-label">Nombres:</label>
                    	<input type="text" class="form-control" id="nombres_referencia_personal" name="nombres_referencia_personal" value="<?php echo $resEdit->nombres_referencia_personal; ?>" placeholder="Nombres">
                        <div id="mensaje_nombres_referencia_personals" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_referencia_personal" class="control-label">Apellidos:</label>
                    	<input type="text" class="form-control" id="apellidos_referencia_personal" name="apellidos_referencia_personal" value="<?php echo $resEdit->apellidos_referencia_personal; ?>" placeholder="Apellidos">
                        <div id="mensaje_apellidos_referencia_personal" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="parentesco_referencia_personal" class="control-label">Relación:</label>
                    	<select name="parentesco_referencia_personal" id="parentesco_referencia_personal"  class="form-control" >
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Amigo" <?php if($resEdit->parentesco_referencia_personal == 'Amigo'){echo ' selected="selected" ' ;}else{} ?>>Amigo</option>
        							  <option value="Compadre" <?php if($resEdit->parentesco_referencia_personal == 'Compadre'){echo ' selected="selected" ' ;}else{} ?>>Compadre</option>
        							  <option value="Comadre" <?php if($resEdit->parentesco_referencia_personal == 'Comadre'){echo ' selected="selected" ' ;}else{} ?>>Comadre</option>
        							  <option value="Compañero Laboral(a)" <?php if($resEdit->parentesco_referencia_personal == 'Compañero Laboral(a)'){echo ' selected="selected" ' ;}else{} ?>>Compañero Laboral(a)</option>
        							  <option value="Jefe(a)" <?php if($resEdit->parentesco_referencia_personal == 'Jefe(a)'){echo ' selected="selected" ' ;}else{} ?>>Jefe(a)</option>
        							  <option value="Otro" <?php if($resEdit->parentesco_referencia_personal == 'Otro'){echo ' selected="selected" ' ;}else{} ?>>Otro</option>
        			    </select> 
                        <div id="mensaje_parentesco_referencia_personal" class="errores"></div>
                 	</div>
             	</div>
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="primer_telefono_referencia_personal" class="control-label">Teléfono:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="primer_telefono_referencia_personal" name="primer_telefono_referencia_personal" value="<?php echo $resEdit->primer_telefono_referencia_personal; ?>" placeholder="Teléfono">
                        <div id="mensaje_primer_telefono_referencia_personal" class="errores"></div>
                 	</div>
             	</div>
             	
              	</div>
              	
              	 <div class="row">
              	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="segundo_telefono_referencia_personal" class="control-label">Celular:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="segundo_telefono_referencia_personal" name="segundo_telefono_referencia_personal" value="<?php echo $resEdit->segundo_telefono_referencia_personal; ?>" placeholder="Celular">
                        <div id="mensaje_segundo_telefono_referencia_personal" class="errores"></div>
                 	</div>
             	</div>
    		  </div>
  			</div>
  			</div>
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-folder-close'></i> Datos Laborables</h4>
	         </div>
	         <div class="panel-body">
			 
			 
			 <div class="row">
			 
			 
			  
			  	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="ultimo_cargo_solicitud_prestaciones" class="control-label">Ultimo Cargo:</label>
                    	<input type="text" class="form-control" id="ultimo_cargo_solicitud_prestaciones" name="ultimo_cargo_solicitud_prestaciones" value="<?php echo $resEdit->ultimo_cargo_solicitud_prestaciones; ?>" placeholder="Cargo">
                        <div id="mensaje_ultimo_cargo_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
			  
			 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="fecha_salida_solicitud_prestaciones" class="control-label">Fecha de Salida:</label>
                    	<input type="date"    class="form-control" id="fecha_salida_solicitud_prestaciones" name="fecha_salida_solicitud_prestaciones" value="<?php echo $resEdit->fecha_salida_solicitud_prestaciones; ?>" placeholder="Salida">
                        <div id="mensaje_fecha_salida_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
			                    
         	  </div>
			 
  			</div>
  			</div>
  			
  			
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-usd'></i> Datos Cuenta Bancaria</h4>
	         </div>
	         <div class="panel-body">
			 
			 
			 <div class="row">
			 
			 <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_bancos" class="control-label">Banco:</label>
                          <select  class="form-control" id="id_bancos" name="id_bancos">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos" class="errores"></div>
                        </div>
            		  </div>
			  
			  
			  
			  <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="tipo_cuenta_bancaria" class="control-label">Tipo Cuenta:</label>
                                                      <select name="tipo_cuenta_bancaria" id="tipo_cuenta_bancaria"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Ahorros" <?php if($resEdit->tipo_cuenta_bancaria == 'Ahorros'){echo ' selected="selected" ' ;}else{} ?>>Ahorros</option>
                        							  <option value="Corriente" <?php if($resEdit->tipo_cuenta_bancaria == 'Corriente'){echo ' selected="selected" ' ;}else{} ?>>Corriente</option>
                        							  </select> 
                                                      <div id="mensaje_tipo_cuenta_bancaria" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="numero_cuenta_bancaria" class="control-label">Número Cuenta:</label>
                                                      <input type="number" class="form-control" id="numero_cuenta_bancaria" name="numero_cuenta_bancaria" value="<?php echo $resEdit->numero_cuenta_bancaria; ?>" placeholder="# cuenta..">
                                                      <div id="mensaje_numero_cuenta_bancaria" class="errores"></div>
                                </div>
                                </div>
			  
			  
			  
			
			                    
         	  </div>
			 
  			</div>
  			</div>
					                		        
                    <div class="row">
    			     <div class="col-lg-12 col-md-12 col-xs-12 " style="text-align: center; margin-top: 10px">
				  	    <div class="form-group">
    	                  <button type="submit" id="Guardar" name="Guardar" value=""   class="btn btn-success" style="margin-top: 10px;"><i class="glyphicon glyphicon-edit"></i> Actualizar Solicitud</button>         
					   
	                    </div>
	                    
        		    </div> 
        		    
        		           		    
    		    </div>
 
         
         
         
         
         
         
         
         
         
         
         
         
         
           <?php } } else {?>
      
      
      
      
      
      
      
      
      
      
            
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-user'></i> Datos Personales</h4>
	         </div>
	         <div class="panel-body">
	         
	         <div class="row">
	         <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="id_sucursales" class="control-label">Sucursal a Tramitar:</label>
                                                       <select name="id_sucursales" id="id_sucursales"  class="form-control">
                                                          <option value="0">--Seleccione--</option>
                                                          <?php foreach($resultSucursales as $res) {?>
                        										<option value="<?php echo $res->id_sucursales; ?>" ><?php echo $res->nombre_sucursales; ?> </option>
                        							        
                        							        <?php } ?>
                        									
                        							   </select> 
                                                      <div id="mensaje_id_sucursales" class="errores"></div>
                                </div>
                                </div>
	        </div>
   		 
   		 <div class="row">
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="cedula_participes" class="control-label">Cedula:</label>
                    	<input type="text" readonly="readonly" class="form-control" id="cedula_participes" name="cedula_participes" placeholder="C.I." value="<?php echo $cedula[0]?>">
                        <input type="hidden" name="id_solicitud_prestaciones" id="id_solicitud_prestaciones" value="0" />
                        <div id="mensaje_cedula_participes" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_solicitud_prestaciones" class="control-label">Nombres:</label>
                    	<input style="text-transform: uppercase;" type="text" class="form-control" id="nombres_solicitud_prestaciones" name="nombres_solicitud_prestaciones" placeholder="Nombres" value="">
                        <div id="mensaje_nombres_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_solicitud_prestaciones" class="control-label">Apellidos:</label>
                    	<input style="text-transform: uppercase;" type="text" class="form-control" id="apellidos_solicitud_prestaciones" name="apellidos_solicitud_prestaciones" placeholder="Apellidos" >
                        <div id="mensaje_apellidos_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_sexo" class="control-label">Género:</label>
                          <select  class="form-control" id="id_sexo" name="id_sexo">
                          	<option value="0">--Seleccione--</option>
                          	 <?php foreach($resultGenero as $res) {?>
                        		<option value="<?php echo $res->id_sexo; ?>" ><?php echo $res->nombre_sexo; ?> </option>
                        							        
                        	<?php } ?>
                          	
                          </select>                         
                          <div id="mensaje_id_sexo" class="errores"></div>
                        </div>
                </div>
          	</div>
			 
			 
			 <div class="row">
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="fecha_nacimiento_solicitud_prestaciones" class="control-label">Fecha de Nacimiento:</label>
                    	<input type="date"  class="form-control" id="fecha_nacimiento_solicitud_prestaciones" name="fecha_nacimiento_solicitud_prestaciones" >
                        <div id="mensaje_fecha_nacimiento_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_estado_civil" class="control-label">Estado Civil:</label>
                          <select  class="form-control" id="id_estado_civil" name="id_estado_civil">
                          	<option value="0">--Seleccione--</option>
                          	<?php foreach($resultEstadoCivil as $res) {?>
                        										<option value="<?php echo $res->id_estado_civil; ?>" ><?php echo $res->nombre_estado_civil; ?> </option>
                        							        
                        							        <?php } ?>
                          	
                          </select>                         
                          <div id="mensaje_id_estado_civil" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="correo_solicitud_prestaciones" class="control-label">E-mail:</label>
                    	<input type="text" class="form-control" id="correo_solicitud_prestaciones" name="correo_solicitud_prestaciones" placeholder="E-mail" value="<?php echo $correo[0]?>">
                        <div id="mensaje_correo_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nivel_educativo_solicitud_prestaciones" class="control-label">Nivel Educativo:</label>
                    	<select name="nivel_educativo_solicitud_prestaciones" id="nivel_educativo_solicitud_prestaciones"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Primario">Primario</option>
        							  <option value="Secundario">Secundario</option>
        							  <option value="Técnico">Técnico</option>
        							  <option value="Universitario">Universitario</option>
        							  <option value="Postgrado">Postgrado</option>
                        </select> 
                        <div id="mensaje_nivel_educativo_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
            
          	</div>
          	
          	
          	
  			</div>
  			</div>
  			
  			
  			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i> Datos Exactos Domicilio</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_provincias" class="control-label">Provincias:</label>
                          <select  class="form-control" id="id_provincias" name="id_provincias">
                          	<option value="0">--Seleccione--</option>
                          	  <?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>" ><?php echo $res->nombre_provincias; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_provincias" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_cantones" class="control-label">Cantones:</label>
                          <select  class="form-control" id="id_cantones" name="id_cantones">
                          	<option value="0">--Seleccione--</option>
                          	 <?php foreach($resultCantones as $res) {?>
                        		<option value="<?php echo $res->id_cantones; ?>" ><?php echo $res->nombre_cantones; ?> </option>
                        							        
                        	<?php } ?>
                          </select>                         
                          <div id="mensaje_id_cantones" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_parroquias" class="control-label">Parroquias:</label>
                          <select  class="form-control" id="id_parroquias" name="id_parroquias">
                          	<option value="0">--Seleccione--</option>
                          	 <?php foreach($resultParroquias as $res) {?>
                        		<option value="<?php echo $res->id_parroquias; ?>" ><?php echo $res->nombre_parroquias; ?> </option>
                        							        
                        	<?php } ?>
                          </select>                         
                          <div id="mensaje_id_parroquias" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="barrio_solicitud_prestaciones" class="control-label">Barrio y/o Sector:</label>
                    	<input type="text" class="form-control" id="barrio_solicitud_prestaciones" name="barrio_solicitud_prestaciones" placeholder="Barrio">
                        <div id="mensaje_barrio_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
          	</div>
          	
          	
          	<div class="row">
          	
          	<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="ciudadela_solicitud_prestaciones" class="control-label">Ciudadela y/o conjunto/Etapa/Manzana:</label>
                    	<input type="text" class="form-control" id="ciudadela_solicitud_prestaciones" name="ciudadela_solicitud_prestaciones" placeholder="Ciudadela">
                        <div id="mensaje_ciudadela_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="calle_solicitud_prestaciones" class="control-label">Calle:</label>
                    	<input type="text" class="form-control" id="calle_solicitud_prestaciones" name="calle_solicitud_prestaciones" placeholder="Calle">
                        <div id="mensaje_calle_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="numero_calle_solicitud_prestaciones" class="control-label">Número de Calle:</label>
                    	<input type="text" class="form-control" id="numero_calle_solicitud_prestaciones" name="numero_calle_solicitud_prestaciones" placeholder="Número de calle">
                        <div id="mensaje_numero_calle_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
          	
          	</div>
          	
          	<div class="row">
          	
          	
          	<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="interseccion_solicitud_prestaciones" class="control-label">Intersección:</label>
                    	<input type="text" class="form-control" id="interseccion_solicitud_prestaciones" name="interseccion_solicitud_prestaciones" placeholder="Intersección">
                        <div id="mensaje_interseccion_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	
          	
          	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="tipo_vivienda_solicitud_prestaciones" class="control-label">Tipo Vivienda:</label>
                    	<select name="tipo_vivienda_solicitud_prestaciones" id="tipo_vivienda_solicitud_prestaciones"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Propia">Propia</option>
        							  <option value="Arrendada">Arrendada</option>
        							  <option value="Anticresis">Anticresis</option>
        							  <option value="Vive con Familiares">Vive con Familiares</option>
        							  <option value="Otra">Otra</option>
                        </select> 
                        <div id="mensaje_tipo_vivienda_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="vivienda_hipotecada_solicitud_prestaciones" class="control-label">Vivienda HIPOTECADA:</label>
                    	<select name="vivienda_hipotecada_solicitud_prestaciones" id="vivienda_hipotecada_solicitud_prestaciones"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="SI">SI</option>
        							  <option value="NO">NO</option>
        							 
                        </select> 
                        <div id="mensaje_vivienda_hipotecada_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
          	
          	</div>
			 
		   
			
			<div class="row">
			
			<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="referencia_dir_solicitud_prestaciones" class="control-label">Referencia Domiciliaria:</label>
                    	<input type="text" class="form-control" id="referencia_dir_solicitud_prestaciones" name="referencia_dir_solicitud_prestaciones" placeholder="Referencia">
                        <div id="mensaje_referencia_dir_solicitud_prestaciones" class="errores"></div>
                 	</div>
           </div>
			
			</div> 
			 
  			</div>
  			</div>
            
            <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-phone-alt'></i> Números Telefónicos</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="telefono_solicitud_prestaciones" class="control-label">Teléfono:</label>
                    	<input type="text" class="form-control" onkeypress="return soloNumeros(event);" id="telefono_solicitud_prestaciones" name="telefono_solicitud_prestaciones" placeholder="Teléfono">
                        <div id="mensaje_telefono_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="celular_solicitud_prestaciones" class="control-label">Celular:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="celular_solicitud_prestaciones" name="celular_solicitud_prestaciones" placeholder="Celular">
                        <div id="mensaje_celular_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-lg-2 col-xs-12 col-md-2">
                 <div class="form-group">
                                                      <label for="numero_codigo_verificacion" class="control-label">Código Verificación:</label>
                                                      <input type="number" class="form-control" id="numero_codigo_verificacion" name="numero_codigo_verificacion" value="" placeholder="sms..">
                                                      <input type="hidden" class="form-control" id="id_codigo_verificacion" name="id_codigo_verificacion" value="0" readonly>
                                                     
                                                      <div id="mensaje_numero_codigo_verificacion" class="errores"></div>
                </div>
				</div>
				
            					
            					
				<div class="col-lg-4 col-xs-12 col-md-4" style="margin-top: 23px;">
   		   		   <span class="input-group-btn">
	         		<button type="button" id="btn_enviar" name="btn_enviar" class="btn btn-primary">Enviar Código</button>
             		<button type="button" id="btn_verificar" name="btn_verificar" class="btn btn-info">Verificar Código</button>
	         		</span>
   		  		 </div>
            					
             	
             	
             	
              	</div>
    		  </div>
  			</div>
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-align-justify'></i> Referencias Familiares</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
			 
			 
			 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_referencia_familiar" class="control-label">Nombres:</label>
                    	<input type="text" class="form-control" id="nombres_referencia_familiar" name="nombres_referencia_familiar" placeholder="Nombres">
                        <div id="mensaje_nombres_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_referencia_familiar" class="control-label">Apellidos:</label>
                    	<input type="text" class="form-control" id="apellidos_referencia_familiar" name="apellidos_referencia_familiar" placeholder="Apellidos">
                        <div id="mensaje_apellidos_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="parentesco_referencia_familiar" class="control-label">Parentesco:</label>
                    	<select name="parentesco_referencia_familiar" id="parentesco_referencia_familiar"  class="form-control" >
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Primo">Primo</option>
        							  <option value="Tío">Tío</option>
        							  <option value="Hermano">Hermano</option>
        							  <option value="Sobrino">Sobrino</option>
        							  <option value="Abuelo">Abuelo</option>
        							  <option value="Hijo">Hijo</option>
        							  <option value="Madre">Madre</option>
        							  <option value="Padre">Padre</option>
        							  <option value="Otro">Otro</option>
        		           </select> 
                        <div id="mensaje_parentesco_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="primer_telefono_referencia_familiar" class="control-label">Teléfono:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="primer_telefono_referencia_familiar" name="primer_telefono_referencia_familiar" placeholder="Teléfono">
                        <div id="mensaje_primer_telefono_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
             	
              	</div>
              	
              <div class="row">
              	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="segundo_telefono_referencia_familiar" class="control-label">Celular:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="segundo_telefono_referencia_familiar" name="segundo_telefono_referencia_familiar" placeholder="Celular">
                        <div id="mensaje_segundo_telefono_referencia_familiar" class="errores"></div>
                 	</div>
             	</div>
    		  </div>
    		  </div>
  			</div>
            
            
            <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-align-justify'></i> Referencias Personales</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
			 
			 
			 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_referencia_personal" class="control-label">Nombres:</label>
                    	<input type="text" class="form-control" id="nombres_referencia_personal" name="nombres_referencia_personal" placeholder="Nombres">
                        <div id="mensaje_nombres_referencia_personals" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_referencia_personal" class="control-label">Apellidos:</label>
                    	<input type="text" class="form-control" id="apellidos_referencia_personal" name="apellidos_referencia_personal" placeholder="Apellidos">
                        <div id="mensaje_apellidos_referencia_personal" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="parentesco_referencia_personal" class="control-label">Relación:</label>
                    	<select name="parentesco_referencia_personal" id="parentesco_referencia_personal"  class="form-control" >
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Amigo">Amigo</option>
        							  <option value="Compadre">Compadre</option>
        							  <option value="Comadre">Comadre</option>
        							  <option value="Compañero Laboral(a)">Compañero Laboral(a)</option>
        							  <option value="Jefe(a)">Jefe(a)</option>
        							  <option value="Otro">Otro</option>
        			    </select> 
                        <div id="mensaje_parentesco_referencia_personal" class="errores"></div>
                 	</div>
             	</div>
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="primer_telefono_referencia_personal" class="control-label">Teléfono:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="primer_telefono_referencia_personal" name="primer_telefono_referencia_personal" placeholder="Teléfono">
                        <div id="mensaje_primer_telefono_referencia_personal" class="errores"></div>
                 	</div>
             	</div>
             	
              	</div>
              	
              	 <div class="row">
              	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="segundo_telefono_referencia_personal" class="control-label">Celular:</label>
                    	<input type="text" onkeypress="return soloNumeros(event);" class="form-control" id="segundo_telefono_referencia_personal" name="segundo_telefono_referencia_personal" placeholder="Celular">
                        <div id="mensaje_segundo_telefono_referencia_personal" class="errores"></div>
                 	</div>
             	</div>
    		  </div>
  			</div>
  			</div>
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-folder-close'></i> Datos Laborables</h4>
	         </div>
	         <div class="panel-body">
			 
			 
			 <div class="row">
			 
			 
			  
			  	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="ultimo_cargo_solicitud_prestaciones" class="control-label">Ultimo Cargo:</label>
                    	<input type="text" class="form-control" id="ultimo_cargo_solicitud_prestaciones" name="ultimo_cargo_solicitud_prestaciones" placeholder="Cargo">
                        <div id="mensaje_ultimo_cargo_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
			  
			 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="fecha_salida_solicitud_prestaciones" class="control-label">Fecha de Salida:</label>
                    	<input type="date"    class="form-control" id="fecha_salida_solicitud_prestaciones" name="fecha_salida_solicitud_prestaciones" placeholder="Salida">
                        <div id="mensaje_fecha_salida_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
			                    
         	  </div>
			 
  			</div>
  			</div>
  			
  			
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-usd'></i> Datos Cuenta Bancaria</h4>
	         </div>
	         <div class="panel-body">
			 
			 
			 <div class="row">
			 
			 <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_bancos" class="control-label">Banco:</label>
                          <select  class="form-control" id="id_bancos" name="id_bancos">
                          	<option value="0">--Seleccione--</option>
                          	<?php foreach($resultBancos as $res) {?>
                        		<option value="<?php echo $res->id_bancos; ?>" ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        	<?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos" class="errores"></div>
                        </div>
            		  </div>
			  
			  
			  
			  <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="tipo_cuenta_bancaria" class="control-label">Tipo Cuenta:</label>
                                                      <select name="tipo_cuenta_bancaria" id="tipo_cuenta_bancaria"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Ahorros">Ahorros</option>
                        							  <option value="Corriente">Corriente</option>
                        							  </select> 
                                                      <div id="mensaje_tipo_cuenta_bancaria" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="numero_cuenta_bancaria" class="control-label">Número Cuenta:</label>
                                                      <input type="number" class="form-control" id="numero_cuenta_bancaria" name="numero_cuenta_bancaria" value="" placeholder="# cuenta..">
                                                      <div id="mensaje_numero_cuenta_bancaria" class="errores"></div>
                                </div>
                                </div>
			  
			  
			  
			
			                    
         	  </div>
			 
  			</div>
  			</div>
					                		        
                    <div class="row">
    			     <div class="col-lg-12 col-md-12 col-xs-12 " style="text-align: center; margin-top: 10px">
				  	    <div class="form-group">
    	                  <button type="submit" id="Guardar" name="Guardar" value=""   class="btn btn-success" style="margin-top: 10px;"><i class="glyphicon glyphicon-edit"></i> Registrar Solicitud</button>         
					   
	                    </div>
	                    
        		    </div> 
        		    
        		           		    
    		    </div>
 
                      
          <?php } ?>
                  </form>
                  
                </div>
              </div>
		
   </div>
		
		
		
		
	</div>
	</div>
	</div>
	</div>
	    
    
    
  
 
     <!-- Bootstrap -->
    <script src="view/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    
    
    <!-- NProgress -->
    <script src="view/vendors/nprogress/nprogress.js"></script>
   
   
    <!-- Datatables -->
    <script src="view/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    
    
    <script src="view/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    
    
    
    <!-- Custom Theme Scripts -->
    <script src="view/build/js/custom.min.js"></script>
	<script src="view/js/jquery.inputmask.bundle.js"></script>
	<!-- codigo de las funciones -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>


<script src="view/js/SolicitudPrestaciones.js?2.2"></script> 

	
  </body>
</html>     