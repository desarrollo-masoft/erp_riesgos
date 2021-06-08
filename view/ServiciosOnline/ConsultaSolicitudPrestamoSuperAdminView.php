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
        <li class="active">Solicitud de Prestamos Generadas</li>
      </ol>
    </section>
    
    

  
		
    <section class="content">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Solicitud de Prestamo Generadas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
             <div class="box-body">
                    	
                    <div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search_solicitud" name="search_solicitud" onkeyup="load_solicitud_prestamos_registrados(1)" placeholder="search.."/>
					</div>
                    	
					<div id="load_registrados" ></div>	
					<div id="solicitud_prestamos_registrados"></div>	
				  
                  </div>
                </div>
        </section>
        
        
        
    <section class="content">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Solicitud de Garantías Generadas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
             <div class="box-body">
                    	
                    	
                    <div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search_garantias" name="search_garantias" onkeyup="load_solicitud_garantias_registrados(1)" placeholder="search.."/>
					</div>
                    	
					<div id="load_garantias_registrados" ></div>	
					<div id="solicitud_garantias_registrados"></div>	
				  
                  </div>
                </div>
        </section>
        
        
     
    
    
    
    
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
    
    
    
        </div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
	    
	    <?php include("view/modulos/links_js.php"); ?>    
        <script src="view/bootstrap/bower_components/jquery-ui-1.12.1/jquery-ui.js"></script> 
        <script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
       
    
        <script type="text/javascript" src="view/bootstrap/otros/table-sorter/jquery.tablesorter.js"></script> 
        <script src="view/bootstrap/otros/blockUI/jquery.blockUI.js"></script>
    
    
     <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   pone_espera();
        		   load_solicitud_prestamos_registrados(1);
        		   load_solicitud_garantias_registrados(1);
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

        	   
        	   function load_solicitud_prestamos_registrados(pagina){


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
           	               url: 'index.php?controller=SolicitudPrestamo&action=searchadminsuper_deudor&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#solicitud_prestamos_registrados").html(x);
           	               	 $("#tabla_solicitud_prestamos_registrados").tablesorter(); 
           	                 $("#load_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#solicitud_prestamos_registrados").html("Ocurrio un error al cargar la informacion de solicitud de prestamos generadas..."+estado+"    "+error);
           	              }
           	            });


           		   }



        	   function load_solicitud_garantias_registrados(pagina){
        		   var search=$("#search_garantias").val();
        		   var con_datos={
        					  action:'ajax',
        					  page:pagina
        					  };
                 $("#load_garantias_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_garantias_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=SolicitudPrestamo&action=searchadminsuper_garantes&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#solicitud_garantias_registrados").html(x);
           	               	 $("#tabla_solicitud_garantias_registrados").tablesorter(); 
           	                 $("#load_garantias_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#solicitud_garantias_registrados").html("Ocurrio un error al cargar la informacion de solicitud de garantías generadas..."+estado+"    "+error);
           	              }
           	            });


           		   }

       		   
        </script>
        
    

	<script type="text/javascript">
    	var id = 0;
    	var cedu = "";
    	var nombre = "";
    	var credito ="";
    	var usuario = "";
    	
    	$("#solicitud_prestamos_registrados").on("click","#btn_abrir",function(event){

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
				$mod_id_nuevo_oficial.append("<option value= " +value.id_usuarios +" >" + value.usuario_usuarios  + "</option>");	
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

	        	swal("Alerta!", "Seleccione Oficial Crédito", "error")
                return false;
	        		
	        } 

    		
    		var parametros = {id_solicitud_prestamo:$mod_id_solicitud_prestamo,id_nuevo_oficial:$mod_id_nuevo_oficial}


    		var $div_respuesta = $("#msg_frm_reasignar"); $div_respuesta.text("").removeClass();
    			
    			
    		$.ajax({
    			beforeSend:function(){},
    			url:"index.php?controller=SolicitudPrestamo&action=ReasignarSolicitud",
    			type:"POST",
    			dataType:"json",
    			data:parametros
    		}).done(function(respuesta){
    					
    			if(respuesta.valor > 0){
    				
    				
    				$("#msg_frm_reasignar").text("Reasignado Correctamente").addClass("alert alert-success");
    				 load_solicitud_prestamos_registrados(1);
          		     load_solicitud_garantias_registrados(1);
    		    }
    			
    			
    		}).fail(function(xhr,status,error){
    			
    			var err = xhr.responseText
    			console.log(err);
    			
    			$div_respuesta.text("Error al reasignar solicitud de crédito").addClass("alert alert-warning");
    			
    		}).always(function(){
    					
    		})
    		
    		event.preventDefault();
    	})
    	
    	
    </script>
  
  
  </body>
</html>   