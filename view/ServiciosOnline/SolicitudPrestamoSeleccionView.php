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
        <li class="active">Solicitud Prestamo</li>
      </ol>
    </section>
    

  
		
    <section class="content">
		<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Solicitud Prestamo</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
           
            <div class="box-body"> 
           
          <form  action="<?php echo $helper->url("SolicitudPrestamo","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
           
             <div class="col-lg-6 col-md-6 col-xs-12">
             <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-user'></i> Deudor</h4>
	         </div>
	         <div class="panel-body">
			 
			  <div class="row">
			           
			           <?php if(!empty($error_deudor)) { if($error_deudor=='Permitir'){?>
			  					
			  					
			  			  <center><img src="view/images/deudor.jpg" class="img-rounded" alt="Cinque Terre" style="text-align:center;  width: 50%;"/></center> 
         	
			  					
			  					
                         <div class="col-lg-12 col-md-12 col-xs-12 " style="text-align: center; margin-top: 30px">
				  		 <a href="index.php?controller=SolicitudPrestamo&action=index&solicitud=d" class="btn btn-success" ><i class="glyphicon glyphicon-edit"></i> Generar</a>
				  		 </div>		
				  		 
				  		 	
                    	<?php }else{?>	
                    	
                    	<p style="text-align: center;"><strong>Estimado participe usted ya cuenta con una solicitud de préstamo generada.</strong></p>
                    	
                    	 <center><img src="view/images/deudor.jpg" class="img-rounded" alt="Cinque Terre" style="text-align:center;  width: 50%;"/></center> 
         
                    	
                    	 <div class="col-lg-12 col-md-12 col-xs-12 " style="text-align: center; margin-top: 30px">
				  		 <a href="javascript:void(0);" class="btn btn-success" disabled><i class="glyphicon glyphicon-edit"></i> Generar</a>
				  		 </div>	
                    	
                    	
                    	<?php }}?>
         	  </div>
         	  
         	  </div>
  			  </div>
  			  </div>
           
           
           
             <div class="col-lg-6 col-md-6 col-xs-12">
  			 <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-user'></i> Garante</h4>
	         </div>
	         <div class="panel-body">
			 
			  <div class="row">
			  
			  			
			  			
			  			 <?php if(!empty($error_garante)) { if($error_garante=='Permitir'){?>
			  				
			  		     <center><img src="view/images/garante.jpg" class="img-rounded" alt="Cinque Terre" style="text-align:center;  width: 50%;"/></center> 
         
			  					
                         <div class="col-lg-12 col-md-12 col-xs-12 " style="text-align: center; margin-top: 10px">
				  		 <a href="index.php?controller=SolicitudPrestamo&action=index&solicitud=g" class="btn btn-success" ><i class="glyphicon glyphicon-edit"></i> Generar</a>
				  		 </div>		
				  		 
				  		 	
                    	<?php }else{?>	
                    	
                    	<p style="text-align: center;"><strong>Estimado participe usted ya cuenta con una solicitud de garantía generada.</strong></p>
                    	
                    	 <center><img src="view/images/garante.jpg" class="img-rounded" alt="Cinque Terre" style="text-align:center;  width: 50%;"/></center> 
         
                    	
                    	 <div class="col-lg-12 col-md-12 col-xs-12 " style="text-align: center; margin-top: 10px">
				  		 <a href="javascript:void(0);" class="btn btn-success" disabled><i class="glyphicon glyphicon-edit"></i> Generar</a>
				  		 </div>	
                    	
                    	
                    	<?php }}?>
			  			
			  					
                      
         	  </div>
         	  
         	  </div>
  			  </div>
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
	<script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>   
    <script src="view/Administracion/js/AnalisisFinanciero.js?0.3"></script>       
	
  </body>
</html> 