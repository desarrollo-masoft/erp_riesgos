
<?php 


$controladores=$_SESSION['controladores'];
 function getcontrolador($controlador,$controladores){
 	$display="display:none";
 	
 	if (!empty($controladores))
 	{
 	foreach ($controladores as $res)
 	{
 		if($res->nombre_controladores==$controlador)
 		{
 			$display= "display:block";
 			break;
 			
 		}
 	}
 	}
 	
 	return $display;
 }
 
?>



   <ul class="sidebar-menu" data-widget="tree">
       <li class="header">MAIN NAVIGATION</li>
	   
       
        <li class="treeview"  style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>"  >
          <a href="#">
            <i class="glyphicon glyphicon-user"></i> <span>Sistemas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="treeview"  style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>"  >
                  <a href="#">
                    <i class="fa fa-folder-open-o"></i> <span>Administración</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    
                <li style="<?php echo getcontrolador("Usuarios",$controladores) ?>"><a href="index.php?controller=Usuarios&action=index"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li style="<?php echo getcontrolador("Controladores",$controladores) ?>"><a href="index.php?controller=Controladores&action=index"><i class="fa fa-circle-o"></i> Controladores</a></li>
                <li style="<?php echo getcontrolador("Roles",$controladores) ?>"><a href="index.php?controller=Roles&action=index"><i class="fa fa-circle-o"></i> Roles de Usuario</a></li>
                <li style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>"><a href="index.php?controller=PermisosRoles&action=index"><i class="fa fa-circle-o"></i> Permisos Roles</a></li>
                <li style="<?php echo getcontrolador("Privilegios",$controladores) ?>"><a href="index.php?controller=Privilegios&action=index"><i class="fa fa-circle-o"></i> Privilegios</a></li>
                <li style="<?php echo getcontrolador("Estados",$controladores) ?>"><a href="index.php?controller=Estados&action=index"><i class="fa fa-circle-o"></i>Estados</a></li>
         
              
                  </ul>
                </li>
             
      	 	</ul>
      	</li>
      
      	
      	<li class="treeview"  style="<?php echo getcontrolador("MenuRiesgos",$controladores) ?>"  >

          <a href="#">

            <i class="glyphicon glyphicon-th-list"></i> <span>Riesgos</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

             <li class="treeview"  style="<?php echo getcontrolador("AdministracionRiesgos",$controladores) ?>"  >

              <a href="#">

                <i class="fa fa-folder-open-o"></i> <span>Administración</span>

                <span class="pull-right-container">

                  <i class="fa fa-angle-left pull-right"></i>

                </span>

              </a>

              <ul class="treeview-menu">
				
					<li style="<?php echo getcontrolador("IngresoB17",$controladores) ?>"><a href="index.php?controller=IngresoB17&action=index"><i class="fa fa-circle-o"></i> Ingresar Balances (B17)</a></li>
					
          	  </ul>

            </li>

            

            

            <li class="treeview"  style="<?php echo getcontrolador("ProcesosRiesgos",$controladores) ?>"  >

              <a href="#">

                <i class="fa fa-folder-open-o"></i> <span>Procesos</span>

                <span class="pull-right-container">

                  <i class="fa fa-angle-left pull-right"></i>



                </span>

              </a>

              <ul class="treeview-menu">

              	 
             </ul>

            </li>

        

        <li class="treeview"  style="<?php echo getcontrolador("ReportesRiesgos",$controladores) ?>"  >

          <a href="#">

            <i class="fa fa-folder-open-o"></i> <span>Reportes</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu">

           <li style="<?php echo getcontrolador("Riesgos",$controladores) ?>"><a href="index.php?controller=Riesgos&action=indexCalificacion"><i class="fa fa-circle-o"></i> Calificaciones</a></li>

		  </ul>

        </li>

       </ul>

      </li>
      	
        
 
      

    </ul>
    