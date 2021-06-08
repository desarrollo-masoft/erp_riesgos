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
        <li class="active">Consulta Afiliaciones Recomendadas</li>
      </ol>
    </section>
    
    
  
		
    <section class="content">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Consulta Afiliaciones Recomendadas</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
             <div class="box-body">
                    
					<div class="row" style="margin-left:1px;">
									<div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="desde" class="control-label">Desde:</label>
                                                          <input type="date" class="form-control" id="desde" name="desde" value="" >
                                                          <div id="mensaje_desde" class="errores"></div>
                                    </div>
                        		    </div>
                        		    
                        		    <div class="col-lg-2 col-xs-12 col-md-2">
                        		    <div class="form-group">
                                                          <label for="hasta" class="control-label">Hasta:</label>
                                                          <input type="date" class="form-control" id="hasta" name="hasta" value="">
                                                          <div id="mensaje_hasta" class="errores"></div>
                                               
                                    </div>
                                    
                        		    </div>
                        		    
                        		    <div class="col-xs-12 col-md-2 col-lg-2" style="text-align: center; margin-top:22px">
                    		        <div class="form-group">
                        		    <button type="button" id="buscar" name="buscar" class="btn btn-info"><i class="glyphicon glyphicon-search"></i></button>
                                	</div>
                                    </div>
                        		    
					</div>
				
					
					<div class="pull-right" style="margin-right:11px;">
					<input type="text" value="" class="form-control" id="search" name="search" onkeyup="load_afiliaciones_recomendadas(1)" placeholder="search.."/>
					</div>
					
					
					<div id="load_registrados" ></div>	
					<div id="afiliaciones_recomendadas_registrados"></div>	
				
					
                  
                  
		</div></div></section>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
      
      </div>
    </div>

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
        		   load_afiliaciones_recomendadas(1);


        		 			  $("#buscar").click(function() 
        					{
        				    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
        				    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

        				    	var desde = $("#desde").val();
        				    	var hasta = $("#hasta").val();
        				    	
        				    	
        				    	


        						if(desde > hasta){

        							$("#mensaje_desde").text("Fecha desde no puede ser mayor a hasta");
        				    		$("#mensaje_desde").fadeIn("slow"); //Muestra mensaje de error
        				            return false;
        				            
            					}else 
        				    	{
        				    		$("#mensaje_desde").fadeOut("slow"); //Muestra mensaje de error
        				    		load_afiliaciones_recomendadas(1);
        						} 


        						if(hasta < desde){

        							$("#mensaje_hasta").text("Fecha hasta no puede ser menor a desde");
        				    		$("#mensaje_hasta").fadeIn("slow"); //Muestra mensaje de error
        				            return false;
        				            
            					}else 
        				    	{
        				    		$("#mensaje_hasta").fadeOut("slow"); //Muestra mensaje de error
        				    		load_afiliaciones_recomendadas(1);
        						} 
        						
        				    					    

        					}); 


        				        $( "#desde" ).focus(function() {
        						  $("#mensaje_desde").fadeOut("slow");
        					    });
        						
        				        $( "#hasta" ).focus(function() {
          						  $("#mensaje_hasta").fadeOut("slow");
          					    });
        						


        		   
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
            	
		        setTimeout($.unblockUI, 1000); 
		        
        	   }

        	   
        	   function load_afiliaciones_recomendadas(pagina){


        		   var search=$("#search").val();
        		   var desde=$("#desde").val();
        		   var hasta=$("#hasta").val();
                   var con_datos={
           					  action:'ajax',
           					  page:pagina,
           					  desde:desde,
           					  hasta:hasta
           					  };
                 $("#load_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=ServiciosOnline&action=search&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#afiliaciones_recomendadas_registrados").html(x);
           	               	 $("#tabla_afiliaciones_recomendadas").tablesorter(); 
           	                 $("#load_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#afiliaciones_recomendadas_registrados").html("Ocurrio un error al cargar la informacion de afiliaciones recomendadas..."+estado+"    "+error);
           	              }
           	            });


           		   }
        </script>
        
        
    

	
  </body>
</html>   