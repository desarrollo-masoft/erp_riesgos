<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Solicitud Hipotecario - Capremci</title>

	 
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
         <li class="active">Solicitud Hipotecario</li>
         </ol>
         </section>
       
  
		
		<div class="col-md-12 col-lg-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Actualizar<small>Solicitud Hipotecario</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                 <div class="x_content">
           
         <form action="<?php echo $helper->url("SolicitudHipotecario","ActualizaSolicitudHipotecario"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">      
    
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {
              
              ?>
          
           
   		 <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-user'></i> Datos del Crédito</h4>
	         </div>
	         <div class="panel-body">
	         
	         
   		 
   		 <div class="row">
   		 		<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_sucursales" class="control-label">Sucursales:</label>
                          <select  class="form-control" id="id_sucursales" name="id_sucursales" disabled>
                          	<option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultSucursales as $res) {?>
                        										<option value="<?php echo $res->id_sucursales; ?>" <?php if ($res->id_sucursales == $resEdit->id_sucursales ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_sucursales; ?> </option>
                        							        
                        							        <?php } ?>	
                          </select>                         
                          <div id="mensaje_id_sucursales" class="errores"></div>
                        </div>
                </div>
                 	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="valor_dolares_datos_credito" class="control-label">Valor en Dólares:</label>
                    	<input type="text" class="form-control" id="valor_dolares_datos_credito" name="valor_dolares_datos_credito" value='<?php echo $resEdit->valor_dolares_datos_credito; ?>'  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" name="valor_dolares_datos_credito" placeholder="valor" >
                                                    
                        <div id="mensaje_valor_dolares_datos_credito" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="plazo_meses_datos_credito" class="control-label">Plazo en Meses:</label>
                    	<input type="text" class="form-control" id="plazo_meses_datos_credito" name="plazo_meses_datos_credito" value='<?php echo $resEdit->plazo_meses_datos_credito; ?>' placeholder="plazo" >
                        <div id="mensaje_plazo_meses_datos_credito" class="errores"></div>
                 	</div>
             	</div>
             	
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="destino_dinero_datos_credito" class="control-label">Destino del Dinero:</label>
                    	<select name="destino_dinero_datos_credito" id="destino_dinero_datos_credito"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Compra de Terreno"<?php if($resEdit->destino_dinero_datos_credito == 'Compra de Terreno'){echo ' selected="selected" ' ;}else{} ?>>Compra de Terreno</option>
        							  <option value="Compra de Vivienda"<?php if($resEdit->destino_dinero_datos_credito == 'Compra de Vivienda'){echo ' selected="selected" ' ;}else{} ?>>Compra de Vivienda</option>
        							  <option value="Construcción"<?php if($resEdit->destino_dinero_datos_credito == 'Construcción'){echo ' selected="selected" ' ;}else{} ?>>Construcción</option>
        							  <option value="Remodelación"<?php if($resEdit->destino_dinero_datos_credito == 'Remodelación'){echo ' selected="selected" ' ;}else{} ?>>Remodelación</option>
        							  
                        </select> 
                        <div id="mensaje_destino_dinero_datos_credito" class="errores"></div>
                 	</div>
             	</div>
             	
             	
          	</div>
	      	
  			</div>
  			</div>
  			
  			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-user'></i> Datos Personales</h4>
	         </div>
	         <div class="panel-body">
	         
	         
   		 
   		 <div class="row">
          		
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="cedula_datos_personales" class="control-label">Cedula:</label>
                    	<input type="text" readonly="readonly" class="form-control" id="cedula_datos_personales" name="cedula_participes" placeholder="C.I." value="<?php echo $resEdit->cedula_datos_personales; ?>">
                        <input type="hidden" name="id_solicitud_hipotecario" id="id_solicitud_hipotecario" value="<?php echo $resEdit->id_solicitud_hipotecario; ?>" />
                        <div id="mensaje_cedula_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_datos_personales" class="control-label">Nombres:</label>
                    	<input type="text" class="form-control" id="nombres_datos_personales" name="nombres_datos_personales" placeholder="Nombres" value="<?php echo $resEdit->nombres_datos_personales; ?>">
                        <div id="mensaje_nombres_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_datos_personales" class="control-label">Apellidos:</label>
                    	<input type="text" class="form-control" id="apellidos_datos_personales" name="apellidos_datos_personales" placeholder="Apellidos" value="<?php echo $resEdit->apellidos_datos_personales; ?>">
                        <div id="mensaje_apellidos_datos_personales" class="errores"></div>
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
                		<label for="fecha_nacimiento_datos_personales" class="control-label">Fecha de Nacimiento:</label>
                    	<input type="date" class="form-control" id="fecha_nacimiento_datos_personales" name="fecha_nacimiento_datos_personales" placeholder="fecha" value="<?php echo $resEdit->fecha_nacimiento_datos_personales; ?>" >
                        <div id="mensaje_fecha_nacimiento_datos_personales" class="errores"></div>
                 	</div>
             	</div>
          	
          	
          	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="separacion_bienes_datos_personales" class="control-label">Separación de Bienes:</label>
                    	<select name="separacion_bienes_datos_personales" id="separacion_bienes_datos_personales"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Si"<?php if($resEdit->separacion_bienes_datos_personales == 'Si'){echo ' selected="selected" ' ;}else{} ?>>Si</option>
        							  <option value="No"<?php if($resEdit->separacion_bienes_datos_personales == 'No'){echo ' selected="selected" ' ;}else{} ?>>No</option>
        			    </select> 
                        <div id="mensaje_separacion_bienes_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="cargas_familiares_datos_personales" class="control-label">Cargas Familiares:</label>
                    	<select name="cargas_familiares_datos_personales" id="cargas_familiares_datos_personales"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Si"<?php if($resEdit->cargas_familiares_datos_personales == 'Si'){echo ' selected="selected" ' ;}else{} ?>>Si</option>
        							  <option value="No"<?php if($resEdit->cargas_familiares_datos_personales == 'No'){echo ' selected="selected" ' ;}else{} ?>>No</option>
        			    </select> 
                        <div id="mensaje_cargas_familiares_datos_personales" class="errores"></div>
                 	</div>
             	</div>
          	</div>
          	
          	
          	<div class="row">
          	
          	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="numero_hijos_datos_personales" class="control-label">Numero de hijos:</label>
                    	<select name="numero_hijos_datos_personales" id="numero_hijos_datos_personales"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="0"<?php if($resEdit->numero_hijos_datos_personales == '0'){echo ' selected="selected" ' ;}else{} ?>>0</option>
        							  <option value="1"<?php if($resEdit->numero_hijos_datos_personales == '1'){echo ' selected="selected" ' ;}else{} ?>>1</option>
        							  <option value="2"<?php if($resEdit->numero_hijos_datos_personales == '2'){echo ' selected="selected" ' ;}else{} ?>>2</option>
        							  <option value="3"<?php if($resEdit->numero_hijos_datos_personales == '3'){echo ' selected="selected" ' ;}else{} ?>>3</option>
        							  <option value="4"<?php if($resEdit->numero_hijos_datos_personales == '4'){echo ' selected="selected" ' ;}else{} ?>>4</option>
        							  <option value="5"<?php if($resEdit->numero_hijos_datos_personales == '5'){echo ' selected="selected" ' ;}else{} ?>>5</option>
        							  <option value="6"<?php if($resEdit->numero_hijos_datos_personales == '6'){echo ' selected="selected" ' ;}else{} ?>>6</option>
        							  <option value="7"<?php if($resEdit->numero_hijos_datos_personales == '7'){echo ' selected="selected" ' ;}else{} ?>>7</option>
        							  <option value="8"<?php if($resEdit->numero_hijos_datos_personales == '8'){echo ' selected="selected" ' ;}else{} ?>>8</option>
        							  <option value="9"<?php if($resEdit->numero_hijos_datos_personales == '9'){echo ' selected="selected" ' ;}else{} ?>>9</option>
        							  <option value="10"<?php if($resEdit->numero_hijos_datos_personales == '10'){echo ' selected="selected" ' ;}else{} ?>>10</option>
        			    </select> 
                        <div id="mensaje_numero_hijos_datos_personales" class="errores"></div>
                 	</div>
             	</div>
          	
          	
          	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="email_datos_personales" class="control-label">E-mail:</label>
                    	<input type="text" class="form-control" id="email_datos_personales" name="email_datos_personales" placeholder="E-mail" value="<?php echo $resEdit->email_datos_personales; ?>">
                        <div id="mensaje_email_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nivel_educativo_datos_personales" class="control-label">Nivel Educativo:</label>
                    	<select name="nivel_educativo_datos_personales" id="nivel_educativo_datos_personales"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Primario"<?php if($resEdit->nivel_educativo_datos_personales == 'Primario'){echo ' selected="selected" ' ;}else{} ?>>Primario</option>
        							  <option value="Secundario"<?php if($resEdit->nivel_educativo_datos_personales == 'Secundario'){echo ' selected="selected" ' ;}else{} ?>>Secundario</option>
        							  <option value="Técnico"<?php if($resEdit->nivel_educativo_datos_personales == 'Técnico'){echo ' selected="selected" ' ;}else{} ?>>Técnico</option>
        							  <option value="Universitario"<?php if($resEdit->nivel_educativo_datos_personales == 'Universitario'){echo ' selected="selected" ' ;}else{} ?>>Universitario</option>
        							  <option value="Postgrado"<?php if($resEdit->nivel_educativo_datos_personales == 'Postgrado'){echo ' selected="selected" ' ;}else{} ?>>Postgrado</option>
                        </select> 
                        <div id="mensaje_nivel_educativo_datos_personales" class="errores"></div>
                 	</div>
             	</div>
            
          	
          	</div>
          	
          	

          	</div>
      
  			</div>
  			
  			
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-phone-alt'></i> Direccion Exaxta del Domicilio</h4>
	         </div>
	         <div class="panel-body">
			 	
          	
          	
          	<div class="row">
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_provincia" class="control-label">Provincia:</label>
                          <select  class="form-control" id="id_provincia" name="id_provincia">
                          <option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>" <?php if ($res->id_provincias == $resEdit->id_provincia ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_provincias; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_provincia" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_canton" class="control-label">Cantón:</label>
                          <select  class="form-control" id="id_canton" name="id_canton">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultCantones as $res) {?>
                        										<option value="<?php echo $res->id_cantones; ?>" <?php if ($res->id_cantones == $resEdit->id_canton ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_cantones; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_canton" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_parroquia" class="control-label">Parroquia:</label>
                          <select  class="form-control" id="id_parroquia" name="id_parroquia">
                          <option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultParroquias as $res) {?>
                        										<option value="<?php echo $res->id_parroquias; ?>" <?php if ($res->id_parroquias == $resEdit->id_parroquia ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_parroquias; ?> </option>
                        							        
                        							        <?php } ?>
                          	
                          </select>                         
                          <div id="mensaje_id_parroquia" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="barrio_datos_personales" class="control-label">Barrio y/o Sector:</label>
                    	<input type="text" class="form-control" id="barrio_datos_personales" name="barrio_datos_personales" placeholder="Barrio" value="<?php echo $resEdit->barrio_datos_personales; ?>">
                        <div id="mensaje_barrio_datos_personales" class="errores"></div>
                 	</div>
             	</div>
          	</div>
          	
          	<div class="row">
          	
          	<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="ciudadela_datos_personales" class="control-label">Ciudadela y/o conjunto/Etapa/Manzana:</label>
                    	<input type="text" class="form-control" id="ciudadela_datos_personales" name="ciudadela_datos_personales" placeholder="Ciudadela" value="<?php echo $resEdit->ciudadela_datos_personales; ?>">
                        <div id="mensaje_ciudadela_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="calle_datos_personales" class="control-label">Calle:</label>
                    	<input type="text" class="form-control" id="calle_datos_personales" name="calle_datos_personales" placeholder="Calle" value="<?php echo $resEdit->calle_datos_personales; ?>">
                        <div id="mensaje_calle_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="numero_calle_datos_personales" class="control-label">Número de Calle:</label>
                    	<input type="text" class="form-control" id="numero_calle_datos_personales" name="numero_calle_datos_personales" placeholder="Número" value="<?php echo $resEdit->numero_calle_datos_personales; ?>">
                        <div id="mensaje_numero_calle_datos_personales" class="errores"></div>
                 	</div>
             	</div>
          	
          	</div>
          	
          
          	<div class="row">
          	
          	
          	<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="interseccion_datos_personales" class="control-label">Intersección:</label>
                    	<input type="text" class="form-control" id="interseccion_datos_personales" name="interseccion_datos_personales" placeholder="Intersección" value="<?php echo $resEdit->interseccion_datos_personales; ?>">
                        <div id="mensaje_interseccion_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
          	
          	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="tipo_vivienda_datos_personales" class="control-label">Tipo Vivienda:</label>
                    	<select name="tipo_vivienda_datos_personales" id="tipo_vivienda_datos_personales"  class="form-control">
                                       <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Propia" <?php if($resEdit->tipo_vivienda_datos_personales == 'Propia'){echo ' selected="selected" ' ;}else{} ?>>Propia</option>
        							  <option value="Arrendada" <?php if($resEdit->tipo_vivienda_datos_personales == 'Arrendada'){echo ' selected="selected" ' ;}else{} ?>>Arrendada</option>
        							  <option value="Anticresis" <?php if($resEdit->tipo_vivienda_datos_personales == 'Anticresis'){echo ' selected="selected" ' ;}else{} ?>>Anticresis</option>
        							  <option value="Vive con Familiares" <?php if($resEdit->tipo_vivienda_datos_personales == 'Vive con Familiares'){echo ' selected="selected" ' ;}else{} ?>>Vive con Familiares</option>
        							  <option value="Otra" <?php if($resEdit->tipo_vivienda_datos_personales == 'Otra'){echo ' selected="selected" ' ;}else{} ?>>Otra</option>
             </select> 
                        <div id="mensaje_tipo_vivienda_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="vivienda_hipotecada_datos_personales" class="control-label">Vivienda HIPOTECADA:</label>
                    	<select name="vivienda_hipotecada_datos_personales" id="vivienda_hipotecada_datos_personales"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="SI"<?php if($resEdit->vivienda_hipotecada_datos_personales == 'SI'){echo ' selected="selected" ' ;}else{} ?>>SI</option>
        							  <option value="NO"<?php if($resEdit->vivienda_hipotecada_datos_personales == 'NO'){echo ' selected="selected" ' ;}else{} ?>>NO</option>
        							 
                        </select> 
                        <div id="mensaje_vivienda_hipotecada_datos_personales" class="errores"></div>
                 	</div>
             	</div>
          	
          	</div>
          
          	<div class="row">
          	
          	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="tiempo_residencia_datos_personales" class="control-label">Tiempo de Residencia en años:</label>
                    	<select name="tiempo_residencia_datos_personales" id="tiempo_residencia_datos_personales"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="1 año"<?php if($resEdit->tiempo_residencia_datos_personales == '1 año'){echo ' selected="selected" ' ;}else{} ?>>1 año</option>
        							  <option value="2 años"<?php if($resEdit->tiempo_residencia_datos_personales == '2 años'){echo ' selected="selected" ' ;}else{} ?>>2 años</option>
        							  <option value="3 años"<?php if($resEdit->tiempo_residencia_datos_personales == '3 años'){echo ' selected="selected" ' ;}else{} ?>>3 años</option>
        							  <option value="4 años"<?php if($resEdit->tiempo_residencia_datos_personales == '4 años'){echo ' selected="selected" ' ;}else{} ?>>4 años</option>
        							  <option value="5 años"<?php if($resEdit->tiempo_residencia_datos_personales == '5 años'){echo ' selected="selected" ' ;}else{} ?>>5 años</option>
        							  <option value="6 años"<?php if($resEdit->tiempo_residencia_datos_personales == '6 años'){echo ' selected="selected" ' ;}else{} ?>>6 años</option>
        							  <option value="7 años"<?php if($resEdit->tiempo_residencia_datos_personales == '7 años'){echo ' selected="selected" ' ;}else{} ?>>7 años</option>
        							  <option value="8 años"<?php if($resEdit->tiempo_residencia_datos_personales == '8 años'){echo ' selected="selected" ' ;}else{} ?>>8 años</option>
        							  <option value="9 años"<?php if($resEdit->tiempo_residencia_datos_personales == '9 años'){echo ' selected="selected" ' ;}else{} ?>>9 años</option>
        							  <option value="10 años"<?php if($resEdit->tiempo_residencia_datos_personales == '10 años'){echo ' selected="selected" ' ;}else{} ?>>10 años</option>
        							  <option value="11 años"<?php if($resEdit->tiempo_residencia_datos_personales == '11 años'){echo ' selected="selected" ' ;}else{} ?>>11 años</option>
        							  <option value="12 años"<?php if($resEdit->tiempo_residencia_datos_personales == '12 años'){echo ' selected="selected" ' ;}else{} ?>>12 años</option>
        							  <option value="13 años"<?php if($resEdit->tiempo_residencia_datos_personales == '13 años'){echo ' selected="selected" ' ;}else{} ?>>13 años</option>
        							  <option value="14 años"<?php if($resEdit->tiempo_residencia_datos_personales == '14 años'){echo ' selected="selected" ' ;}else{} ?>>14 años</option>
        							  <option value="15 años"<?php if($resEdit->tiempo_residencia_datos_personales == '15 años'){echo ' selected="selected" ' ;}else{} ?>>15 años</option>
        							  <option value="16 años"<?php if($resEdit->tiempo_residencia_datos_personales == '16 años'){echo ' selected="selected" ' ;}else{} ?>>16 años</option>
        							  <option value="17 años"<?php if($resEdit->tiempo_residencia_datos_personales == '17 años'){echo ' selected="selected" ' ;}else{} ?>>17 años</option>
        							  <option value="18 años"<?php if($resEdit->tiempo_residencia_datos_personales == '18 años'){echo ' selected="selected" ' ;}else{} ?>>18 años</option>
        							  <option value="19 años"<?php if($resEdit->tiempo_residencia_datos_personales == '19 años'){echo ' selected="selected" ' ;}else{} ?>>19 años</option>
        							  <option value="20 años"<?php if($resEdit->tiempo_residencia_datos_personales == '20 años'){echo ' selected="selected" ' ;}else{} ?>>20 años</option>
        							  <option value="21 años"<?php if($resEdit->tiempo_residencia_datos_personales == '21 años'){echo ' selected="selected" ' ;}else{} ?>>21 años</option>
        							  <option value="22 años"<?php if($resEdit->tiempo_residencia_datos_personales == '22 años'){echo ' selected="selected" ' ;}else{} ?>>22 años</option>
        							  <option value="23 años"<?php if($resEdit->tiempo_residencia_datos_personales == '23 años'){echo ' selected="selected" ' ;}else{} ?>>23 años</option>
        							  <option value="24 años"<?php if($resEdit->tiempo_residencia_datos_personales == '24 años'){echo ' selected="selected" ' ;}else{} ?>>24 años</option>
        							  <option value="25 años"<?php if($resEdit->tiempo_residencia_datos_personales == '25 años'){echo ' selected="selected" ' ;}else{} ?>>25 años</option>
        							  <option value="26 años"<?php if($resEdit->tiempo_residencia_datos_personales == '26 años'){echo ' selected="selected" ' ;}else{} ?>>26 años</option>
        							  <option value="27 años"<?php if($resEdit->tiempo_residencia_datos_personales == '27 años'){echo ' selected="selected" ' ;}else{} ?>>27 años</option>
        							  <option value="28 años"<?php if($resEdit->tiempo_residencia_datos_personales == '28 años'){echo ' selected="selected" ' ;}else{} ?>>28 años</option>
        							  <option value="29 años"<?php if($resEdit->tiempo_residencia_datos_personales == '29 años'){echo ' selected="selected" ' ;}else{} ?>>29 años</option>
        							  <option value="30 años"<?php if($resEdit->tiempo_residencia_datos_personales == '30 años'){echo ' selected="selected" ' ;}else{} ?>>30 años</option>
        							  <option value="mas de 30 años"<?php if($resEdit->tiempo_residencia_datos_personales == 'mas de 30 años'){echo ' selected="selected" ' ;}else{} ?>>mas de 30 años</option>
        							  
        							 
                        </select> 
                        <div id="mensaje_tiempo_residencia_datos_personales" class="errores"></div>
                 	</div>
             	</div>
           
			<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="referencia_domiciliaria_datos_perdonales" class="control-label">Referencia Domiciliaria:</label>
                    	<input type="text" class="form-control" id="referencia_domiciliaria_datos_perdonales" name="referencia_domiciliaria_datos_perdonales"  placeholder="Referencia" value="<?php echo $resEdit->referencia_domiciliaria_datos_perdonales; ?>">
                        <div id="mensaje_referencia_domiciliaria_datos_perdonales" class="errores"></div>
                 	</div>
           </div>
			
			</div>
          	
    		  </div>
  			</div>
  			
  			
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-phone-alt'></i>En Caso de No tener Vivienda Propia</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombre_arrendatario_datos_personales" class="control-label">Nombres Arrendatario:</label>
                    	<input type="text" class="form-control"  id="nombre_arrendatario_datos_personales" name="nombre_arrendatario_datos_personales" placeholder="nombres" value="<?php echo $resEdit->nombre_arrendatario_datos_personales; ?>">
                        <div id="mensaje_nombre_arrendatario_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellido_arrendatario_datos_personales" class="control-label">Apellidos Arrendatario:</label>
                    	<input type="text"  class="form-control" id="apellido_arrendatario_datos_personales" name="apellido_arrendatario_datos_personales" placeholder="apellidos" value="<?php echo $resEdit->apellido_arrendatario_datos_personales; ?>">
                        <div id="mensaje_celular_solicitud_prestaciones" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="celular_arrendatario_datos_personales" class="control-label">Celular Arrendatario:</label>
                    	<input type="text"  class="form-control" id="celular_arrendatario_datos_personales" onKeyPress="return checkIt(event)" name="celular_arrendatario_datos_personales" placeholder="Celular" value="<?php echo $resEdit->celular_arrendatario_datos_personales; ?>">
                        <div id="mensaje_celular_arrendatario_datos_personales" class="errores"></div>
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
                		<label for="telefono_datos_personales" class="control-label">Teléfono:</label>
                    	<input type="text" class="form-control"  id="telefono_datos_personales" onKeyPress="return checkIt(event)" maxlength="10" name="telefono_datos_personales" placeholder="Teléfono" value="<?php echo $resEdit->telefono_datos_personales; ?>">
                        <div id="mensaje_telefono_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="celular_datos_personales" class="control-label">Celular:</label>
                    	<input type="text"  class="form-control" id="celular_datos_personales" onKeyPress="return checkIt(event)" maxlength="10" name="celular_datos_personales" placeholder="Celular" value="<?php echo $resEdit->celular_datos_personales; ?>">
                        <div id="mensaje_celular_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="telf_trabajo_datos_personales" class="control-label">Teléfono del Trabajo:</label>
                    	<input type="text"  class="form-control" id="telf_trabajo_datos_personales" onKeyPress="return checkIt(event)" maxlength="10" name="telf_trabajo_datos_personales" placeholder="Teléfono" value="<?php echo $resEdit->telf_trabajo_datos_personales; ?>">
                        <div id="mensaje_telf_trabajo_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="ext_telef_datos_personales" class="control-label">Ext:</label>
                    	<input type="text"  class="form-control" id="ext_telef_datos_personales" onKeyPress="return checkIt(event)" name="ext_telef_datos_personales" placeholder="ext.." value="<?php echo $resEdit->ext_telef_datos_personales; ?>">
                        <div id="ext_telef_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
             	
				
             	
              	</div>
              	
              	
              	
              	<div class="row">
              	
              	
              		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="node_telef_datos_personales" class="control-label">Node:</label>
                    	<input type="text"  class="form-control" id="node_telef_datos_personales" onKeyPress="return checkIt(event)" name="node_telef_datos_personales" placeholder="node" value="<?php echo $resEdit->node_telef_datos_personales; ?>">
                        <div id="mensaje_node_telef_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
              	
              	
              	<div class="col-lg-2 col-xs-12 col-md-2">
                 <div class="form-group">
                                                      <label for="numero_codigo_verificacion" class="control-label">Código Verificación:</label>
                                                      <input type="number" class="form-control" id="numero_codigo_verificacion" name="numero_codigo_verificacion" value="<?php echo $resEdit->numero_codigo_verificacion; ?>" placeholder="sms..">
                                                      <input type="hidden" class="form-control" id="id_codigo_verificacion" name="id_codigo_verificacion" value="<?php echo $resEdit->id_codigo_verificacion; ?>" readonly>
                                                      <input type="hidden" class="form-control" id="identificador_consecutivos" name="identificador_consecutivos" value="<?php echo $resEdit->identificador_consecutivos; ?>" readonly>
                                                     
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
	         <h4><i class='glyphicon glyphicon-align-justify'></i> Referencia Familiar que no Viva con Usted</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
			 
			 
			 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_referencia_familiar_datos_personales" class="control-label">Nombres:</label>
                    	<input type="text" class="form-control" id="nombres_referencia_familiar_datos_personales" name="nombres_referencia_familiar_datos_personales" placeholder="Nombres" value="<?php echo $resEdit->nombres_referencia_familiar_datos_personales; ?>">
                        <div id="mensaje_nombres_referencia_familiar_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_referencia_familiar_datos_personales" class="control-label">Apellidos:</label>
                    	<input type="text" class="form-control" id="apellidos_referencia_familiar_datos_personales" name="apellidos_referencia_familiar_datos_personales" placeholder="Apellidos" value="<?php echo $resEdit->apellidos_referencia_familiar_datos_personales; ?>">
                        <div id="mensaje_apellidos_referencia_familiar_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="parentesco_referencia_familiar_datos_personales" class="control-label">Parentesco:</label>
                    	<select name="parentesco_referencia_familiar_datos_personales" id="parentesco_referencia_familiar_datos_personales"  class="form-control" >
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Primo"<?php if($resEdit->parentesco_referencia_familiar_datos_personales == 'Primo'){echo ' selected="selected" ' ;}else{} ?>>Primo</option>
        							  <option value="Tío"<?php if($resEdit->parentesco_referencia_familiar_datos_personales == 'Tío'){echo ' selected="selected" ' ;}else{} ?>>Tío</option>
        							  <option value="Hermano"<?php if($resEdit->parentesco_referencia_familiar_datos_personales == 'Hermano'){echo ' selected="selected" ' ;}else{} ?>>Hermano</option>
        							  <option value="Sobrino"<?php if($resEdit->parentesco_referencia_familiar_datos_personales == 'Sobrino'){echo ' selected="selected" ' ;}else{} ?>>Sobrino</option>
        							  <option value="Abuelo"<?php if($resEdit->parentesco_referencia_familiar_datos_personales == 'Abuelo'){echo ' selected="selected" ' ;}else{} ?>>Abuelo</option>
        							  <option value="Hijo"<?php if($resEdit->parentesco_referencia_familiar_datos_personales == 'Hijo'){echo ' selected="selected" ' ;}else{} ?>>Hijo</option>
        							  <option value="Madre"<?php if($resEdit->parentesco_referencia_familiar_datos_personales == 'Madre'){echo ' selected="selected" ' ;}else{} ?>>Madre</option>
        							  <option value="Padre"<?php if($resEdit->parentesco_referencia_familiar_datos_personales == 'Padre'){echo ' selected="selected" ' ;}else{} ?>>Padre</option>
        							  <option value="Otro"<?php if($resEdit->parentesco_referencia_familiar_datos_personales == 'Otro'){echo ' selected="selected" ' ;}else{} ?>>Otro</option>
        		           </select> 
                        <div id="mensaje_parentesco_referencia_familiar_datos_personales" class="errores"></div>
                 	</div>
             	</div>
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="primer_telefono_ref_familiar_datos_personales" class="control-label">Teléfono:</label>
                    	<input type="text"  class="form-control"  onKeyPress="return checkIt(event)" id="primer_telefono_ref_familiar_datos_personales" maxlength="10" name="primer_telefono_ref_familiar_datos_personales" placeholder="Teléfono" value="<?php echo $resEdit->primer_telefono_ref_familiar_datos_personales; ?>">
                        <div id="mensaje_primer_telefono_ref_familiar_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
              	</div>
              	
              <div class="row">
              	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="segundo_telefono_ref_familiar_datos_personales" class="control-label">Celular:</label>
                    	<input type="text"  class="form-control" onKeyPress="return checkIt(event)" id="segundo_telefono_ref_familiar_datos_personales" maxlength="10" name="segundo_telefono_ref_familiar_datos_personales" placeholder="Celular" value="<?php echo $resEdit->segundo_telefono_ref_familiar_datos_personales; ?>">
                        <div id="mensaje_segundo_telefono_ref_familiar_datos_personales" class="errores"></div>
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
                		<label for="nombres_referencia_personal_datos_personales" class="control-label">Nombres:</label>
                    	<input type="text" class="form-control" id="nombres_referencia_personal_datos_personales" name="nombres_referencia_personal_datos_personales" placeholder="Nombres" value="<?php echo $resEdit->nombres_referencia_personal_datos_personales; ?>">
                        <div id="mensaje_nombres_referencia_personal_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_referencia_personal_datos_personales" class="control-label">Apellidos:</label>
                    	<input type="text" class="form-control" id="apellidos_referencia_personal_datos_personales" name="apellidos_referencia_personal_datos_personales" placeholder="Apellidos" value="<?php echo $resEdit->apellidos_referencia_personal_datos_personales; ?>">
                        <div id="mensaje_apellidos_referencia_personal_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="relacion_referencia_personal_datos_personales" class="control-label">Relación:</label>
                    	<select name="relacion_referencia_personal_datos_personales" id="relacion_referencia_personal_datos_personales"  class="form-control" >
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Amigo"<?php if($resEdit->relacion_referencia_personal_datos_personales == 'Amigo'){echo ' selected="selected" ' ;}else{} ?>>Amigo</option>
        							  <option value="Compadre"<?php if($resEdit->relacion_referencia_personal_datos_personales == 'Compadre'){echo ' selected="selected" ' ;}else{} ?>>Compadre</option>
        							  <option value="Comadre"<?php if($resEdit->relacion_referencia_personal_datos_personales == 'Comadre'){echo ' selected="selected" ' ;}else{} ?>>Comadre</option>
        							  <option value="Compañero Laboral(a)"<?php if($resEdit->relacion_referencia_personal_datos_personales == 'Compañero Laboral(a)'){echo ' selected="selected" ' ;}else{} ?>>Compañero Laboral(a)</option>
        							  <option value="Jefe(a)"<?php if($resEdit->relacion_referencia_personal_datos_personales == 'Jefe(a)'){echo ' selected="selected" ' ;}else{} ?>>Jefe(a)</option>
        							  <option value="Otro"<?php if($resEdit->relacion_referencia_personal_datos_personales == 'Otro'){echo ' selected="selected" ' ;}else{} ?>>Otro</option>
        			    </select> 
                        <div id="mensaje_relacion_referencia_personal_datos_personales" class="errores"></div>
                 	</div>
             	</div>
          		<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="primer_telefono_ref_personal_datos_personales" class="control-label">Teléfono:</label>
                    	<input type="text"  class="form-control" onKeyPress="return checkIt(event)" id="primer_telefono_ref_personal_datos_personales" maxlength="10" name="primer_telefono_ref_personal_datos_personales" placeholder="Teléfono" value="<?php echo $resEdit->primer_telefono_ref_personal_datos_personales; ?>">
                        <div id="mensaje_primer_telefono_ref_personal_datos_personales" class="errores"></div>
                 	</div>
             	</div>
             	
              	</div>
              	
              	 <div class="row">
              	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="segundo_telefono_ref_personal_datos_personales" class="control-label">Celular:</label>
                    	<input type="text"  class="form-control" onKeyPress="return checkIt(event)" id="segundo_telefono_ref_personal_datos_personales" maxlength="10" name="segundo_telefono_ref_personal_datos_personales" placeholder="Celular" value="<?php echo $resEdit->segundo_telefono_ref_personal_datos_personales; ?>">
                        <div id="mensaje_segundo_telefono_ref_personal_datos_personales" class="errores"></div>
                 	</div>
             	</div>
    		  </div>
  			</div>
  			</div>
  			
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i> Datos Laborales</h4>
	         </div>
	         <div class="panel-body">
			 
			 
			 <div class="row">
                    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_entidades" class="control-label">Institucion o Empresa:</label>
                          <select  class="form-control" id="id_entidades" name="id_entidades">
                          	 <option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultInstitucion as $res) {?>
                        										<option value="<?php echo $res->id_entidades; ?>" <?php if ($res->id_entidades == $resEdit->id_entidades ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_entidades; ?> </option>
                        							        
                        							        <?php } ?>
                          	
                          </select>                         
                          <div id="mensaje_id_entidades" class="errores"></div>
                        </div>
            		  </div>
            		  
            	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="reparto_unidad_datos_laborales" class="control-label">Reparto o Unidad:</label>
                    	<input type="text" class="form-control" id="reparto_unidad_datos_laborales" name="reparto_unidad_datos_laborales" placeholder="unidad" value="<?php echo $resEdit->reparto_unidad_datos_laborales; ?>">
                        <div id="mensaje_reparto_unidad_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
             	
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="seccion_datos_laborales" class="control-label">Sección:</label>
                    	<input type="text" class="form-control" id="seccion_datos_laborales" name="seccion_datos_laborales" placeholder="sección" value="<?php echo $resEdit->seccion_datos_laborales; ?>">
                        <div id="mensaje_seccion_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_jefe_datos_laborales" class="control-label">Nombre del Jefe Inmediato:</label>
                    	<input type="text" class="form-control" id="nombres_jefe_datos_laborales" name="nombres_jefe_datos_laborales" placeholder="Nombres" value="<?php echo $resEdit->nombres_jefe_datos_laborales; ?>">
                        <div id="mensaje_nombres_jefe_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
             	
             	</div>
             	
             	
             	<div class="row">
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_jefe_datos_laborales" class="control-label">Apellido del Jefe Inmediato:</label>
                    	<input type="text" class="form-control" id="apellidos_jefe_datos_laborales" name="apellidos_jefe_datos_laborales" placeholder="Apellidos" value="<?php echo $resEdit->apellidos_jefe_datos_laborales; ?>">
                        <div id="mensaje_apellidos_jefe_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="telefono_jefe_datos_laborales" class="control-label">Teléfono del Jefe Inmediato:</label>
                    	<input type="text" class="form-control" onKeyPress="return checkIt(event)" id="telefono_jefe_datos_laborales" maxlength="10" name="telefono_jefe_datos_laborales" placeholder="Teléfono" value="<?php echo $resEdit->telefono_jefe_datos_laborales; ?>">
                        <div id="mensaje_telefono_jefe_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
             	
             	 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="cargo_actual_datos_laborales" class="control-label">Cargo Actual:</label>
                    	<input type="text" class="form-control" id="cargo_actual_datos_laborales" name="cargo_actual_datos_laborales" placeholder="cargo" value="<?php echo $resEdit->cargo_actual_datos_laborales; ?>">
                        <div id="mensaje_cargo_actual_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
             	
             	
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="anios_servicio_datos_laborales" class="control-label">Años de Servicio:</label>
                    	<input type="text" class="form-control" id="anios_servicio_datos_laborales" name="anios_servicio_datos_laborales" placeholder="años" value="<?php echo $resEdit->anios_servicio_datos_laborales; ?>">
                        <div id="mensaje_anios_servicio_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
             	
             	</div>
             	
             	
             	<div class="row">
            		  
                <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_provincia_datos_laborales" class="control-label">Provincia:</label>
                          <select  class="form-control" id="id_provincia_datos_laborales" name="id_provincia_datos_laborales">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>" <?php if ($res->id_provincias == $resEdit->id_provincia_datos_laborales ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_provincias; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_provincia_datos_laborales" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_canton_datos_laborales" class="control-label">Cantón:</label>
                          <select  class="form-control" id="id_canton_datos_laborales" name="id_canton_datos_laborales">
                          		<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultCantones as $res) {?>
                        										<option value="<?php echo $res->id_cantones; ?>" <?php if ($res->id_cantones == $resEdit->id_canton_datos_laborales ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_cantones; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_canton_datos_laborales" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_parroquia_datos_laborales" class="control-label">Parroquia:</label>
                          <select  class="form-control" id="id_parroquia_datos_laborales" name="id_parroquia_datos_laborales">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultParroquias as $res) {?>
                        										<option value="<?php echo $res->id_parroquias; ?>" <?php if ($res->id_parroquias == $resEdit->id_parroquia_datos_laborales ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_parroquias; ?> </option>
                        							        
                        							        <?php } ?>
                          	
                          </select>                         
                          <div id="mensaje_id_parroquia_datos_laborales" class="errores"></div>
                        </div>
            		  </div>
            		  
               <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="calle_datos_laborales" class="control-label">Calle:</label>
                    	<input type="text" class="form-control" id="calle_datos_laborales" name="calle_datos_laborales" placeholder="calle" value="<?php echo $resEdit->calle_datos_laborales; ?>">
                        <div id="mensaje_calle_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
                        		
            </div>
			 
		  	<div class="row">
		  	
		  	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="numero_calle_datos_laborales" class="control-label">Número:</label>
                    	<input type="text" class="form-control" id="numero_calle_datos_laborales" name="numero_calle_datos_laborales" placeholder="número" value="<?php echo $resEdit->numero_calle_datos_laborales; ?>">
                        <div id="mensaje_numero_calle_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
             	
             	
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="interseccion_datos_laborales" class="control-label">Intersección:</label>
                    	<input type="text" class="form-control" id="interseccion_datos_laborales" name="interseccion_datos_laborales" placeholder="interseccion" value="<?php echo $resEdit->interseccion_datos_laborales; ?>">
                        <div id="mensaje_interseccion_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
		  	 	
            <div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="referencia_direccion_trabajo_datos_laborales" class="control-label">Referencia de la dirección de trabajo:</label>
                    	<input type="text" class="form-control" id="referencia_direccion_trabajo_datos_laborales" name="referencia_direccion_trabajo_datos_laborales" placeholder="Apellidos" value="<?php echo $resEdit->referencia_direccion_trabajo_datos_laborales; ?>">
                        <div id="mensaje_referencia_direccion_trabajo_datos_laborales" class="errores"></div>
                 	</div>
             	</div>
		  	
		  	
		  	</div>	    
			 
			 
			 
			 
			 
			 
  			</div>
  			</div>
  			
  		<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i> Datos Del Conyuge</h4>
	         </div>
	         <div class="panel-body">
			 
			 
			  <div class="row">
          		
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="cedula_datos_conyuge" class="control-label">Cedula:</label>
                    	<input type="text"  class="form-control" onKeyPress="return checkIt(event)" id="cedula_datos_conyuge" name="cedula_datos_conyuge" placeholder="C.I." value="<?php echo $resEdit->cedula_datos_conyuge; ?>">
                        <div id="mensaje_cedula_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_datos_conyuge" class="control-label">Nombres:</label>
                    	<input type="text" class="form-control" id="nombres_datos_conyuge" name="nombres_datos_conyuge" placeholder="Nombres" value="<?php echo $resEdit->nombres_datos_conyuge; ?>">
                        <div id="mensaje_nombres_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_datos_conyuge" class="control-label">Apellidos:</label>
                    	<input type="text" class="form-control" id="apellidos_datos_conyuge" name="apellidos_datos_conyuge" placeholder="Apellidos" value="<?php echo $resEdit->apellidos_datos_conyuge; ?>">
                        <div id="mensaje_apellidos_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_sexo_datos_conyuge" class="control-label">Género:</label>
                          <select  class="form-control" id="id_sexo_datos_conyuge" name="id_sexo_datos_conyuge">
                          	 <option value="0" selected="selected">--Seleccione--</option>
                        								
                          	 <?php foreach($resultGenero as $res) {?>
                        		<option value="<?php echo $res->id_sexo; ?>" <?php if ($res->id_sexo == $resEdit->id_sexo_datos_conyuge ){  echo  ' selected="selected" '  ;}  ?>><?php echo $res->nombre_sexo; ?> </option>
                        							        
                        	<?php } ?>
                          </select>                         
                          <div id="mensaje_id_sexo_datos_conyuge" class="errores"></div>
                        </div>
                </div>
          	</div>   
			 
			 
			 <div class="row">
			 
			<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="fecha_nacimiento_datos_conyuge" class="control-label">Fecha de Nacimiento:</label>
                    	<input type="date" class="form-control" id="fecha_nacimiento_datos_conyuge" name="fecha_nacimiento_datos_conyuge" placeholder="Apellidos" value="<?php echo $resEdit->fecha_nacimiento_datos_conyuge; ?>">
                        <div id="mensaje_fecha_nacimiento_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
			
			<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="vive_residencia_datos_conyuge" class="control-label">Vive en la Residencia:</label>
                    	<select name="vive_residencia_datos_conyuge" id="vive_residencia_datos_conyuge"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Si"<?php if($resEdit->vive_residencia_datos_conyuge == 'Si'){echo ' selected="selected" ' ;}else{} ?>>Si</option>
        							  <option value="No"<?php if($resEdit->vive_residencia_datos_conyuge == 'No'){echo ' selected="selected" ' ;}else{} ?>>No</option>
        			    </select> 
                        <div id="mensaje_vive_residencia_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	
             	
             	
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="telefono_datos_conyuge" class="control-label">Teléfono:</label>
                    	<input type="text" class="form-control" onKeyPress="return checkIt(event)" id="telefono_datos_conyuge" name="telefono_datos_conyuge" maxlength="10" placeholder="telefono" value="<?php echo $resEdit->telefono_datos_conyuge; ?>">
                        <div id="mensaje_telefono_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	
             	
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="celular_datos_conyuge" class="control-label">Celular:</label>
                    	<input type="text" class="form-control" onKeyPress="return checkIt(event)" id="celular_datos_conyuge" name="celular_datos_conyuge" maxlength="10" placeholder="celular" value="<?php echo $resEdit->celular_datos_conyuge; ?>">
                        <div id="mensaje_celular_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
			 
			 
			 </div>
			 
			 
			 
  			</div>
  			</div>
  			
  			
  			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i> Si no vive el conyuge: Dirección Exacta</h4>
	         </div>
	         <div class="panel-body">
			 
				<div class="row">
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_provincia_datos_conyuge" class="control-label">Provincia:</label>
                          <select  class="form-control" id="id_provincia_datos_conyuge" name="id_provincia_datos_conyuge">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>" <?php if ($res->id_provincias == $resEdit->id_provincia_datos_conyuge ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_provincias; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_provincia_datos_conyuge" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_canton_datos_conyuge" class="control-label">Cantón:</label>
                          <select  class="form-control" id="id_canton_datos_conyuge" name="id_canton_datos_conyuge">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultCantones as $res) {?>
                        										<option value="<?php echo $res->id_cantones; ?>" <?php if ($res->id_cantones == $resEdit->id_canton_datos_conyuge ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_cantones; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_canton_datos_conyuge" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_parroquia_datos_conyuge" class="control-label">Parroquia:</label>
                          <select  class="form-control" id="id_parroquia_datos_conyuge" name="id_parroquia_datos_conyuge">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultParroquias as $res) {?>
                        										<option value="<?php echo $res->id_parroquias; ?>" <?php if ($res->id_parroquias == $resEdit->id_parroquia_datos_conyuge ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_parroquias; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_parroquia_datos_conyuge" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="barrio_datos_conyuge" class="control-label">Barrio y/o Sector:</label>
                    	<input type="text" class="form-control" id="barrio_datos_conyuge" name="barrio_datos_conyuge" placeholder="Barrio" value="<?php echo $resEdit->barrio_datos_conyuge; ?>">
                        <div id="mensaje_barrio_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
          	</div>
          	
          	<div class="row">
          	
          	<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="ciudadela_datos_conyuge" class="control-label">Ciudadela y/o conjunto/Etapa/Manzana:</label>
                    	<input type="text" class="form-control" id="ciudadela_datos_conyuge" name="ciudadela_datos_conyuge" placeholder="Ciudadela" value="<?php echo $resEdit->ciudadela_datos_conyuge; ?>">
                        <div id="mensaje_ciudadela_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="calle_datos_conyuge" class="control-label">Calle:</label>
                    	<input type="text" class="form-control" id="calle_datos_conyuge" name="calle_datos_conyuge" placeholder="Calle" value="<?php echo $resEdit->calle_datos_conyuge; ?>">
                        <div id="mensaje_calle_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="numero_calle_datos_conyuge" class="control-label">Número de Calle:</label>
                    	<input type="text" class="form-control" id="numero_calle_datos_conyuge" name="numero_calle_datos_conyuge" placeholder="número" value="<?php echo $resEdit->numero_calle_datos_conyuge; ?>">
                        <div id="mensaje_numero_calle_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
          	
          	</div>
			
			<div class="row">
			
			<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="interseccion_datos_conyuge" class="control-label">Intersección:</label>
                    	<input type="text" class="form-control" id="interseccion_datos_conyuge" name="interseccion_datos_conyuge" placeholder="Intersección" value="<?php echo $resEdit->interseccion_datos_conyuge; ?>">
                        <div id="mensaje_interseccion_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
			
			</div>
			 
			 
			 
  			</div>
  			</div>
  			
  			
  			
  			
  		     <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i> Actividad Económica del Conyuge</h4>
	         </div>
	         <div class="panel-body">
			 
				<div class="row">
          	
          	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="actividad_economica_datos_conyuge" class="control-label">Tipo de Empleado:</label>
                    	<select name="actividad_economica_datos_conyuge" id="actividad_economica_datos_conyuge"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Empleado Publico"<?php if($resEdit->actividad_economica_datos_conyuge == 'Empleado Publico'){echo ' selected="selected" ' ;}else{} ?>>Empleado Publico</option>
                                      <option value="Empleado Privado"<?php if($resEdit->actividad_economica_datos_conyuge == 'Empleado Privado'){echo ' selected="selected" ' ;}else{} ?>>Empleado Privado</option>
        							  <option value="Libre Ejercicio Profesional"<?php if($resEdit->actividad_economica_datos_conyuge == 'Libre Ejercicio Profesional'){echo ' selected="selected" ' ;}else{} ?>>Libre Ejercicio Profesional</option>
        							  <option value="Independiente"<?php if($resEdit->actividad_economica_datos_conyuge == 'Independiente'){echo ' selected="selected" ' ;}else{} ?>>Independiente</option>
        							  <option value="Jubilado"<?php if($resEdit->actividad_economica_datos_conyuge == 'Jubilado'){echo ' selected="selected" ' ;}else{} ?>>Jubilado</option>
        			   				  <option value="Ama de Casa"<?php if($resEdit->actividad_economica_datos_conyuge == 'Ama de Casa'){echo ' selected="selected" ' ;}else{} ?>>Ama de Casa</option>
        			    
        			    </select> 
                        <div id="mensaje_actividad_economica_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
          	
          	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="empresa_datos_conyuge" class="control-label">Empresa:</label>
                    	<input type="text" class="form-control" id="empresa_datos_conyuge" name="empresa_datos_conyuge" placeholder="Empresa" value="<?php echo $resEdit->empresa_datos_conyuge; ?>">
                        <div id="mensaje_empresa_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="naturaleza_negocio_datos_conyuge" class="control-label">Naturaleza del Negocio:</label>
                    	<input type="text" class="form-control" id="naturaleza_negocio_datos_conyuge" name="naturaleza_negocio_datos_conyuge" placeholder="Negocio" value="<?php echo $resEdit->naturaleza_negocio_datos_conyuge; ?>">
                        <div id="mensaje_naturaleza_negocio_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="cargo_datos_conyuge" class="control-label">Cargo:</label>
                    	<input type="text" class="form-control" id="cargo_datos_conyuge" name="cargo_datos_conyuge" placeholder="Cargo" value="<?php echo $resEdit->cargo_datos_conyuge; ?>">
                        <div id="mensaje_cargo_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
          	
          	</div>
          	
          	
			
			<div class="row">
			
			<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="anios_laborados_datos_conyuge" class="control-label">Tiempo Laborado en Años:</label>
                    	<input type="text" class="form-control" id="anios_laborados_datos_conyuge" name="anios_laborados_datos_conyuge" placeholder="Años" value="<?php echo $resEdit->anios_laborados_datos_conyuge; ?>">
                        <div id="mensaje_anios_laborados_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	
             	
             <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="tipo_contrato_datos_conyuge" class="control-label">Tipo de Contrato:</label>
                    	<select name="tipo_contrato_datos_conyuge" id="tipo_contrato_datos_conyuge"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Nombramiento"<?php if($resEdit->tipo_contrato_datos_conyuge == 'Nombramiento'){echo ' selected="selected" ' ;}else{} ?>>Nombramiento</option>
                                      <option value="Termino Fijo"<?php if($resEdit->tipo_contrato_datos_conyuge == 'Termino Fijo'){echo ' selected="selected" ' ;}else{} ?>>Termino Fijo</option>
        							  <option value="Termino Indefinido"<?php if($resEdit->tipo_contrato_datos_conyuge == 'Termino Indefinido'){echo ' selected="selected" ' ;}else{} ?>>Termino Indefinido</option>
        							  <option value="Prestacion de Servicios"<?php if($resEdit->tipo_contrato_datos_conyuge == 'Prestacion de Servicios'){echo ' selected="selected" ' ;}else{} ?>>Prestacion de Servicios</option>
        							  
        			    </select> 
                        <div id="mensaje_tipo_contrato_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
			
			<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_jefe_datos_conyuge" class="control-label">Nombres del Jefe:</label>
                    	<input type="text" class="form-control" id="nombres_jefe_datos_conyuge" name="nombres_jefe_datos_conyuge" placeholder="Nombres" value="<?php echo $resEdit->nombres_jefe_datos_conyuge; ?>">
                        <div id="mensaje_nombres_jefe_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
			
			<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_jefe_datos_conyuge" class="control-label">Apellidos del Jefe:</label>
                    	<input type="text" class="form-control" onKeyPress="return checkIt(event)" id="apellidos_jefe_datos_conyuge" name="apellidos_jefe_datos_conyuge" placeholder="Apellidos" value="<?php echo $resEdit->apellidos_jefe_datos_conyuge; ?>">
                        <div id="mensaje_apellidos_jefe_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	
             	
			
			
			</div>
			 
			 <div class="row">
			 
			 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="telefono_jefe_datos_conyuge" class="control-label">Teléfono del Jefe:</label>
                    	<input type="text" class="form-control" onKeyPress="return checkIt(event)" id="telefono_jefe_datos_conyuge" maxlength="10" name="telefono_jefe_datos_conyuge" placeholder="Teléfono" value="<?php echo $resEdit->telefono_jefe_datos_conyuge; ?>">
                        <div id="mensaje_telefono_jefe_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
			 
			 
			
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_provincia_trabajo_datos_conyuge" class="control-label">Provincia:</label>
                          <select  class="form-control" id="id_provincia_trabajo_datos_conyuge" name="id_provincia_trabajo_datos_conyuge">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>" <?php if ($res->id_provincias == $resEdit->id_provincia_trabajo_datos_conyuge ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_provincias; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_provincia_trabajo_datos_conyuge" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_canton_trabajo_datos_conyuge" class="control-label">Cantón:</label>
                          <select  class="form-control" id="id_canton_trabajo_datos_conyuge" name="id_canton_trabajo_datos_conyuge">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultCantones as $res) {?>
                        										<option value="<?php echo $res->id_cantones; ?>" <?php if ($res->id_cantones == $resEdit->id_canton_trabajo_datos_conyuge ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_cantones; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_canton_trabajo_datos_conyuge" class="errores"></div>
                        </div>
            		  </div>
             	
             	<div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_parroquia_trabajo_datos_conyuge" class="control-label">Parroquia:</label>
                          <select  class="form-control" id="id_parroquia_trabajo_datos_conyuge" name="id_parroquia_trabajo_datos_conyuge">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	<?php foreach($resultParroquias as $res) {?>
                        										<option value="<?php echo $res->id_parroquias; ?>" <?php if ($res->id_parroquias == $resEdit->id_parroquia_trabajo_datos_conyuge ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_parroquias; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_parroquia_trabajo_datos_conyuge" class="errores"></div>
                        </div>
            		  </div>
             	
             	
			 
			 
			 </div>
			 
			 
			  <div class="row">
			  
			 
          	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="calle_trabajo_datos_conyuge" class="control-label">Calle:</label>
                    	<input type="text" class="form-control" id="calle_trabajo_datos_conyuge" name="calle_trabajo_datos_conyuge" placeholder="Calle" value="<?php echo $resEdit->calle_trabajo_datos_conyuge; ?>">
                        <div id="mensaje_calle_trabajo_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nuemero_calle_trabajo_datos_conyuge" class="control-label">Número de Calle:</label>
                    	<input type="text" class="form-control" id="nuemero_calle_trabajo_datos_conyuge" name="nuemero_calle_trabajo_datos_conyuge" placeholder="Número" value="<?php echo $resEdit->nuemero_calle_trabajo_datos_conyuge; ?>">
                        <div id="mensaje_nuemero_calle_trabajo_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="interseccion_trabajo_datos_conyuge" class="control-label">Intersección:</label>
                    	<input type="text" class="form-control" id="interseccion_trabajo_datos_conyuge" name="interseccion_trabajo_datos_conyuge" placeholder="Intersección" value="<?php echo $resEdit->interseccion_trabajo_datos_conyuge; ?>">
                        <div id="mensaje_interseccion_trabajo_datos_conyuge" class="errores"></div>
                 	</div>
             	</div>	
			 
			  
			  </div>
			 
			
			 
			 <div class="row">
			 
			  <div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="referencia_trabajo_datos_conyuge" class="control-label">Referencia de la direccion del trabajo:</label>
                    	<input type="text" class="form-control" id="referencia_trabajo_datos_conyuge" name="referencia_trabajo_datos_conyuge" placeholder="Referencia" value="<?php echo $resEdit->referencia_trabajo_datos_conyuge; ?>">
                        <div id="mensaje_referencia_trabajo_datos_conyuge" class="errores"></div>
                 	</div>
             </div>
			 
			 
			 </div>
			 
  			</div>
  			</div>
  			
  			
  		<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i>Datos de la actividad para independientes o Detalle del proyecto</h4>
	         </div>
	         <div class="panel-body">
	         <div class="row">
	         
	          <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="actividad_principal_datos_independientes" class="control-label">Actividad Principal:</label>
                    	<input type="text" class="form-control" id="actividad_principal_datos_independientes" name="actividad_principal_datos_independientes" placeholder="Actividad" value="<?php echo $resEdit->actividad_principal_datos_independientes; ?>">
                        <div id="mensaje_actividad_principal_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
             	 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="ruc_datos_independientes" class="control-label">R.U.C. :</label>
                    	<input type="text" class="form-control" onKeyPress="return checkIt(event)" id="ruc_datos_independientes" name="ruc_datos_independientes" placeholder="R.U.C." value="<?php echo $resEdit->ruc_datos_independientes; ?>">
                        <div id="mensaje_ruc_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
             	
             	 <div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="detalle_actividades_datos_independientes" class="control-label">Descripción Completa:</label>
                    	<input type="text" class="form-control" id="detalle_actividades_datos_independientes" name="detalle_actividades_datos_independientes" placeholder="Descripción" value="<?php echo $resEdit->detalle_actividades_datos_independientes; ?>">
                        <div id="mensaje_detalle_actividades_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
	         
	         
	         
	         </div>
	         
	         
	         <div class="row">
	         
	         <div class="panel-heading">
	         <h4>Detalle las actividades e Ingresos y Egresos</h4>
	         </div>
	         
	         </div>
	         
	         <div class="row">
	         
	         <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="local_datos_independientes" class="control-label">Local:</label>
                    	<select name="local_datos_independientes" id="local_datos_independientes"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Propio"<?php if($resEdit->local_datos_independientes == 'Propio'){echo ' selected="selected" ' ;}else{} ?>>Propio</option>
                                      <option value="Arrendado"<?php if($resEdit->local_datos_independientes == 'Arrendado'){echo ' selected="selected" ' ;}else{} ?>>Arrendado</option>
        							  <option value="Otro"<?php if($resEdit->local_datos_independientes == 'Otro'){echo ' selected="selected" ' ;}else{} ?>>Otro</option>
        							 
        							  
        			    </select> 
                        <div id="mensaje_local_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
             	
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="nombres_propietario_datos_independientes" class="control-label">Nombres del Propietario:</label>
                    	<input type="text" class="form-control" id="nombres_propietario_datos_independientes" name="nombres_propietario_datos_independientes" placeholder="Descripción" value="<?php echo $resEdit->nombres_propietario_datos_independientes; ?>">
                        <div id="mensaje_nombres_propietario_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
             	 <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="apellidos_propietario_datos_independientes" class="control-label">Apellidos del Propietario :</label>
                    	<input type="text" class="form-control" id="apellidos_propietario_datos_independientes" name="apellidos_propietario_datos_independientes" placeholder="Apellidos" value="<?php echo $resEdit->apellidos_propietario_datos_independientes; ?>">
                        <div id="mensaje_apellidos_propietario_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="telefono_propietario_datos_independientes" class="control-label">Teléfono del Propietario :</label>
                    	<input type="text" class="form-control" onKeyPress="return checkIt(event)" id="telefono_propietario_datos_independientes" name="telefono_propietario_datos_independientes" placeholder="Teléfono" value="<?php echo $resEdit->telefono_propietario_datos_independientes; ?>">
                        <div id="mensaje_telefono_propietario_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
             	</div>
             	
             	  <div class="row">
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="tiempo_funcionamiento_datos_independientes" class="control-label">Tiempo de Funcionamiento :</label>
                    	<input type="text" class="form-control" id="tiempo_funcionamiento_datos_independientes" name="tiempo_funcionamiento_datos_independientes" placeholder="Tiempo" value="<?php echo $resEdit->tiempo_funcionamiento_datos_independientes; ?>">
                        <div id="mensaje_tiempo_funcionamiento_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="numero_patronal_datos_independientes" class="control-label">Número Patronal:</label>
                    	<input type="text" class="form-control" id="numero_patronal_datos_independientes" name="numero_patronal_datos_independientes" placeholder="Número" value="<?php echo $resEdit->numero_patronal_datos_independientes; ?>">
                        <div id="mensaje_numero_patronal_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="numero_empleados_datos_independientes" class="control-label">Número de Empleados:</label>
                    	<input type="text" class="form-control" id="numero_empleados_datos_independientes" name="numero_empleados_datos_independientes" placeholder="Número" value="<?php echo $resEdit->numero_empleados_datos_independientes; ?>">
                        <div id="mensaje_numero_empleados_datos_independientes" class="errores"></div>
                 	</div>
             	</div>
	         
	         </div>
	         
	         	
  			</div>
  			</div>
  			
  			
  						
  		<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i>Datos Económicos y Financieros</h4>
	         </div>
	         <div class="panel-body">
	         
	         
	         <div class="panel-heading">
	        <h4>Referencias bancarias</h4>
	         </div>
	       <div class="row">
	       
	       <div class="col-xs-12 col-md-4 col-md-4 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_bancos_referencia_bancaria" class="control-label">Institución:</label>
                          <select  class="form-control" id="id_bancos_referencia_bancaria" name="id_bancos_referencia_bancaria">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos_referencia_bancaria ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos_referencia_bancaria" class="errores"></div>
                        </div>
           </div>
            		  
            		  
              <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                		<label for="tipo_cuenta_referencia_bancaria" class="control-label">Tipo de cuenta o producto (tarjeta):</label>
                    	<select name="tipo_cuenta_referencia_bancaria" id="tipo_cuenta_referencia_bancaria"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Ahorros" <?php if($resEdit->tipo_cuenta_referencia_bancaria == 'Ahorros'){echo ' selected="selected" ' ;}else{} ?>>Ahorros</option>
                                      <option value="Corriente" <?php if($resEdit->tipo_cuenta_referencia_bancaria == 'Corriente'){echo ' selected="selected" ' ;}else{} ?>>Corriente</option>
        							   
        			    </select> 
                        <div id="mensaje_tipo_cuenta_referencia_bancaria" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                		<label for="numero_cuenta_referencia_bancaria" class="control-label">Número de cuenta/Tarjeta:</label>
                    	<input type="text" class="form-control" id="numero_cuenta_referencia_bancaria" onKeyPress="return checkIt(event)" name="numero_cuenta_referencia_bancaria" placeholder="Número" value="<?php echo $resEdit->numero_cuenta_referencia_bancaria; ?>">
                        <div id="mensaje_numero_cuenta_referencia_bancaria" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	       </div>
	       
	       
	       
	       <div class="row">
	       
	       <div class="col-xs-12 col-md-4 col-md-4 ">
            		    <div class="form-group">
            		      <select  class="form-control" id="id_bancos_uno_datos_economicos" name="id_bancos_uno_datos_economicos">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos_uno_datos_economicos ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos_uno_datos_economicos" class="errores"></div>
                        </div>
           </div>
            		  
            		  
              <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                    	<select name="tipo_cuenta_uno_datos_economicos" id="tipo_cuenta_uno_datos_economicos"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Ahorros"<?php if($resEdit->tipo_cuenta_uno_datos_economicos == 'Ahorros'){echo ' selected="selected" ' ;}else{} ?>>Ahorros</option>
                                      <option value="Corriente"<?php if($resEdit->tipo_cuenta_uno_datos_economicos == 'Corriente'){echo ' selected="selected" ' ;}else{} ?>>Corriente</option>
        							   
        			    </select> 
                        <div id="mensaje_tipo_cuenta_uno_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="numero_cuenta_uno_datos_economicos"  onKeyPress="return checkIt(event)" name="numero_cuenta_uno_datos_economicos" placeholder="Número" value="<?php echo $resEdit->numero_cuenta_uno_datos_economicos; ?>">
                        <div id="mensaje_numero_cuenta_uno_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	       </div>
	       
	       
	       
	     
	       <div class="row">
	       
	       <div class="col-xs-12 col-md-4 col-md-4 ">
            		    <div class="form-group">
            		      <select  class="form-control" id="id_bancos_dos_datos_economicos" name="id_bancos_dos_datos_economicos">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos_dos_datos_economicos ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos_dos_datos_economicos" class="errores"></div>
                        </div>
           </div>
            		  
            		  
              <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                    	<select name="tipo_cuenta_dos_datos_economicos" id="tipo_cuenta_dos_datos_economicos"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Ahorros"<?php if($resEdit->tipo_cuenta_dos_datos_economicos == 'Ahorros'){echo ' selected="selected" ' ;}else{} ?>>Ahorros</option>
                                      <option value="Corriente"<?php if($resEdit->tipo_cuenta_dos_datos_economicos == 'Corriente'){echo ' selected="selected" ' ;}else{} ?>>Corriente</option>
        							   
        			    </select> 
                        <div id="mensaje_tipo_cuenta_dos_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="numero_cuenta_dos_datos_economicos"  onKeyPress="return checkIt(event)" name="numero_cuenta_dos_datos_economicos" placeholder="Número" value="<?php echo $resEdit->numero_cuenta_dos_datos_economicos; ?>">
                        <div id="mensaje_numero_cuenta_dos_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	       </div>
	      <div class="row">
	       
	       <div class="col-xs-12 col-md-4 col-md-4 ">
            		    <div class="form-group">
            		      <select  class="form-control" id="id_bancos_tres_datos_economicos" name="id_bancos_tres_datos_economicos">
                          	   <option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos_tres_datos_economicos ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos_tres_datos_economicos" class="errores"></div>
                        </div>
           </div>
            		  
            		  
              <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                    	<select name="tipo_cuenta_tres_datos_economicos" id="tipo_cuenta_tres_datos_economicos"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Ahorros" <?php if($resEdit->tipo_cuenta_tres_datos_economicos == 'Ahorros'){echo ' selected="selected" ' ;}else{} ?>>Ahorros</option>
                                      <option value="Corriente" <?php if($resEdit->tipo_cuenta_tres_datos_economicos == 'Corriente'){echo ' selected="selected" ' ;}else{} ?>>Corriente</option>
        							   
        			    </select> 
                        <div id="mensaje_tipo_cuenta_tres_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="numero_cuenta_tres_datos_economicos"  onKeyPress="return checkIt(event)" name="numero_cuenta_tres_datos_economicos" placeholder="Número" value="<?php echo $resEdit->numero_cuenta_tres_datos_economicos; ?>">
                        <div id="mensaje_numero_cuenta_tres_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	       </div>
	       <div class="row">
	       
	       <div class="col-xs-12 col-md-4 col-md-4 ">
            		    <div class="form-group">
            		      <select  class="form-control" id="id_bancos_cuatro_datos_economicos" name="id_bancos_cuatro_datos_economicos">
                          	 <option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos_cuatro_datos_economicos ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos_cuatro_datos_economicos" class="errores"></div>
                        </div>
           </div>
            		  
            		  
              <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                    	<select name="tipo_cuenta_cuatro_datos_economicos" id="tipo_cuenta_cuatro_datos_economicos"  class="form-control">
                                      <option value="" selected="selected">--Seleccione--</option>
                                      <option value="Ahorros" <?php if($resEdit->tipo_cuenta_cuatro_datos_economicos == 'Ahorros'){echo ' selected="selected" ' ;}else{} ?>>Ahorros</option>
                                      <option value="Corriente"<?php if($resEdit->tipo_cuenta_cuatro_datos_economicos == 'Corriente'){echo ' selected="selected" ' ;}else{} ?>>Corriente</option>
        							   
        			    </select> 
                        <div id="mensaje_tipo_cuenta_cuatro_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="numero_cuenta_cuatro_datos_economicos" onKeyPress="return checkIt(event)" name="numero_cuenta_cuatro_datos_economicos" placeholder="Número" value="<?php echo $resEdit->numero_cuenta_cuatro_datos_economicos; ?>">
                        <div id="mensaje_numero_cuenta_cuatro_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	       </div>
	       
	       <div class="row">
	         
	         <div class="panel-heading">
	         <h4>&nbsp; &nbsp;Referencias comerciales y / o proveedores</h4>
	         </div>
	         
	         
	         <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                		<label for="empresa_uno_datos_economicos" class="control-label">Empresa / Proveedor:</label>
                    	<input type="text" class="form-control" id="empresa_uno_datos_economicos" name="empresa_uno_datos_economicos" placeholder="Empresa" value="<?php echo $resEdit->empresa_uno_datos_economicos; ?>">
                        <div id="mensaje_empresa_uno_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                		<label for="direccion_uno_datos_economicos" class="control-label">Dirección:</label>
                    	<input type="text" class="form-control" id="direccion_uno_datos_economicos" name="direccion_uno_datos_economicos" placeholder="Dirección" value="<?php echo $resEdit->direccion_uno_datos_economicos; ?>">
                        <div id="mensaje_direccion_uno_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
             	
             	<div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                		<label for="numero_telefono_uno_datos_economicos" class="control-label">Teléfono:</label>
                    	<input type="text" class="form-control" id="numero_telefono_uno_datos_economicos" onKeyPress="return checkIt(event)" name="numero_telefono_uno_datos_economicos" placeholder="Teléfono" value="<?php echo $resEdit->numero_telefono_uno_datos_economicos; ?>">
                        <div id="mensaje_numero_telefono_uno_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	         
	         
	         </div>
	       
	       
	       
	       <div class="row">
	       
	       
	       <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
               
                    	<input type="text" class="form-control" id="empresa_dos_datos_economicos" name="empresa_dos_datos_economicos" placeholder="Empresa" value="<?php echo $resEdit->empresa_dos_datos_economicos; ?>">
                        <div id="mensaje_empresa_dos_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	         <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
        
                    	<input type="text" class="form-control" id="direccion_dos_datos_economicos" name="direccion_dos_datos_economicos" placeholder="Dirección" value="<?php echo $resEdit->direccion_dos_datos_economicos; ?>">
                        <div id="mensaje_direccion_dos_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	         <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                
                    	<input type="text" class="form-control" id="numero_telefono_dos_datos_economicos" onKeyPress="return checkIt(event)" name="numero_telefono_dos_datos_economicos" placeholder="Teléfono" value="<?php echo $resEdit->numero_telefono_dos_datos_economicos; ?>">
                        <div id="mensaje_numero_telefono_dos_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	       
	       
	       </div>
	       
	       
	       
	            <div class="row">
	       
	       
	       <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
               
                    	<input type="text" class="form-control" id="empresa_tres_datos_economicos" name="empresa_tres_datos_economicos" placeholder="Empresa" value="<?php echo $resEdit->empresa_tres_datos_economicos; ?>">
                        <div id="mensaje_empresa_tres_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	         <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
        
                    	<input type="text" class="form-control" id="direccion_tres_datos_economicos" name="direccion_tres_datos_economicos" placeholder="Dirección" value="<?php echo $resEdit->direccion_tres_datos_economicos; ?>">
                        <div id="mensaje_direccion_tres_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	         <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                
                    	<input type="text" class="form-control" id="numero_telefono_tres_datos_economicos" onKeyPress="return checkIt(event)" name="numero_telefono_tres_datos_economicos" placeholder="Teléfono" value="<?php echo $resEdit->numero_telefono_tres_datos_economicos; ?>">
                        <div id="mensaje_numero_telefono_tres_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	       
	       
	       </div>
	       
	       
	            <div class="row">
	       
	       
	       <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
               
                    	<input type="text" class="form-control" id="empresa_cuatro_datos_economicos" name="empresa_cuatro_datos_economicos" placeholder="Empresa" value="<?php echo $resEdit->empresa_cuatro_datos_economicos; ?>">
                        <div id="mensaje_empresa_cuatro_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	         <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
        
                    	<input type="text" class="form-control" id="direccion_cuatro_datos_economicos" name="direccion_cuatro_datos_economicos" placeholder="Dirección" value="<?php echo $resEdit->direccion_cuatro_datos_economicos; ?>">
                        <div id="mensaje_direccion_cuatro_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	         <div class="col-xs-6 col-md-4 col-lg-4 ">
            		<div class="form-group">
                
                    	<input type="text" class="form-control" id="numero_telefono_cuatro_datos_economicos" onKeyPress="return checkIt(event)" name="numero_telefono_cuatro_datos_economicos" placeholder="Teléfono" value="<?php echo $resEdit->numero_telefono_cuatro_datos_economicos; ?>">
                        <div id="mensaje_numero_telefono_cuatro_datos_economicos" class="errores"></div>
                 	</div>
             	</div>
	         
	       
	       
	        </div>
	       </div>
     	  </div>
  			
  			
 			<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i> Estado de Situación Patrimonial</h4>
	         </div>
	         <div class="panel-body">
			 
			 <div class="row">
                    		   
             
            <table class="col-lg-12 col-md-12 col-xs-12 tablesorter table table-striped table-bordered dt-responsive nowrap">
            
            <tr>
            <th><b>ACTIVOS</b></th>
            <th><b>VALOR EN DÓLARES</b></th>
            <th><b>PASIVOS</b></th>
            <th><b>VALOR EN DÓLARES</b></th>
            </tr>
            
            
             <tr>
            <td style="text-align: center;"><b>Activos Corrientes</b></td>
            <td style="text-align: center;"><b>&nbsp;</b></td>
            <td style="text-align: center;"><b>Pasivos Corrientes</b></td>
            <td style="text-align: center;"><b>&nbsp;</b></td>
            </tr>
            
            <tr>
            <td>Efectivo</td>
            <td><input type="text" class="form-control cantidades1" id="efectivo_activos_corrientes" name="efectivo_activos_corrientes"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->efectivo_activos_corrientes; ?>"><div id="mensaje_efectivo_activos_corrientes" class="errores"></div></td>
            <td>Préstamo CAPREMCI (menor a 1 año)</td>
            <td><input type="text" class="form-control cantidades1" id="prestamo_menor_anio_pasivo_corriente" name="prestamo_menor_anio_pasivo_corriente"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->prestamo_menor_anio_pasivo_corriente; ?>"><div id="mensaje_prestamo_menor_anio_pasivo_corriente" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Bancos / Cooperativas</td>
            <td><input type="text" class="form-control cantidades1" id="bancos_activos_corrientes" name="bancos_activos_corrientes"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->bancos_activos_corrientes; ?>"><div id="mensaje_bancos_activos_corrientes" class="errores"></div></td>
            <td>Préstamo emergente CAPREMCI</td>
            <td><input type="text" class="form-control cantidades1" id="prestamo_emergente_pasivo_corriente" name="prestamo_emergente_pasivo_corriente" '  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->prestamo_emergente_pasivo_corriente; ?>"><div id="mensaje_prestamo_emergente_pasivo_corriente" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Cuentas por cobrar</td>
            <td><input type="text" class="form-control cantidades1" id="cuentas_cobrar_activos_corrientes" name="cuentas_cobrar_activos_corrientes"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->cuentas_cobrar_activos_corrientes; ?>"><div id="mensaje_cuentas_cobrar_activos_corrientes" class="errores"></div></td>
            <td>Cuentas por pagar</td>
            <td><input type="text" class="form-control cantidades1" id="cuentas_pagar_pasivo_corriente" name="cuentas_pagar_pasivo_corriente"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->cuentas_pagar_pasivo_corriente; ?>"><div id="mensaje_cuentas_pagar_pasivo_corriente" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Inversiones</td>
            <td><input type="text" class="form-control cantidades1" id="inversiones_activos_corrientes" name="inversiones_activos_corrientes"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->inversiones_activos_corrientes; ?>"><div id="mensaje_inversiones_activos_corrientes" class="errores"></div></td>
            <td>Proveedores</td>
            <td><input type="text" class="form-control cantidades1" id="proveedores_pasivo_corriente" name="proveedores_pasivo_corriente"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->proveedores_pasivo_corriente; ?>"><div id="mensaje_proveedores_pasivo_corriente" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Inventarios / Mercaderías </td>
            <td><input type="text" class="form-control cantidades1" id="inventarios_activos_corrientes" name="inventarios_activos_corrientes"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->inventarios_activos_corrientes; ?>"><div id="mensaje_inventarios_activos_corrientes" class="errores"></div></td>
            <td>Otras obligaciones menores a 1 año</td>
            <td><input type="text" class="form-control cantidades1" id="obligaciones_menores_anio_pasivo_corriente" name="obligaciones_menores_anio_pasivo_corriente"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->obligaciones_menores_anio_pasivo_corriente; ?>"><div id="mensaje_obligaciones_menores_anio_pasivo_corriente" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Muebles y enseres </td>
            <td><input type="text" class="form-control cantidades1" id="muebles_activos_corrientes" name="muebles_activos_corrientes"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->muebles_activos_corrientes; ?>"><div id="mensaje_muebles_activos_corrientes" class="errores"></div></td>
            <td>Con Banco</td>
            <td><input type="text" class="form-control cantidades1" id="con_banco_pasivo_corriente" name="con_banco_pasivo_corriente"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->con_banco_pasivo_corriente; ?>"><div id="mensaje_con_banco_pasivo_corriente" class="errores"></div></td>
            </tr>
            
            
            <tr>
            <td>Otros Activos Corrientes</td>
            <td><input type="text" class="form-control cantidades1" id="otros_activos_corrientes" name="otros_activos_corrientes"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->otros_activos_corrientes; ?>"><div id="mensaje_otros_activos_corrientes" class="errores"></div></td>
            <td>Con Cooperativas</td>
            <td><input type="text" class="form-control cantidades1" id="con_cooperativas_pasivo_corriente" name="con_cooperativas_pasivo_corriente"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" value="<?php echo $resEdit->con_cooperativas_pasivo_corriente; ?>"><div id="mensaje_con_cooperativas_pasivo_corriente" class="errores"></div></td>
            </tr>
            
            
            <tr>
            <td style="text-align: center;"><b>Activos Fijos</b></td>
            <td>&nbsp;</td>
            <td style="text-align: center;"><b>Pasivos a Largo Plazo</b></td>
            <td>&nbsp;</td>
            </tr>
            
            <tr>
            <td>Terreno</td>
            <td><input type="text" class="form-control cantidades1" id="terreno_activos_fijos" name="terreno_activos_fijos"  value="<?php echo $resEdit->terreno_activos_fijos; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_terreno_activos_fijos" class="errores"></div></td>
            <td>Préstamo CAPREMCI (mayor a 1 año)</td>
            <td><input type="text" class="form-control cantidades1" id="prestamo_mayor_anio_pasivos_largo_plazo" name="prestamo_mayor_anio_pasivos_largo_plazo" value="<?php echo $resEdit->prestamo_mayor_anio_pasivos_largo_plazo; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_prestamo_mayor_anio_pasivos_largo_plazo" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Vivienda</td>
            <td><input type="text" class="form-control cantidades1" id="vivienda_activos_fijos" name="vivienda_activos_fijos" value="<?php echo $resEdit->vivienda_activos_fijos; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_vivienda_activos_fijos" class="errores"></div></td>
            <td>Otras obligaciones mayores a 1 año</td>
            <td><input type="text" class="form-control cantidades1" id="obligaciones_mayores_anio_pasivos_largo_plazo" name="obligaciones_mayores_anio_pasivos_largo_plazo" value="<?php echo $resEdit->obligaciones_mayores_anio_pasivos_largo_plazo; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_obligaciones_mayores_anio_pasivos_largo_plazo" class="errores"></div></td>
            </tr>
           
            <tr>
            <td>Vehículo</td>
            <td><input type="text" class="form-control cantidades1" id="vehiculo_activos_fijos" name="vehiculo_activos_fijos" value="<?php echo $resEdit->vehiculo_activos_fijos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_vehiculo_activos_fijos" class="errores"></div></td>
            <td>Con Banco</td>
            <td><input type="text" class="form-control cantidades1" id="con_banco_pasivos_largo_plazo" name="con_banco_pasivos_largo_plazo" value="<?php echo $resEdit->con_banco_pasivos_largo_plazo; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_con_banco_pasivos_largo_plazo" class="errores"></div></td>
            </tr>
            
            
            <tr>
            <td>Maquinaria</td>
            <td><input type="text" class="form-control cantidades1" id="maquinaria_activos_fijos" name="maquinaria_activos_fijos" value="<?php echo $resEdit->maquinaria_activos_fijos; ?>"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_maquinaria_activos_fijos" class="errores"></div></td>
            <td>Con Cooperativas</td>
            <td><input type="text" class="form-control cantidades1" id="con_cooperativas_pasivos_largo_plazo" name="con_cooperativas_pasivos_largo_plazo" value="<?php echo $resEdit->con_cooperativas_pasivos_largo_plazo; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_con_cooperativas_pasivos_largo_plazo" class="errores"></div></td>
            </tr>
             
             
            <tr>
            <td>Otros Activos Fijos (detalle) </td>
            <td><input type="text" class="form-control cantidades1" id="otros_activos_fijos" name="otros_activos_fijos" value="<?php echo $resEdit->otros_activos_fijos; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_otros_activos_fijos" class="errores"></div></td>
            <td>Otros pasivos a largo plazo (detalle)</td>
            <td><input type="text" class="form-control cantidades1" id="otros_pasivos_largo_plazo" name="otros_pasivos_largo_plazo" value="<?php echo $resEdit->otros_pasivos_largo_plazo; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_otros_pasivos_largo_plazo" class="errores"></div></td>
            </tr>
            
            <tr>
            <td colspan="2" style="text-align: center;"><b>Activos Intangibles</b></td>
            <td>Patrimonio</td>
            <td><input type="text" class="form-control cantidades1" id="patrimonio" name="patrimonio" value="<?php echo $resEdit->patrimonio; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_patrimonio" class="errores"></div></td>
            </tr>
            
            
            <tr>
            <td>Valor de su Prestación en CAPREMCI </td>
            <td><input type="text" class="form-control cantidades1" id="valor_prestacion_activos_intangibles" value="<?php echo $resEdit->valor_prestacion_activos_intangibles; ?>" name="valor_prestacion_activos_intangibles"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_valor_prestacion_activos_intangibles" class="errores"></div></td>
            <td>Garantías en CAPREMCI</td>
            <td><input type="text" class="form-control cantidades1" id="garantias_capremci" name="garantias_capremci" value="<?php echo $resEdit->garantias_capremci; ?>"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_garantias_capremci" class="errores"></div></td>
            </tr>
            
            
            </table>
             
            </div>
			 
  			</div>
  			</div>  			
  			
  			
  							
  		<div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i>Detalle Activos</h4>
	         </div>
	         <div class="panel-body">
	       <div class="row">
	       
	       <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="id_bancos_uno_detalle_activos" class="control-label">Bancos / Cooperativas / Inversiones</label>
                          <select  class="form-control" id="id_bancos_uno_detalle_activos" name="id_bancos_uno_detalle_activos">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos_uno_detalle_activos ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos_uno_detalle_activos" class="errores"></div>
                        </div>
           </div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="tipo_producto_uno_detalle_activos" class="control-label">Tipo / Producto</label>
                    	<input type="text" class="form-control" id="tipo_producto_uno_detalle_activos" name="tipo_producto_uno_detalle_activos"  placeholder="tipo" value="<?php echo $resEdit->tipo_producto_uno_detalle_activos; ?>">
                        <div id="mensaje_tipo_producto_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="valor_uno_detalle_activos" class="control-label">Valor / Saldo</label>
                    	<input type="text" class="form-control" id="valor_uno_detalle_activos" name="valor_uno_detalle_activos" value="<?php echo $resEdit->valor_uno_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="valor">
                        <div id="mensaje_valor_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="plazo_uno_detalle_activos" class="control-label">Plazo</label>
                    	<input type="text" class="form-control" id="plazo_uno_detalle_activos" name="plazo_uno_detalle_activos"  placeholder="plazo" value="<?php echo $resEdit->plazo_uno_detalle_activos; ?>">
                        <div id="mensaje_plazo_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	       
	       </div>
	      
	     
	     <div class="row">
	       
	       <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    <select  class="form-control" id="id_bancos_dos_detalle_activos" name="id_bancos_dos_detalle_activos">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos_dos_detalle_activos ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos_dos_detalle_activos" class="errores"></div>
                        </div>
           </div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="tipo_producto_dos_detalle_activos" name="tipo_producto_dos_detalle_activos" placeholder="tipo" value="<?php echo $resEdit->tipo_producto_dos_detalle_activos; ?>">
                        <div id="mensaje_tipo_producto_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		
                    	<input type="text" class="form-control" id="valor_dos_detalle_activos" name="valor_dos_detalle_activos" value="<?php echo $resEdit->valor_dos_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="valor">
                        <div id="mensaje_valor_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="plazo_dos_detalle_activos" name="plazo_dos_detalle_activos" placeholder="plazo" value="<?php echo $resEdit->plazo_dos_detalle_activos; ?>">
                        <div id="mensaje_plazo_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       
	       <div class="row">
	       
	       <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    <select  class="form-control" id="id_bancos_tres_detalle_activos" name="id_bancos_tres_detalle_activos">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos_tres_detalle_activos ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos_tres_detalle_activos" class="errores"></div>
                        </div>
           </div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="tipo_producto_tres_detalle_activos" name="tipo_producto_tres_detalle_activos" placeholder="tipo" value="<?php echo $resEdit->tipo_producto_tres_detalle_activos; ?>">
                        <div id="mensaje_tipo_producto_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		
                    	<input type="text" class="form-control" id="valor_tres_detalle_activos" name="valor_tres_detalle_activos" value="<?php echo $resEdit->valor_tres_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="valor">
                        <div id="mensaje_valor_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="plazo_tres_detalle_activos" name="plazo_tres_detalle_activos" placeholder="plazo" value="<?php echo $resEdit->plazo_tres_detalle_activos; ?>">
                        <div id="mensaje_plazo_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       
	       
	       <div class="row">
	       
	       <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    <select  class="form-control" id="id_bancos_cuatro_detalle_activos" name="id_bancos_cuatro_detalle_activos">
                          	<option value="0" selected="selected">--Seleccione--</option>
                          	 	<?php foreach($resultBancos as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" <?php if ($res->id_bancos == $resEdit->id_bancos_cuatro_detalle_activos ){  echo  ' selected="selected" '  ;}  ?> ><?php echo $res->nombre_bancos; ?> </option>
                        							        
                        							        <?php } ?>
                          </select>                         
                          <div id="mensaje_id_bancos_cuatro_detalle_activos" class="errores"></div>
                        </div>
           </div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="tipo_producto_cuatro_detalle_activos" name="tipo_producto_cuatro_detalle_activos" placeholder="tipo" value="<?php echo $resEdit->tipo_producto_cuatro_detalle_activos; ?>">
                        <div id="mensaje_tipo_producto_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		
                    	<input align="right" type="text" class="form-control" id="valor_cuatro_detalle_activos"  name="valor_cuatro_detalle_activos"   value="<?php echo $resEdit->valor_cuatro_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="valor">
                        <div id="mensaje_valor_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="plazo_cuatro_detalle_activos" name="plazo_cuatro_detalle_activos" placeholder="plazo" value="<?php echo $resEdit->plazo_cuatro_detalle_activos; ?>">
                        <div id="mensaje_plazo_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	     
	      <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="muebles_uno_detalle_activos" class="control-label">Muebles / Inmuebles / Enseres</label>
                    	<input type="text" class="form-control" id="muebles_uno_detalle_activos" name="muebles_uno_detalle_activos" placeholder="muebles" value="<?php echo $resEdit->muebles_uno_detalle_activos; ?>">
                        <div id="mensaje_muebles_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="direccion_uno_detalle_activos" class="control-label">Dirección</label>
                    	<input type="text" class="form-control" id="direccion_uno_detalle_activos" name="direccion_uno_detalle_activos" placeholder="direccion" value="<?php echo $resEdit->direccion_uno_detalle_activos; ?>">
                        <div id="mensaje_direccion_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="valor_muebles_uno_detalle_activos" class="control-label">Valor</label>
                    	<input style="text-align:right;"  value="<?php echo $resEdit->valor_muebles_uno_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" type="text" class="form-control" id="valor_muebles_uno_detalle_activos" name="valor_muebles_uno_detalle_activos" placeholder="valor">
                        <div id="mensaje_valor_muebles_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="esta_hipotecado_uno_detalle_activos" class="control-label">¿Está Hipotecado?</label>
                    	<input type="text" class="form-control" id="esta_hipotecado_uno_detalle_activos" name="esta_hipotecado_uno_detalle_activos" placeholder="hipotecado" value="<?php echo $resEdit->esta_hipotecado_uno_detalle_activos; ?>">
                        <div id="mensaje_esta_hipotecado_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	       
	       </div>
	       
	       <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="muebles_dos_detalle_activos" name="muebles_dos_detalle_activos" placeholder="muebles" value="<?php echo $resEdit->muebles_dos_detalle_activos; ?>">
                        <div id="mensaje_muebles_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="direccion_dos_detalle_activos" name="direccion_dos_detalle_activos" placeholder="direccion" value="<?php echo $resEdit->direccion_dos_detalle_activos; ?>">
                        <div id="mensaje_direccion_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="valor_muebles_dos_detalle_activos" value="<?php echo $resEdit->valor_muebles_dos_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" name="valor_muebles_dos_detalle_activos" placeholder="valor">
                        <div id="mensaje_valor_muebles_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="esta_hipotecado_dos_detalle_activos" name="esta_hipotecado_dos_detalle_activos" placeholder="hipotecado" value="<?php echo $resEdit->esta_hipotecado_dos_detalle_activos; ?>">
                        <div id="mensaje_esta_hipotecado_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="muebles_tres_detalle_activos" name="muebles_tres_detalle_activos" placeholder="muebles" value="<?php echo $resEdit->muebles_tres_detalle_activos; ?>">
                        <div id="mensaje_muebles_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="direccion_tres_detalle_activos" name="direccion_tres_detalle_activos" placeholder="direccion" value="<?php echo $resEdit->direccion_tres_detalle_activos; ?>">
                        <div id="mensaje_direccion_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="valor_muebles_tres_detalle_activos"  value="<?php echo $resEdit->valor_muebles_tres_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" name="valor_muebles_tres_detalle_activos" placeholder="valor">
                        <div id="mensaje_valor_muebles_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="esta_hipotecado_tres_detalle_activos" name="esta_hipotecado_tres_detalle_activos" placeholder="hipotecado" value="<?php echo $resEdit->esta_hipotecado_tres_detalle_activos; ?>">
                        <div id="mensaje_esta_hipotecado_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="muebles_cuatro_detalle_activos" name="muebles_cuatro_detalle_activos" placeholder="muebles" value="<?php echo $resEdit->muebles_cuatro_detalle_activos; ?>">
                        <div id="mensaje_muebles_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="direccion_cuatro_detalle_activos" name="direccion_cuatro_detalle_activos" placeholder="direccion" value="<?php echo $resEdit->direccion_cuatro_detalle_activos; ?>">
                        <div id="mensaje_direccion_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="valor_muebles_cuatro_detalle_activos" name="valor_muebles_cuatro_detalle_activos" value="<?php echo $resEdit->valor_muebles_cuatro_detalle_activos; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="valor">
                        <div id="mensaje_valor_muebles_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="esta_hipotecada_cuatro_detalle_activos" name="esta_hipotecada_cuatro_detalle_activos" placeholder="hipotecado" value="<?php echo $resEdit->esta_hipotecada_cuatro_detalle_activos; ?>">
                        <div id="mensaje_esta_hipotecada_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       
	       
	       <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="vehiculo_uno_detalle_activos" class="control-label">Vehículos / Marca / Placa / Año</label>
                    	<input type="text" class="form-control" id="vehiculo_uno_detalle_activos" name="vehiculo_uno_detalle_activos" placeholder="Vehívulo" value="<?php echo $resEdit->vehiculo_uno_detalle_activos; ?>">
                        <div id="mensaje_vehiculo_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="valor_vehiculo_uno_detalle_activos" class="control-label">Valor</label>
                    	<input type="text" class="form-control" id="valor_vehiculo_uno_detalle_activos" name="valor_vehiculo_uno_detalle_activos" value="<?php echo $resEdit->valor_vehiculo_uno_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="Valor">
                        <div id="mensaje_valor_vehiculo_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="uso_uno_detalle_activos" class="control-label">Uso</label>
                    	<input type="text" class="form-control" id="uso_uno_detalle_activos" name="uso_uno_detalle_activos" placeholder="Uso" value="<?php echo $resEdit->uso_uno_detalle_activos; ?>">
                        <div id="mensaje_uso_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="asegurado_uno_detalle_activos" class="control-label">¿Está Asegurado?</label>
                    	<input type="text" class="form-control" id="asegurado_uno_detalle_activos" name="asegurado_uno_detalle_activos" placeholder="Asegurado" value="<?php echo $resEdit->asegurado_uno_detalle_activos; ?>">
                        <div id="mensaje_asegurado_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	       
	       </div>
	       
	       <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="vehiculo_dos_detalle_activos" name="vehiculo_dos_detalle_activos" placeholder="Vehívulo" value="<?php echo $resEdit->vehiculo_dos_detalle_activos; ?>">
                        <div id="mensaje_vehiculo_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="valor_vehiculo_dos_detalle_activos" name="valor_vehiculo_dos_detalle_activos" value="<?php echo $resEdit->valor_vehiculo_dos_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="Valor">
                        <div id="mensaje_valor_vehiculo_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="uso_dos_detalle_activos" name="uso_dos_detalle_activos" placeholder="Uso" value="<?php echo $resEdit->uso_dos_detalle_activos; ?>">
                        <div id="mensaje_uso_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="asegurado_dos_detalle_activos" name="asegurado_dos_detalle_activos" placeholder="Asegurado" value="<?php echo $resEdit->asegurado_dos_detalle_activos; ?>">
                        <div id="mensaje_asegurado_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="vehiculo_tres_detalle_activos" name="vehiculo_tres_detalle_activos" placeholder="Vehívulo" value="<?php echo $resEdit->vehiculo_tres_detalle_activos; ?>">
                        <div id="mensaje_vehiculo_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="valor_vehiculo_tres_detalle_activos" name="valor_vehiculo_tres_detalle_activos" value="<?php echo $resEdit->valor_vehiculo_tres_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="Valor">
                        <div id="mensaje_valor_vehiculo_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="uso_tres_detalle_activos" name="uso_tres_detalle_activos" placeholder="Uso" value="<?php echo $resEdit->uso_tres_detalle_activos; ?>">
                        <div id="mensaje_uso_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="asegurado_tres_detalle_activos" name="asegurado_tres_detalle_activos" placeholder="Asegurado" value="<?php echo $resEdit->asegurado_tres_detalle_activos; ?>">
                        <div id="mensaje_asegurado_tres_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="vehiculo_cuatro_detalle_activos" name="vehiculo_cuatro_detalle_activos" placeholder="Vehívulo" value="<?php echo $resEdit->vehiculo_cuatro_detalle_activos; ?>">
                        <div id="mensaje_vehiculo_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="valor_vehiculo_cuatro_detalle_activos" name="valor_vehiculo_cuatro_detalle_activos" value="<?php echo $resEdit->valor_vehiculo_cuatro_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="Valor" >
                        <div id="mensaje_valor_vehiculo_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="uso_cuatro_detalle_activos" name="uso_cuatro_detalle_activos" placeholder="Uso" value="<?php echo $resEdit->uso_cuatro_detalle_activos; ?>">
                        <div id="mensaje_uso_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       
	       
	        <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="asegurado_cuatro_detalle_activos" name="asegurado_cuatro_detalle_activos" placeholder="Asegurado" value="<?php echo $resEdit->asegurado_cuatro_detalle_activos; ?>">
                        <div id="mensaje_asegurado_cuatro_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       
	       <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="otros_uno_detalle_activos" class="control-label">Otros Activos</label>
                    	<input type="text" class="form-control" id="otros_uno_detalle_activos" name="otros_uno_detalle_activos" placeholder="Otros" value="<?php echo $resEdit->otros_uno_detalle_activos; ?>">
                        <div id="mensaje_otros_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<label for="valor_otros_uno_detalle_activos" class="control-label">Valor</label>
                    	<input type="text" class="form-control" id="valor_otros_uno_detalle_activos" name="valor_otros_uno_detalle_activos" value="<?php echo $resEdit->valor_otros_uno_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="Valor">
                        <div id="mensaje_valor_otros_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<label for="observacion_otro_uno_detalle_activos" class="control-label">Observación</label>
                    	<input type="text" class="form-control" id="observacion_otro_uno_detalle_activos" name="observacion_otro_uno_detalle_activos" placeholder="Observación" value="<?php echo $resEdit->observacion_otro_uno_detalle_activos; ?>">
                        <div id="mensaje_observacion_otro_uno_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       <div class="row">
	       
	       <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="otros_dos_detalle_activos" name="otros_dos_detalle_activos" placeholder="Otros" value="<?php echo $resEdit->otros_dos_detalle_activos; ?>">
                        <div id="mensaje_otros_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
            		  
            <div class="col-xs-6 col-md-3 col-lg-3 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="valor_otros_dos_detalle_activos" name="valor_otros_dos_detalle_activos"  value="<?php echo $resEdit->valor_otros_dos_detalle_activos; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" placeholder="Valor">
                        <div id="mensaje_valor_otros_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
             	
             	
              <div class="col-xs-6 col-md-6 col-lg-6 ">
            		<div class="form-group">
                		<input type="text" class="form-control" id="observacion_dos_detalle_activos" name="observacion_dos_detalle_activos" placeholder="Observación" value="<?php echo $resEdit->observacion_dos_detalle_activos; ?>">
                        <div id="mensaje_observacion_dos_detalle_activos" class="errores"></div>
                 	</div>
             	</div>
	       </div>
	       
	       
	       
	     
	      </div>
     	  </div>
     	  
     	  
     	  <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i>Detalle Pasivos</h4>
	         </div>
	         <div class="panel-body">
	     
	      <div class="row">
                    		   
             
            <table class="col-lg-12 col-md-12 col-xs-12 tablesorter table table-striped table-bordered dt-responsive nowrap">
            
            <tr>
            <th><b>Institución</b></th>
            <th><b>Valor</b></th>
            <th><b>Destino</b></th>
            <th><b>Garantía</b></th>
            <th><b>Plazo</b></th>
            <th><b>Saldo</b></th>
            </tr>
            
            
            <tr>
            <td><input type="text" class="form-control cantidades1" id="institucion_uno_detalle_pasivos" name="institucion_uno_detalle_pasivos" placeholder="Institución" value="<?php echo $resEdit->institucion_uno_detalle_pasivos; ?>"><div id="mensaje_institucion_uno_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" value="<?php echo $resEdit->valor_uno_detalle_pasivos; ?>"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" id="valor_uno_detalle_pasivos" name="valor_uno_detalle_pasivos"  placeholder="Valor" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_valor_uno_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="destino_uno_detalle_pasivos" name="destino_uno_detalle_pasivos" placeholder="Destino"value="<?php echo $resEdit->destino_uno_detalle_pasivos; ?>"><div id="mensaje_destino_uno_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="garantia_uno_detalle_pasivos" name="garantia_uno_detalle_pasivos" placeholder="Garantía"value="<?php echo $resEdit->garantia_uno_detalle_pasivos; ?>"><div id="mensaje_garantia_uno_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="plazo_uno_detalle_pasivos" name="plazo_uno_detalle_pasivos" placeholder="Plazo"value="<?php echo $resEdit->plazo_uno_detalle_pasivos; ?>"><div id="mensaje_plazo_uno_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="saldo_uno_detalle_pasivos" name="saldo_uno_detalle_pasivos" placeholder="Saldo"value="<?php echo $resEdit->saldo_uno_detalle_pasivos; ?>"><div id="mensaje_saldo_uno_detalle_pasivos" class="errores"></div></td>
            </tr>
            
            <tr>
            <td><input type="text" class="form-control cantidades1" id="institucion_dos_detalle_pasivos" name="institucion_dos_detalle_pasivos" placeholder="Institución" value="<?php echo $resEdit->institucion_dos_detalle_pasivos; ?>"><div id="mensaje_institucion_dos_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" value="<?php echo $resEdit->valor_dos_detalle_pasivos; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" id="valor_dos_detalle_pasivos" name="valor_dos_detalle_pasivos" placeholder="Valor"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_valor_dos_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="destino_dos_detalle_pasivos" name="destino_dos_detalle_pasivos" placeholder="Destino" value="<?php echo $resEdit->destino_dos_detalle_pasivos; ?>"><div id="mensaje_destino_dos_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="garantia_dos_detalle_pasivos" name="garantia_dos_detalle_pasivos" placeholder="Garantía" value="<?php echo $resEdit->garantia_dos_detalle_pasivos; ?>"><div id="mensaje_garantia_dos_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="plazo_dos_detalle_pasivos" name="plazo_dos_detalle_pasivos" placeholder="Plazo" value="<?php echo $resEdit->plazo_dos_detalle_pasivos; ?>"><div id="mensaje_plazo_dos_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="saldo_dos_detalle_pasivos" name="saldo_dos_detalle_pasivos" placeholder="Saldo" value="<?php echo $resEdit->saldo_dos_detalle_pasivos; ?>"><div id="mensaje_saldo_dos_detalle_pasivos" class="errores"></div></td>
            </tr>
            
            <tr>
            <td><input type="text" class="form-control cantidades1" id="institucion_tres_detalle_pasivos" name="institucion_tres_detalle_pasivos" placeholder="Institución" value="<?php echo $resEdit->institucion_tres_detalle_pasivos; ?>"><div id="institucion_tres_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" value="<?php echo $resEdit->valor_tres_detalle_pasivos; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" id="valor_tres_detalle_pasivos" name="valor_tres_detalle_pasivos"  placeholder="Valor" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_valor_tres_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="destino_tres_detalle_pasivos" name="destino_tres_detalle_pasivos" placeholder="Destino" value="<?php echo $resEdit->destino_tres_detalle_pasivos; ?>"><div id="mensaje_destino_tres_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="garantia_tres_detalle_pasivos" name="garantia_tres_detalle_pasivos" placeholder="Garantía" value="<?php echo $resEdit->garantia_tres_detalle_pasivos; ?>"><div id="mensaje_garantia_tres_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="plazo_tres_detalle_pasivos" name="plazo_tres_detalle_pasivos" placeholder="Plazo" value="<?php echo $resEdit->plazo_tres_detalle_pasivos; ?>"><div id="mensaje_plazo_tres_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="saldo_tres_detalle_pasivos" name="saldo_tres_detalle_pasivos"placeholder="Saldo" value="<?php echo $resEdit->saldo_tres_detalle_pasivos; ?>"><div id="mensaje_saldo_tres_detalle_pasivos" class="errores"></div></td>
            </tr>
            
            <tr>
            <td><input type="text" class="form-control cantidades1" id="institucion_cuatro_detalle_pasivos" name="institucion_cuatro_detalle_pasivos" placeholder="Institución" value="<?php echo $resEdit->institucion_cuatro_detalle_pasivos; ?>"><div id="mensaje_institucion_cuatro_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" value="<?php echo $resEdit->valor_cuatro_detalle_pasivos; ?>"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" id="valor_cuatro_detalle_pasivos" name="valor_cuatro_detalle_pasivos" placeholder="Valor"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_valor_cuatro_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="destino_cuatro_detalle_pasivos" name="destino_cuatro_detalle_pasivos" placeholder="Destino" value="<?php echo $resEdit->destino_cuatro_detalle_pasivos; ?>"><div id="mensaje_destino_cuatro_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="garantia_cuatro_detalle_pasivos" name="garantia_cuatro_detalle_pasivos" placeholder="Garantía" value="<?php echo $resEdit->garantia_cuatro_detalle_pasivos; ?>"><div id="mensaje_garantia_cuatro_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="plazo_cuatro_detalle_pasivos" name="plazo_cuatro_detalle_pasivos" placeholder="Plazo" value="<?php echo $resEdit->plazo_cuatro_detalle_pasivos; ?>"><div id="mensaje_plazo_cuatro_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="saldo_cuatro_detalle_pasivos" name="saldo_cuatro_detalle_pasivos" placeholder="Saldo" value="<?php echo $resEdit->saldo_cuatro_detalle_pasivos; ?>"><div id="mensaje_saldo_cuatro_detalle_pasivos" class="errores"></div></td>
            </tr>
            
            <tr>
            <td><input type="text" class="form-control cantidades1" id="institucion_cinco_detalle_pasivos" name="institucion_cinco_detalle_pasivos" placeholder="Institución" value="<?php echo $resEdit->institucion_cinco_detalle_pasivos; ?>"><div id="mensaje_institucion_cinco_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" value="<?php echo $resEdit->valor_cinco_detalle_pasivos; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" id="valor_cinco_detalle_pasivos" name="valor_cinco_detalle_pasivos" placeholder="Valor"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_valor_cinco_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="destino_cinco_detalle_pasivos" name="destino_cinco_detalle_pasivos" placeholder="Destino" value="<?php echo $resEdit->destino_cinco_detalle_pasivos; ?>"><div id="mensaje_destino_cinco_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="garantia_cinco_detalle_pasivos" name="garantia_cinco_detalle_pasivos" placeholder="Garantía" value="<?php echo $resEdit->garantia_cinco_detalle_pasivos; ?>"><div id="mensaje_garantia_cinco_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="plazo_cinco_detalle_pasivos" name="plazo_cinco_detalle_pasivos"placeholder="Plazo" value="<?php echo $resEdit->plazo_cinco_detalle_pasivos; ?>"><div id="mensaje_plazo_cinco_detalle_pasivos" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="saldo_cinco_detalle_pasivos" name="saldo_cinco_detalle_pasivos" placeholder="Saldo" value="<?php echo $resEdit->saldo_cinco_detalle_pasivos; ?>"><div id="mensaje_saldo_cinco_detalle_pasivos" class="errores"></div></td>
            </tr>
            
            </table>
             
            </div>
	    
	   
	       
	       
	     
	      </div>
     	  </div>
     	  
     	  
     	 <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i>Ingresos y Gastos Mensuales</h4>
	         </div>
	         <div class="panel-body">
	     
	      <div class="row">
                    		   
             
            <table class="col-lg-12 col-md-12 col-xs-12 tablesorter table table-striped table-bordered dt-responsive nowrap">
            
            <tr>
            <th><b>Ingresos</b></th>
            <th><b>Valor en Dolares</b></th>
            <th><b>Gastos</b></th>
            <th><b>Valor en dólares</b></th>
            </tr>
            
            
            <tr>
            <td>Sueldo del afiliado</td>
            <td><input type="text" class="form-control cantidades1" value="<?php echo $resEdit->sueldo_afiliado_ingresos_mensuales; ?>" id="sueldo_afiliado_ingresos_mensuales" name="sueldo_afiliado_ingresos_mensuales"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_sueldo_afiliado_ingresos_mensuales" class="errores"></div></td>
            <td>Alimentación</td>
            <td><input type="text" class="form-control cantidades1"  id="alimentacion_gastos_mensuales" name="alimentacion_gastos_mensuales"  value="<?php echo $resEdit->alimentacion_gastos_mensuales; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_alimentacion_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Sueldo del cónyuge </td>
            <td><input type="text" class="form-control cantidades1" id="sueldo_conyuge_ingresos_mensuales" name="sueldo_conyuge_ingresos_mensuales"  value="<?php echo $resEdit->sueldo_conyuge_ingresos_mensuales; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_sueldo_conyuge_ingresos_mensuales" class="errores"></div></td>
            <td>Arriendos</td>
            <td><input type="text" class="form-control cantidades1" id="arriendos_gastos_mensuales" name="arriendos_gastos_mensuales" value="<?php echo $resEdit->arriendos_gastos_mensuales; ?>"   data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_arriendos_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            
            <tr>
            <td>Comisiones</td>
            <td><input type="text" class="form-control cantidades1" id="comisiones_ingresos_mensuales" name="comisiones_ingresos_mensuales"  value="<?php echo $resEdit->comisiones_ingresos_mensuales; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_comisiones_ingresos_mensuales" class="errores"></div></td>
            <td>Educación</td>
            <td><input type="text" class="form-control cantidades1" id="educacion_gastos_mensuales" name="educacion_gastos_mensuales"  value="<?php echo $resEdit->educacion_gastos_mensuales; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_educacion_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Arriendos</td>
            <td><input type="text" class="form-control cantidades1" id="arriendos_ingresos_mensuales" name="arriendos_ingresos_mensuales" value="<?php echo $resEdit->arriendos_ingresos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_arriendos_ingresos_mensuales" class="errores"></div></td>
            <td>Vestuario</td>
            <td><input type="text" class="form-control cantidades1" id="vestuario_gastos_mensuales" name="vestuario_gastos_mensuales"  value="<?php echo $resEdit->vestuario_gastos_mensuales; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_vestuario_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Dividendos</td>
            <td><input type="text" class="form-control cantidades1" id="dividendos_ingresos_mensuales" name="dividendos_ingresos_mensuales"  value="<?php echo $resEdit->dividendos_ingresos_mensuales; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_dividendos_ingresos_mensuales" class="errores"></div></td>
            <td>Servicios públicos</td>
            <td><input type="text" class="form-control cantidades1" id="servicios_publicos_gastos_mensuales" name="servicios_publicos_gastos_mensuales" value="<?php echo $resEdit->servicios_publicos_gastos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_servicios_publicos_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Ingresos del Negocio</td>
            <td><input type="text" class="form-control cantidades1" id="ingresos_negocio_ingresos_mensuales" name="ingresos_negocio_ingresos_mensuales" value="<?php echo $resEdit->ingresos_negocio_ingresos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_ingresos_negocio_ingresos_mensuales" class="errores"></div></td>
            <td>Movilización / transporte</td>
            <td><input type="text" class="form-control cantidades1" id="movilizacion_gastos_mensuales" name="movilizacion_gastos_mensuales" value="<?php echo $resEdit->movilizacion_gastos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_movilizacion_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Pensiones</td>
            <td><input type="text" class="form-control cantidades1" id="pensiones_ingresos_mensuales" name="pensiones_ingresos_mensuales" value="<?php echo $resEdit->pensiones_ingresos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_pensiones_ingresos_mensuales" class="errores"></div></td>
            <td>Ahorros cooperativas</td>
            <td><input type="text" class="form-control cantidades1" id="ahorros_cooperativas_gastos_mensuales" name="ahorros_cooperativas_gastos_mensuales" value="<?php echo $resEdit->ahorros_cooperativas_gastos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_ahorros_cooperativas_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            <tr>
            <td>Otros Ingresos (detalle)</td>
            <td>&nbsp;</td>
            <td>Cuotas tarjetas de crédito</td>
            <td><input type="text" class="form-control cantidades1" id="cuotas_tarjetas_gastos_mensuales" name="cuotas_tarjetas_gastos_mensuales" value="<?php echo $resEdit->cuotas_tarjetas_gastos_mensuales; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_cuotas_tarjetas_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            <tr>
            <td><input type="text" class="form-control cantidades1" id="otros_detalle_uno_ingresos_mensuales" name="otros_detalle_uno_ingresos_mensuales" placeholder="otros ingresos.." value="<?php echo $resEdit->otros_detalle_uno_ingresos_mensuales; ?>"><div id="mensaje_otros_detalle_uno_ingresos_mensuales" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="otros_uno_ingresos_mensuales" name="otros_uno_ingresos_mensuales"  value="<?php echo $resEdit->otros_uno_ingresos_mensuales; ?>" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_otros_uno_ingresos_mensuales" class="errores"></div></td>
            <td>Cuotas de préstamos</td>
            <td><input type="text" class="form-control cantidades1" id="cuotas_prestamo_gastos_mensuales" name="cuotas_prestamo_gastos_mensuales" value="<?php echo $resEdit->cuotas_prestamo_gastos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_cuotas_prestamo_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            
            <tr>
            <td><input type="text" placeholder="otros ingresos.." class="form-control cantidades1" id="otros_detalle_dos_ingresos_mensuales" name="otros_detalle_dos_ingresos_mensuales" value="<?php echo $resEdit->otros_detalle_dos_ingresos_mensuales; ?>"><div id="mensaje_otros_detalle_dos_ingresos_mensuales" class="errores"></div></td>
            <td><input type="text" class="form-control cantidades1" id="otros_dos_ingresos_mensuales" name="otros_dos_ingresos_mensuales" value="<?php echo $resEdit->otros_dos_ingresos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_otros_dos_ingresos_mensuales" class="errores"></div></td>
            <td>Otros gastos (detalle)</td>
            <td>&nbsp;</td>
            </tr>
            
         
         	<tr>
           <td><input type="text" placeholder="otros ingresos.." class="form-control cantidades1" id="otros_detalle_tres_ingresos_mensuales" name="otros_detalle_tres_ingresos_mensuales" value="<?php echo $resEdit->otros_detalle_tres_ingresos_mensuales; ?>"><div id="mensaje_otros_detalle_tres_ingresos_mensuales" class="errores"></div></td>
           <td><input type="text" class="form-control cantidades1" id="otros_tres_ingresos_mensuales" name="otros_tres_ingresos_mensuales" value="<?php echo $resEdit->otros_tres_ingresos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_otros_tres_ingresos_mensuales" class="errores"></div></td>
           <td><input type="text"  placeholder="otros gastos.." class="form-control cantidades1" id="otros_detalle_uno_gastos_mensuales" name="otros_detalle_uno_gastos_mensuales" value="<?php echo $resEdit->otros_detalle_uno_gastos_mensuales; ?>"><div id="mensaje_otros_detalle_uno_gastos_mensuales" class="errores"></div></td>
           <td><input type="text" class="form-control cantidades1" id="otros_gastos_uno_gastos_mensuales" name="otros_gastos_uno_gastos_mensuales" value="<?php echo $resEdit->otros_gastos_uno_gastos_mensuales; ?>"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false"><div id="mensaje_otros_gastos_uno_gastos_mensuales" class="errores"></div></td>
            </tr>
            
            </table>
             
            </div>
	    
	   
	       
	       
	     
	      </div>
     	  </div> 
     	  
     	  
     	  
     	  
  			<div class="row">
		    	<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; ">
		    		<div class="form-group">
              			<button type="button" id="btn_Guardar" name="btn_Guardar" class="btn btn-success"><i class="fa " aria-hidden="true"></i>Registrar Solicitud</button>
            		</div>
		    	</div>
		    </div>
		    
		    
		    
		   
		   
		   
		   
		   
		   
		   
		    
		    
		    
		    
		     <?php 
          } } else {?>
    
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

<script src="view/js/SolicitudHipotecario.js?3.10"></script> 
	
  </body>
</html>   