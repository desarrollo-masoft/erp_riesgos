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
    
    

      
       
       
       
       <!-- VENTANA MODAL INFORMACIÓN OFICIAL DE CRÉDITO -->
       
       
             
        <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
           <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 style="margin-left: 15px;">Estimado Participe.</h3>
           </div>
           <div class="modal-body">
          
          <p>Si ya registro una solicitud de crédito envie la siguiente información al correo electrónico de su oficial de crédito asignado para agilizar el proceso.</p>
          <p><b>1.-</b> 3 últimos roles de pago firmados por su entidad pagadora.<br><b>2.-</b> Certificado de tiempo de servicio.<br><b>3.-</b> Copia de cédula y papeleta de votación (7 febrero 2021).<br><b>4.-</b> Copia planilla de servicio básico (Actualizada).<br><b>5.-</b> Copia de libreta de ahorros.</p>
         
              <center><img src="view/images/enviar_info_cred.gif" class="img-rounded" alt="Cinque Terre" style="text-align:center;  width: 50%;"/></center> 
         
          </div>
           	
          
          
           <div class="modal-footer">
           
            <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
	      </div>
	     </div>
	   </div>
          
       
       
       <!-- TERMINA MODAL INFORMACIÓN OFICIAL DE CRÉDITO -->
       
       
       
     
  
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
                    	
					<div id="load_garantias_registrados" ></div>	
					<div id="solicitud_garantias_registrados"></div>	
				  
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
        
        <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   pone_espera();
        		   $("#mostrarmodal").modal("show");
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

        		   var con_datos={
        					  action:'ajax',
        					  page:pagina
        					  };
                 $("#load_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=SolicitudPrestamo&action=search_deudor',
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

        		   var con_datos={
        					  action:'ajax',
        					  page:pagina
        					  };
                 $("#load_garantias_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_garantias_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=SolicitudPrestamo&action=search_garantes',
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#solicitud_garantias_registrados").html(x);
           	               	 $("#tabla_solicitud_prestamos_registrados").tablesorter(); 
           	                 $("#load_garantias_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#solicitud_garantias_registrados").html("Ocurrio un error al cargar la informacion de solicitud de garantías generadas..."+estado+"    "+error);
           	              }
           	            });


           		   }

       		   
        </script>
        
    

	
  </body>
</html>   