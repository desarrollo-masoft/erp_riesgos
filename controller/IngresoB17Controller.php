<?php
class IngresoB17Controller extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}
	
	public function index(){
	    
	    session_start();
	    
	    if (isset(  $_SESSION['usuario_usuarios']) )
	    {
	        
	        $b17_cabeza = new B17CabezaModel();
	        //$resultTipCom = $tipo_comprobante->getAll("nombre_tipo_comprobantes");
	        
	        
	        
	        $nombre_controladores = "IngresoB17";
	        $id_rol= $_SESSION['id_rol'];
	        $resultPer = $b17_cabeza->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	        
	        
	        
	        if (!empty($resultPer))
	        {
	            
	            $this->view_RiesgosAdministracion("IngresoB17",array(
	                "resultTipCom"=>"" , "resultFormaPago"=>"", "resultTipoComprobantes"=>""
	            ));
	            
	            
	        }else{
	            	            
	            $this->view("Error",array(
	                "resultado"=>"No tiene Permisos de Generar Comprobantes"
	                
	                
	            ));
	            exit();
	        }	        
	        
	    }
	    else
	    {
	        
	        $this->redirect("Usuarios","sesion_caducada");
	    }
	    
	}
	
	
	

	
}
?>