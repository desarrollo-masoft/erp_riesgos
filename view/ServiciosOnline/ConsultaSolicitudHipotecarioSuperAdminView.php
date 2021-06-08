<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Consulta Solicitud Hipotecario - Capremci</title>

	
		
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
        
        <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   pone_espera();
        		   load_solicitud_hipotecario_registrados(1);
        		});

        	   function pone_espera(){

        		   $.blockUI({ 
        				message: '<h4><img src="view/images/load.gif" /> Espere por favor, estamos procesando su requerimiento...</h4>',
        				css: { 
        		            border: 'none', 
        		            padding: '15px', 
        		            backgroundColor: '#000', 
        		            '-webkit-border-radius': '10px', 
        		            '-moz-border-radius': '10px', 
        		            opacity: .5, 
        		            color: '#fff',
        		           
        	        		}
        	    });
            	
		        setTimeout($.unblockUI, 500); 
		        
        	   }

        	   
        	   function load_solicitud_hipotecario_registrados(pagina){


        		   var search=$("#search_solicitud").val();
                   
        		   var con_datos={
        					  action:'ajax',
        					  page:pagina
        					  };
                 $("#load_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=SolicitudHipotecario&action=searchadminsuper&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#solicitud_hipotecario_registrados").html(x);
           	               	 $("#tabla_solicitud_hipotecario_registrados").tablesorter(); 
           	                 $("#load_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#solicitud_hipotecario_registrados").html("Ocurrio un error al cargar la informacion de solicitud de hipotecario generadas..."+estado+"    "+error);
           	              }
           	            });


           		   }

       		   
        </script>
        
        
        

        
        
        
        	        
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
         <li class="active">Solicitud Hipotecario Generadas</li>
         </ol>
         </section>
       
  
		
		<div class="col-md-12 col-lg-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Solicitud<small>Hipotecario Registradas</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    	
                    <div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search_solicitud" name="search_solicitud" onkeyup="load_solicitud_hipotecario_registrados(1)" placeholder="search.."/>
					</div>
                    	
					<div id="load_registrados" ></div>	
					<div id="solicitud_hipotecario_registrados"></div>	
				  
                  </div>
                </div>
        </div>
        
       </div>
     </div>
   </div>
 </div>    
    
    
    
    
    
    <!-- PARA VENTANAS MODALES -->
    
      <div class="modal fade" id="mod_reasignar" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Reasignar Oficial de Crédito</h4>
          </div>
          <div class="modal-body">
          <!-- empieza el formulario modal productos -->
          	<form class="form-horizontal" method="post" id="frm_reasignar" name="frm_reasignar">
          	
          	  <div class="form-group">
				<label for="mod_cedu" class="col-sm-3 control-label">Cedula:</label>
				<div class="col-sm-8">
				  <input type="hidden" class="form-control" id="mod_id_solicitud_prestamo" name="mod_id_solicitud_prestamo"  readonly>
				  <input type="text" class="form-control" id="mod_cedu" name="mod_cedu"  readonly>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Nombres:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  readonly>
				</div>
			  </div>
			  
			  
			   <div class="form-group">
				<label for="mod_credito" class="col-sm-3 control-label">Tipo Crédito:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_credito" name="mod_credito"  readonly>
				</div>
			  </div>
			  
			  
			   <div class="form-group">
				<label for="mod_usuario" class="col-sm-3 control-label">Oficial Crédito:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_usuario" name="mod_usuario"  readonly>
				</div>
			  </div>
			
			  			  
          	<div class="form-group">
				<label for="mod_id_nuevo_oficial" class="col-sm-3 control-label">Reasignar A:</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_id_nuevo_oficial" name="mod_id_nuevo_oficial" required>
					<option value="0">--Seleccione--</option>					
				  </select>
				</div>
			  </div>
			  
			  <div id="msg_frm_reasignar" class=""></div>
			  
          	</form>
          	<!-- termina el formulario modal lote -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" form="frm_reasignar" class="btn btn-primary" id="guardar_datos">Reasignar Solicitud</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
    
    
    <!-- Bootstrap -->
    <script src="view/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
    
    
    <!-- NProgress -->
    <script src="view/vendors/nprogress/nprogress.js"></script>
   
   
    <!-- Datatables -->
    <script src="view/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    
    
    <script src="view/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    
    
    <!-- Custom Theme Scripts -->
    <script src="view/build/js/custom.min.js"></script>
	
	<!-- codigo de las funciones -->

	<script type="text/javascript">
    	var id = 0;
    	var cedu = "";
    	var nombre = "";
    	var credito ="";
    	var usuario = "";
    	
    	$("#solicitud_hipotecario_registrados").on("click","#btn_abrir",function(event){

    		var $div_respuesta = $("#msg_frm_reasignar"); $div_respuesta.text("").removeClass();
    	    
    		id = $(this).data().id;
    		cedu = $(this).data().cedu;
    		nombre = $(this).data().nombre;
    		credito = $(this).data().credito;
    		usuario = $(this).data().usuario;
    
    		$("#mod_reasignar").on('show.bs.modal',function(e){
    
    			 var modal = $(this)
    			 modal.find('#mod_id_solicitud_prestamo').val(id);
    			 modal.find('#mod_cedu').val(cedu);
    			 modal.find('#mod_nombre').val(nombre);
    			 modal.find('#mod_credito').val(credito);
    			 modal.find('#mod_usuario').val(usuario);
    			 cargarUsuarios();
    			
    		}) 
    		
    	})

    	
    	
    function cargarUsuarios(){
       	 
		let $mod_id_nuevo_oficial = $("#mod_id_nuevo_oficial");
		
		$.ajax({
			beforeSend:function(){},
			url:"index.php?controller=SolicitudPrestamo&action=cargar_oficiales_credito",
			type:"POST",
			dataType:"json",
			data:null
		}).done(function(datos){		
			
			$mod_id_nuevo_oficial.empty();
			$mod_id_nuevo_oficial.append("<option value='0'>--Seleccione--</option>");
			$.each(datos.data, function(index, value) {
				$mod_id_nuevo_oficial.append("<option value= " +value.id_usuarios +" >" + value.nombre_usuarios  + "</option>");	
	  		});
			
		}).fail(function(xhr,status,error){
			var err = xhr.responseText
			console.log(err)
			
		})
	}




    	$("#frm_reasignar").on("submit",function(event){



    		let $mod_id_solicitud_prestamo = $('#mod_id_solicitud_prestamo').val();
    		let $mod_cedu = $('#mod_cedu').val();
    		let $mod_nombre = $('#mod_nombre').val();
    		let $mod_credito = $('#mod_credito').val();
    		let $mod_usuario = $('#mod_usuario').val();
            let $mod_id_nuevo_oficial = $('#mod_id_nuevo_oficial').val();
    		
    		
    		if($mod_id_solicitud_prestamo > 0) {  
    			
	        } else {  

	        	swal("Alerta!", "Seleccione Solicitud", "error")
                return false;
	        		
	        } 

    		if($mod_id_nuevo_oficial > 0) {  
    			
	        } else {  

	        	swal("Alerta!", "Seleccione Oficial Hipotecario", "error")
                return false;
	        		
	        } 

    		
    		var parametros = {id_solicitud_prestamo:$mod_id_solicitud_prestamo,id_nuevo_oficial:$mod_id_nuevo_oficial}


    		var $div_respuesta = $("#msg_frm_reasignar"); $div_respuesta.text("").removeClass();
    			
    			
    		$.ajax({
    			beforeSend:function(){},
    			url:"index.php?controller=SolicitudHipotecario&action=ReasignarSolicitud",
    			type:"POST",
    			dataType:"json",
    			data:parametros
    		}).done(function(respuesta){
    					
    			if(respuesta.valor > 0){
    				
    				
    				$("#msg_frm_reasignar").text("Reasignado Correctamente").addClass("alert alert-success");
    				 load_solicitud_hipotecario_registrados(1);
          	    }
    			
    			
    		}).fail(function(xhr,status,error){
    			
    			var err = xhr.responseText
    			console.log(err);
    			
    			$div_respuesta.text("Error al reasignar solicitud hipotecario").addClass("alert alert-warning");
    			
    		}).always(function(){
    					
    		})
    		
    		event.preventDefault();
    	})
    	
    	
    </script>
  
  
  </body>
</html>   