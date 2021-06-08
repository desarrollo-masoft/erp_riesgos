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
            <li class="active">Solicitud Afiliaciones</li>
          </ol>
        </section>






           <section class="content">
           <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
       
           <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><b>CONSULTA SOLICITUDES AFILIACIÓN</b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
         
             
                      
                                        <div id="div_listado_solicitudes" class="letrasize11">
                                	
                                    		<table id="tbl_listado_solicitudes" class="table table-striped table-bordered">
                                    			<thead>
                                    				<tr class="danger">
                                        				<th>Cedula</th>
                                        				<th>Apellidos</th>
                                        				<th>Nombres</th>
														<th>Celular</th>
                                        				<th>Correo</th>
                                        				<th>Dirección</th>
														<th>Coordinación</th>
                                        				<th>Fecha Registro</th>
                                        				<th>Opciones</th>
                                        			</tr>                    				
                                    			</thead>                    			
                                    			<tfoot>
                                    				<tr>
                                    				</tr>
                                    			</tfoot>
                                    		</table>
                                		</div>
                    </div>
                  </div>
                </div>
              
            </div>
            </section>
            




   
  </div>
 
 
 
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
  <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="view/bootstrap/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="view/bootstrap/bower_components/jquery-ui-1.12.1/jquery-ui.js"></script> 
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
   
    <script src="view/ServiciosOnline/js/ConsultaNuevaAfiliacionOnline.js?0.02"></script>       
  
	
  </body>
</html>
