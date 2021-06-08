<!DOCTYPE HTML>
	<html lang="es">
    <head>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ERP-RIESGOS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
        
    <?php include("view/modulos/links_css.php"); ?>    
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="//cdn.datatables.net/fixedheader/2.1.0/css/dataTables.fixedHeader.min.css"/>    
    <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.20/integration/font-awesome/dataTables.fontAwesome.css"/>
       
     			
    <style type="text/css">
 	  .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('view/images/ajax-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
        }
       .letrasize10{
        font-size: 10px;
       }
       .letrasize11{
        font-size: 11px;
       }
       .letrasize12{
        font-size: 12px;
       }
       .tooltip[aria-hidden=false] {
        opacity: 1;
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

      <header class="main-header">
      
          <?php include("view/modulos/logo.php"); ?>
          <?php include("view/modulos/head.php"); ?>	
        
      </header>
    
       <aside class="main-sidebar">
        <section class="sidebar">
         <?php include("view/modulos/menu_profile.php"); ?>
          <br>
         <?php include("view/modulos/menu.php"); ?>
        </section>
      </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        
        <small><?php echo $fecha; ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Recomendar Afiliación</li>
      </ol>
    </section>

       
  
		
                    
                    
		
      
    <section class="content">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recomendar Afiliación</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
             <div class="box-body">
      
      
         
           <form  action="<?php echo $helper->url("ServiciosOnline","InsertaRecomendacion"); ?>" method="post" onsubmit="return checkSubmit();" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
           
           
      
          <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-user'></i> Datos Generales</h4>
	         </div>
	         <div class="panel-body">
			 
			 <div class="row">
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                      <label for="cedula" class="control-label">Cedula:</label>
                                                      <input type="text" class="form-control" id="cedula" name="cedula" value=""  placeholder="cedula.." >
                                                      <div id="mensaje_cedula" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    
                    		    <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group">
                                                      <label for="nombre" class="control-label">Nombre:</label>
                                                      <input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="nombres..">
                                                      <div id="mensaje_nombre" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    <div class="col-lg-6 col-xs-12 col-md-6">
                    		    <div class="form-group">
                                                      <label for="direccion" class="control-label">Dirección:</label>
                                                      <input type="text" class="form-control" id="direccion" name="direccion" value="" placeholder="dirección..">
                                                      <div id="mensaje_direccion" class="errores"></div>
                                </div>
                                </div>
                    			
                    		
         	  </div>
			 
			 
			 
			 
			 <div class="row">
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="labor" class="control-label">Cargo:</label>
                                                      <input type="text" class="form-control" id="labor" name="labor" value=""  placeholder="cargo..">
                                                      <div id="mensaje_labor" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="correo" class="control-label">Email:</label>
                                                      <input type="text" class="form-control" id="correo" name="correo" value="" placeholder="email..">
                                                      <div id="mensaje_correo" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="telefono" class="control-label">Teléfono:</label>
                                                      <input type="text" class="form-control" id="telefono" name="telefono" value="" placeholder="teléfono..">
                                                      <div id="mensaje_usuario_usuario" class="errores"></div>
                                </div>
                                </div>
                    			
                    		
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="celular" class="control-label">Celular:</label>
                                                      <input type="text" class="form-control" id="celular" name="celular" value="" placeholder="celular..">
                                                      <div id="mensaje_celular" class="errores"></div>
                                </div>
                                </div>
         	  </div>
			 
			 
			 
			 <div class="row">
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="id_entidades" class="control-label">Fuerza:</label>
                                                      <select name="id_entidades" id="id_entidades"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultEntidades as $res) {?>
                        										<option value="<?php echo $res->id_entidad_patronal; ?>"  ><?php echo $res->nombre_entidad_patronal; ?> </option>
                        							        <?php } ?>
                        						      </select> 
                                                      <div id="mensaje_id_entidades" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="fecha_ingreso" class="control-label">Fecha Entrada:</label>
                                                      <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" min="1800-01-01" max="<?php echo date('Y-m-d');?>" value="" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                                                      <div id="mensaje_fecha_ingreso" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="sueldo" class="control-label">Sueldo:</label>
                                                      <input type="text" class="form-control cantidades1" id="sueldo" name="sueldo" value='0.00' 
                                                      data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false">
                                                      <div id="mensaje_sueldo" class="errores"></div>
                                </div>
                                </div>
                    			
                    			
                    		
                    		
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="hijos" class="control-label">Número Hijos:</label>
                                                      <input type="number" class="form-control" id="hijos" name="hijos" value="" placeholder="# hijos..">
                                                      <div id="mensaje_hijos" class="errores"></div>
                                </div>
                                </div>
                    		    
         	  </div>
			 
			 
			 
			 
			 <div class="row">
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="edad" class="control-label">Edad:</label>
                                                      <input type="number" class="form-control" id="edad" name="edad" value="" placeholder="edad..">
                                                      <div id="mensaje_edad" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="id_sexo" class="control-label">Género:</label>
                                                       <select name="id_sexo" id="id_sexo"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultSexo as $res) {?>
                        										<option value="<?php echo $res->id_sexo; ?>" ><?php echo $res->nombre_sexo; ?> </option>
                        							        <?php } ?>
                        							   </select> 
                                                      <div id="mensaje_id_sexo" class="errores"></div>
                                </div>
                                </div>
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="id_estado_civil" class="control-label">Estado Civil:</label>
                                                      <select name="id_estado_civil" id="id_estado_civil"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultEstado_civil as $res) {?>
                        										<option value="<?php echo $res->id_estado_civil_participes; ?>" ><?php echo $res->nombre_estado_civil_participes; ?> </option>
                        							        <?php } ?>
                        							  </select> 
                                                      <div id="mensaje_id_estado_civil" class="errores"></div>
                                </div>
                                </div>
                    			
                    		
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                      <label for="id_tipo_sangre" class="control-label">Tipo de Sangre:</label>
                                                      <select name="id_tipo_sangre" id="id_tipo_sangre"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultTipo_sangre as $res) {?>
                        										<option value="<?php echo $res->id_tipo_sangre; ?>" ><?php echo $res->nombre_tipo_sangre; ?> </option>
                        							        <?php } ?>
                        							  </select> 
                                                      <div id="mensaje_id_tipo_sangre" class="errores"></div>
                                </div>
                                </div>
         	  </div>
			 
			 
  			</div>
  			</div>
  			
           
        
                       
           
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i> Datos Residencia Hogar</h4>
	         </div>
	         <div class="panel-body">
			 <div class="row">
                    		   
                    		    
             					<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_provincias_vivienda" class="control-label">Provincia:</label>
                                                          <select name="id_provincias_vivienda" id="id_provincias_vivienda"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>"  ><?php echo $res->nombre_provincias; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_provincias_vivienda" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_cantones_vivienda" class="control-label">Cantón:</label>
                                                          <select name="id_cantones_vivienda" id="id_cantones_vivienda"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                                                            <?php foreach($resultCantones as $res) {?>
                        										<option value="<?php echo $res->id_cantones; ?>" ><?php echo $res->nombre_cantones; ?> </option>
                        							        <?php } ?>
                        							      
                        								  </select> 
                                                          <div id="mensaje_id_cantones_vivienda" class="errores"></div>
                                </div>
                    		    </div>
                    		   
                    			
                    			<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_parroquias_vivienda" class="control-label">Parroquia:</label>
                                                          <select name="id_parroquias_vivienda" id="id_parroquias_vivienda"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        								  <?php foreach($resultParroquias as $res) {?>
                        										<option value="<?php echo $res->id_parroquias; ?>" ><?php echo $res->nombre_parroquias; ?> </option>
                        							        <?php } ?>
                        								  </select> 
                                                          <div id="mensaje_id_parroquias_vivienda" class="errores"></div>
                                </div>
                    		    </div>
                    			
            </div>
			</div>
  			</div>
           
           
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-home'></i> Datos Residencia Asignasión</h4>
	         </div>
	         <div class="panel-body">
			 
			 
			 <div class="row">
                    		   
                    		    
             					<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_provincias_asignacion" class="control-label">Provincia:</label>
                                                          <select name="id_provincias_asignacion" id="id_provincias_asignacion"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultProvincias as $res) {?>
                        										<option value="<?php echo $res->id_provincias; ?>" ><?php echo $res->nombre_provincias; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_provincias_asignacion" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		    
                    		    <div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_cantones_asignacion" class="control-label">Cantón:</label>
                                                          <select name="id_cantones_asignacion" id="id_cantones_asignacion"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        							      
                        							      <?php foreach($resultCantones as $res) {?>
                        										<option value="<?php echo $res->id_cantones; ?>"  ><?php echo $res->nombre_cantones; ?> </option>
                        							        <?php } ?>
                        							      
                        							      </select> 
                                                          <div id="mensaje_id_cantones_asignacion" class="errores"></div>
                                </div>
                    		    </div>
                    		   
                    			
                    			<div class="col-lg-3 col-xs-12 col-md-3">
                    		    <div class="form-group">
                                                          <label for="id_parroquias_asignacion" class="control-label">Parroquia:</label>
                                                          <select name="id_parroquias_asignacion" id="id_parroquias_asignacion"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        								  <?php foreach($resultParroquias as $res) {?>
                        										<option value="<?php echo $res->id_parroquias; ?>" ><?php echo $res->nombre_parroquias; ?> </option>
                        							        <?php } ?>
                        								  </select> 
                                                          <div id="mensaje_id_parroquias_asignacion" class="errores"></div>
                                </div>
                    		    </div>
                        		
            </div>
			 
			<div class="row"> 
			 	
                    			<div class="col-lg-9 col-xs-12 col-md-9">
                    		    <div class="form-group">
                                                      <label for="observacion" class="control-label">Observación:</label>
                                                      <textarea type="text"  class="form-control" id="observacion" name="observacion" value=""  placeholder="observaciones.."></textarea>
                                                      <div id="mensaje_observacion" class="errores"></div>
                                </div>
                    		    </div>
                    		    
                    		    
            </div>      		    
			 
			 
  			</div>
  			</div>
  			
  			  
			  			<div class="col-lg-12 col-md-12 col-xs-12 " style="text-align: center; margin-top: 10px">
				  		 <button type="submit" id="generar" name="generar" value=""   class="btn btn-success" style="margin-top: 10px;"><i class="glyphicon glyphicon-edit"></i> Registrar Recomendación</button>         
					    </div>
  			
  			
         
      
      
       </form>
           
      
      
      
      
			      </div>
			      </div>
	  </section>
			  

	
	    
    
    
  
 
 
     </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
	    
	    <?php include("view/modulos/links_js.php"); ?>    
        <script src="view/bootstrap/bower_components/jquery-ui-1.12.1/jquery-ui.js"></script> 
        <script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
       
    
        <script type="text/javascript" src="view/bootstrap/otros/table-sorter/jquery.tablesorter.js"></script> 
        <script src="view/bootstrap/otros/blockUI/jquery.blockUI.js"></script>
        
 
	
	<script>
		$(document).ready(function(){

			$("#id_provincias_vivienda").change(function(){

	            // obtenemos el combo de resultado combo 2
	           var $id_cantones_vivienda = $("#id_cantones_vivienda");
	       	

	            // lo vaciamos
	           var id_provincias_vivienda = $(this).val();

	          
	          
	            if(id_provincias_vivienda != 0)
	            {
	            	 $id_cantones_vivienda.empty();
	            	
	            	 var datos = {
	                   	   
	            			 id_provincias_vivienda:$(this).val()
	                  };
	             
	            	
	         	   $.post("<?php echo $helper->url("SolicitudPrestamo","devuelveCanton"); ?>", datos, function(resultado) {

	          		  if(resultado.length==0)
	          		   {
	          				$id_cantones_vivienda.append("<option value='0' >--Seleccione--</option>");	
	             	   }else{
	             		    $id_cantones_vivienda.append("<option value='0' >--Seleccione--</option>");
	          		 		$.each(resultado, function(index, value) {
	          		 			$id_cantones_vivienda.append("<option value= " +value.id_cantones +" >" + value.nombre_cantones  + "</option>");	
	                     		 });
	             	   }	
	            	      
	         		  }, 'json');


	            }else{

	            	var id_cantones_vivienda=$("#id_cantones_vivienda");
	            	id_cantones_vivienda.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	var id_parroquias_vivienda=$("#id_parroquias_vivienda");
	            	id_parroquias_vivienda.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	
	            	
	            	
	            }
	            

			});
		});
	
       

	</script>
		 
		 
		 
		 
		 
		 
		 <script>
		$(document).ready(function(){

			$("#id_cantones_vivienda").change(function(){

	            // obtenemos el combo de resultado combo 2
	           var $id_parroquias_vivienda = $("#id_parroquias_vivienda");
	       	

	            // lo vaciamos
	           var id_cantones_vivienda = $(this).val();

	          
	          
	            if(id_cantones_vivienda != 0)
	            {
	            	 $id_parroquias_vivienda.empty();
	            	
	            	 var datos = {
	                   	   
	            			 id_cantones_vivienda:$(this).val()
	                  };
	             
	            	
	         	   $.post("<?php echo $helper->url("SolicitudPrestamo","devuelveParroquias"); ?>", datos, function(resultado) {

	          		  if(resultado.length==0)
	          		   {
	          				$id_parroquias_vivienda.append("<option value='0' >--Seleccione--</option>");	
	             	   }else{
	             		    $id_parroquias_vivienda.append("<option value='0' >--Seleccione--</option>");
	          		 		$.each(resultado, function(index, value) {
	          		 			$id_parroquias_vivienda.append("<option value= " +value.id_parroquias +" >" + value.nombre_parroquias  + "</option>");	
	                     		 });
	             	   }	
	            	      
	         		  }, 'json');


	            }else{

	            	var id_parroquias_vivienda=$("#id_parroquias_vivienda");
	            	id_parroquias_vivienda.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	
	            	
	            	
	            }
	            

			});
		});
	
       

	</script>
		    
			
        
        
        
        
        
        
        
        
        
        
        <script>
		$(document).ready(function(){

			$("#id_provincias_asignacion").change(function(){

	            // obtenemos el combo de resultado combo 2
	           var $id_cantones_asignacion = $("#id_cantones_asignacion");
	       	

	            // lo vaciamos
	           var id_provincias_asignacion = $(this).val();

	          
	          
	            if(id_provincias_asignacion != 0)
	            {
	            	 $id_cantones_asignacion.empty();
	            	
	            	 var datos = {
	                   	   
	            			 id_provincias_asignacion:$(this).val()
	                  };
	             
	            	
	         	   $.post("<?php echo $helper->url("SolicitudPrestamo","devuelveCanton"); ?>", datos, function(resultado) {

	          		  if(resultado.length==0)
	          		   {
	          				$id_cantones_asignacion.append("<option value='0' >--Seleccione--</option>");	
	             	   }else{
	             		    $id_cantones_asignacion.append("<option value='0' >--Seleccione--</option>");
	          		 		$.each(resultado, function(index, value) {
	          		 			$id_cantones_asignacion.append("<option value= " +value.id_cantones +" >" + value.nombre_cantones  + "</option>");	
	                     		 });
	             	   }	
	            	      
	         		  }, 'json');


	            }else{

	            	var id_cantones_asignacion=$("#id_cantones_asignacion");
	            	id_cantones_asignacion.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	var id_parroquias_asignacion=$("#id_parroquias_asignacion");
	            	id_parroquias_asignacion.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	
	            	
	            	
	            }
	            

			});
		});
	
       

	</script>
		 
		 
		 
		 
		 
		 
		 <script>
		$(document).ready(function(){

			$("#id_cantones_asignacion").change(function(){

	            // obtenemos el combo de resultado combo 2
	           var $id_parroquias_asignacion = $("#id_parroquias_asignacion");
	       	

	            // lo vaciamos
	           var id_cantones_asignacion = $(this).val();

	          
	          
	            if(id_cantones_asignacion != 0)
	            {
	            	 $id_parroquias_asignacion.empty();
	            	
	            	 var datos = {
	                   	   
	            			 id_cantones_asignacion:$(this).val()
	                  };
	             
	            	
	         	   $.post("<?php echo $helper->url("SolicitudPrestamo","devuelveParroquias"); ?>", datos, function(resultado) {

	          		  if(resultado.length==0)
	          		   {
	          				$id_parroquias_asignacion.append("<option value='0' >--Seleccione--</option>");	
	             	   }else{
	             		    $id_parroquias_asignacion.append("<option value='0' >--Seleccione--</option>");
	          		 		$.each(resultado, function(index, value) {
	          		 			$id_parroquias_asignacion.append("<option value= " +value.id_parroquias +" >" + value.nombre_parroquias  + "</option>");	
	                     		 });
	             	   }	
	            	      
	         		  }, 'json');


	            }else{

	            	var id_parroquias_asignacion=$("#id_parroquias_asignacion");
	            	id_parroquias_asignacion.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	
	            	
	            	
	            }
	            

			});
		});
	
       

	</script>
		    
        
        
        
        
        <script>
		  $(function () {
		   
		    
		    $('#datemask2').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })
		    //Money Euro
		    $('[data-mask]').inputmask()
		
		    
		  })
		</script>
		        
		        
        
       
      
       <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#generar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var cedula = $("#cedula").val();
		    	var nombre = $("#nombre").val();
		    	var direccion = $("#direccion").val();
		    	var labor = $("#labor").val();
		    	var correo = $("#correo").val();
		    	var telefono = $("#telefono").val();
		    	var celular  = $("#celular").val();
		    	var id_entidades  = $("#id_entidades").val();
		    	var fecha_ingreso  = $("#fecha_ingreso").val();

		    	var sueldo  = $("#sueldo").val();
		    	var hijos  = $("#hijos").val();
		    	var edad  = $("#edad").val();
		    	var id_sexo  = $("#id_sexo").val();
		    	var id_estado_civil  = $("#id_estado_civil").val();
		    	var id_tipo_sangre  = $("#id_tipo_sangre").val();


		    	
		    	var id_provincias_vivienda  = $("#id_provincias_vivienda").val();
		    	var id_cantones_vivienda  = $("#id_cantones_vivienda").val();
		    	var id_parroquias_vivienda  = $("#id_parroquias_vivienda").val();

		    	var id_provincias_asignacion  = $("#id_provincias_asignacion").val();
		    	var id_cantones_asignacion  = $("#id_cantones_asignacion").val();
		    	var id_parroquias_asignacion  = $("#id_parroquias_asignacion").val();

		    	var observacion  = $("#observacion").val();
		    	var tiempo = tiempo || 1000;
				  
		    	
		    	if (cedula == "")
		    	{
			    	
		    		$("#mensaje_cedula").text("Introduzca Cedula");
		    		$("#mensaje_cedula").fadeIn("slow"); //Muestra mensaje de error
		          
		            $("html, body").animate({ scrollTop: $(mensaje_cedula).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_cedula_usuarios").fadeOut("slow"); //Muestra mensaje de error
		            
				}    
				
		    	if (nombre == "")
		    	{
			    	
		    		$("#mensaje_nombre").text("Introduzca un Nombre");
		    		$("#mensaje_nombre").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_nombre).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombre").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	if (direccion == "")
		    	{
			    	
		    		$("#mensaje_direccion").text("Introduzca Dirección");
		    		$("#mensaje_direccion").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_direccion).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_direccion").fadeOut("slow"); //Muestra mensaje de error
		            
				}   
						    	
			
		    	if (labor == "")
		    	{
		    		
		    		$("#mensaje_labor").text("Introduzca Cargo");
		    		$("#mensaje_labor").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_labor).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_labor").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	

		    	
		    	
		    	
		    	
				
		    	if (correo == "")
		    	{
			    	
		    		$("#mensaje_correo").text("Introduzca un correo");
		    		$("#mensaje_correo").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_correo).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else if (regex.test($('#correo').val().trim()))
		    	{
		    		$("#mensaje_correo").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	else 
		    	{
		    		$("#mensaje_correo").text("Introduzca un correo Valido");
		    		$("#mensaje_correo").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_correo).offset().top-120 }, tiempo);
		            return false;	
			    }


		    

		    	if (celular == "" )
		    	{
			    	
		    		$("#mensaje_celular").text("Ingrese #");
		    		$("#mensaje_celular").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_celular).offset().top-120 }, tiempo);
		            return false;	
			    }
		    	else 
		    	{
		    		$("#mensaje_celular").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	
		    	if (id_entidades == 0 )
		    	{
			    	
		    		$("#mensaje_id_entidades").text("Seleccione");
		    		$("#mensaje_id_entidades").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_id_entidades).offset().top-120 }, tiempo);
		            return false;	
			    }
		    	else 
		    	{
		    		$("#mensaje_id_entidades").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (fecha_ingreso == "" )
		    	{
			    	
		    		$("#mensaje_fecha_ingreso").text("Seleccione");
		    		$("#mensaje_fecha_ingreso").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(fecha_ingreso).offset().top-120 }, tiempo);
		            return false;	
			    }
		    	else 
		    	{
		    		$("#mensaje_fecha_ingreso").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	

		    	if (sueldo == 0.00 )
		    	{
			    	
		    		$("#mensaje_sueldo").text("Ingrese Sueldo");
		    		$("#mensaje_sueldo").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_sueldo).offset().top-120 }, tiempo);
		            return false;	
			    }
		    	else 
		    	{
		    		$("#mensaje_sueldo").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (hijos == "" )
		    	{
			    	
		    		$("#mensaje_hijos").text("Ingrese # Hijos");
		    		$("#mensaje_hijos").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_hijos).offset().top-120 }, tiempo);
		            return false;	
			    }
		    	else 
		    	{
		    		$("#mensaje_hijos").fadeOut("slow"); //Muestra mensaje de error
		            
				}



		    	if (edad == "" || edad == 0 )
		    	{
			    	
		    		$("#mensaje_edad").text("Ingrese Edad");
		    		$("#mensaje_edad").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_edad).offset().top-120 }, tiempo);
		            return false;	
			    }
		    	else 
		    	{
		    		$("#mensaje_edad").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (id_sexo == 0 )
		    	{
			    	
		    		$("#mensaje_id_sexo").text("Seleccione");
		    		$("#mensaje_id_sexo").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_sexo).offset().top-120 }, tiempo);
		            return false;	
			    }
		    	else 
		    	{
		    		$("#mensaje_id_sexo").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    	if (id_estado_civil == 0 )
		    	{
			    	
		    		$("#mensaje_id_estado_civil").text("Seleccione");
		    		$("#mensaje_id_estado_civil").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_estado_civil).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_estado_civil").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    	if (id_tipo_sangre == 0 )
		    	{
			    	
		    		$("#mensaje_id_tipo_sangre").text("Seleccione");
		    		$("#mensaje_id_tipo_sangre").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_tipo_sangre).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_tipo_sangre").fadeOut("slow"); //Muestra mensaje de error
		            
				}



		    	if (id_provincias_vivienda == 0 )
		    	{
			    	
		    		$("#mensaje_id_provincias_vivienda").text("Seleccione");
		    		$("#mensaje_id_provincias_vivienda").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_provincias_vivienda).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_provincias_vivienda").fadeOut("slow"); //Muestra mensaje de error
		            
				}



		    	if (id_cantones_vivienda == 0 )
		    	{
			    	
		    		$("#mensaje_id_cantones_vivienda").text("Seleccione");
		    		$("#mensaje_id_cantones_vivienda").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_cantones_vivienda).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_cantones_vivienda").fadeOut("slow"); //Muestra mensaje de error
		            
				}
    					    
		    	if (id_parroquias_vivienda == 0 )
		    	{
			    	
		    		$("#mensaje_id_parroquias_vivienda").text("Seleccione");
		    		$("#mensaje_id_parroquias_vivienda").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_parroquias_vivienda).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_parroquias_vivienda").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (id_provincias_asignacion == 0 )
		    	{
			    	
		    		$("#mensaje_id_provincias_asignacion").text("Seleccione");
		    		$("#mensaje_id_provincias_asignacion").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_provincias_asignacion).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_provincias_asignacion").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (id_cantones_asignacion == 0 )
		    	{
			    	
		    		$("#mensaje_id_cantones_asignacion").text("Seleccione");
		    		$("#mensaje_id_cantones_asignacion").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_cantones_asignacion).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_cantones_asignacion").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (id_parroquias_asignacion == 0 )
		    	{
			    	
		    		$("#mensaje_id_parroquias_asignacion").text("Seleccione");
		    		$("#mensaje_id_parroquias_asignacion").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_parroquias_asignacion).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_parroquias_asignacion").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (observacion == "" )
		    	{
			    	
		    		$("#mensaje_observacion").text("Ingrese observaciones");
		    		$("#mensaje_observacion").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_observacion).offset().top-120 }, tiempo);
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_observacion").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
			}); 


		        $( "#cedula" ).focus(function() {
				  $("#mensaje_cedula").fadeOut("slow");
			    });
				
				$( "#nombre" ).focus(function() {
					$("#mensaje_nombre").fadeOut("slow");
    			});
				$( "#direccion" ).focus(function() {
					$("#mensaje_direccion").fadeOut("slow");
    			});
    			
				$( "#labor" ).focus(function() {
					$("#mensaje_labor").fadeOut("slow");
    			});
				$( "#correo" ).focus(function() {
					$("#mensaje_correo").fadeOut("slow");
    			});
				$( "#celular" ).focus(function() {
					$("#mensaje_celular").fadeOut("slow");
    			});
				
				$( "#id_entidades" ).focus(function() {
					$("#mensaje_id_entidades").fadeOut("slow");
    			});
				
				$( "#fecha_ingreso" ).focus(function() {
					$("#mensaje_fecha_ingreso").fadeOut("slow");
    			});
			
				$( "#sueldo" ).focus(function() {
					$("#mensaje_sueldo").fadeOut("slow");
    			});

				$( "#hijos" ).focus(function() {
					$("#mensaje_hijos").fadeOut("slow");
    			});
				
				$( "#edad" ).focus(function() {
					$("#mensaje_edad").fadeOut("slow");
    			});

				$( "#id_sexo" ).focus(function() {
					$("#mensaje_id_sexo").fadeOut("slow");
    			});


				$( "#id_estado_civil" ).focus(function() {
					$("#mensaje_id_estado_civil").fadeOut("slow");
    			});

				$( "#id_tipo_sangre" ).focus(function() {
					$("#mensaje_id_tipo_sangre").fadeOut("slow");
    			});
				$( "#id_provincias_vivienda" ).focus(function() {
					$("#mensaje_id_provincias_vivienda").fadeOut("slow");
    			});
				$( "#id_cantones_vivienda" ).focus(function() {
					$("#mensaje_id_cantones_vivienda").fadeOut("slow");
    			});
				$( "#id_parroquias_vivienda" ).focus(function() {
					$("#mensaje_id_parroquias_vivienda").fadeOut("slow");
    			});

				$( "#id_provincias_asignacion" ).focus(function() {
					$("#mensaje_id_provincias_asignacion").fadeOut("slow");
    			});
				$( "#id_cantones_asignacion" ).focus(function() {
					$("#mensaje_id_cantones_asignacion").fadeOut("slow");
    			});
				$( "#id_parroquias_asignacion" ).focus(function() {
					$("#mensaje_id_parroquias_asignacion").fadeOut("slow");
    			});
				$( "#observacion" ).focus(function() {
					$("#mensaje_observacion").fadeOut("slow");
    			});  
		}); 

	</script>
        
       
       
       <script>
      $(document).ready(function(){
      $(".cantidades1").inputmask();
      });
	  </script>
	
 
 <script type="text/javascript">

            enviando = false; //Obligaremos a entrar el if en el primer submit
            
            function checkSubmit() {
                if (!enviando) {
            		enviando= true;
            		return true;
                } else {
                    //Si llega hasta aca significa que pulsaron 2 veces el boton submit
                   
                  
                    return false;
                }
            }
        
        </script>
	
  </body>
</html>   