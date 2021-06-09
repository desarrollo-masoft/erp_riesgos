    <!DOCTYPE HTML>
	<html lang="es">
    <head>
        
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro de Balances (B17)</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
    <?php include("view/modulos/links_css.php"); ?>		
     <link rel="stylesheet" href="view/bootstrap/plugins/iCheck/all.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  	 <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
   <style type="text/css">
    .form-control {
        border-radius: 5px; !important;
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
     
         
   </style>
 
	</head>
 
    <body class="hold-transition skin-blue fixed sidebar-mini">

              
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
        <li class="active">Registro de Balances (B17)</li>
      </ol>
     </section>
     
     <section class="content">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h4 class="text-info">  Ingreso de Balances (B17) </h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
        
        
        
        	<div class="row">
          
	          
	         <div class="col-md-4 col-lg-4 col-xs-12">
	         	<div class="form-group">
	         		<label for="id_tipo_procesos" class="control-label">Proceso:</label>
                    <select name="id_tipo_procesos" id="id_tipo_procesos"   class="form-control" >
                        <option value="0" selected="selected">--Seleccione--</option>
                        <option value="1" >Nuevo</option>
                        <option value="2" >Actualizar</option>                       					       
					 </select> 
	         	</div>
	         </div>
	         
	         <div class="col-md-4 col-lg-4 col-xs-12">
	         	<div class="form-group">
	         		<label for="anio_procesos" class="control-label">AÑO :</label>
	         		<input type="number" id="anio_procesos" name="anio_procesos" min="2000" max="<?php echo date('Y'); ?>" value="<?php echo date('Y'); ?>" class="form-control">
                    </div>
	         </div>
	         <div class="col-md-4 col-lg-4 col-xs-12">
	         	<div class="form-group">
	         		<label for="mes_procesos" class="control-label">MES :</label>
                    <select name="mes_procesos" id="mes_procesos"   class="form-control" >                    	
                      	<?php for ( $i=1; $i<=count($meses); $i++){ ?>
                      	<?php if( $i == date('n')){ ?>
                      	<option value="<?php echo $i;?>" selected ><?php echo $meses[$i-1]; ?></option>
                      	<?php }else{?>
                      	<option value="<?php echo $i;?>" ><?php echo $meses[$i-1]; ?></option>
                      	<?php }}?>
					 </select> 
	         	</div>
	         </div>
	      </div>
        
        
                    
            
                	
        	
        	<div class="row">
        	        	
        		<div class=" col-xs-12 col-md-12 col-lg-12 ">
        			<div class="pull-right">
        				
        				<button type="button" id="btn_ingresa_inversiones" value="valor"  class="btn btn-success" onclick="fn_insertar_saldos_bancarios()">
        				<i class="fa fa-sign-in text-success" aria-hidden="true"></i> Ingreso Saldo Bancario
        				</button>
    					        			
        			</div>
    				
				</div>
				<div class="clearfix"></div>	
				        	
        	</div>
        	
        	
        	
        	
        
        </div>
      </div>
     </section>
     
     <section class="content">
      <div class="box box-success">
        <div class="box-header with-border">
          <h4 class="text-info"> Listado Inversiones </h4>  
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        
        <div class="box-body">
        
        	<div class="row">
     			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            		<div id="div_inversiones" class="letrasize11">
                    <!--                 		display compact -->
                    <!--  table tablesorter table-striped table-bordered nowrap -->
                		<table id="tblinversiones" class="table table-bordered display compact">
                			<thead>
                			
            
                				<tr class="info">
                					<th>#</th>
                    				<th>Tipo Identificaci&oacute;n</th>
                    				<th>Identificaci&oacute;n</th>
                    				<th>Nombre Emisor</th>
                    				<th>Tipo Cuenta</th>
                    				<th>Numero Cuenta</th>
                    				<th>Cuenta Contable</th>
                    				<th>Denominacion Moneda</th>
                    				<th>Valor Moneda</th>
                    				<th>Valor Libros</th> 
                    				<th>Calificacion</th>
                    				<th>Calificador Riesgos</th>
                    				<th>Fecha Ult. Calif.</th>
                    				<th>Tasa Interes</th>
                    				<th>Fecha Corte</th>
                    				<th>Opciones</th> 
                				</tr>                    				
                			</thead>  
                			<tbody>
                				
                			</tbody>                  			
                			<tfoot>
                				
                			</tfoot>
                		</table>
            		</div>
     			</div>
     		</div>
             		
        </div>
        
       </div>
      </section>
     
	 </div>
	
	 </div>
 
 
 
 <!-- para modales -->
 
 
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
     
   
    <?php include("view/modulos/links_js.php"); ?>
    <script src="view/bootstrap/plugins/iCheck/icheck.js"></script>
    <script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>    
    <script src="view/inversiones/js/saldos_bancarios_mensuales.js?0.31"></script> 
    
    
   

	
 </body>
</html>