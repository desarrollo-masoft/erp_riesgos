<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP-RIESGOS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
    
  <link rel="stylesheet" href="view/bootstrap/bower_components/font-awesome/css/font-awesome.min.css">
   
    
   <?php include("view/modulos/links_css.php"); ?>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
    <style type="text/css">
    
    .letrasize11{
        font-size: 12px;
       }
    
    </style>
    
    
  </head>

  <body class="hold-transition skin-green fixed sidebar-mini">
    
	
	
     <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        ?>
    
    <div class="wrapper">



        <section class="content-header">
          <h1>
            <small><?php echo $fecha; ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Página Web</a></li>
            <li class="active">Solicitar Afiliación</li>
          </ol>
        </section>

     
          <!-- INICIA NUEVA AFILIACION -->
	    
       <section class="content">
	   
	   <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Solicitar Afiliación</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body"> 
	   
	   
		
		             <form id="frm_afiliacion" action="" method="post" enctype="multipart/form-data" class="col-lg-12 col-md-12 col-xs-12">
          		 	 	 <div class="row">
                         	<div class="col-xs-12 col-md-3 col-lg-3 ">
                            	<div class="form-group">
                                	<label for="cedula_afiliados" class="control-label">Cedula:</label>
                                    <input type="number" class="form-control" id="cedula_afiliados" name="cedula_afiliados" value=""  placeholder="ci-ruc..">
                                    <div id="mensaje_cedula_afiliados" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="nombre_afiliados" class="control-label">Nombres:</label>
                                      <input style="text-transform: uppercase;" type="text" class="form-control" id="nombre_afiliados" name="nombre_afiliados" value="" placeholder="nombres..">
                                      <div id="mensaje_nombre_afiliados" class="errores"></div>
                                 </div>
                             </div>
                             <div class="col-xs-12 col-md-3 col-lg-3">
                             	<div class="form-group">
                                	 <label for="apellidos_afiliados" class="control-label">Apellidos:</label>
                                      <input style="text-transform: uppercase;" type="text" class="form-control" id="apellidos_afiliados" name="apellidos_afiliados" value="" placeholder="apellidos..">
                                      <div id="mensaje_apellidos_afiliados" class="errores"></div>
                                 </div>
                             </div>
                            
                          </div>
                          
                          <div class="row">
                          
                           <div class="col-lg-3 col-xs-12 col-md-3">
                        		    <div class="form-group">
                                          <label for="correo_afiliados" class="control-label">Correo:</label>
                                          <input type="email" class="form-control" id="correo_afiliados" name="correo_afiliados" value="" placeholder="email..">
                                          <div id="mensaje_correo_afiliados" class="errores"></div>
                                    </div>
                    	   </div>
								
							  <div class="col-lg-3 col-xs-12 col-md-3">
                             
                                 <div class="form-group">
                                    <label for="celular_afiliados" class="control-label">Celular:</label>
                                    <input type="text" id="celular_afiliados" name="celular_afiliados" value="" class="form-control" data-inputmask='"mask": "999-999-9999","clearIncomplete" : true' data-mask>
                                    <div id="mensaje_celular_afiliados" class="errores"></div>
                                    
                                  </div>
                    		    
                             </div>
                             
                             <div class="col-lg-3 col-xs-12 col-md-3">
                             	<div class="form-group">
                                    <label for="telefono_afiliados" class="control-label">Teléfono:</label>                                        
                                    <input type="text" class="form-control"  id="telefono_afiliados" name="telefono_afiliados" value=""  data-inputmask='"mask": "(99) 9999-999","clearIncomplete" : true' data-mask>
                                </div>
                    		   
                    	    </div>
							
                                                      
                          </div>
                          
		
                         
                    		
                    		<div class="row"> 
                    		
								<div class="col-xs-12 col-md-3 col-lg-3 ">
                          		<div class="form-group">
                             		 	<label for="fecha_nacimiento_afiliados" class="control-label">Fecha Nacimiento:</label>
                                        <input type="text" class="form-control" id="fecha_nacimiento_afiliados" name="fecha_nacimiento_afiliados" value="" data-fechaactual="<?php echo date('Y/m/d');?>" >
                                        <div id="mensaje_fecha_nacimiento_afiliados" class="errores"></div>
                                       
                                </div>                            	
                             </div> 
							
								<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_entidad_patronal" class="control-label">Dirección:</label>
                                                          <select name="id_entidad_patronal" id="id_entidad_patronal"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultEnt as $res) {?>
                        										<option value="<?php echo $res->id_entidad_patronal; ?>" ><?php echo $res->nombre_entidad_patronal; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_entidad_patronal" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_entidad_patronal_coordinaciones" class="control-label">Cordinación:</label>
                                                          <select name="id_entidad_patronal_coordinaciones" id="id_entidad_patronal_coordinaciones" onchange="seleccion();" class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        							      
                        							      <?php foreach($resultCor as $res) {?>
                        										<option value="<?php echo $res->id_entidad_patronal_coordinaciones; ?>"  ><?php echo $res->nombre_entidad_patronal_coordinaciones; ?> </option>
                        							        <?php } ?>
                        							     
                        							      </select> 
                                                          <div id="mensaje_id_entidad_patronal_coordinaciones" class="errores"></div>
                                </div>
                    		    </div>
                    		   
							   
							   <div id="div_otra" style="display: none;">
							    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="nombre_otra_coordinacion" class="control-label">Nombre Otra Coordinación:</label>
                                                      <input style="text-transform: uppercase;" type="text" class="form-control" id="nombre_otra_coordinacion" name="nombre_otra_coordinacion" value="" placeholder="nombre otra coordinación..">
                                                      <div id="mensaje_nombre_otra_coordinacion" class="errores"></div>
                                </div>
            					</div>
							   </div>
							   
                            </div>
							     
								 

			                    <div class="row">
			  					<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="id_bancos" class="control-label">Banco:</label>
                                                       <select name="id_bancos" id="id_bancos"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultBan as $res) {?>
                        										<option value="<?php echo $res->id_bancos; ?>" ><?php echo $res->nombre_bancos; ?> </option>
                        							        <?php } ?>
                        							   </select> 
                                                      <div id="mensaje_id_bancos" class="errores"></div>
                                </div>
                                </div>
			        		    
			        		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="tipo_cuenta_afiliados" class="control-label">Tipo Cuenta:</label>
                                                      <select name="tipo_cuenta_afiliados" id="tipo_cuenta_afiliados"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Ahorros">Ahorros</option>
                        							  <option value="Corriente">Corriente</option>
                        							  </select> 
                                                      <div id="mensaje_tipo_cuenta_afiliados" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="numero_cuenta_afiliados" class="control-label">Número Cuenta:</label>
                                                      <input type="number" class="form-control" id="numero_cuenta_afiliados" name="numero_cuenta_afiliados" value="" placeholder="# cuenta..">
                                                      <div id="mensaje_numero_cuenta_afiliados" class="errores"></div>
                                </div>
                                </div>
                     		   </div>	 
							
                                
                     	<div class="row">
            			    <div class="col-xs-12 col-lg-10 col-md-10" style="margin-top:15px;  text-align: center; ">
                	   		    <div class="form-group">
            	                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Solicitar Afiliación</button>
            	                </div>
    	        		    </div>
    	        		    
            		    </div>
          		 	
          		 	</form>
    
         
		
		 </div>
		  </div>
		
	  </section>
	   
	  
          
          <!-- TERMINA NUEVA AFILIACION -->
          
          
 
  
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
  <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="view/bootstrap/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="view/bootstrap/bower_components/jquery-ui-1.12.1/jquery-ui.js"></script> 
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
   
    <script src="view/ServiciosOnline/js/NuevaAfiliacionOnline.js?0.02"></script>       
    
	
  </body>
</html>
