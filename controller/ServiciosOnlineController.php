<?php
class ServiciosOnlineController extends ControladorBase{
  
    
    
    public function index(){
        
        session_start();

        if(isset($_SESSION["id_usuarios"])){
            
            $this->view_ServiciosOnline("ServiciosOnline",array(
                ""=>""
                
            ));
        }
        else{
          
            $this->redirect("Usuarios","Loguear");
        }
        
    }
    
    public function Bienvenida(){
        
        session_start();
        
        if(isset($_SESSION['id_usuarios']))
        {
            $_usuario=$_SESSION['nombre_usuarios'];
            $_id_rol=$_SESSION['id_rol'];
            
            if($_id_rol==1){
                
                
                $this->view_Administracion("BienvenidaAdmin",array(
                    "allusers"=>$_usuario
                ));
                
                die();
                
            }elseif($_id_rol==2){
                
						    $usuarios = new UsuariosModel();
	        
							$resultEdit = "";
							$resultRol = "";
							$resEstado="";
							$_id_usuario = $_SESSION['id_usuarios'];
							
							
							$columnas = "usuarios.id_usuarios,
										usuarios.cedula_usuarios,
										usuarios.nombre_usuarios,
										usuarios.apellidos_usuarios,
										usuarios.telefono_usuarios,
										usuarios.celular_usuarios,
										usuarios.correo_usuarios,
										claves.clave_n_claves,
										claves.caduca_claves,
										usuarios.fotografia_usuarios,
										usuarios.creado,
										usuarios.fecha_nacimiento_usuarios,
										usuarios.usuario_usuarios,
										eusuarios.nombre_estado,
										usuarios.id_estado,
										rol.id_rol,
										rol.nombre_rol";
							
							$tablas = "public.usuarios
										INNER JOIN public.claves ON usuarios.id_usuarios = claves.id_usuarios
										LEFT JOIN public.rol ON usuarios.id_rol = rol.id_rol
										INNER JOIN public.estado ON estado.id_estado = claves.id_estado
										AND estado.tabla_estado = 'CLAVES' AND estado.nombre_estado='ACTIVO'
										INNER JOIN public.estado eusuarios ON eusuarios.id_estado = usuarios.id_estado";
							
							$id       = "usuarios.id_usuarios";
							
							$where    = " usuarios.id_usuarios = '$_id_usuario' ";
							$resultEdit = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id); 
							
							if(!empty($resultEdit)){
								
								
								$_id_rol	   =$resultEdit[0]->id_rol;
								$_id_estado	   =$resultEdit[0]->id_estado;
								
								$rol=new RolesModel();
								$resultRol = $rol->getCondiciones('*','rol',"id_rol='$_id_rol'",'nombre_rol');
								
								$resEstado = array();
								$resEstado = $usuarios->getCondiciones('*','estado',"tabla_estado='USUARIOS' and id_estado='$_id_estado'",'id_estado');
								
								$entidad = new EntidadPatronalParticipesModel();
								$resultEnt= $entidad->getAll("nombre_entidad_patronal");
									
								$cordinacion = new CordinacionesModel();
								$resultCor= $cordinacion->getAll("nombre_entidad_patronal_coordinaciones");
								
								$genero = new GeneroParticipesModel();
								$resultGen= $genero->getAll("nombre_genero_participes");
									
								$estado_civil = new EstadoCivilParticipesModel();
								$resultCivil= $estado_civil->getBy("id_estado_civil_participes not in (7,6)");
								
								
								
								
							}
				
				
                $this->view_ServiciosOnline("BienvenidaOnline",array(
                    "resultEdit" =>$resultEdit, "resultRol"=>$resultRol, "resEstado"=>$resEstado,
					"resultEnt"=>$resultEnt, "resultCor"=>$resultCor,
					"resultGen"=>$resultGen, "resultCivil"=>$resultCivil
                ));
                
                die();
                
            }else{
                
                $this->view_Administracion("Bienvenida",array(
                    "allusers"=>$_usuario
                ));
                
                die();
            }
            
            
        }else{
            
            $this->redirect("Usuarios","sesion_caducada");
            
        }
    }
    
    public function cargarDatos(){
        
        session_start();
        $usuarios = new UsuariosModel();
        
        
        if(isset($_SESSION["id_usuarios"])){
            
            $id_usuarios = $_SESSION["id_usuarios"];
            $cedula_usuarios = $_SESSION["cedula_usuarios"];
            
            $query = "
                    select age(fecha_nacimiento_participes) as fecha_nacimiento_encontrada,
                    date(fecha_nacimiento_participes) as fecha_nacimiento_participes, b.nombre_estado_participes, a.celular_participes, a.correo_participes,
                    a.cedula_participes, a.nombre_participes
                    from core_participes a
                    inner join core_estado_participes b on a.id_estado_participes=b.id_estado_participes
                    where cedula_participes='$cedula_usuarios' and a.id_estatus=1";
            $resultado  = $usuarios->enviaquery($query);
            
             
            $query1 = "select to_char(b.creado, 'yyyy-mm-dd HH24:MI:SS') as creado from usuarios a
                    inner join sesiones b on a.id_usuarios=b.id_usuarios
                    where a.id_usuarios='$id_usuarios' 
                    order by b.id_sesiones desc limit 2";
            $resultado1  = $usuarios->enviaquery($query1);
            
            
            if(!empty($resultado)){
                
                
                $edad = $this->CalcularEdad($resultado[0]->fecha_nacimiento_participes, date("Y-m-d"));
                $años = explode(",", $edad);
                $años = $años[0];
                
                $meses = explode(",", $edad);
                $meses = $meses[1];
                
                $dias = explode(",", $edad);
                $dias = $dias[2];
                
                
                
                $data = array(['años' => $años, 'meses' => $meses, 'dias' => $dias, 'edad'=>$edad]);
                
            }else{
                
                $data = array(['años' => "", 'meses' => "", 'dias' => "", 'edad'=>""]);
            }
            
           
            
            
            
            echo json_encode(array('participes'=>$resultado, 'usuarios'=>$resultado1, 'fecha'=>$data));
            
        }
        
    }
    
    
    public function CalcularEdad($date_1, $date_2, $differenceFormat = '%y Años, %m Meses, %d Dias')
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        
        $interval = date_diff($datetime1, $datetime2);
        
        return $interval->format($differenceFormat);
    }
    
    
     
    
    public function dtCargarCreditos(){
        
        if( !isset( $_SESSION ) ){
            session_start();
        }
        
        try{
            
            ob_start();
            
            $usuarios = new UsuariosModel();
            $cedula_usuarios = $_SESSION["cedula_usuarios"];
            
            
            //dato que viene de parte del plugin DataTable
            $requestData = $_REQUEST;
            $searchDataTable   = $requestData['search']['value'];
            
            
            $columnas1 = " a.id_creditos, a.numero_creditos, a.monto_otorgado_creditos, a.fecha_concesion_creditos, a.plazo_creditos, c.nombre_tipo_creditos,
                        ( select max(aa.fecha_tabla_amortizacion) as fecha_tabla_amortizacion from core_tabla_amortizacion aa where aa.id_creditos=a.id_creditos and aa.id_estatus=1) as fecha_finalizacion,
                        ( select sum(cc.saldo_cuota_tabla_amortizacion_pagos) from core_tabla_amortizacion bb 
                        inner join core_tabla_amortizacion_pagos cc on bb.id_tabla_amortizacion=cc.id_tabla_amortizacion
                        inner join core_tabla_amortizacion_parametrizacion dd on cc.id_tabla_amortizacion_parametrizacion=dd.id_tabla_amortizacion_parametrizacion
                        where bb.id_estatus=1 and cc.id_estatus=1 and bb.id_creditos=a.id_creditos and dd.tipo_tabla_amortizacion_parametrizacion=0) as saldo_capital";
            $tablas1   = " core_creditos a 
                        inner join core_participes b on a.id_participes=b.id_participes
                        inner join core_tipo_creditos c on a.id_tipo_creditos=c.id_tipo_creditos";
            $where1    = " b.id_estatus=1 and a.id_estatus=1 and a.id_estado_creditos=4
                        and b.cedula_participes='$cedula_usuarios'";
            
            $id        = "a.numero_creditos";
            
            
            if( strlen( $searchDataTable ) > 0 ){
                
                $where1    .= " AND a.numero_creditos ILIKE  '%".$searchDataTable."%' ";
                
                
            }
            
            $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
            $cantidadBusqueda = (int)$rsCantidad[0]->total;
            
            /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
            
            // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
            $columns = array(
                0 => 'numero_creditos',
                1 => 'nombre_tipo_creditos',
                2 => 'monto_otorgado_creditos',
                3 => 'saldo_capital',
                4 => 'plazo_creditos',
                5 => 'fecha_concesion_creditos',
                6 => 'fecha_finalizacion',
                7 => 'opciones'
                
              
                
            );
            
            $orderby   = $columns[$requestData['order'][0]['column']];
            $orderdir  = $requestData['order'][0]['dir'];
            $orderdir  = strtoupper($orderdir);
            /**PAGINACION QUE VIEN DESDE DATATABLE**/
            $per_page  = $requestData['length'];
            $offset    = $requestData['start'];
            
            //para validar que consulte todos
            $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
            
            $limit = " ORDER BY $id LIMIT $per_page OFFSET '$offset'";
            
            $resultSet = $usuarios->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
            
            //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
            $sql = "";
            //$cantidadBusquedaFiltrada = sizeof($resultSet);
            
            /** crear el array data que contiene columnas en plugins **/
            $data = array();
            $dataFila = array();
            
            
            foreach ( $resultSet as $res){
                
                $opciones="";
                $opciones = '<div class="pull-right ">
                              <span >
                                <a onclick="mostrar_detalle_modal_creditos(this)" id="" data-id_creditos="'.$res->id_creditos.'" href="#" class=" no-padding btn btn-sm btn-default" data-toggle="tooltip" data-placement="right" title="Ver Detalle"> <i class="fa  fa-file-text-o fa-2x fa-fw" aria-hidden="true" ></i>
	                           </a>
                            </span>
                            </div>';
                
                
                $dataFila['numero']       = $res->numero_creditos;
                $dataFila['nombre'] = $res->nombre_tipo_creditos;
                $dataFila['valor']       = number_format($res->monto_otorgado_creditos, 2, ",", ".");
                $dataFila['saldo']        = number_format($res->saldo_capital, 2, ",", ".");
                $dataFila['plazo']         = $res->plazo_creditos.' meses';
                $dataFila['fec_con']        = $res->fecha_concesion_creditos;
                $dataFila['fec_final']        = $res->fecha_finalizacion;
                $dataFila['opciones'] = $opciones;
                
                
                $data[] = $dataFila;
                
                
            }
            
            
            $salida = ob_get_clean();
            
            if( !empty($salida) )
                throw new Exception($salida);
                
                $json_data = array(
                    "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                    "recordsTotal" => intval($cantidadBusqueda),  // total number of records
                    "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data" => $data,   // total data array
                    "sql" => $sql
                );
                
        } catch (Exception $e) {
            
            $json_data = array(
                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "recordsTotal" => intval("0"),  // total number of records
                "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => array(),   // total data array
                "sql" => "",
                "buffer" => error_get_last(),
                "ERRORDATATABLE" => $e->getMessage()
            );
        }
        
        
        echo json_encode($json_data);
        
        
        
    }
    
    
    
    public function dtMostrarDetallesCreditosModal(){
        
        
        
        if( !isset( $_SESSION ) ){
            session_start();
        }
        
        try{
            
            ob_start();
            
            $usuarios = new UsuariosModel();
            
            
            //dato que viene de parte del plugin DataTable
            $requestData = $_REQUEST;
            $searchDataTable   = $requestData['search']['value'];
            $id_creditos =  (isset($_REQUEST['id_creditos'])&& $_REQUEST['id_creditos'] !=NULL)?$_REQUEST['id_creditos']:'';
            
            
            $columnas1 = " core_creditos.id_creditos,
                      core_tabla_amortizacion.fecha_tabla_amortizacion,
                      core_tabla_amortizacion.capital_tabla_amortizacion,
                      core_tabla_amortizacion.interes_tabla_amortizacion,
                      core_tabla_amortizacion.total_valor_tabla_amortizacion,
                      core_tabla_amortizacion.mora_tabla_amortizacion,
                      core_tabla_amortizacion.balance_tabla_amortizacion,
                      core_tabla_amortizacion.id_estado_tabla_amortizacion,
                      core_tabla_amortizacion.numero_pago_tabla_amortizacion,
                      core_tabla_amortizacion.total_balance_tabla_amortizacion,
                      core_estado_tabla_amortizacion.nombre_estado_tabla_amortizacion,
                      core_tabla_amortizacion.total_valor_tabla_amortizacion,
                      (select sum(c1.capital_tabla_amortizacion)
                      from core_tabla_amortizacion c1 where id_creditos = '$id_creditos' and id_estatus=1 limit 1
                      ) as \"totalcapital\",
                      (select sum(c1.interes_tabla_amortizacion)
                      from core_tabla_amortizacion c1 where id_creditos = '$id_creditos' and id_estatus=1 limit 1
                      ) as \"totalintereses\",
                      (select COALESCE(SUM (r1.valor_pago_tabla_amortizacion_pagos),0)
						from core_tabla_amortizacion_pagos r1
						INNER JOIN core_tabla_amortizacion_parametrizacion p ON r1.id_tabla_amortizacion_parametrizacion = p.id_tabla_amortizacion_parametrizacion
						inner join core_tabla_amortizacion aa on aa.id_tabla_amortizacion=r1.id_tabla_amortizacion
						where p.tipo_tabla_amortizacion_parametrizacion = 8 and aa.id_estatus=1 and aa.id_creditos ='$id_creditos'
					  ) as \"totalseguro\",
                      (select sum(c1.total_valor_tabla_amortizacion)
                      from core_tabla_amortizacion c1 where id_creditos = '$id_creditos' and id_estatus=1 limit 1
                      ) as \"totalcuota\",
                      (select sum(c1.mora_tabla_amortizacion)
                      from core_tabla_amortizacion c1 where id_creditos = '$id_creditos' and id_estatus=1 limit 1
                      ) as \"totalmora\",
                                   (
	                    select COALESCE(SUM (r.valor_pago_tabla_amortizacion_pagos),0)
						from core_tabla_amortizacion_pagos r INNER JOIN core_tabla_amortizacion_parametrizacion p ON r.id_tabla_amortizacion_parametrizacion = p.id_tabla_amortizacion_parametrizacion
						where r.id_tabla_amortizacion = core_tabla_amortizacion.id_tabla_amortizacion AND p.tipo_tabla_amortizacion_parametrizacion = 8) as seguro_desgravamen_final,
            	    (
            	    select COALESCE(SUM (r.saldo_cuota_tabla_amortizacion_pagos),0)
            	    from core_tabla_amortizacion_pagos r 
                     INNER JOIN core_tabla_amortizacion_parametrizacion p ON r.id_tabla_amortizacion_parametrizacion = p.id_tabla_amortizacion_parametrizacion
            	    where r.id_tabla_amortizacion = core_tabla_amortizacion.id_tabla_amortizacion) as saldo_final";
            
            
            $tablas1 = "   public.core_creditos,
                      public.core_tabla_amortizacion,
                      public.core_estado_tabla_amortizacion";
            $where1= "   core_tabla_amortizacion.id_creditos = core_creditos.id_creditos AND
                    core_estado_tabla_amortizacion.id_estado_tabla_amortizacion = core_tabla_amortizacion.id_estado_tabla_amortizacion
                    AND core_creditos.id_creditos ='$id_creditos' AND core_tabla_amortizacion.id_estatus=1";
           // $id="core_tabla_amortizacion.numero_pago_tabla_amortizacion";
            
            
            
            if( strlen( $searchDataTable ) > 0 ){
                
                $where1    .= " AND core_estado_tabla_amortizacion.nombre_estado_tabla_amortizacion ILIKE  '%".$searchDataTable."%' ";
                
                
            }
            
            $rsCantidad    = $usuarios->getCantidad("*", $tablas1, $where1);
            $cantidadBusqueda = (int)$rsCantidad[0]->total;
            
            /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
            
            // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
            $columns = array(
                0 => 'numero_pago_tabla_amortizacion',
                1 => 'fecha_tabla_amortizacion',
                2 => 'capital_tabla_amortizacion',
                3 => 'interes_tabla_amortizacion',
                4 => 'seguro_desgravamen_final',
                5 => 'mora_tabla_amortizacion',
                6 => 'total_valor_tabla_amortizacion',
                7 => 'saldo_final',
                8 => 'balance_tabla_amortizacion',
                9 => 'nombre_estado_tabla_amortizacion'
                
                
                
            );
            
            $orderby   = $columns[$requestData['order'][0]['column']];
            $orderdir  = $requestData['order'][0]['dir'];
            $orderdir  = strtoupper($orderdir);
            /**PAGINACION QUE VIEN DESDE DATATABLE**/
            $per_page  = $requestData['length'];
            $offset    = $requestData['start'];
            
            //para validar que consulte todos
            $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
            
            $limit = " ORDER BY $orderby $orderdir LIMIT $per_page OFFSET '$offset'";
            
            $resultSet = $usuarios->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
            
            //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
            $sql = "";
            //$cantidadBusquedaFiltrada = sizeof($resultSet);
            
            /** crear el array data que contiene columnas en plugins **/
            $data = array();
            $dataFila = array();
            
            $capital =0;
            $interes=0;
            $seguro=0;
            $mora=0;
            $total=0;
            $saldo=0;
            $balance=0;
            
            foreach ( $resultSet as $res){
               
                $capital =$capital+$res->capital_tabla_amortizacion;
                $interes=$interes+$res->interes_tabla_amortizacion;
                $seguro=$seguro+$res->seguro_desgravamen_final;
                $mora=$mora+$res->mora_tabla_amortizacion;
                $total=$total+$res->total_valor_tabla_amortizacion;
                $saldo=$saldo+$res->saldo_final;
                $balance=$balance+$res->balance_tabla_amortizacion;
                
            
                
                $opciones="";
                if($res->id_estado_tabla_amortizacion==1){$opciones = '<span class="badge bg-yellow" style="font-size: 12px;">'.$res->nombre_estado_tabla_amortizacion.'</span>';}
                if($res->id_estado_tabla_amortizacion==2){$opciones = '<span class="badge bg-light-blue" style="font-size: 12px;">'.$res->nombre_estado_tabla_amortizacion.'</span>';}
                if($res->id_estado_tabla_amortizacion==3){$opciones = '<span class="badge bg-green" style="font-size: 12px;">'.$res->nombre_estado_tabla_amortizacion.'</span>';}
                
                
               
                
                $dataFila['numero_pago']       = $res->numero_pago_tabla_amortizacion;
                $dataFila['fecha']        = $res->fecha_tabla_amortizacion;
                $dataFila['capital']       = number_format($res->capital_tabla_amortizacion, 2, ",", ".");
                $dataFila['interes']        = number_format($res->interes_tabla_amortizacion, 2, ",", ".");
                $dataFila['seguro']         = number_format($res->seguro_desgravamen_final, 2, ",", ".");
                $dataFila['mora']        = number_format($res->mora_tabla_amortizacion, 2, ",", ".");
                $dataFila['total']        = number_format($res->total_valor_tabla_amortizacion, 2, ",", ".");
                $dataFila['saldo']        = number_format($res->saldo_final, 2, ",", ".");
                $dataFila['balance']        = number_format($res->balance_tabla_amortizacion, 2, ",", ".");
                $dataFila['estado']        = $opciones;
                
                $data[] = $dataFila;
                
                
            }
            
            $totales = array();
            $totales['total_capital']      = number_format($capital, 2, ",", ".");
            $totales['total_interes']      = number_format($interes, 2, ",", ".");
            $totales['total_seguro']      = number_format($seguro, 2, ",", ".");
            $totales['total_mora']      = number_format($mora, 2, ",", ".");
            $totales['total_total']      = number_format($total, 2, ",", ".");
            $totales['total_saldo']      = number_format($saldo, 2, ",", ".");
            $totales['total_balance']      = number_format($balance, 2, ",", ".");
            
            
            $salida = ob_get_clean();
            
            if( !empty($salida) )
                throw new Exception($salida);
                
                $json_data = array(
                    "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                    "recordsTotal" => intval($cantidadBusqueda),  // total number of records
                    "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data" => $data,   // total data array
                    "sql" => $sql,
                    "totales" =>$totales
                );
                
        } catch (Exception $e) {
            
            $json_data = array(
                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "recordsTotal" => intval("0"),  // total number of records
                "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => array(),   // total data array
                "sql" => "",
                "buffer" => error_get_last(),
                "ERRORDATATABLE" => $e->getMessage()
            );
        }
        
        
        echo json_encode($json_data);
        
        
        
        
    }
    
    
    
    
    public function dtCargarCuentaIndividual() {
        
        
        if( !isset( $_SESSION ) ){
            session_start();
        }
        
        try{
            
            ob_start();
            
            $usuarios = new UsuariosModel();
            $cedula_usuarios = $_SESSION["cedula_usuarios"];
            
            
            //dato que viene de parte del plugin DataTable
            $requestData = $_REQUEST;
            $searchDataTable   = $requestData['search']['value'];
            
            
            $columnas1 = " c.id_participes, coalesce(sum(c.valor_personal_contribucion+c.valor_patronal_contribucion),0) as valor_personal,
                		( select to_char(max(c2.fecha_registro_contribucion), 'YYYY-MM-DD') from core_contribucion c2 where c2.id_estatus=1 and c2.id_estado_contribucion=1 and c2.id_participes=c.id_participes and c2.id_contribucion_tipo=1) as fecha_ultimo_aporte";
            $tablas1   = " core_contribucion c
                    		inner join core_contribucion_tipo t on c.id_contribucion_tipo=t.id_contribucion_tipo
                    		inner join core_participes p on c.id_participes=p.id_participes";
            $where1    = " c.id_estatus=1 and c.id_estado_contribucion=1 and c.id_contribucion_tipo not in (11)
			                and c.id_contribucion_tipo_trans not in (25)
                    		and p.id_estatus=1 and p.cedula_participes='$cedula_usuarios'
                    		group by c.id_participes";
                            
            $id        = "c.id_participes";
            
            
            if( strlen( $searchDataTable ) > 0 ){
                
                //$where1    .= " AND core_estado_tabla_amortizacion.nombre_estado_tabla_amortizacion ILIKE  '%".$searchDataTable."%' ";
                
                
            }
           
            /*
            $rsCantidad    = $usuarios->getCantidad('*', $tablas1, $where1);
            $cantidadBusqueda = (int)$rsCantidad[0]->total;
            */
            
            $rsCantidad    = 1;
            $cantidadBusqueda = (int)$rsCantidad;
            
            
            /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
            
            // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
            $columns = array(
                0 => 'fecha_ultimo_aporte',
                1 => 'valor_personal'
               
                
            );
            
            $orderby   = $columns[$requestData['order'][0]['column']];
            $orderdir  = $requestData['order'][0]['dir'];
            $orderdir  = strtoupper($orderdir);
            /**PAGINACION QUE VIEN DESDE DATATABLE**/
            $per_page  = $requestData['length'];
            $offset    = $requestData['start'];
            
            //para validar que consulte todos
            $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
            
            $limit = " ORDER BY $orderby $orderdir LIMIT $per_page OFFSET '$offset'";
            
            $resultSet = $usuarios->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
            
            //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
            $sql = "";
            //$cantidadBusquedaFiltrada = sizeof($resultSet);
            
            /** crear el array data que contiene columnas en plugins **/
            $data = array();
            $dataFila = array();
            
            
            foreach ( $resultSet as $res){
                
                $opciones="";
                $opciones = '<div class="pull-right ">
                              <span >
                                <a onclick="mostrar_detalle_modal_cuenta_individual(this)" id="" data-id_participes="'.$res->id_participes.'" href="#" class=" no-padding btn btn-sm btn-default" data-toggle="tooltip" data-placement="right" title="Ver Detalle"> <i class="fa  fa-file-text-o fa-2x fa-fw" aria-hidden="true" ></i>
	                           </a>
                            </span>
                            </div>';
                
                $dataFila['fecha']       = $res->fecha_ultimo_aporte;
                $dataFila['valor_personal'] = number_format($res->valor_personal, 2, ",", ".");
                $dataFila['opciones'] = $opciones;
                
                $data[] = $dataFila;
                
               
            }
            
            
            $salida = ob_get_clean();
            
            if( !empty($salida) )
                throw new Exception($salida);
                
                $json_data = array(
                    "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                    "recordsTotal" => intval($cantidadBusqueda),  // total number of records
                    "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data" => $data,   // total data array
                    "sql" => $sql
                );
                
        } catch (Exception $e) {
            
            $json_data = array(
                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "recordsTotal" => intval("0"),  // total number of records
                "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => array(),   // total data array
                "sql" => "",
                "buffer" => error_get_last(),
                "ERRORDATATABLE" => $e->getMessage()
            );
        }
        
        
        echo json_encode($json_data);
        
        
        
        
    }
    
    
    
    
    
    public function dtMostrarDetallesCuentaIndividualModal(){
        
        if( !isset( $_SESSION ) ){
            session_start();
        }
        
        try {
            ob_start();
            
            $contribucion = new CoreContribucionModel();
            
            //dato que viene de parte del plugin DataTable
            $requestData = $_REQUEST;
            $searchDataTable   = $requestData['search']['value'];
            
            
            $condicion_id_contribucion_tipo="";
            
            $id_participes =  (isset($_POST['id_participes'])&& $_POST['id_participes'] !=NULL)?$_POST['id_participes']:0;
            $id_contribucion_tipo  =  (isset($_POST['id_contribucion_tipo'])&& $_POST['id_contribucion_tipo'] !=NULL)?$_POST['id_contribucion_tipo']:0;
            
            
            
            
            //$id_entidad_patronal = $_POST['id_entidad_patronal'];
            
            if($id_contribucion_tipo<>0){
                
                $condicion_id_contribucion_tipo = " and c1.id_contribucion_tipo = '$id_contribucion_tipo'";
                
            }
            
            $columnas1 = " aa.anio,
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 1 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"enero\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 2 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"febrero\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 3 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"marzo\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 4 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"abril\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 5 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"mayo\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 6 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"junio\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 7 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"julio\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 8 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"agosto\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 9 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"septiembre\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 10 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"octubre\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 11 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"noviembre\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 12 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"diciembre\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"acumulado\",
                
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 and c1.id_contribucion_tipo not in (11) and c1.id_contribucion_tipo_trans not in (25) limit 1
                ) as \"total\"
";
            $tablas1   = "(select to_char(fecha_registro_contribucion,'YYYY') as anio
                	from core_contribucion
                	where id_participes = '$id_participes' and id_contribucion_tipo not in (11) and id_contribucion_tipo_trans not in (25)
                	group by to_char(fecha_registro_contribucion,'YYYY')
                	order by to_char(fecha_registro_contribucion,'YYYY')
                	) aa";
            $where1    = " 1=1 ";
            
            /* PARA FILTROS DE CONSULTA */
            
            /*if( strlen( $searchDataTable ) > 0 )
             {
             $where1 .= " AND ( ";
             $where1 .= " bb.nombre_entidad_patronal ILIKE '%$searchDataTable%' ";
             $where1 .= " OR TO_CHAR(aa.year_descuentos_registrados_cabeza,'9999') ilike '%$searchDataTable%' ";
             $where1 .= " ) ";
             
             }*/
            
            
            $rsCantidad    = $contribucion->getCantidad("*", $tablas1, $where1);
            $cantidadBusqueda = (int)$rsCantidad[0]->total;
            
            /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
            
            // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
            $columns = array(
                0 => '1',
                1 => '1',
                2 => '1',
                3 => '1',
                4 => '1',
                5 => '1',
                6 => '1',
                7 => '1',
                8 => '1',
                9 => '1',
                10 => '1',
                11 => '1',
                12 => '1',
                13 => '1',
                14 => '1'
            );
            
            $orderby   = $columns[$requestData['order'][0]['column']];
            $orderdir  = $requestData['order'][0]['dir'];
            $orderdir  = strtoupper($orderdir);
            /**PAGINACION QUE VIEN DESDE DATATABLE**/
            $per_page  = $requestData['length'];
            $offset    = $requestData['start'];
            
            //para validar que consulte todos
            $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
            
            $limit = " ORDER BY $orderby $orderdir LIMIT   $per_page OFFSET '$offset'";
            
            //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
            $sql = "";
            
            $resultSet=$contribucion->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
            
            /** crear el array data que contiene columnas en plugins **/
            $data = array();
            $dataFila = array();
            
            foreach ( $resultSet as $res){
                
                $valor_total = number_format($res->total, 2, ",", ".");
                
                $dataFila['anio'] = $res->anio;
                $dataFila['enero'] = number_format($res->enero, 2, ",", ".");
                $dataFila['febrero']  = number_format($res->febrero, 2, ",", ".");
                $dataFila['marzo'] = number_format($res->marzo, 2, ",", ".");
                $dataFila['abril']  = number_format($res->abril, 2, ",", ".");
                $dataFila['mayo'] = number_format($res->mayo, 2, ",", ".");
                $dataFila['junio']  = number_format($res->junio, 2, ",", ".");
                $dataFila['julio'] = number_format($res->julio, 2, ",", ".");
                $dataFila['agosto']  = number_format($res->agosto, 2, ",", ".");
                $dataFila['septiembre'] = number_format($res->septiembre, 2, ",", ".");
                $dataFila['octubre']  = number_format($res->octubre, 2, ",", ".");
                $dataFila['noviembre'] = number_format($res->noviembre, 2, ",", ".");
                $dataFila['diciembre']  = number_format($res->diciembre, 2, ",", ".");
                $dataFila['acumulado']  = number_format($res->acumulado, 2, ",", ".");
                $dataFila['total']  = number_format($res->total, 2, ",", ".");
                
                $data[] = $dataFila;
            }
            
            $totales = array();
            $totales['total']      = $valor_total;
            
            
            
            $salida = ob_get_clean();
            
            if( !empty($salida) )
                throw new Exception($salida);
                
                $json_data = array(
                    "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                    "recordsTotal" => intval($cantidadBusqueda),  // total number of records
                    "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data" => $data,   // total data array
                    "sql" => $sql,
                    "totales" => $totales 
                );
                
        } catch (Exception $e) {
            
            $json_data = array(
                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "recordsTotal" => intval("0"),  // total number of records
                "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => array(),   // total data array
                "sql" => $sql,
                "buffer" => error_get_last(),
                "ERRORDATATABLE" => $e->getMessage()
            );
        }
        
        
        echo json_encode($json_data);
        
    }
    
    
    public function getcontribucion_tipo(){
        
        $contribucion_tipo = null;
        $contribucion_tipo = new ContribucionTipoModel();
        
        $id_participes =  (isset($_POST['id_participes'])&& $_POST['id_participes'] !=NULL)?$_POST['id_participes']:0;
        
        
        $query = "select a.id_contribucion_tipo, b.nombre_contribucion_tipo from core_contribucion a
                inner join core_contribucion_tipo b on a.id_contribucion_tipo=b.id_contribucion_tipo
                where a.id_participes='$id_participes' and a.id_estatus=1 and a.id_estado_contribucion=1
				and a.id_contribucion_tipo not in (11) and a.id_contribucion_tipo_trans not in (25)
                group by a.id_contribucion_tipo, b.nombre_contribucion_tipo";
        
        $resulset = $contribucion_tipo->enviaquery($query);
        
        if(!empty($resulset) && count($resulset)>0){
            
            echo json_encode(array('data'=>$resulset));
        }
    }
    
    
    public function getcontribucion_tipo_patronales(){
        
        $contribucion_tipo = null;
        $contribucion_tipo = new ContribucionTipoModel();
        
        $id_participes =  (isset($_POST['id_participes'])&& $_POST['id_participes'] !=NULL)?$_POST['id_participes']:0;
        
        
        $query = "select a.id_contribucion_tipo, b.nombre_contribucion_tipo from core_contribucion_pagada a
                inner join core_contribucion_tipo b on a.id_contribucion_tipo=b.id_contribucion_tipo
                where a.id_participes='$id_participes' and a.id_estatus=1 and a.id_estado_contribucion=1
				and a.id_contribucion_tipo not in (11) and a.id_contribucion_tipo_trans not in (25)
                group by a.id_contribucion_tipo, b.nombre_contribucion_tipo";
        
        $resulset = $contribucion_tipo->enviaquery($query);
        
        if(!empty($resulset) && count($resulset)>0){
            
            echo json_encode(array('data'=>$resulset));
        }
    }
    
    
    
    public function reporte_cuenta_individual(){
        session_start();
        $entidades = new EntidadesModel();
        //PARA OBTENER DATOS DE LA EMPRESA
        $datos_empresa = array();
        $rsdatosEmpresa = $entidades->getBy("id_entidades = 1");
        
        if(!empty($rsdatosEmpresa) && count($rsdatosEmpresa)>0){
            //llenar nombres con variables que va en html de reporte
            $datos_empresa['NOMBREEMPRESA']=$rsdatosEmpresa[0]->nombre_entidades;
            $datos_empresa['DIRECCIONEMPRESA']=$rsdatosEmpresa[0]->direccion_entidades;
            $datos_empresa['TELEFONOEMPRESA']=$rsdatosEmpresa[0]->telefono_entidades;
            $datos_empresa['RUCEMPRESA']=$rsdatosEmpresa[0]->ruc_entidades;
            $datos_empresa['FECHAEMPRESA']=date('Y-m-d H:i');
            $datos_empresa['USUARIOEMPRESA']=(isset($_SESSION['usuario_usuarios']))?$_SESSION['usuario_usuarios']:'';
        }
        
        //NOTICE DATA
        $datos_cabecera = array();
        $datos_cabecera['USUARIO'] = (isset($_SESSION['nombre_usuarios'])) ? $_SESSION['nombre_usuarios'] : 'N/D';
        $datos_cabecera['FECHA'] = date('Y/m/d');
        $datos_cabecera['HORA'] = date('h:i:s');
        
        $contribucion = new CoreContribucionModel();
        
        
        $condicion_id_contribucion_tipo="";
        $where_to="";
        
        
        
        
        
        
        $id_participes =  (isset($_REQUEST['id_participes'])&& $_REQUEST['id_participes'] !=NULL)?$_REQUEST['id_participes']:0;
        $id_contribucion_tipo  =  (isset($_REQUEST['id_contribucion_tipo'])&& $_REQUEST['id_contribucion_tipo'] !=NULL)?$_REQUEST['id_contribucion_tipo']:0;
        
        
        if($id_contribucion_tipo==0){
            
            $condicion_id_contribucion_tipo="";
            
        }else{
            
            
            $condicion_id_contribucion_tipo=" and c1.id_contribucion_tipo = '$id_contribucion_tipo'";
        }
        
        
        
        
        
        
        
        //////retencion detalle
        $columnas = " aa.anio,
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 1 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"enero\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 2 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"febrero\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 3 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"marzo\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 4 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"abril\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 5 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"mayo\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 6 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"junio\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 7 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"julio\",
                (select coalesce(sum(c1.valor_personal_contribucion  + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 8 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"agosto\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 9 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"septiembre\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 10 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"octubre\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 11 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"noviembre\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion) = 12 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"diciembre\",
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where to_char(c1.fecha_registro_contribucion,'YYYY') = aa.anio
                	 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"acumulado\",
                
                (select coalesce(sum(c1.valor_personal_contribucion + c1.valor_patronal_contribucion),0)
                	from core_contribucion c1 where id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"total\"
";
        $tablas   = "(select to_char(fecha_registro_contribucion,'YYYY') as anio
                	from core_contribucion
                	where id_participes = '$id_participes'
                	group by to_char(fecha_registro_contribucion,'YYYY')
                	order by to_char(fecha_registro_contribucion,'YYYY')
                	) aa";
        $where    = " 1=1 ";
        $id="aa.anio";
        $resultSetDetalle = $contribucion->getCondiciones($columnas, $tablas, $where, $id);
        
        
        
        
        $html='';
        
        
        $html.= '<table class="1">';
        
        $html.= "<tr>";
        
        $html.='<th style="text-align: center;  font-size: 12px;">Año</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Enero</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Febrero</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Marzo</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Abril</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Mayo</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Junio</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Julio</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Agosto</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Septiembre</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Octubre</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Noviembre</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Diciembre</th>';
        $html.='<th style="text-align: center;  font-size: 12px;">Acumulado</th>';
        
        
        
        $html.='</tr>';
        
        
        $i=0;
        
        foreach ($resultSetDetalle as $res)
        {
            
            
            $i++;
            $html.='<tr>';
            $html.='<td style="font-size: 10px;"align="center">'.$res->anio.'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->enero, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->febrero, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->marzo, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->abril, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->mayo, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->junio, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->julio, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->agosto, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->septiembre, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->octubre, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->noviembre, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->diciembre, 2, ",", ".").'</td>';
            $html.='<td style="font-size: 10px;"align="right">'.number_format($res->acumulado, 2, ",", ".").'</td>';
            
            
            
            
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        
        
        $datos_reporte['DETALLE_APORTES_PERSONALES']= $html;
        
        
        
        
        
        $this->verReporte("DetalleAportesPersonales", array('datos_empresa'=>$datos_empresa, 'datos_cabecera'=>$datos_cabecera, 'datos_reporte'=>$datos_reporte));
        
        
    }
    
    
    
    
    
    
    
    public function dtCargarCuentaDesembolsar() {
        
        
        if( !isset( $_SESSION ) ){
            session_start();
        }
        
        try{
            
            ob_start();
            
            $usuarios = new UsuariosModel();
            $cedula_usuarios = $_SESSION["cedula_usuarios"];
            
            
            //dato que viene de parte del plugin DataTable
            $requestData = $_REQUEST;
            $searchDataTable   = $requestData['search']['value'];
            
            
            $columnas1 = " c.id_participes, coalesce(sum(c.valor_personal_contribucion_pagada+c.valor_patronal_contribucion_pagada),0) as valor_personal,
                		( select coalesce(sum(c1.valor_personal_contribucion_pagada+c1.valor_patronal_contribucion_pagada),0) as valor_patronal
                			from core_contribucion_pagada c1
                			inner join core_contribucion_tipo t on c1.id_contribucion_tipo=t.id_contribucion_tipo
                			where c1.id_estatus=1 and c1.id_estado_contribucion=1
                			and c1.id_participes=c.id_participes
                			and t.id_contribucion_categoria=1
                	    ) as valor_patronal,
                
                	    ( select (coalesce(sum(c1.valor_personal_contribucion_pagada+c1.valor_patronal_contribucion_pagada),0)*-0.02)
                			from core_contribucion_pagada c1
                			inner join core_contribucion_tipo t on c1.id_contribucion_tipo=t.id_contribucion_tipo
                			where c1.id_estatus=1 and c1.id_estado_contribucion=1
                			and c1.id_participes=c.id_participes
                			and t.id_contribucion_tipo=49
                	    )as valor_2xciento_retencion_superavit_patronal,
                        ( select to_char(max(c2.fecha_registro_contribucion_pagada), 'YYYY-MM-DD') from core_contribucion_pagada c2 where c2.id_estatus=1 and c2.id_estado_contribucion=1 and c2.id_participes=c.id_participes and c2.id_contribucion_tipo=1) as fecha_ultimo_aporte
                        ";
            $tablas1   = " core_contribucion_pagada c
                    		inner join core_contribucion_tipo t on c.id_contribucion_tipo=t.id_contribucion_tipo
                    		inner join core_participes p on c.id_participes=p.id_participes";
            $where1    = " c.id_estatus=1 and c.id_estado_contribucion=1
                    		and p.id_estatus=1 and p.cedula_participes='$cedula_usuarios'
                    		and t.id_contribucion_categoria=2
                    		group by c.id_participes";
            
            $id        = "c.id_participes";
            
            
            if( strlen( $searchDataTable ) > 0 ){
                
                //$where1    .= " AND core_estado_tabla_amortizacion.nombre_estado_tabla_amortizacion ILIKE  '%".$searchDataTable."%' ";
                
                
            }
            
            /*
             $rsCantidad    = $usuarios->getCantidad('*', $tablas1, $where1);
             $cantidadBusqueda = (int)$rsCantidad[0]->total;
             */
            
            $rsCantidad    = 1;
            $cantidadBusqueda = (int)$rsCantidad;
            
            
            /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
            
            // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
            $columns = array(
                0 => 'fecha_ultimo_aporte',
                1 => 'valor_personal',
                2 => 'valor_patronal'
                
                
            );
            
            $orderby   = $columns[$requestData['order'][0]['column']];
            $orderdir  = $requestData['order'][0]['dir'];
            $orderdir  = strtoupper($orderdir);
            /**PAGINACION QUE VIEN DESDE DATATABLE**/
            $per_page  = $requestData['length'];
            $offset    = $requestData['start'];
            
            //para validar que consulte todos
            $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
            
            $limit = " ORDER BY $orderby $orderdir LIMIT $per_page OFFSET '$offset'";
            
            $resultSet = $usuarios->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
            
            //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
            $sql = "";
            //$cantidadBusquedaFiltrada = sizeof($resultSet);
            
            /** crear el array data que contiene columnas en plugins **/
            $data = array();
            $dataFila = array();
            
            
            foreach ( $resultSet as $res){
                
                $opciones="";
                $opciones = '<div class="pull-right ">
                              <span >
                                <a onclick="mostrar_detalle_modal_cuenta_desembolsar(this)" id="" data-id_participes="'.$res->id_participes.'" href="#" class=" no-padding btn btn-sm btn-default" data-toggle="tooltip" data-placement="right" title="Ver Detalle"> <i class="fa  fa-file-text-o fa-2x fa-fw" aria-hidden="true" ></i>
	                           </a>
                            </span>
                            </div>';
                
                $dataFila['fecha']       = $res->fecha_ultimo_aporte;
                $dataFila['valor_personal'] = number_format($res->valor_personal, 2, ",", ".");
                $dataFila['valor_patronal']       = number_format($res->valor_patronal, 2, ",", ".");
                $dataFila['saldo']        = number_format($res->valor_personal + $res->valor_patronal, 2, ",", ".");
                $dataFila['retencion']         = number_format($res->valor_2xciento_retencion_superavit_patronal, 2, ",", ".");
                $dataFila['total']        = number_format(($res->valor_personal + $res->valor_patronal) - (abs($res->valor_2xciento_retencion_superavit_patronal)), 2, ",", ".");
                $dataFila['opciones'] = $opciones;
                
                $data[] = $dataFila;
                
                
            }
            
            
            $salida = ob_get_clean();
            
            if( !empty($salida) )
                throw new Exception($salida);
                
                $json_data = array(
                    "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                    "recordsTotal" => intval($cantidadBusqueda),  // total number of records
                    "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data" => $data,   // total data array
                    "sql" => $sql
                );
                
        } catch (Exception $e) {
            
            $json_data = array(
                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "recordsTotal" => intval("0"),  // total number of records
                "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => array(),   // total data array
                "sql" => "",
                "buffer" => error_get_last(),
                "ERRORDATATABLE" => $e->getMessage()
            );
        }
        
        
        echo json_encode($json_data);
        
        
        
        
    }
    
    
    
    
    
    public function dtMostrarDetallesCuentaDesembolsarModal(){
        
        if( !isset( $_SESSION ) ){
            session_start();
        }
        
        try {
            ob_start();
            
            $contribucion = new CoreContribucionModel();
            
            //dato que viene de parte del plugin DataTable
            $requestData = $_REQUEST;
            $searchDataTable   = $requestData['search']['value'];
            
            
            $condicion_id_contribucion_tipo="";
            
            $id_participes =  (isset($_POST['id_participes'])&& $_POST['id_participes'] !=NULL)?$_POST['id_participes']:0;
            $id_contribucion_tipo  =  (isset($_POST['id_contribucion_tipo'])&& $_POST['id_contribucion_tipo'] !=NULL)?$_POST['id_contribucion_tipo']:0;
            
            
            
            
            //$id_entidad_patronal = $_POST['id_entidad_patronal'];
            
            if($id_contribucion_tipo<>0){
                
                $condicion_id_contribucion_tipo = " and c1.id_contribucion_tipo = '$id_contribucion_tipo'";
                
            }
            
            $columnas1 = " aa.anio,
                (select coalesce(sum(c1.valor_personal_contribucion_pagada + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 1 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"enero\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 2 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"febrero\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 3 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"marzo\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada  + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 4 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"abril\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada  + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 5 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"mayo\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada  + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 6 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"junio\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada  + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 7 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"julio\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada  + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 8 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"agosto\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 9 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"septiembre\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 10 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"octubre\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 11 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"noviembre\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	and extract(month from c1.fecha_registro_contribucion_pagada) = 12 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"diciembre\",
                (select coalesce(sum(c1.valor_personal_contribucion_pagada + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where to_char(c1.fecha_registro_contribucion_pagada,'YYYY') = aa.anio
                	 and id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"acumulado\",
                
                (select coalesce(sum(c1.valor_personal_contribucion_pagada + c1.valor_patronal_contribucion_pagada),0)
                	from core_contribucion_pagada c1 where id_participes = '$id_participes' $condicion_id_contribucion_tipo and id_estatus=1 limit 1
                ) as \"total\"
";
            $tablas1   = "(select to_char(fecha_registro_contribucion_pagada,'YYYY') as anio
                	from core_contribucion_pagada
                	where id_participes = '$id_participes'
                	group by to_char(fecha_registro_contribucion_pagada,'YYYY')
                	order by to_char(fecha_registro_contribucion_pagada,'YYYY')
                	) aa";
            $where1    = " 1=1 ";
            
            /* PARA FILTROS DE CONSULTA */
            
            /*if( strlen( $searchDataTable ) > 0 )
             {
             $where1 .= " AND ( ";
             $where1 .= " bb.nombre_entidad_patronal ILIKE '%$searchDataTable%' ";
             $where1 .= " OR TO_CHAR(aa.year_descuentos_registrados_cabeza,'9999') ilike '%$searchDataTable%' ";
             $where1 .= " ) ";
             
             }*/
            
            
            $rsCantidad    = $contribucion->getCantidad("*", $tablas1, $where1);
            $cantidadBusqueda = (int)$rsCantidad[0]->total;
            
            /**PARA ORDENAMIENTO Y  LIMITACIONES DE DATATABLE **/
            
            // datatable column index  => database column name estas columas deben en el mismo orden que defines la cabecera de la tabla
            $columns = array(
                0 => '1',
                1 => '1',
                2 => '1',
                3 => '1',
                4 => '1',
                5 => '1',
                6 => '1',
                7 => '1',
                8 => '1',
                9 => '1',
                10 => '1',
                11 => '1',
                12 => '1',
                13 => '1',
                14 => '1'
            );
            
            $orderby   = $columns[$requestData['order'][0]['column']];
            $orderdir  = $requestData['order'][0]['dir'];
            $orderdir  = strtoupper($orderdir);
            /**PAGINACION QUE VIEN DESDE DATATABLE**/
            $per_page  = $requestData['length'];
            $offset    = $requestData['start'];
            
            //para validar que consulte todos
            $per_page  = ( $per_page == "-1" ) ? "ALL" : $per_page;
            
            $limit = " ORDER BY $orderby $orderdir LIMIT   $per_page OFFSET '$offset'";
            
            //$sql = " SELECT $columnas1 FROM $tablas1 WHERE $where1  $limit ";
            $sql = "";
            
            $resultSet=$contribucion->getCondicionesSinOrden($columnas1, $tablas1, $where1, $limit);
            
            /** crear el array data que contiene columnas en plugins **/
            $data = array();
            $dataFila = array();
            
            foreach ( $resultSet as $res){
                
                $valor_total = number_format($res->total, 2, ",", ".");
                
                $dataFila['anio'] = $res->anio;
                $dataFila['enero'] = number_format($res->enero, 2, ",", ".");
                $dataFila['febrero']  = number_format($res->febrero, 2, ",", ".");
                $dataFila['marzo'] = number_format($res->marzo, 2, ",", ".");
                $dataFila['abril']  = number_format($res->abril, 2, ",", ".");
                $dataFila['mayo'] = number_format($res->mayo, 2, ",", ".");
                $dataFila['junio']  = number_format($res->junio, 2, ",", ".");
                $dataFila['julio'] = number_format($res->julio, 2, ",", ".");
                $dataFila['agosto']  = number_format($res->agosto, 2, ",", ".");
                $dataFila['septiembre'] = number_format($res->septiembre, 2, ",", ".");
                $dataFila['octubre']  = number_format($res->octubre, 2, ",", ".");
                $dataFila['noviembre'] = number_format($res->noviembre, 2, ",", ".");
                $dataFila['diciembre']  = number_format($res->diciembre, 2, ",", ".");
                $dataFila['acumulado']  = number_format($res->acumulado, 2, ",", ".");
                $dataFila['total']  = number_format($res->total, 2, ",", ".");
                
                $data[] = $dataFila;
            }
            
            $totales = array();
            $totales['total']      = $valor_total;
            
            
            
            $salida = ob_get_clean();
            
            if( !empty($salida) )
                throw new Exception($salida);
                
                $json_data = array(
                    "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                    "recordsTotal" => intval($cantidadBusqueda),  // total number of records
                    "recordsFiltered" => intval($cantidadBusqueda), // total number of records after searching, if there is no searching then totalFiltered = totalData
                    "data" => $data,   // total data array
                    "sql" => $sql,
                    "totales" => $totales
                );
                
        } catch (Exception $e) {
            
            $json_data = array(
                "draw" => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
                "recordsTotal" => intval("0"),  // total number of records
                "recordsFiltered" => intval("0"), // total number of records after searching, if there is no searching then totalFiltered = totalData
                "data" => array(),   // total data array
                "sql" => $sql,
                "buffer" => error_get_last(),
                "ERRORDATATABLE" => $e->getMessage()
            );
        }
        
        
        echo json_encode($json_data);
        
    }
    
    
    
    
    
    
    /////////////////////////////MAYCOL PARA MIGRAR USUARIOS DE LA WEB CAPREMCI///////////////////////////////////////
    
    public function migrar_usuarios_web_capremci(){
        
    $usuarios=new UsuariosModel();
        
    require_once 'core/DB_Functions.php';
    $db = new DB_Functions();
    
    $columnas = "id_usuarios, cedula_usuarios, clave_usuarios, pass_sistemas_usuarios, telefono_usuarios, celular_usuarios, correo_usuarios, fotografia_usuarios";
    $tablas   = "usuarios";
    $where    = "id_rol=41 order by id_usuarios asc";
    
        
    $resultSet=$db->getCondiciones($columnas, $tablas, $where);
        
    if(!empty($resultSet)){
        
        foreach ($resultSet as $res){
        
            $_cedula_usuarios     =$res->cedula_usuarios;
            
            $_clave_usuarios    =$res->clave_usuarios;
            $_clave_n_usuarios  =$res->pass_sistemas_usuarios;
            
            $_id_rol_principal  =2;
            $_id_usuarios         =$res->id_usuarios;
            
            $imagen_usuarios    =$res->fotografia_usuarios;
            
            $_caduca_clave  =0;
            $_cambiar_clave =1;
           
            $clave_fecha_hoy = date("Y-m-d");
            $clave_fecha_siguiente_mes = date("Y-m-d",strtotime($clave_fecha_hoy."+ 5 year"));
            
            
            $resultUsu=$usuarios->getCondiciones("id_usuarios", "usuarios", "cedula_usuarios='$_cedula_usuarios'", "id_usuarios");
            
            if(!empty($resultUsu)){
                
                $_cambiar_clave=0;
            }
            
            $resultPart=$usuarios->getCondiciones("rtrim(ltrim(nombre_participes)) as nombre_participes, rtrim(ltrim(apellido_participes)) as apellido_participes, fecha_nacimiento_participes, correo_participes, telefono_participes, celular_participes, id_estado_participes", "core_participes", "cedula_participes='$_cedula_usuarios' and id_estatus=1", "cedula_participes");
            
            if(!empty($resultPart)){
            
                
                $_nombre_usuarios       					       =$resultPart[0]->nombre_participes;
                $_apellidos_usuario       				   =$resultPart[0]->apellido_participes;
                $_fecha_nacimiento_usuarios       					       =$resultPart[0]->fecha_nacimiento_participes;
                $_telefono_usuarios       				   =$resultPart[0]->telefono_participes;
                $_celular_usuarios       					       =$resultPart[0]->celular_participes;
                $_correo_usuarios       				   =$resultPart[0]->correo_participes;
                $_id_estado_participes       				   =$resultPart[0]->id_estado_participes;
                
                $_nombre_usuarios1 = explode(" ", $_nombre_usuarios);
                $_apellidos_usuario1 = explode(" ", $_apellidos_usuario);
                $_usuario_usuarios = $_nombre_usuarios1[0].' '.$_apellidos_usuario1[0];
                
                
                if($_id_estado_participes==5){
                    
                    $_id_estado =2;
                    
                }else{
                
                    $_id_estado =1;
                }
                
                
                $funcion = "ins_usuarios_migracion_web_capremci";
                $parametros = "'$_id_usuarios', '$_cedula_usuarios',
    		    				   '$_nombre_usuarios',
                                   '$_apellidos_usuario',
                                   '$_correo_usuarios',
                                   '$_celular_usuarios',
    		    	               '$_telefono_usuarios',
    		    	               '$_fecha_nacimiento_usuarios',
    		    	               '$_usuario_usuarios',
    		    	               '$_id_estado',
    		    	               '$imagen_usuarios',
                                   '$_id_rol_principal',
                                   '$_clave_usuarios',
                                   '$_clave_n_usuarios',
                                   '$clave_fecha_hoy',
                                   '$clave_fecha_siguiente_mes',
                                   '$_caduca_clave',
                                   '$_cambiar_clave'";
                $usuarios->setFuncion($funcion);
                $usuarios->setParametros($parametros);
                
                
                $resultado=$usuarios->llamafuncion();
                
                
                
                
            }
            
            
           
           
           
            
           
            
        }
        
    }
    
    
    
    
    }
    
    
    
    
    
    
    public function migrar_codigos_verificacion(){
        
        $usuarios=new UsuariosModel();
        
        require_once 'core/DB_Functions.php';
        $db = new DB_Functions();
        
        
        
        $columnas = "b.cedula_usuarios, a.id_codigo_verificacion, a.id_usuarios, a.numero_codigo_verificacion, a.validado_codigo_verificacion, to_char(a.creado, 'YYYY-MM-DD') AS creado,  to_char(a.modificado, 'YYYY-MM-DD') AS modificado, a.numero_celular_solicitante";
        $tablas   = "codigo_verificacion a inner join usuarios b on a.id_usuarios=b.id_usuarios";
        $where    = "1=1 order by a.id_codigo_verificacion asc";
        
        
        $resultSet=$db->getCondiciones($columnas, $tablas, $where);
        
        if(!empty($resultSet)){
            
            foreach ($resultSet as $res){
                
                $_cedula_usuarios     =$res->cedula_usuarios;
                $creado =$res->creado;
                $creado = (!empty($creado) && $creado !="") ? $creado : 'null';
                $creado = ( $creado == 'null' ) ? $creado : "'".$creado."'";
                
                $modificado =$res->modificado;
                $modificado = (!empty($modificado) && $modificado !="") ? $modificado : 'null';
                $modificado = ( $modificado == 'null' ) ? $modificado : "'".$modificado."'";
                
                
                $resultUsu=$usuarios->getCondiciones("id_usuarios", "usuarios", "cedula_usuarios='$_cedula_usuarios'", "id_usuarios");
                
                if(!empty($resultUsu)){
                    
                  
                    
                    $id_usuarios =$resultUsu[0]->id_usuarios;
                   
                    $query = "INSERT INTO core_codigo_verificacion (id_codigo_verificacion, id_usuarios, numero_codigo_verificacion, validado_codigo_verificacion, creado, modificado, numero_celular_solicitante)
                            VALUES ('$res->id_codigo_verificacion','$id_usuarios','$res->numero_codigo_verificacion', '$res->validado_codigo_verificacion', $creado, $modificado, '$res->numero_celular_solicitante')";
                    $resultado  = $usuarios->enviaquery($query);
                    
                    
                }
                
               
                                
            }
            
            
        }
        
        
    }
    
    
    
    
    public function migrar_solicitud_prestamo(){
        
        $usuarios=new UsuariosModel();
        
        require_once 'core/DB_Functions.php';
        $db = new DB_Functions();
        
        
        
        $columnas = "a.id_solicitud_prestamo, a.tipo_participe_datos_prestamo, a.monto_datos_prestamo, 
a.plazo_datos_prestamo, a.destino_dinero_datos_prestamo, a.tipo_cuenta_cuenta_bancaria, a.numero_cuenta_cuenta_bancaria, 
a.numero_cedula_datos_personales, a.apellidos_solicitante_datos_personales, a.nombres_solicitante_datos_personales, 
a.correo_solicitante_datos_personales, a.id_sexo_datos_personales, 
a.fecha_nacimiento_datos_personales, a.id_estado_civil_datos_personales, 
a.separacion_bienes_datos_personales, a.cargas_familiares_datos_personales, a.numero_hijos_datos_personales, 
a.nivel_educativo_datos_personales, a.id_provincias_vivienda, a.id_cantones_vivienda, a.id_parroquias_vivienda, 
a.barrio_sector_vivienda, a.ciudadela_conjunto_etapa_manzana_vivienda, a.calle_vivienda, a.numero_calle_vivienda,
a.intersecion_vivienda, a.tipo_vivienda, a.vivienda_hipotecada_vivienda, a.tiempo_residencia_vivienda, 
a.nombre_propietario_vivienda, a.celular_propietario_vivienda, a.referencia_direccion_domicilio_vivienda, 
a.numero_casa_solicitante, a.numero_celular_solicitante, a.numero_trabajo_solicitante, a.extension_solicitante, 
a.mode_solicitante, a.apellidos_referencia_personal, a.nombres_referencia_personal, a.relacion_referencia_personal, a.numero_telefonico_referencia_personal, a.apellidos_referencia_familiar, a.nombres_referencia_familiar, a.parentesco_referencia_familiar, a.numero_telefonico_referencia_familiar, a.id_entidades, a.id_provincias_asignacion,
a.id_cantones_asignacion, a.id_parroquias_asignacion, a.numero_telefonico_datos_laborales, a.interseccion_datos_laborales,
a.calle_datos_laborales, a.cargo_actual_datos_laborales, a.sueldo_total_info_economica, 
a.cuota_prestamo_ordinario_info_economica, a.arriendos_info_economica, a.cuota_prestamo_emergente_info_economica, 
a.honorarios_profesionales_info_economica, a.cuota_otros_prestamos_info_economica, 
a.comisiones_info_economica, a.cuota_prestamo_iess_info_economica, a.horas_suplementarias_info_economica, 
a.arriendos_egre_info_economica, a.alimentacion_info_economica, a.otros_ingresos_1_info_economica, 
a.valor_ingresos_1_info_economica, a.estudios_info_economica, a.otros_ingresos_2_info_economica, 
a.valor_ingresos_2_info_economica, a.pago_servicios_basicos_info_economica, a.otros_ingresos_3_info_economica, 
a.valor_ingresos_3_info_economica, a.pago_tarjetas_credito_info_economica, a.otros_ingresos_4_info_economica, 
a.valor_ingresos_4_info_economica, a.afiliacion_cooperativas_info_economica, a.otros_ingresos_5_info_economica, 
a.valor_ingresos_5_info_economica, a.ahorro_info_economica, a.otros_ingresos_6_info_economica, 
a.valor_ingresos_6_info_economica, a.impuesto_renta_info_economica, a.otros_ingresos_7_info_economica, 
a.valor_ingresos_7_info_economica, a.otros_ingresos_8_info_economica, a.valor_ingresos_8_info_economica, 
a.otros_egresos_1_info_economica, a.valor_egresos_1_info_economica, a.total_ingresos_mensuales, a.total_egresos_mensuales, 
a.numero_cedula_conyuge, a.apellidos_conyuge, a.nombres_conyuge, a.id_sexo_conyuge, a.fecha_nacimiento_conyuge, 
a.convive_afiliado_conyuge, a.numero_telefonico_conyuge, a.actividad_economica_conyuge, a.fecha_presentacion, 
a.fecha_aprobacion, a.id_usuarios_oficial_credito_aprueba, a.id_usuarios_registra, a.creado, a.modificado, a.identificador_consecutivos, a.id_tipo_creditos, a.nombre_banco_cuenta_bancaria, a.tipo_pago_cuenta_bancaria, 
a.id_estado_tramites, a.id_sucursales, a.cedula_deudor_a_garantizar, a.nombre_deudor_a_garantizar, 
a.porcentaje_aportacion, a.identificador_consecutivos_deudor, a.id_codigo_verificacion,
(select b.cedula_usuarios from usuarios b where b.id_usuarios=a.id_usuarios_oficial_credito_aprueba) as cedula_empleado,
(select c.cedula_usuarios from usuarios c where c.id_usuarios=a.id_usuarios_registra) as cedula_participe
";
        $tablas   = "solicitud_prestamo a";
        $where    = "1=1 order by a.id_solicitud_prestamo asc";
        
        
        $resultSet=$db->getCondiciones($columnas, $tablas, $where);
        
        if(!empty($resultSet)){
            
            foreach ($resultSet as $res){
                
                
                
                $id_solicitud_prestamo=$res->id_solicitud_prestamo;
                $tipo_participe_datos_prestamo=$res->tipo_participe_datos_prestamo;
                $monto_datos_prestamo=$res->monto_datos_prestamo;
                $plazo_datos_prestamo=$res->plazo_datos_prestamo;
                $destino_dinero_datos_prestamo=$res->destino_dinero_datos_prestamo;
                $tipo_cuenta_cuenta_bancaria=$res->tipo_cuenta_cuenta_bancaria;
                $numero_cuenta_cuenta_bancaria=$res->numero_cuenta_cuenta_bancaria;
                $numero_cedula_datos_personales=$res->numero_cedula_datos_personales;
                $apellidos_solicitante_datos_personales=$res->apellidos_solicitante_datos_personales;
                $nombres_solicitante_datos_personales=$res->nombres_solicitante_datos_personales;
                $correo_solicitante_datos_personales=$res->correo_solicitante_datos_personales;
                $id_sexo_datos_personales=$res->id_sexo_datos_personales;
                $fecha_nacimiento_datos_personales=$res->fecha_nacimiento_datos_personales;
                $fecha_nacimiento_datos_personales = (!empty($fecha_nacimiento_datos_personales) && $fecha_nacimiento_datos_personales !="") ? $fecha_nacimiento_datos_personales : 'null';
                $fecha_nacimiento_datos_personales = ( $fecha_nacimiento_datos_personales == 'null' ) ? $fecha_nacimiento_datos_personales : "'".$fecha_nacimiento_datos_personales."'";
                
                $id_estado_civil_datos_personales=$res->id_estado_civil_datos_personales;
                if($id_estado_civil_datos_personales==4){ $id_estado_civil_datos_personales=5;}
                if($id_estado_civil_datos_personales==5){ $id_estado_civil_datos_personales=4;}
                
                
                
                $separacion_bienes_datos_personales=$res->separacion_bienes_datos_personales;
                $cargas_familiares_datos_personales=$res->cargas_familiares_datos_personales;
                $numero_hijos_datos_personales=$res->numero_hijos_datos_personales;
                $nivel_educativo_datos_personales=$res->nivel_educativo_datos_personales;
                $id_provincias_vivienda=$res->id_provincias_vivienda;
                $id_cantones_vivienda=$res->id_cantones_vivienda;
                $id_parroquias_vivienda=$res->id_parroquias_vivienda;
                $barrio_sector_vivienda=$res->barrio_sector_vivienda;
                $ciudadela_conjunto_etapa_manzana_vivienda=$res->ciudadela_conjunto_etapa_manzana_vivienda;
                $calle_vivienda=$res->calle_vivienda;
                $numero_calle_vivienda=$res->numero_calle_vivienda;
                $intersecion_vivienda=$res->intersecion_vivienda;
                $tipo_vivienda=$res->tipo_vivienda;
                $vivienda_hipotecada_vivienda=$res->vivienda_hipotecada_vivienda;
                $tiempo_residencia_vivienda=$res->tiempo_residencia_vivienda;
                $nombre_propietario_vivienda=$res->nombre_propietario_vivienda;
                $celular_propietario_vivienda=$res->celular_propietario_vivienda;
                $referencia_direccion_domicilio_vivienda=$res->referencia_direccion_domicilio_vivienda;
                $numero_casa_solicitante=$res->numero_casa_solicitante;
                $numero_celular_solicitante=$res->numero_celular_solicitante;
                $numero_trabajo_solicitante=$res->numero_trabajo_solicitante;
                $extension_solicitante=$res->extension_solicitante;
                $mode_solicitante=$res->mode_solicitante;
                $apellidos_referencia_personal=$res->apellidos_referencia_personal;
                $nombres_referencia_personal=$res->nombres_referencia_personal;
                $relacion_referencia_personal=$res->relacion_referencia_personal;
                $numero_telefonico_referencia_personal=$res->numero_telefonico_referencia_personal;
                $apellidos_referencia_familiar=$res->apellidos_referencia_familiar;
                $nombres_referencia_familiar=$res->nombres_referencia_familiar;
                $parentesco_referencia_familiar=$res->parentesco_referencia_familiar;
                $numero_telefonico_referencia_familiar=$res->numero_telefonico_referencia_familiar;
                $id_entidades=$res->id_entidades;
                $id_provincias_asignacion=$res->id_provincias_asignacion;
                $id_cantones_asignacion=$res->id_cantones_asignacion;
                $id_parroquias_asignacion=$res->id_parroquias_asignacion;
                $numero_telefonico_datos_laborales=$res->numero_telefonico_datos_laborales;
                $interseccion_datos_laborales=$res->interseccion_datos_laborales;
                $calle_datos_laborales=$res->calle_datos_laborales;
                $cargo_actual_datos_laborales=$res->cargo_actual_datos_laborales;
                $sueldo_total_info_economica=$res->sueldo_total_info_economica;
                $cuota_prestamo_ordinario_info_economica=$res->cuota_prestamo_ordinario_info_economica;
                $arriendos_info_economica=$res->arriendos_info_economica;
                $cuota_prestamo_emergente_info_economica=$res->cuota_prestamo_emergente_info_economica;
                $honorarios_profesionales_info_economica=$res->honorarios_profesionales_info_economica;
                $cuota_otros_prestamos_info_economica=$res->cuota_otros_prestamos_info_economica;
                $comisiones_info_economica=$res->comisiones_info_economica;
                $cuota_prestamo_iess_info_economica=$res->cuota_prestamo_iess_info_economica;
                $horas_suplementarias_info_economica=$res->horas_suplementarias_info_economica;
                $arriendos_egre_info_economica=$res->arriendos_egre_info_economica;
                $alimentacion_info_economica=$res->alimentacion_info_economica;
                $otros_ingresos_1_info_economica=$res->otros_ingresos_1_info_economica;
                $valor_ingresos_1_info_economica=$res->valor_ingresos_1_info_economica;
                $estudios_info_economica=$res->estudios_info_economica;
                $otros_ingresos_2_info_economica=$res->otros_ingresos_2_info_economica;
                $valor_ingresos_2_info_economica=$res->valor_ingresos_2_info_economica;
                $pago_servicios_basicos_info_economica=$res->pago_servicios_basicos_info_economica;
                $otros_ingresos_3_info_economica=$res->otros_ingresos_3_info_economica;
                $valor_ingresos_3_info_economica=$res->valor_ingresos_3_info_economica;
                $pago_tarjetas_credito_info_economica=$res->pago_tarjetas_credito_info_economica;
                $otros_ingresos_4_info_economica=$res->otros_ingresos_4_info_economica;
                $valor_ingresos_4_info_economica=$res->valor_ingresos_4_info_economica;
                $afiliacion_cooperativas_info_economica=$res->afiliacion_cooperativas_info_economica;
                $otros_ingresos_5_info_economica=$res->otros_ingresos_5_info_economica;
                $valor_ingresos_5_info_economica=$res->valor_ingresos_5_info_economica;
                $ahorro_info_economica=$res->ahorro_info_economica;
                $otros_ingresos_6_info_economica=$res->otros_ingresos_6_info_economica;
                $valor_ingresos_6_info_economica=$res->valor_ingresos_6_info_economica;
                $impuesto_renta_info_economica=$res->impuesto_renta_info_economica;
                $otros_ingresos_7_info_economica=$res->otros_ingresos_7_info_economica;
                $valor_ingresos_7_info_economica=$res->valor_ingresos_7_info_economica;
                $otros_ingresos_8_info_economica=$res->otros_ingresos_8_info_economica;
                $valor_ingresos_8_info_economica=$res->valor_ingresos_8_info_economica;
                $otros_egresos_1_info_economica=$res->otros_egresos_1_info_economica;
                $valor_egresos_1_info_economica=$res->valor_egresos_1_info_economica;
                $total_ingresos_mensuales=$res->total_ingresos_mensuales;
                $total_egresos_mensuales=$res->total_egresos_mensuales;
                $numero_cedula_conyuge=$res->numero_cedula_conyuge;
                $apellidos_conyuge=$res->apellidos_conyuge;
                $nombres_conyuge=$res->nombres_conyuge;
                $id_sexo_conyuge=$res->id_sexo_conyuge;
                $id_sexo_conyuge = (!empty($id_sexo_conyuge) && $id_sexo_conyuge !="") ? $id_sexo_conyuge : 'null';
                $id_sexo_conyuge = ( $id_sexo_conyuge == 'null' ) ? $id_sexo_conyuge : "'".$id_sexo_conyuge."'";
                
                
                $fecha_nacimiento_conyuge=$res->fecha_nacimiento_conyuge;
                $fecha_nacimiento_conyuge = (!empty($fecha_nacimiento_conyuge) && $fecha_nacimiento_conyuge !="") ? $fecha_nacimiento_conyuge : 'null';
                $fecha_nacimiento_conyuge = ( $fecha_nacimiento_conyuge == 'null' ) ? $fecha_nacimiento_conyuge : "'".$fecha_nacimiento_conyuge."'";
                
                
                $convive_afiliado_conyuge=$res->convive_afiliado_conyuge;
                $numero_telefonico_conyuge=$res->numero_telefonico_conyuge;
                $actividad_economica_conyuge=$res->actividad_economica_conyuge;
                $fecha_presentacion=$res->fecha_presentacion;
                
                $fecha_presentacion = (!empty($fecha_presentacion) && $fecha_presentacion !="") ? $fecha_presentacion : 'null';
                $fecha_presentacion = ( $fecha_presentacion == 'null' ) ? $fecha_presentacion : "'".$fecha_presentacion."'";
                
                
                
                $fecha_aprobacion=$res->fecha_aprobacion;
                $fecha_aprobacion = (!empty($fecha_aprobacion) && $fecha_aprobacion !="") ? $fecha_aprobacion : 'null';
                $fecha_aprobacion = ( $fecha_aprobacion == 'null' ) ? $fecha_aprobacion : "'".$fecha_aprobacion."'";
                
                
                //$id_usuarios_oficial_credito_aprueba=$res->id_usuarios_oficial_credito_aprueba;
                //$id_usuarios_registra=$res->id_usuarios_registra;
                
                $cedula_empleado=$res->cedula_empleado;
                $cedula_participe=$res->cedula_participe;
                
                
                
                $resultUsu1=$usuarios->getCondiciones("id_usuarios", "usuarios", "cedula_usuarios='$cedula_empleado'", "id_usuarios");
                $id_usuarios_oficial_credito_aprueba =$resultUsu1[0]->id_usuarios;
                
                
                $resultUsu=$usuarios->getCondiciones("id_usuarios", "usuarios", "cedula_usuarios='$cedula_participe'", "id_usuarios");
                $id_usuarios_registra =$resultUsu[0]->id_usuarios;
                
                
                $creado =$res->creado;
                $creado = (!empty($creado) && $creado !="") ? $creado : 'null';
                $creado = ( $creado == 'null' ) ? $creado : "'".$creado."'";
                
                $modificado =$res->modificado;
                $modificado = (!empty($modificado) && $modificado !="") ? $modificado : 'null';
                $modificado = ( $modificado == 'null' ) ? $modificado : "'".$modificado."'";
                
                $identificador_consecutivos=$res->identificador_consecutivos;
                $id_tipo_creditos=$res->id_tipo_creditos;
                
                if($id_tipo_creditos==1){ $id_tipo_creditos=4;}
                if($id_tipo_creditos==2){ $id_tipo_creditos=2;}
                if($id_tipo_creditos==3){ $id_tipo_creditos=6;}
                
                
                $nombre_banco_cuenta_bancaria=$res->nombre_banco_cuenta_bancaria;
                $tipo_pago_cuenta_bancaria=$res->tipo_pago_cuenta_bancaria;
                $id_estado_tramites=$res->id_estado_tramites;
                $id_sucursales=$res->id_sucursales;
                $cedula_deudor_a_garantizar=$res->cedula_deudor_a_garantizar;
                $nombre_deudor_a_garantizar=$res->nombre_deudor_a_garantizar;
                $porcentaje_aportacion=$res->porcentaje_aportacion;
                $identificador_consecutivos_deudor=$res->identificador_consecutivos_deudor;
                $id_codigo_verificacion=$res->id_codigo_verificacion;
                
                
                
                    $query = "INSERT INTO solicitud_prestamo (id_solicitud_prestamo, tipo_participe_datos_prestamo, monto_datos_prestamo, plazo_datos_prestamo, destino_dinero_datos_prestamo, tipo_cuenta_cuenta_bancaria, numero_cuenta_cuenta_bancaria, numero_cedula_datos_personales, apellidos_solicitante_datos_personales, nombres_solicitante_datos_personales, correo_solicitante_datos_personales, id_sexo_datos_personales, fecha_nacimiento_datos_personales, id_estado_civil_datos_personales, separacion_bienes_datos_personales, cargas_familiares_datos_personales, numero_hijos_datos_personales, nivel_educativo_datos_personales, id_provincias_vivienda, id_cantones_vivienda, id_parroquias_vivienda, barrio_sector_vivienda, ciudadela_conjunto_etapa_manzana_vivienda, calle_vivienda, numero_calle_vivienda, intersecion_vivienda, tipo_vivienda, vivienda_hipotecada_vivienda, tiempo_residencia_vivienda, nombre_propietario_vivienda, celular_propietario_vivienda, referencia_direccion_domicilio_vivienda, numero_casa_solicitante, numero_celular_solicitante, numero_trabajo_solicitante, extension_solicitante, mode_solicitante, apellidos_referencia_personal, nombres_referencia_personal, relacion_referencia_personal, numero_telefonico_referencia_personal, apellidos_referencia_familiar, nombres_referencia_familiar, parentesco_referencia_familiar, numero_telefonico_referencia_familiar, id_entidades, id_provincias_asignacion, id_cantones_asignacion, id_parroquias_asignacion, numero_telefonico_datos_laborales, interseccion_datos_laborales, calle_datos_laborales, cargo_actual_datos_laborales, sueldo_total_info_economica, cuota_prestamo_ordinario_info_economica, arriendos_info_economica, cuota_prestamo_emergente_info_economica, honorarios_profesionales_info_economica, cuota_otros_prestamos_info_economica, comisiones_info_economica, cuota_prestamo_iess_info_economica, horas_suplementarias_info_economica, arriendos_egre_info_economica, alimentacion_info_economica, otros_ingresos_1_info_economica, valor_ingresos_1_info_economica, estudios_info_economica, otros_ingresos_2_info_economica, valor_ingresos_2_info_economica, pago_servicios_basicos_info_economica, otros_ingresos_3_info_economica, valor_ingresos_3_info_economica, pago_tarjetas_credito_info_economica, otros_ingresos_4_info_economica, valor_ingresos_4_info_economica, afiliacion_cooperativas_info_economica, otros_ingresos_5_info_economica, valor_ingresos_5_info_economica, ahorro_info_economica, otros_ingresos_6_info_economica, valor_ingresos_6_info_economica, impuesto_renta_info_economica, otros_ingresos_7_info_economica, valor_ingresos_7_info_economica, otros_ingresos_8_info_economica, valor_ingresos_8_info_economica, otros_egresos_1_info_economica, valor_egresos_1_info_economica, total_ingresos_mensuales, total_egresos_mensuales, numero_cedula_conyuge, apellidos_conyuge, nombres_conyuge, id_sexo_conyuge, fecha_nacimiento_conyuge, convive_afiliado_conyuge, numero_telefonico_conyuge, actividad_economica_conyuge, fecha_presentacion, fecha_aprobacion, id_usuarios_oficial_credito_aprueba, id_usuarios_registra, creado, modificado, identificador_consecutivos, id_tipo_creditos, nombre_banco_cuenta_bancaria, tipo_pago_cuenta_bancaria, id_estado_tramites, id_sucursales, cedula_deudor_a_garantizar, nombre_deudor_a_garantizar, porcentaje_aportacion, identificador_consecutivos_deudor, id_codigo_verificacion)
                            VALUES ('$id_solicitud_prestamo',
'$tipo_participe_datos_prestamo',
'$monto_datos_prestamo',
'$plazo_datos_prestamo',
'$destino_dinero_datos_prestamo',
'$tipo_cuenta_cuenta_bancaria',
'$numero_cuenta_cuenta_bancaria',
'$numero_cedula_datos_personales',
'$apellidos_solicitante_datos_personales',
'$nombres_solicitante_datos_personales',
'$correo_solicitante_datos_personales',
'$id_sexo_datos_personales',
$fecha_nacimiento_datos_personales,
'$id_estado_civil_datos_personales',
'$separacion_bienes_datos_personales',
'$cargas_familiares_datos_personales',
'$numero_hijos_datos_personales',
'$nivel_educativo_datos_personales',
'$id_provincias_vivienda',
'$id_cantones_vivienda',
'$id_parroquias_vivienda',
'$barrio_sector_vivienda',
'$ciudadela_conjunto_etapa_manzana_vivienda',
'$calle_vivienda',
'$numero_calle_vivienda',
'$intersecion_vivienda',
'$tipo_vivienda',
'$vivienda_hipotecada_vivienda',
'$tiempo_residencia_vivienda',
'$nombre_propietario_vivienda',
'$celular_propietario_vivienda',
'$referencia_direccion_domicilio_vivienda',
'$numero_casa_solicitante',
'$numero_celular_solicitante',
'$numero_trabajo_solicitante',
'$extension_solicitante',
'$mode_solicitante',
'$apellidos_referencia_personal',
'$nombres_referencia_personal',
'$relacion_referencia_personal',
'$numero_telefonico_referencia_personal',
'$apellidos_referencia_familiar',
'$nombres_referencia_familiar',
'$parentesco_referencia_familiar',
'$numero_telefonico_referencia_familiar',
'$id_entidades',
'$id_provincias_asignacion',
'$id_cantones_asignacion',
'$id_parroquias_asignacion',
'$numero_telefonico_datos_laborales',
'$interseccion_datos_laborales',
'$calle_datos_laborales',
'$cargo_actual_datos_laborales',
'$sueldo_total_info_economica',
'$cuota_prestamo_ordinario_info_economica',
'$arriendos_info_economica',
'$cuota_prestamo_emergente_info_economica',
'$honorarios_profesionales_info_economica',
'$cuota_otros_prestamos_info_economica',
'$comisiones_info_economica',
'$cuota_prestamo_iess_info_economica',
'$horas_suplementarias_info_economica',
'$arriendos_egre_info_economica',
'$alimentacion_info_economica',
'$otros_ingresos_1_info_economica',
'$valor_ingresos_1_info_economica',
'$estudios_info_economica',
'$otros_ingresos_2_info_economica',
'$valor_ingresos_2_info_economica',
'$pago_servicios_basicos_info_economica',
'$otros_ingresos_3_info_economica',
'$valor_ingresos_3_info_economica',
'$pago_tarjetas_credito_info_economica',
'$otros_ingresos_4_info_economica',
'$valor_ingresos_4_info_economica',
'$afiliacion_cooperativas_info_economica',
'$otros_ingresos_5_info_economica',
'$valor_ingresos_5_info_economica',
'$ahorro_info_economica',
'$otros_ingresos_6_info_economica',
'$valor_ingresos_6_info_economica',
'$impuesto_renta_info_economica',
'$otros_ingresos_7_info_economica',
'$valor_ingresos_7_info_economica',
'$otros_ingresos_8_info_economica',
'$valor_ingresos_8_info_economica',
'$otros_egresos_1_info_economica',
'$valor_egresos_1_info_economica',
'$total_ingresos_mensuales',
'$total_egresos_mensuales',
'$numero_cedula_conyuge',
'$apellidos_conyuge',
'$nombres_conyuge',
$id_sexo_conyuge,
$fecha_nacimiento_conyuge,
'$convive_afiliado_conyuge',
'$numero_telefonico_conyuge',
'$actividad_economica_conyuge',
$fecha_presentacion,
$fecha_aprobacion,
'$id_usuarios_oficial_credito_aprueba',
'$id_usuarios_registra',
 $creado,
 $modificado,
'$identificador_consecutivos',
'$id_tipo_creditos',
'$nombre_banco_cuenta_bancaria',
'$tipo_pago_cuenta_bancaria',
'$id_estado_tramites',
'$id_sucursales',
'$cedula_deudor_a_garantizar',
'$nombre_deudor_a_garantizar',
'$porcentaje_aportacion',
'$identificador_consecutivos_deudor',
'$id_codigo_verificacion'
)";
                    $resultado  = $usuarios->enviaquery($query);
                    
                    
                
                
                
                
            }
            
            
        }
        
        
    }
    
    
    
    
    
    public function attachment(){
        
        session_start();
        $consulta_documentos= new UsuariosModel();
        if (isset(  $_SESSION['nombre_usuarios']) )
        {
            
            $id_usuarios=$_SESSION['id_usuarios'];
            
            if(isset($_GET["fec"])){
                
                
                $fec=$_GET["fec"];
                
                
                if($fec=="estado_dic_2018"){
                    
                    $directorio = $_SERVER ['DOCUMENT_ROOT'];
                    
                    $mi_pdf = $directorio.'/erp_riesgos/documentos/BALANCES FCPC GADPP/BALANCE DICIEMBRE 2018 FONDO GADPP.pdf';
                    
                    if(file_exists($mi_pdf))
                    {
                        $funcion = "consulta_documentos";
                        $parametros = " '$id_usuarios', 'Estados Financieros al 31 de Diciembre de 2018'";
                        $consulta_documentos->setFuncion($funcion);
                        $consulta_documentos->setParametros($parametros);
                        $resultado=$consulta_documentos->Insert();
                        
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
                        readfile($mi_pdf);
                    }else
                    {
                        echo 'ESTIMADO PARTICIPE SE PRESENTAN INCONVENIENTES PARA ABRIR EL PDF, INTENTELO MAS TARDE.';
                    }
                    
                    
                }
                
                  if($fec=="estado_dic_2019"){
                    
                    $directorio = $_SERVER ['DOCUMENT_ROOT'];
                    
                    $mi_pdf = $directorio.'/erp_riesgos/documentos/BALANCES FCPC GADPP/BALANCE DICIEMBRE 2019 FONDO GADPP.pdf';
                    
                    if(file_exists($mi_pdf))
                    {
                        $funcion = "consulta_documentos";
                        $parametros = " '$id_usuarios', 'Estados Financieros al 31 de Diciembre de 2019'";
                        $consulta_documentos->setFuncion($funcion);
                        $consulta_documentos->setParametros($parametros);
                        $resultado=$consulta_documentos->Insert();
                        
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
                        readfile($mi_pdf);
                    }else
                    {
                        echo 'ESTIMADO PARTICIPE SE PRESENTAN INCONVENIENTES PARA ABRIR EL PDF, INTENTELO MAS TARDE.';
                    }
                    
                    
                }
				
				
				  if($fec=="estado_dic_2020"){
                    
                    $directorio = $_SERVER ['DOCUMENT_ROOT'];
                    
                    $mi_pdf = $directorio.'/erp_riesgos/documentos/BALANCES FCPC GADPP/BALANCE DICIEMBRE 2020 FONDO GADPP.pdf';
                    
                    if(file_exists($mi_pdf))
                    {
                        $funcion = "consulta_documentos";
                        $parametros = " '$id_usuarios', 'Estados Financieros al 31 de Diciembre de 2020'";
                        $consulta_documentos->setFuncion($funcion);
                        $consulta_documentos->setParametros($parametros);
                        $resultado=$consulta_documentos->Insert();
                        
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
                        readfile($mi_pdf);
                    }else
                    {
                        echo 'ESTIMADO PARTICIPE SE PRESENTAN INCONVENIENTES PARA ABRIR EL PDF, INTENTELO MAS TARDE.';
                    }
                    
                    
                }
				
				
				  if($fec=="estado_ene_2021"){
                    
                    $directorio = $_SERVER ['DOCUMENT_ROOT'];
                    
                    $mi_pdf = $directorio.'/erp_riesgos/documentos/BALANCES FCPC GADPP/BALANCE ENERO 2021 FONDO GADPP.pdf';
                    
                    if(file_exists($mi_pdf))
                    {
                        $funcion = "consulta_documentos";
                        $parametros = " '$id_usuarios', 'Estados Financieros al 31 de Enero de 2021'";
                        $consulta_documentos->setFuncion($funcion);
                        $consulta_documentos->setParametros($parametros);
                        $resultado=$consulta_documentos->Insert();
                        
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
                        readfile($mi_pdf);
                    }else
                    {
                        echo 'ESTIMADO PARTICIPE SE PRESENTAN INCONVENIENTES PARA ABRIR EL PDF, INTENTELO MAS TARDE.';
                    }
                    
                    
                }
				
				  if($fec=="estado_feb_2021"){
                    
                    $directorio = $_SERVER ['DOCUMENT_ROOT'];
                    
                    $mi_pdf = $directorio.'/erp_riesgos/documentos/BALANCES FCPC GADPP/BALANCE FEBRERO 2021 FONDO GADPP.pdf';
                    
                    if(file_exists($mi_pdf))
                    {
                        $funcion = "consulta_documentos";
                        $parametros = " '$id_usuarios', 'Estados Financieros al 28 de Febrero de 2021'";
                        $consulta_documentos->setFuncion($funcion);
                        $consulta_documentos->setParametros($parametros);
                        $resultado=$consulta_documentos->Insert();
                        
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
                        readfile($mi_pdf);
                    }else
                    {
                        echo 'ESTIMADO PARTICIPE SE PRESENTAN INCONVENIENTES PARA ABRIR EL PDF, INTENTELO MAS TARDE.';
                    }
                    
                    
                }
				
				
				
				
				  if($fec=="estado_mar_2021"){
                    
                    $directorio = $_SERVER ['DOCUMENT_ROOT'];
                    
                    $mi_pdf = $directorio.'/erp_riesgos/documentos/BALANCES FCPC GADPP/BALANCE MARZO 2021 FONDO GADPP.pdf';
                    
                    if(file_exists($mi_pdf))
                    {
                        $funcion = "consulta_documentos";
                        $parametros = " '$id_usuarios', 'Estados Financieros al 31 de Marzo de 2021'";
                        $consulta_documentos->setFuncion($funcion);
                        $consulta_documentos->setParametros($parametros);
                        $resultado=$consulta_documentos->Insert();
                        
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
                        readfile($mi_pdf);
                    }else
                    {
                        echo 'ESTIMADO PARTICIPE SE PRESENTAN INCONVENIENTES PARA ABRIR EL PDF, INTENTELO MAS TARDE.';
                    }
                    
                    
                }
				
				
				
				
				
				 if($fec=="dic_2019_1"){
                    
                    $directorio = $_SERVER ['DOCUMENT_ROOT'];
                    
                    $mi_pdf = $directorio.'/erp_riesgos/documentos/INFORMES DE AUDITORIA/INFORME DE AUDITORIA INTERNA 2019.pdf';
                    
                    if(file_exists($mi_pdf))
                    {
                        $funcion = "consulta_documentos";
                        $parametros = " '$id_usuarios', 'Informe de Auditoría Interna Primer Semestre año 2019'";
                        $consulta_documentos->setFuncion($funcion);
                        $consulta_documentos->setParametros($parametros);
                        $resultado=$consulta_documentos->Insert();
                        
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
                        readfile($mi_pdf);
                    }else
                    {
                        echo 'ESTIMADO PARTICIPE SE PRESENTAN INCONVENIENTES PARA ABRIR EL PDF, INTENTELO MAS TARDE.';
                    }
                    
                    
                }
				
				
				 if($fec=="dic_2019_2"){
                    
                    $directorio = $_SERVER ['DOCUMENT_ROOT'];
                    
                    $mi_pdf = $directorio.'/erp_riesgos/documentos/INFORMES DE AUDITORIA/INFORME DE AUDITORIA 2019.pdf';
                    
                    if(file_exists($mi_pdf))
                    {
                        $funcion = "consulta_documentos";
                        $parametros = " '$id_usuarios', 'Informe de Auditoría al 31 de Diciembre del 2019'";
                        $consulta_documentos->setFuncion($funcion);
                        $consulta_documentos->setParametros($parametros);
                        $resultado=$consulta_documentos->Insert();
                        
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
                        readfile($mi_pdf);
                    }else
                    {
                        echo 'ESTIMADO PARTICIPE SE PRESENTAN INCONVENIENTES PARA ABRIR EL PDF, INTENTELO MAS TARDE.';
                    }
                    
                    
                }
				
				
				
                
            }
            
            
            
        }else{
            
            $this->redirect("Usuarios","sesion_caducada");
        }
        
        
        
        
        
    }
    
    
    
    
    
    
    
    public function index2(){
        
        session_start();
        if (isset(  $_SESSION['nombre_usuarios']) )
        {
            
            
            $sexo= new SexoModel();
            $resultSexo = $sexo->getAll("nombre_sexo");
            
            $estado_civil= new Estado_civilModel();
            $resultEstado_civil = $estado_civil->getBy("id_estado_civil_participes not in (7,6) ");
            
            
            $tipo_sangre= new Tipo_sangreModel();
            $resultTipo_sangre = $tipo_sangre->getAll("nombre_tipo_sangre");
            
            $estado = new EstadoParticipesModel();
            $resultEstado= $estado->getAll("nombre_estado_participes");
            
            
            $entidades = new EntidadPatronalParticipesModel();
            $resultEntidades= $entidades->getAll("nombre_entidad_patronal");
            
            
            $provincias = new ProvinciasModel();
            $resultProvincias= $provincias->getAll("nombre_provincias");
            
            $parroquias = new ParroquiasModel();
            $resultParroquias= $parroquias->getAll("nombre_parroquias");
            
            $cantones = new CantonesModel();
            $resultCantones= $cantones->getAll("nombre_cantones");
            
            
            $afiliacion = new AfiliadoRecomendacionModel();
            
            $nombre_controladores = "SolicitudPrestamo";
            $id_rol= $_SESSION['id_rol'];
            $resultPer = $afiliacion->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
            
            if (!empty($resultPer))
            {
                
                
                
                $this->view_ServiciosOnline("AfiliadoRecomendacion",array(
                    "resultSexo"=>$resultSexo, "resultEstado_civil"=>$resultEstado_civil, "resultTipo_sangre"=>$resultTipo_sangre, "resultEstado"=>$resultEstado, "resultEntidades"=>$resultEntidades,
                    "resultProvincias"=>$resultProvincias,
                    "resultParroquias"=>$resultParroquias, "resultCantones"=>$resultCantones
                    
                ));
                
            }
            else
            {
                $this->view("Error",array(
                    "resultado"=>"No tiene Permisos de Acceso a Afiliado Recomendación"
                    
                ));
                
            }
            
            
        }
        else
        {
            $error = TRUE;
            $mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
            
            $this->view("Login",array(
                "resultSet"=>"$mensaje", "error"=>$error
            ));
            
            
            die();
            
        }
        
    }
    
    
    
    
    
    public function InsertaRecomendacion(){
        
        session_start();
        
        if (isset(  $_SESSION['nombre_usuarios']) )
        {
            
            $usuarios = new UsuariosModel();
            $afiliacion = new AfiliadoRecomendacionModel();
            
            if ( isset($_POST["cedula"]) )
            {
                
                $_cedula    = $_POST["cedula"];
                $_nombre     = $_POST["nombre"];
                $_direccion     = $_POST["direccion"];
                $_id_usuarios_sugiere = $_SESSION['id_usuarios'];
                
                
                $_labor = $_POST["labor"];
                $_correo   = $_POST["correo"];
                $_telefono    = $_POST["telefono"];
                $_celular     = $_POST["celular"];
                $_id_entidades            = $_POST["id_entidades"];
                $_fecha_ingreso          = $_POST["fecha_ingreso"];
                $_sueldo           = $_POST["sueldo"];
                $_hijos          = $_POST["hijos"];
                $_edad           = $_POST["edad"];
                $_id_sexo          = $_POST["id_sexo"];
                $_id_estado_civil           = $_POST["id_estado_civil"];
                $_id_tipo_sangre          = $_POST["id_tipo_sangre"];
                
                $_id_provincias_vivienda          = $_POST["id_provincias_vivienda"];
                $_id_cantones_vivienda          = $_POST["id_cantones_vivienda"];
                $_id_parroquias_vivienda         = $_POST["id_parroquias_vivienda"];
                $_id_provincias_asignacion          = $_POST["id_provincias_asignacion"];
                $_id_cantones_asignacion          = $_POST["id_cantones_asignacion"];
                $_id_parroquias_asignacion         = $_POST["id_parroquias_asignacion"];
                $_observacion        = $_POST["observacion"];
                
                
                
                try {
                    
                    
                    
                    
                    $funcion = "public.afiliado_recomendacion";
                    $parametros = "'$_cedula',
					'$_nombre',
					'$_direccion',
					'$_fecha_ingreso',
					'$_id_usuarios_sugiere',
					'$_id_provincias_vivienda',
					'$_id_cantones_vivienda',
					'$_id_parroquias_vivienda',
					'$_id_provincias_asignacion',
					'$_id_cantones_asignacion',
					'$_id_parroquias_asignacion',
					'$_id_sexo',
					'$_id_tipo_sangre',
					'$_id_estado_civil',
					'$_id_entidades',
					'$_telefono',
					'$_celular',
					'$_correo',
					'$_edad',
					'$_hijos',
					'$_sueldo'";
                    $afiliacion->setFuncion($funcion);
                    $afiliacion->setParametros($parametros);
                    $resultado=$afiliacion->Insert();
                    
                    
                    
                    
                } catch (Exception $e) {
                    
                    $this->redirect("ServiciosOnline", "index2");
                    
                }
                
                
                
                
                
                
                $this->redirect("Usuarios", "Bienvenida");
                
                
            }
            else
            {
                
                $this->redirect("Usuarios", "Bienvenida");
            }
            
            
        }
        else
        {
            
            $error = TRUE;
            $mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
            $this->view("Login",array(
                "resultSet"=>"$mensaje", "error"=>$error
            ));
            
            
            die();
            
        }
        
    }
    
    
    
    
    
    
    
    public function index3(){
        
        session_start();
        if (isset(  $_SESSION['nombre_usuarios']) )
        {
            
            $afiliacion = new AfiliadoRecomendacionModel();
            
            $nombre_controladores = "AfiliadoRecomendacion";
            $id_rol= $_SESSION['id_rol'];
            $resultPer = $afiliacion->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
            
            if (!empty($resultPer))
            {
                
                
                
                $this->view_ServiciosOnline("ConsultaAfiliacionesRecomendadas",array(
                    "resultSexo"=>""
                    
                ));
                
            }
            else
            {
                $this->view("Error",array(
                    "resultado"=>"No tiene Permisos de Acceso a Consulta Afiliado Recomendación"
                    
                ));
                
            }
            
            
        }
        else
        {
            $error = TRUE;
            $mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
            
            $this->view("Login",array(
                "resultSet"=>"$mensaje", "error"=>$error
            ));
            
            
            die();
            
        }
        
    }
    
    
    
    
    
    public function search(){
        
        session_start();
        $afiliacion = new AfiliadoRecomendacionModel();
        $where_to="";
        $columnas = " usuarios.cedula_usuarios,
				  (usuarios.nombre_usuarios || ' ' || usuarios.apellidos_usuarios) as nombre_usuarios,
				  afiliado_recomendacion.cedula,
				  afiliado_recomendacion.nombre,
				  afiliado_recomendacion.direccion,
				  afiliado_recomendacion.telefono,
				  afiliado_recomendacion.celular,
				  afiliado_recomendacion.correo,
				  afiliado_recomendacion.edad,
				  afiliado_recomendacion.hijos,
				  afiliado_recomendacion.sueldo,
				  afiliado_recomendacion.fecha_ingreso,
				  parroquias.nombre_parroquias,
				  core_provincias.nombre_provincias,
				  cantones.nombre_cantones,
				  tipo_sangre.nombre_tipo_sangre,
				  sexo.nombre_sexo,
				  core_estado_civil_participes.nombre_estado_civil_participes,
				  core_entidad_patronal.nombre_entidad_patronal,
				  afiliado_recomendacion.creado";
        
        $tablas   = "public.afiliado_recomendacion,
                  public.usuarios,
                  public.parroquias,
                  public.core_provincias,
                  public.cantones,
                  public.sexo,
                  public.tipo_sangre,
                  public.core_estado_civil_participes,
                  public.core_entidad_patronal";
        
        $where    = "
  afiliado_recomendacion.id_provincias_asignacion = core_provincias.id_provincias AND
  afiliado_recomendacion.id_cantones_asignacion = cantones.id_cantones AND
  afiliado_recomendacion.id_parroquias_asignacion = parroquias.id_parroquias AND
  usuarios.id_usuarios = afiliado_recomendacion.id_usuarios_sugiere AND
  sexo.id_sexo = afiliado_recomendacion.id_sexo AND
  tipo_sangre.id_tipo_sangre = afiliado_recomendacion.id_tipo_sangre AND
  core_estado_civil_participes.id_estado_civil_participes = afiliado_recomendacion.id_estado_civil AND
  core_entidad_patronal.id_entidad_patronal = afiliado_recomendacion.id_entidades";
        
        $id       = "afiliado_recomendacion.id_afiliado_recomendacion";
        
        
        
        
        
        $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
        $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
        $desde=  (isset($_REQUEST['desde'])&& $_REQUEST['desde'] !=NULL)?$_REQUEST['desde']:'';
        $hasta=  (isset($_REQUEST['hasta'])&& $_REQUEST['hasta'] !=NULL)?$_REQUEST['hasta']:'';
        
        $where2="";
        
        
        if($action == 'ajax')
        {
            
            if(!empty($search)){
                
                
                if($desde!="" && $hasta!=""){
                    
                    $where2=" AND DATE(afiliado_recomendacion.creado)  BETWEEN '$desde' AND '$hasta'";
                    
                    
                }
                
                $where1=" AND (usuarios.cedula_usuarios LIKE '".$search."%' OR usuarios.nombre_usuarios LIKE '".$search."%' OR usuarios.correo_usuarios LIKE '".$search."%' OR afiliado_recomendacion.cedula_usuarios LIKE '".$search."%' OR afiliado_recomendacion.nombre_usuarios LIKE '".$search."%' OR afiliado_recomendacion.correo_usuarios LIKE '".$search."%')";
                
                $where_to=$where.$where1.$where2;
            }else{
                if($desde!="" && $hasta!=""){
                    
                    $where2=" AND DATE(afiliado_recomendacion.creado)  BETWEEN '$desde' AND '$hasta'";
                    
                }
                
                $where_to=$where.$where2;
                
            }
            
            $html="";
            $resultSet=$afiliacion->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 10; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre páginas después de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$afiliacion->getCondicionesPagDesc($columnas, $tablas, $where_to, $id, $limit);
            $count_query   = $cantidadResult;
            $total_pages = ceil($cantidadResult/$per_page);
            
            
            
            
            
            if($cantidadResult>0)
            {
                
                $html.='<div class="pull-left" style="margin-left:11px;">';
                $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
                $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
                $html.='</div>';
                $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:425px; overflow-y:scroll;">';
                $html.= "<table id='tabla_afiliaciones_recomendadas' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Cedula Sugiere</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Nombre Sugiere</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Fuerza</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Sueldo</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Edad</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Hijos</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Provincia Asig.</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Cantón Asig.</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Parroquia Asig.</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Creado</th>';
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                $i=0;
                
                foreach ($resultSet as $res)
                {
                    $i++;
                    $html.='<tr>';
                    $html.='<td style="font-size: 11px;">'.$i.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->cedula_usuarios.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->cedula.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre.'</td>';
                    
                    $html.='<td style="font-size: 11px;">'.$res->correo.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->celular.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_entidad_patronal.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->sueldo.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->edad.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->hijos.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_provincias.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_cantones.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->nombre_parroquias.'</td>';
                    
                    $html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->creado)).'</td>';
                    $html.='</tr>';
                }
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate_load_afiliaciones_recomendadas("index.php", $page, $total_pages, $adjacents).'';
                $html.='</div>';
                
                
            }else{
                $html.='<div class="col-lg-6 col-md-6 col-xs-12">';
                $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay afiliaciones recomendadas registradas...</b>';
                $html.='</div>';
                $html.='</div>';
            }
            
            
            
            
            echo $html;
            die();
            
        }
        
        
    }
    
    
    
    
    
    
    
    public function paginate_load_afiliaciones_recomendadas($reload, $page, $tpages, $adjacents) {
        
        $prevlabel = "&lsaquo; Prev";
        $nextlabel = "Next &rsaquo;";
        $out = '<ul class="pagination pagination-large">';
        
        // previous label
        
        if($page==1) {
            $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
        } else if($page==2) {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_afiliaciones_recomendadas(1)'>$prevlabel</a></span></li>";
        }else {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_afiliaciones_recomendadas(".($page-1).")'>$prevlabel</a></span></li>";
            
        }
        
        // first label
        if($page>($adjacents+1)) {
            $out.= "<li><a href='javascript:void(0);' onclick='load_afiliaciones_recomendadas(1)'>1</a></li>";
        }
        // interval
        if($page>($adjacents+2)) {
            $out.= "<li><a>...</a></li>";
        }
        
        // pages
        
        $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
        $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
        for($i=$pmin; $i<=$pmax; $i++) {
            if($i==$page) {
                $out.= "<li class='active'><a>$i</a></li>";
            }else if($i==1) {
                $out.= "<li><a href='javascript:void(0);' onclick='load_afiliaciones_recomendadas(1)'>$i</a></li>";
            }else {
                $out.= "<li><a href='javascript:void(0);' onclick='load_afiliaciones_recomendadas(".$i.")'>$i</a></li>";
            }
        }
        
        // interval
        
        if($page<($tpages-$adjacents-1)) {
            $out.= "<li><a>...</a></li>";
        }
        
        // last
        
        if($page<($tpages-$adjacents)) {
            $out.= "<li><a href='javascript:void(0);' onclick='load_afiliaciones_recomendadas($tpages)'>$tpages</a></li>";
        }
        
        // next
        
        if($page<$tpages) {
            $out.= "<li><span><a href='javascript:void(0);' onclick='load_afiliaciones_recomendadas(".($page+1).")'>$nextlabel</a></span></li>";
        }else {
            $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
        }
        
        $out.= "</ul>";
        return $out;
    }
    
    
    
	
	
	
	
	
	
	
	
	
	
	
    /////////////////////////////MAYCOL PARA MIGRAR USUARIOS DE LA WEB CAPREMCI///////////////////////////////////////
    
    public function migrar_participes_a_usuarios(){
        
    $usuarios=new UsuariosModel();
        
    
    $columnas = "apellido_participes, nombre_participes, cedula_participes, correo_participes, 
				fecha_nacimiento_participes, telefono_participes , celular_participes, id_estado_participes";

    $tablas   = "core_participes";
    $where    = "1=1";
    
        
    $resultSet=$usuarios->getCondiciones($columnas, $tablas, $where, "id_participes");
        
    if(!empty($resultSet)){
        
        foreach ($resultSet as $res){
        
            $_cedula_usuarios     =$res->cedula_participes;
            $_clave_usuarios    =$usuarios->encriptar(2021);
            $_clave_n_usuarios  =2021;
            $_id_rol_principal  =2;
            $_id_usuarios       =0;
            
            $imagen_usuarios    ="";
			$directorio = dirname(__FILE__).'\..\view\images\usuario.jpg';
    		                
			if( is_file( $directorio )){
				$data = file_get_contents($directorio);
				$imagen_usuarios = pg_escape_bytea($data);
			}
            
            $_caduca_clave  =0;
            $_cambiar_clave =1;
           
            $clave_fecha_hoy = date("Y-m-d");
            $clave_fecha_siguiente_mes = date("Y-m-d",strtotime($clave_fecha_hoy."+ 5 year"));
            
            $resultUsu=$usuarios->getCondiciones("id_usuarios", "usuarios", "cedula_usuarios='$_cedula_usuarios'", "id_usuarios");
            
            if(!empty($resultUsu)){
                
                $_cambiar_clave=0;
            }
            
            $resultPart=$usuarios->getCondiciones("rtrim(ltrim(nombre_participes)) as nombre_participes, rtrim(ltrim(apellido_participes)) as apellido_participes, fecha_nacimiento_participes, correo_participes, telefono_participes, celular_participes, id_estado_participes", "core_participes", "cedula_participes='$_cedula_usuarios' and id_estatus=1", "cedula_participes");
            
			
            if(!empty($resultPart)){
            
                
                $_nombre_usuarios       					       =$resultPart[0]->nombre_participes;
                $_apellidos_usuario       				   =$resultPart[0]->apellido_participes;
				
                $_fecha_nacimiento_usuarios       =$resultPart[0]->fecha_nacimiento_participes;
				
                $_telefono_usuarios       				   =$resultPart[0]->telefono_participes;
                $_celular_usuarios       					       =$resultPart[0]->celular_participes;
                $_correo_usuarios       				   =$resultPart[0]->correo_participes;
                $_id_estado_participes       				   =$resultPart[0]->id_estado_participes;
                
                $_nombre_usuarios1 = explode(" ", $_nombre_usuarios);
                $_apellidos_usuario1 = explode(" ", $_apellidos_usuario);
                $_usuario_usuarios = $_nombre_usuarios1[0].' '.$_apellidos_usuario1[0];
                
                
                if($_id_estado_participes==5){
                    
                    $_id_estado =2;
                    
                }else{
                
                    $_id_estado =1;
                }
                
                
                $funcion = "ins_usuarios_migracion_participes";
                $parametros = "'$_id_usuarios', '$_cedula_usuarios',
    		    				   '$_nombre_usuarios',
                                   '$_apellidos_usuario',
                                   '$_correo_usuarios',
                                   '$_celular_usuarios',
    		    	               '$_telefono_usuarios',
    		    	               null,
    		    	               '$_usuario_usuarios',
    		    	               '$_id_estado',
    		    	               '$imagen_usuarios',
                                   '$_id_rol_principal',
                                   '$_clave_usuarios',
                                   '$_clave_n_usuarios',
                                   '$clave_fecha_hoy',
                                   '$clave_fecha_siguiente_mes',
                                   '$_caduca_clave',
                                   '$_cambiar_clave'";
								   
								     
								   
                $usuarios->setFuncion($funcion);
                $usuarios->setParametros($parametros);
                
                
                $resultado=$usuarios->llamafuncion();
                
                
            }
           
            
        }
        
    }
    
    
    
    
    }
    
    
    
      public function  propaganda_actualizacion_datos(){
        
        session_start();
        $_id_usuarios = $_SESSION["id_usuarios"];
        $usuarios = new UsuariosModel();
        
        $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
        
        
        if($action == 'ajax' && $_id_usuarios>0)
        {
            
            $columnas_1="usuarios.actualizacion";
            $tablas_1="public.usuarios";
            $where_1="usuarios.id_usuarios='$_id_usuarios' and usuarios.actualizacion='TRUE'";
            $id_1= "usuarios.id_usuarios";
            $resultUsu=$usuarios->getCondiciones($columnas_1, $tablas_1, $where_1, $id_1);
            
            
            if(!empty($resultUsu) && count($resultUsu)>0){
                $respuesta='SI';
                echo $respuesta;
                die();
                
            }else{
                
                $respuesta='NO';
                echo $respuesta;
                die();
            }
            
            
        }
        
    }
    
    
	
	
	public function devuelveCordinacion()
	{
	    //session_start();
	    $resultParr = array();
	    
	    
	    if(isset($_POST["id_entidad_patronal"]))
	    {
	        
	        $id_entidad_patronal=(int)$_POST["id_entidad_patronal"];
	        
	        $entidad=new CordinacionesModel();
	        
	        $resultParr = $entidad->getBy(" id_entidad_patronal = '$id_entidad_patronal'  ");
	        
	        
	    }
	    
	    echo json_encode($resultParr);
	    
	}
	
	
	
	
	
    
}

?>