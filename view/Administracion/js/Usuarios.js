 $(document).ready( function (){
	 /*pone_espera();*/
	   load_usuarios(1);
	   load_usuarios_inactivos(1);
	   var ct="Usuarios Activos";
	  
	   $('[data-mask]').inputmask();
	   
	   
	   $('#fecha_nacimiento_usuarios').inputmask(
			   'yyyy/mm/dd', { 
				   'placeholder': 'yyyy/mm/dd',				   
				   'clearIncomplete': true,
				   'oncomplete': function () {
					   //console.log($(this).val())
				        if($(this).val() >= $('[data-fechaactual]').data('fechaactual')){
				        	$('#mensaje_fecha_nacimiento_usuarios').text('Fecha no valida')
				        	$('#mensaje_fecha_nacimiento_usuarios').fadeIn()
				        	$(this).val('')
				        }else{
				        	$('#mensaje_fecha_nacimiento_usuarios').fadeOut()
				        }
				    }
			   })
	  //'yearrange': { 'minyear': '1950', 'maxyear': '2018' },
		
});//docreadyend
 
 /**
  * autocomplete de usuarios
  * update 2019-08-05
  */
//para autocomplete de cedula de usuarios
 $("#cedula_usuarios").on("focus",function(e) {
		
		let _elemento = $(this);
		
	    if ( !_elemento.data("autocomplete") ) {
	    	    	
	    	_elemento.autocomplete({
	    		minLength: 3,    	    
	    		source:function (request, response) {
	    			$.ajax({
	    				url:"index.php?controller=Usuarios&action=AutocompleteCedula",
	    				dataType:"json",
	    				type:"GET",
	    				data:{term:request.term},
	    			}).done(function(x){
	    				
	    				response(x); 
	    				
	    			}).fail(function(xhr,status,error){
	    				var err = xhr.responseText
	    				console.log(err)
	    			})
	    		},
	    		select: function (event, ui) {	     	       		    			
	    			if(ui.item.id == ''){
	    				$("#id_usuarios").val('');
	    				_elemento.val("");
	    				_elemento.focus();	   
	    				 return;
	    			}
	    			$("#id_usuarios").val(ui.item.id);
	    			_elemento.val(ui.item.value);
	    			
	    			cedulaSeleccionada(_elemento.val())	    			
	    			
	     	    },
	     	   appendTo: null,
	     	   change: function(event,ui){	     		   
	     		   if(ui.item == null){	     			   
	     			//_elemento.notify("Cedula no se encuentra registrada",{ position:"buttom left", autoHideDelay: 2000});
	     		   }
	     	   }
	    	
	    	})
	    }
	});
 
 $("#cedula_usuarios").on("focusout",function(e) {

	 let elemento = $(this);
	 let validador = fnvalidaCedula("cedula_usuarios");
	 if( elemento.val() != "" && validador == true){
		 
	 }else{
		 elemento.notify("Digite Cedula Valida",{ position:"buttom left", autoHideDelay: 2000});
		 elemento.focus();
		 $("#frm_ins_usuario")[0].reset(); $('#id_usuarios').val('');
	 }
 })
 
 /**
  * fn para devolver los datos de cedula seleccionada
  * @param cedula
  */
 function cedulaSeleccionada(paramCedula){
	 
	 $.ajax({
			url:'index.php?controller=Usuarios&action=AutocompleteCedula',
			type:'POST',
			dataType:'json',
			data:{term:paramCedula}
		}).done(function(respuesta){
			//console.log(respuesta[0].id);
			//valida if( !$.isEmptyObject(respuesta)){
			if(JSON.stringify(respuesta)!='{}'){
			//if (Object.entries(respuesta).length === 0) {
				$('#id_usuarios').val(respuesta.id_usuarios);					
				$('#nombre_usuarios').val(respuesta.nombre_usuarios);
				$('#apellidos_usuarios').val(respuesta.apellidos_usuarios);
				$('#usuario_usuarios').val(respuesta.usuario_usuarios);
				$('#fecha_nacimiento_usuarios').val(respuesta.fecha_nacimiento_usuarios);
				$('#celular_usuarios').val(respuesta.celular_usuarios);
				$('#telefono_usuarios').val(respuesta.telefono_usuarios);
				$('#correo_usuarios').val(respuesta.correo_usuarios);					
				$('#codigo_clave').val(respuesta.clave_n_claves);
	
				if(respuesta.id_rol>0){
					$('#id_rol_principal option[value='+respuesta.id_rol+']').attr('selected','selected');
					}
	
				if(respuesta.id_estado>0){
					$('#id_estado option[value='+respuesta.id_estado+']').attr('selected','selected');
					}
	
				if(respuesta.caduca_claves=='t'){
					
					$('#caduca_clave').attr('checked','checked');
				}
	
				if( respuesta.clave_usuarios != ""){
					$('#clave_usuarios').val(respuesta.clave_n_claves).attr('readonly','readonly');
					$('#clave_usuarios_r').val(respuesta.clave_n_claves).attr('readonly','readonly');
					$('#lbl_cambiar_clave').text("Cambiar Clave:  ");
					$('#cambiar_clave').show();					
						
					}
			}else{ $("#frm_ins_usuario")[0].reset(); $('#id_usuarios').val(''); }
			
			
		}).fail( function( xhr , status, error ){
			 var err=xhr.responseText
			console.log(err)
		});
 }

/**
 * para autocomplete de usuarios
 * @param pagina
 * @returns json
 */
$( "#cedula_usuariosw" ).autocomplete({

	source: "index.php?controller=Usuarios&action=AutocompleteCedula",
	minLength: 4,
    select: function (event, ui) {
       // Set selection          
       $('#id_usuarios').val(ui.item.id);
       $('#cedula_usuarios').val(ui.item.value); // save selected id to input      
       return false;
    },focus: function(event, ui) { 
        var text = ui.item.value; 
        $('#cedula_usuarios').val();            
        return false; 
    } 
}).focusout(function() {
	validarcedula();
	if(document.getElementById('cedula_usuarios').value != ''){
		$.ajax({
			url:'index.php?controller=Usuarios&action=AutocompleteCedula',
			type:'POST',
			dataType:'json',
			data:{term:$('#cedula_usuarios').val()}
		}).done(function(respuesta){
			//console.log(respuesta[0].id);
			//valida if( !$.isEmptyObject(respuesta)){
			if(JSON.stringify(respuesta)!='{}'){
			//if (Object.entries(respuesta).length === 0) {
				$('#id_usuarios').val(respuesta.id_usuarios);					
				$('#nombre_usuarios').val(respuesta.nombre_usuarios);
				$('#apellidos_usuarios').val(respuesta.apellidos_usuarios);
				$('#usuario_usuarios').val(respuesta.usuario_usuarios);
				$('#fecha_nacimiento_usuarios').val(respuesta.fecha_nacimiento_usuarios);
				$('#celular_usuarios').val(respuesta.celular_usuarios);
				$('#telefono_usuarios').val(respuesta.telefono_usuarios);
				$('#correo_usuarios').val(respuesta.correo_usuarios);					
				$('#codigo_clave').val(respuesta.clave_n_claves);
	
				if(respuesta.id_rol>0){
					$('#id_rol_principal option[value='+respuesta.id_rol+']').attr('selected','selected');
					}
	
				if(respuesta.id_estado>0){
					$('#id_estado option[value='+respuesta.id_estado+']').attr('selected','selected');
					}
	
				if(respuesta.caduca_claves=='t'){
					
					$('#caduca_clave').attr('checked','checked');
				}
	
				if( respuesta.clave_usuarios != ""){
					$('#clave_usuarios').val(respuesta.clave_n_claves).attr('readonly','readonly');
					$('#clave_usuarios_r').val(respuesta.clave_n_claves).attr('readonly','readonly');
					$('#lbl_cambiar_clave').text("Cambiar Clave:  ");
					$('#cambiar_clave').show();					
						
					}
			}else{ $("#frm_ins_usuario")[0].reset(); }
			//console.log(respuesta)
			/*if(respuesta[0].id>0){				
				$('#id_proveedor').val(respuesta[0].id);
	           $('#proveedor').val(respuesta[0].value); // save selected id to input
	           $('#nombre_proveedor').val(respuesta[0].nombre);
	           $('#datos_proveedor').show();
			}else{$('#datos_proveedor').hide(); $('#id_proveedor').val('0');  $('#proveedor').val('').focus();}*/
			
		}).fail( function( xhr , status, error ){
			 var err=xhr.responseText
			console.log(err)
		});
	}
	
});

/**
 * FORMULARIO PARA AGREGAR USUARIOS
 * @param event
 * @returns
 */
$('#frm_ins_usuario').on('submit',function(e){
	
	//selecionarTodos();
	
	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;
			    	
	var id_rol  = $("#id_rol").val();
	var id_estado  = $("#id_estado").val();
	var id_rol_principal = $("#id_rol_principal").val();
	
	
	if (document.getElementById('cedula_usuarios').value  == "")
	{    	
		$("#mensaje_cedula_usuarios").text("Introduzca Identificación");
		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
        return false
    }    
	
	if (document.getElementById('nombre_usuarios').value == "")
	{
    	
		$("#mensaje_nombre_usuarios").text("Introduzca un Nombre");
		$("#mensaje_nombre_usuarios").fadeIn("slow"); //Muestra mensaje de error
        return false
    }
	

	if ( document.getElementById('apellidos_usuarios').value == "")
	{
    	
		$("#mensaje_apellido_usuarios").text("Introduzca un apellido");
		$("#mensaje_apellido_usuarios").fadeIn("slow"); //Muestra mensaje de error
        return false
    }
	
	if ( document.getElementById('usuario_usuarios').value == "")
	{
    	
		$("#mensaje_usuario_usuarios").text("Digite un Nombre de Usuario");
		$("#mensaje_usuario_usuarios").fadeIn("slow"); //Muestra mensaje de error
        return false
    }

	/*para input fecha nacimiento*/				
	if ($("#fecha_nacimiento_usuarios").val() == "")
	{
    	
		$("#mensaje_fecha_nacimiento_usuarios").text("Introduzca fecha Nacimiento");
		$("#mensaje_fecha_nacimiento_usuarios").fadeIn("slow"); //Muestra mensaje de error
        return false
    }

	/*para input celular*/				
	if ($("#celular_usuarios").val() == "")
	{
    	
		$("#mensaje_celular_usuarios").text("Introduzca Celular");
		$("#mensaje_celular_usuarios").fadeIn("slow"); //Muestra mensaje de error
        return false;
    }	

	/* input correos */	
	if ($("#correo_usuarios").val() == "")
	{
    	
		$("#mensaje_correo_usuarios").text("Introduzca un correo");
		$("#mensaje_correo_usuarios").fadeIn("slow"); //Muestra mensaje de error
        return false;
    }
	else if (regex.test($('#correo_usuarios').val().trim()))
	{
		$("#mensaje_correo_usuarios").fadeOut("slow"); //Muestra mensaje de error
        
	}

	if ($("#clave_usuarios").val() == "")
	{
		
		$("#mensaje_clave_usuarios").text("Introduzca una Clave");
		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
        return false
        
    }else if ($("#clave_usuarios").val().length!=8){
    	
    	$("#mensaje_clave_usuarios").text("Introduzca 8 Digitos");
		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
        return false
	}	

	if ($("#clave_usuarios_r").val() == "")
	{
		
		$("#mensaje_clave_usuarios_r").text("Introduzca una Clave");
		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
        return false
    }
	
	if ($("#clave_usuarios").val() != $("#clave_usuarios_r").val())
	{
    	
		$("#mensaje_clave_usuarios_r").text("Claves no Coinciden");
		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
        return false;
    }
	
	/*para input_select estado usuario*/
	if (document.getElementById('id_estado').value == 0 )
	{
    	
		$("#mensaje_id_estados").text("Seleccione un Estado");
		$("#mensaje_id_estados").fadeIn("slow"); //Muestra mensaje de error
        return false;
    }
	
	if (document.getElementById('id_rol_principal').value == 0 )
	{
    	
		$("#mensaje_id_rol_principal").text("Seleccione Rol Principal");
		$("#mensaje_id_rol_principal").fadeIn("slow"); //Muestra mensaje de error
        return false;
    }
	
	//var parametros = $(this).serialize();
	
	var parametros = new FormData(this)
	
	parametros.append('action','ajax')
	
		
	 $.ajax({
		 beforeSend:function(){},
		 url:'index.php?controller=Usuarios&action=InsertaUsuarios',
		 type:'POST',
		 data:parametros,
		 dataType: 'json',
		 contentType: false, //importante enviar este parametro en false
         processData: false,  //importante enviar este parametro en false
         
		 success: function(respuesta){
			 //$("#frm_ins_usuario")[0].reset();
			 //console.log(respuesta);
			 if(respuesta.success==1){
				
				 
				 swal({title:"Usuarios",text:respuesta.mensaje,icon:"success"})
 	    		.then((value) => {
 	    			window.location.href= 'index.php?controller=Usuarios&action=index';
 	    		});
				 	
            		//load_usuarios(1);
            		//load_usuarios_inactivos(1);
					
	                }
			 
			 if(respuesta.success==0){
	                	
	                	swal({
	              		  title: "Usuarios",
	              		  text: respuesta.mensaje,
	              		  icon: "warning",
	              		  button: "Aceptar",
	              		});
	             }			 
			 
		 },
		 error: function(xhr,estado,error){    			 
			 //console.log(xhr.responseText);
			 var err=xhr.responseText
			 
			 swal({
        		  title: "Error",
        		  text: "Error conectar con el Servidor \n "+err,
        		  icon: "error",
        		  button: "Aceptar",
        		});
	        }
	 })
	
	/*parametros.forEach((value,key) => {
      console.log(key+" "+value)
	});*/
	
	e.preventDefault();
	
})
//termina submit de formulario


 $('#link_agregar_rol').click(function() { 
     copiarOpcion($('#id_rol option:selected').clone(), "#lista_roles");
 });
 
/*
 $("#cedula_usuarios").focusout(function(){
		validarcedula();
		$.ajax({
			url:'index.php?controller=Usuarios&action=AutocompleteDevuelveNombres',
			type:'POST',
			dataType:'json',
			data:{cedula_usuarios:$('#cedula_usuarios').val()}
		}).done(function(respuesta){

			$('#id_usuarios').val(respuesta.id_usuarios);					
			$('#nombre_usuarios').val(respuesta.nombre_usuarios);
			$('#apellidos_usuarios').val(respuesta.apellidos_usuarios);
			$('#usuario_usuarios').val(respuesta.usuario_usuarios);
			$('#fecha_nacimiento_usuarios').val(respuesta.fecha_nacimiento_usuarios);
			$('#celular_usuarios').val(respuesta.celular_usuarios);
			$('#telefono_usuarios').val(respuesta.telefono_usuarios);
			$('#correo_usuarios').val(respuesta.correo_usuarios);					
			$('#codigo_clave').val(respuesta.clave_n_claves);

			if(respuesta.id_rol>0){
				$('#id_rol_principal option[value='+respuesta.id_rol+']').attr('selected','selected');
				}

			if(respuesta.estado_usuarios>0){
				$('#id_estado option[value='+respuesta.estado_usuarios+']').attr('selected','selected');
				}

			if(respuesta.caduca_claves=='t'){
				
				$('#caduca_clave').attr('checked','checked');
			}

			if( typeof respuesta.clave_n_usuarios !== "undefined"){
				$('#clave_usuarios').val(respuesta.clave_n_claves).attr('readonly','readonly');
				$('#clave_usuarios_r').val(respuesta.clave_n_claves).attr('readonly','readonly');
				$('#lbl_cambiar_clave').text("Cambiar Clave:  ");
				$('#cambiar_clave').show();
					
					
				}
			if(respuesta.privilegios.length>0){
       	 $('#lista_roles').empty();
       	 $.each(respuesta.privilegios, function(k, v) {
       		 $('#lista_roles').append("<option value= " +v.id_rol +" >" + v.nombre_rol  + "</option>");
    		   
       	});
			}
		}).fail(function(respuesta) {

			$('#id_usuarios').val("");
			$('#nombre_usuarios').val("");
			$('#apellidos_usuarios').val("");
			$('#usuario_usuarios').val("");
			$('#fecha_nacimiento_usuarios').val("");
			$('#celular_usuarios').val("");
			$('#telefono_usuarios').val("");
			$('#correo_usuarios').val("");
			$('#clave_usuarios').val("");
			$('#clave_usuarios_r').val("");
			    			    
		  });

	});  
*/
 
 $( "#cedula_usuarios" ).focus(function() {
	  $("#mensaje_cedula_usuarios").fadeOut("slow");
   });
	
	$( "#nombre_usuarios" ).focus(function() {
		$("#mensaje_nombre_usuarios").fadeOut("slow");
	});

	$( "#apellidos_usuarios" ).focus(function() {
		$("#mensaje_apellido_usuarios").fadeOut("slow");
	});
	
	$('#usuario_usuarios').on('focus',function(){
		$("#mensaje_usuario_usuarios").fadeOut("slow");
	})

	$( "#fecha_nacimiento_usuarios" ).focus(function() {
		$("#mensaje_fecha_nacimiento_usuarios").fadeOut("slow");
	});
	
	$( "#clave_usuarios" ).focus(function() {
		$("#mensaje_clave_usuarios").fadeOut("slow");
	});
	$( "#clave_usuarios_r" ).focus(function() {
		$("#mensaje_clave_usuarios_r").fadeOut("slow");
	});
	
	$( "#celular_usuarios" ).focus(function() {
		$("#mensaje_celular_usuarios").fadeOut("slow");
	});
	
	$( "#correo_usuarios" ).focus(function() {
		$("#mensaje_correo_usuarios").fadeOut("slow");
	});
	
	$("#id_estado").on('focus',function() {
		$("#mensaje_id_estados").fadeOut("slow"); 
	})
	
	$("#id_rol_principal").focus(function() {
		$("#mensaje_id_rol_principal").fadeOut("slow"); 
	});
 
 $('#link_agregar_roles').click(function() { 
     $('#id_rol option').each(function() {
         copiarOpcion($(this).clone(), "#lista_roles");
     }); 
 });

 $('#link_eliminar_rol').click(function() { 
     $('#lista_roles option:selected').remove(); 
 });

 $('#link_eliminar_roles').click(function() { 
     $('#lista_roles option').each(function() {
         $(this).remove(); 
     }); 
 });

 $('#id_rol_principal').change(function() { 
 	copiarOpcion($('#id_rol_principal option:selected').clone(), "#lista_roles");
 });
 
 $("#Cancelar").on('click',function() 
			{
			 $("#cedula_usuarios").val("");
		     $("#nombre_usuarios").val("");
		     $("#clave_usuarios").val("");
		     $("#clave_usuarios_r").val("");
		     $("#telefono_usuarios").val("");
		     $("#celular_usuarios").val("");
		     $("#correo_usuarios").val("");
		     $("#id_rol").val("");
		     $("#id_estado").val("");
		     $("#fotografia_usuarios").val("");
		     $("#id_usuarios").val("");
		     
		    }); 
 
 $(".caducaclave").blur(function(){
		var clave = $("#clave_usuarios").val();
		var _id_usuarios = $("#id_usuarios").val();

		if($('#cambiar_clave').is(':checked')){
		$.ajax({
         beforeSend: function(objeto){
           $("#resultadosjq").html('...');
         },
         url: 'index.php?controller=Usuarios&action=ajax_caducaclave',
         type: 'POST',
         data: {clave_usuarios:clave,id_usuarios:_id_usuarios},
         success: function(x){
          if(x.trim()!=""){
         	 	$("#mensaje_clave_usuarios").text(x);
		    		$("#mensaje_clave_usuarios").fadeIn("slow");
	            	 $("#clave_usuarios").val("");
	            	 $("#clave_usuarios_r").val("");
              }
         },
        error: function(jqXHR,estado,error){
          $("#resultadosjq").html("Ocurrio un error al cargar la informacion de Usuarios..."+estado+"    "+error);
        }
      });
		}
     
});
 
 $('#cambiar_clave').change(
    function(){
    	
        if (this.checked) {

	           $('#clave_usuarios').removeAttr("readonly");
	           $('#clave_usuarios_r').removeAttr("readonly");
	           $('#clave_usuarios').val("");
	           $('#clave_usuarios_r').val("");
        }else{
        	$('#clave_usuarios').attr("readonly","readonly");
	        $('#clave_usuarios_r').attr("readonly","readonly");
	        $('#clave_usuarios').val($('#codigo_clave').val());
	        $('#clave_usuarios_r').val($('#codigo_clave').val());
	        }
});
 
 $('.nav-tabs a').on('shown.bs.tab', function(e){
     var currentTab = $(e.target).text();
     ct=currentTab;
     //console.log(currentTab);
     });
 
 $("#btExportar").click(function(){
	
	 get_data_for_xls();
	
});
 

 function copiarOpcion(opcion, destino) {
      var valor = $(opcion).val();
      if (($(destino + " option[value=" + valor + "] ").length == 0) && valor != 0 ) {
          $(opcion).appendTo(destino);
      }
  }

  function selecionarTodos(){
  	$("#lista_roles option").each(function(){
	      $(this).attr("selected", true);
		 });
   }
  

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
	
  setTimeout($.unblockUI, 3000); 
  
 }

      	   
 function load_usuarios(pagina){

	   var search=$("#search").val();
     var con_datos={
				  action:'ajax',
				  page:pagina
				  };
		  
   $("#load_registrados").fadeIn('slow');
   
   $.ajax({
             beforeSend: function(objeto){
               $("#load_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
             },
             url: 'index.php?controller=Usuarios&action=consulta_usuarios_activos&search='+search,
             type: 'POST',
             data: con_datos,
             success: function(x){
               $("#users_registrados").html(x);
               $("#load_registrados").html("");
               $("#tabla_usuarios").tablesorter(); 
               
             },
            error: function(jqXHR,estado,error){
              $("#users_registrados").html("Ocurrio un error al cargar la informacion de Usuarios..."+estado+"    "+error);
            }
          });


	   }

 function load_usuarios_inactivos(pagina){

	   var search=$("#search_inactivos").val();
     var con_datos={
				  action:'ajax',
				  page:pagina
				  };
		  
   $("#load_inactivos_registrados").fadeIn('slow');
   
   $.ajax({
             beforeSend: function(objeto){
               $("#load_inactivos_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');
             },
             url: 'index.php?controller=Usuarios&action=consulta_usuarios_inactivos&search='+search,
             type: 'POST',
             data: con_datos,
             success: function(x){
               $("#users_inactivos_registrados").html(x);
               $("#load_inactivos_registrados").html("");
               $("#tabla_usuarios_inactivos").tablesorter(); 
               
             },
            error: function(jqXHR,estado,error){
              $("#users_inactivos_registrados").html("Ocurrio un error al cargar la informacion de Usuarios..."+estado+"    "+error);
            }
          });
}

 function validarcedula(ObjValidador) {
	 
	 let elemento = $("#"+ObjValidador);
     var cad = $.trim(elemento.val());
     var total = 0;
     var longitud = cad.length;
     var longcheck = longitud - 1;

     if (cad !== "" && longitud === 10){
       for(i = 0; i < longcheck; i++){
         if (i%2 === 0) {
           var aux = cad.charAt(i) * 2;
           if (aux > 9) aux -= 9;
           total += aux;
         } else {
           total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
         }
       }

       total = total % 10 ? 10 - total % 10 : 0;

       if (cad.charAt(longitud-1) == total) {
     	  elemento.val(cad);
       }else{
    	   elemento.notify("Cedula no Valida",{ position:"buttom left", autoHideDelay: 2000});     	  
    	   elemento.val("").focus();
    	   return false;
       }
     }else{ elemento.val("").focus(); return false;}
     return true;
  }
 
 function numeros(e){
     
     key = e.keyCode || e.which;
     tecla = String.fromCharCode(key).toLowerCase();
     letras = "0123456789";
     especiales = [8,37,39,46];
  
     tecla_especial = false
     for(var i in especiales){
     if(key == especiales[i]){
      tecla_especial = true;
      break;
         } 
     }
  
     if(letras.indexOf(tecla)==-1 && !tecla_especial)
         return false;
  }
 
 var interval, mouseMove;

 $(document).mousemove(function(){
     //Establezco la última fecha cuando moví el cursor
     mouseMove = new Date();
     /* Llamo a esta función para que ejecute una acción pasado x tiempo
      después de haber dejado de mover el mouse (en este caso pasado 3 seg) */
     inactividad(function(){
     	window.location.href = "index.php?controller=Usuarios&amp;action=cerrar_sesion";
     }, 600);
   });

 $(document).scroll(function(){
     //Establezco la última fecha cuando moví el cursor
     mouseMove = new Date();
     /* Llamo a esta función para que ejecute una acción pasado x tiempo
      después de haber dejado de mover el mouse (en este caso pasado 3 seg) */
     inactividad(function(){
     	window.location.href = "index.php?controller=Usuarios&amp;action=cerrar_sesion";
     }, 600);
   });

   $(document).keydown(function(){
       //Establezco la última fecha cuando moví el cursor
       mouseMove = new Date();
       /* Llamo a esta función para que ejecute una acción pasado x tiempo
        después de haber dejado de mover el mouse (en este caso pasado 3 seg) */
       inactividad(function(){
       	window.location.href = "index.php?controller=Usuarios&amp;action=cerrar_sesion";
       }, 600);
     });

  

   /* Función creada para ejecutar una acción (callback), al pasar x segundos 
      (seconds) de haber dejado de mover el cursor */
   var inactividad = function(callback, seconds){
     //Elimino el intervalo para que no se ejecuten varias instancias
     clearInterval(interval);
     //Creo el intervalo
     interval = setInterval(function(){
        //Hora actual
        var now = new Date();
        //Diferencia entre la hora actual y la última vez que se movió el cursor
        var diff = (now.getTime()-mouseMove.getTime())/1000;
        //Si la diferencia es mayor o igual al tiempo que pasastes por parámetro
        if(diff >= seconds){
         //Borro el intervalo
         clearInterval(interval);
         //Ejecuto la función que será llamada al pasar el tiempo de inactividad
         callback();          
        }
     }, 200);
   }
   
   function get_data_for_xls()
   {
  	 var activeTab = $('.nav-tabs .active').text();
  	 var search=$("#search").val();
  	 	
  	 	
  			if (activeTab == "Usuarios Activos")
  			{
  				var users ="activos";
  				var con_datos={
  						  search:search,
  						  users:users,
  						  action:'ajax'
  						  };
  				$.ajax({
  					url:'index.php?controller=Usuarios&action=Exportar_usuariosExcel',
  			        type : "POST",
  			        async: true,			
  					data: con_datos,
  					success:function(data){
  						
  							
  						if(data.length>3)
  						   {
  				  var array = JSON.parse(data);
  				  var newArr = [];
  				   while(array.length) newArr.push(array.splice(0,7));
  				   console.log(newArr);
  				   
  				   var dt = new Date();
  				   var m=dt.getMonth();
  				   m+=1;
  				   var y=dt.getFullYear();
  				   var d=dt.getDate();
  				   var fecha=d.toString()+"/"+m.toString()+"/"+y.toString();
  				   var wb =XLSX.utils.book_new();
  				   wb.SheetNames.push("Reporte Usuarios Activos");
  				   var ws = XLSX.utils.aoa_to_sheet(newArr);
  				   wb.Sheets["Reporte Usuarios Activos"] = ws;
  				   var wbout = XLSX.write(wb,{bookType:'xlsx', type:'binary'});
  				   function s2ab(s) { 
  			            var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
  			            var view = new Uint8Array(buf);  //create uint8array as viewer
  			            for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
  			            return buf;    
  				   }
  			       saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'ReporteUsuariosActivos'+fecha+'.xlsx');
  					   }
  				   else{
  					   alert("No hay información para descargar");
  				   }
  					}
  				});
  				}
  			else
  			{
  				var users ="inactivos";
  				var con_datos={
  						  search:search,
  						  users:users,
  						  action:'ajax'
  						  };
  				$.ajax({
  					url:'index.php?controller=Usuarios&action=Exportar_usuariosExcel',
  			        type : "POST",
  			        async: true,			
  					data: con_datos,
  					success:function(data){
  						
  							
  						if(data.length>3)
  						   {
  				  var array = JSON.parse(data);
  				  var newArr = [];
  				   while(array.length) newArr.push(array.splice(0,7));
  				   console.log(newArr);
  				   
  				   var dt = new Date();
  				   var m=dt.getMonth();
  				   m+=1;
  				   var y=dt.getFullYear();
  				   var d=dt.getDate();
  				   var fecha=d.toString()+"/"+m.toString()+"/"+y.toString();
  				   var wb =XLSX.utils.book_new();
  				   wb.SheetNames.push("Reporte Usuarios Inactivos");
  				   var ws = XLSX.utils.aoa_to_sheet(newArr);
  				   wb.Sheets["Reporte Usuarios Inactivos"] = ws;
  				   var wbout = XLSX.write(wb,{bookType:'xlsx', type:'binary'});
  				   function s2ab(s) { 
  			            var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
  			            var view = new Uint8Array(buf);  //create uint8array as viewer
  			            for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
  			            return buf;    
  				   }
  			       saveAs(new Blob([s2ab(wbout)],{type:"application/octet-stream"}), 'ReporteUsuariosInactivos'+fecha+'.xlsx');
  					   }
  				   else{
  					   alert("No hay información para descargar");
  				   }
  					}
  				});
  				
  				
  				
  				}
   }
   
   
 
	   

   $('#frm_act_usuario').on('submit',function(e){
   	
   	//selecionarTodos();
   	
   	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
   	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;
   			    	
   	var id_rol  = $("#id_rol").val();
   	var id_estado  = $("#id_estado").val();
   	var id_rol_principal = $("#id_rol_principal").val();
   	
   	
   	if (document.getElementById('cedula_usuarios').value  == "")
   	{    	
   		$("#mensaje_cedula_usuarios").text("Introduzca Identificación");
   		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }    
   	
   	if (document.getElementById('nombre_usuarios').value == "")
   	{
       	
   		$("#mensaje_nombre_usuarios").text("Introduzca un Nombre");
   		$("#mensaje_nombre_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }
   	

   	if ( document.getElementById('apellidos_usuarios').value == "")
   	{
       	
   		$("#mensaje_apellido_usuarios").text("Introduzca un apellido");
   		$("#mensaje_apellido_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }
   	
   	if ( document.getElementById('usuario_usuarios').value == "")
   	{
       	
   		$("#mensaje_usuario_usuarios").text("Digite un Nombre de Usuario");
   		$("#mensaje_usuario_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }

   	/*para input fecha nacimiento*/				
   	if ($("#fecha_nacimiento_usuarios").val() == "")
   	{
       	
   		$("#mensaje_fecha_nacimiento_usuarios").text("Introduzca fecha Nacimiento");
   		$("#mensaje_fecha_nacimiento_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }

   	/*para input celular*/				
   	if ($("#celular_usuarios").val() == "")
   	{
       	
   		$("#mensaje_celular_usuarios").text("Introduzca Celular");
   		$("#mensaje_celular_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }	

   	/* input correos */	
   	if ($("#correo_usuarios").val() == "")
   	{
       	
   		$("#mensaje_correo_usuarios").text("Introduzca un correo");
   		$("#mensaje_correo_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }
   	else if (regex.test($('#correo_usuarios').val().trim()))
   	{
   		$("#mensaje_correo_usuarios").fadeOut("slow"); //Muestra mensaje de error
           
   	}

   	if ($("#clave_usuarios").val() == "")
   	{
   		
   		$("#mensaje_clave_usuarios").text("Introduzca una Clave");
   		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
           
       }else if ($("#clave_usuarios").val().length!=8){
       	
       	$("#mensaje_clave_usuarios").text("Introduzca 8 Digitos");
   		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
   	}	

   	if ($("#clave_usuarios_r").val() == "")
   	{
   		
   		$("#mensaje_clave_usuarios_r").text("Introduzca una Clave");
   		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
           return false
       }
   	
   	if ($("#clave_usuarios").val() != $("#clave_usuarios_r").val())
   	{
       	
   		$("#mensaje_clave_usuarios_r").text("Claves no Coinciden");
   		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }
   	
   	/*para input_select estado usuario*/
   	if (document.getElementById('id_estado').value == 0 )
   	{
       	
   		$("#mensaje_id_estados").text("Seleccione un Estado");
   		$("#mensaje_id_estados").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }
   	
   	if (document.getElementById('id_rol_principal').value == 0 )
   	{
       	
   		$("#mensaje_id_rol_principal").text("Seleccione Rol Principal");
   		$("#mensaje_id_rol_principal").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }
   	
   	//var parametros = $(this).serialize();
   	
   	var parametros = new FormData(this)
   	
   	parametros.append('action','ajax')
   	
   		
   	 $.ajax({
   		 beforeSend:function(){},
   		 url:'index.php?controller=Usuarios&action=InsertaUsuarios',
   		 type:'POST',
   		 data:parametros,
   		 dataType: 'json',
   		 contentType: false, //importante enviar este parametro en false
            processData: false,  //importante enviar este parametro en false
            
   		 success: function(respuesta){
   			 //$("#frm_act_usuario")[0].reset();
   			 //console.log(respuesta);
   			 if(respuesta.success==1){
   					    				
    				swal({title:"Usuarios",text:respuesta.mensaje,icon:"success"})
    	    		.then((value) => {
    	    			window.location.href= 'index.php?controller=Usuarios&action=actualizo_perfil';
    	    		});
               		
   					
   	          }
   			 
   			 if(respuesta.success==0){
   	                	
   	                	swal({
   	              		  title: "Usuarios",
   	              		  text: respuesta.mensaje,
   	              		  icon: "warning",
   	              		  button: "Aceptar",
   	              		});
   	             }			 
   			 
   		 },
   		 error: function(xhr,estado,error){    			 
   			 //console.log(xhr.responseText);
   			 var err=xhr.responseText
   			 
   			 swal({
           		  title: "Error",
           		  text: "Error conectar con el Servidor \n "+err,
           		  icon: "error",
           		  button: "Aceptar",
           		});
   	        }
   	 })
   	
   	/*parametros.forEach((value,key) => {
         console.log(key+" "+value)
   	});*/
   	
   	e.preventDefault();
   	
   })

  
  
  
  
  
  
  
  
   $('#frm_act_participes').on('submit',function(e){
   	
   	
   	
   	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
   	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;
   			    	
   	var id_rol  = $("#id_rol").val();
   	var id_estado  = $("#id_estado").val();
   	var id_rol_principal = $("#id_rol_principal").val();
	
	
	var id_genero_participes                       = $("#id_genero_participes").val();
	var id_entidad_patronal                       = $("#id_entidad_patronal").val();
	var id_entidad_patronal_coordinaciones                       = $("#id_entidad_patronal_coordinaciones").val();
	
	var id_estado_civil_participes                       = $("#id_estado_civil_participes").val();
	var numero_cedula_conyuge        					 = $("#numero_cedula_conyuge").val();
    var apellidos_conyuge        						 = $("#apellidos_conyuge").val();
    var nombres_conyuge        						 = $("#nombres_conyuge").val();
    var nombre_otra_coordinacion        		     = $("#nombre_otra_coordinacion").val();
   	
	
	var combo = document.getElementById("id_entidad_patronal_coordinaciones");
	var selected = combo.options[combo.selectedIndex].text;
	
	
	
   	if (document.getElementById('cedula_usuarios').value  == "")
   	{    	
   		$("#mensaje_cedula_usuarios").text("Introduzca Identificación");
   		$("#mensaje_cedula_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }    
   	
   	if (document.getElementById('nombre_usuarios').value == "")
   	{
       	
   		$("#mensaje_nombre_usuarios").text("Introduzca un Nombre");
   		$("#mensaje_nombre_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }
   	

   	if ( document.getElementById('apellidos_usuarios').value == "")
   	{
       	
   		$("#mensaje_apellido_usuarios").text("Introduzca un apellido");
   		$("#mensaje_apellido_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }
   	
   	if ( document.getElementById('usuario_usuarios').value == "")
   	{
       	
   		$("#mensaje_usuario_usuarios").text("Digite un Nombre de Usuario");
   		$("#mensaje_usuario_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }

   	/*para input fecha nacimiento*/				
   	if ($("#fecha_nacimiento_usuarios").val() == "")
   	{
       	
   		$("#mensaje_fecha_nacimiento_usuarios").text("Introduzca fecha Nacimiento");
   		$("#mensaje_fecha_nacimiento_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
       }

   	/*para input celular*/				
   	if ($("#celular_usuarios").val() == "")
   	{
       	
   		$("#mensaje_celular_usuarios").text("Introduzca Celular");
   		$("#mensaje_celular_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }	

   	/* input correos */	
   	if ($("#correo_usuarios").val() == "")
   	{
       	
   		$("#mensaje_correo_usuarios").text("Introduzca un correo");
   		$("#mensaje_correo_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }
   	else if (regex.test($('#correo_usuarios').val().trim()))
   	{
   		$("#mensaje_correo_usuarios").fadeOut("slow"); //Muestra mensaje de error
           
   	}

   	if ($("#clave_usuarios").val() == "")
   	{
   		
   		$("#mensaje_clave_usuarios").text("Introduzca una Clave");
   		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
           
       }else if ($("#clave_usuarios").val().length!=8){
       	
       	$("#mensaje_clave_usuarios").text("Introduzca 8 Digitos");
   		$("#mensaje_clave_usuarios").fadeIn("slow"); //Muestra mensaje de error
           return false
   	}	

   	if ($("#clave_usuarios_r").val() == "")
   	{
   		
   		$("#mensaje_clave_usuarios_r").text("Introduzca una Clave");
   		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
           return false
       }
   	
   	if ($("#clave_usuarios").val() != $("#clave_usuarios_r").val())
   	{
       	
   		$("#mensaje_clave_usuarios_r").text("Claves no Coinciden");
   		$("#mensaje_clave_usuarios_r").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }
   	
   	/*para input_select estado usuario*/
   	if (document.getElementById('id_estado').value == 0 )
   	{
       	
   		$("#mensaje_id_estados").text("Seleccione un Estado");
   		$("#mensaje_id_estados").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }
   	
   	if (document.getElementById('id_rol_principal').value == 0 )
   	{
       	
   		$("#mensaje_id_rol_principal").text("Seleccione Rol Principal");
   		$("#mensaje_id_rol_principal").fadeIn("slow"); //Muestra mensaje de error
           return false;
       }
   	
	if (id_genero_participes == 0 )
   	{
       	
   		$("#mensaje_id_genero_participes").text("Seleccione");
   		$("#mensaje_id_genero_participes").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
	if (id_estado_civil_participes == 0 )
   	{
       	
   		$("#mensaje_id_estado_civil_participes").text("Seleccione");
   		$("#mensaje_id_estado_civil_participes").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
   if(id_estado_civil_participes != 1 && id_estado_civil_participes != 4 && id_estado_civil_participes != 3) {

	
	if (numero_cedula_conyuge == "" )
   	{
       	
   		$("#mensaje_numero_cedula_conyuge").text("Ingrese Cedula");
   		$("#mensaje_numero_cedula_conyuge").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
	if (apellidos_conyuge == "" )
   	{
       	
   		$("#mensaje_apellidos_conyuge").text("Ingrese Apellidos");
   		$("#mensaje_apellidos_conyuge").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
	if (nombres_conyuge == "" )
   	{
       	
   		$("#mensaje_nombres_conyuge").text("Ingrese Nombres");
   		$("#mensaje_nombres_conyuge").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
	}
	
	
	
	if (id_entidad_patronal == 0 )
   	{
       	
   		$("#mensaje_id_entidad_patronal").text("Seleccione");
   		$("#mensaje_id_entidad_patronal").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
	
	if (id_entidad_patronal_coordinaciones == 0 )
   	{
       	
   		$("#mensaje_id_entidad_patronal_coordinaciones").text("Seleccione");
   		$("#mensaje_id_entidad_patronal_coordinaciones").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
	
	  if(selected == 'OTRA')
	  {
	   
		   if (nombre_otra_coordinacion == "" )
			{
				
				$("#mensaje_nombre_otra_coordinacion").text("Ingrese");
				$("#mensaje_nombre_otra_coordinacion").fadeIn("slow"); //Muestra mensaje de error
				   return false;
			}
	   
	  }
   	
	
	
	
	
   	//var parametros = $(this).serialize();
   	
   	var parametros = new FormData(this)
   	
   	parametros.append('action','ajax')
   	
   		
   	 $.ajax({
   		 beforeSend:function(){},
   		 url:'index.php?controller=Usuarios&action=ActualizaParticipes',
   		 type:'POST',
   		 data:parametros,
   		 dataType: 'json',
   		 contentType: false, //importante enviar este parametro en false
            processData: false,  //importante enviar este parametro en false
            
   		 success: function(respuesta){
   			 //$("#frm_act_usuario")[0].reset();
   			 //console.log(respuesta);
   			 if(respuesta.success==1){
   					    				
    				swal({title:"Usuarios",text:respuesta.mensaje,icon:"success"})
    	    		.then((value) => {
    	    			window.location.href= 'index.php?controller=Usuarios&action=actualizo_perfil';
    	    		});
               		
   					
   	          }
   			 
   			 if(respuesta.success==0){
   	                	
   	                	swal({
   	              		  title: "Usuarios",
   	              		  text: respuesta.mensaje,
   	              		  icon: "warning",
   	              		  button: "Aceptar",
   	              		});
   	             }			 
   			 
   		 },
   		 error: function(xhr,estado,error){    			 
   			 //console.log(xhr.responseText);
   			 var err=xhr.responseText
   			 
   			 swal({
           		  title: "Error",
           		  text: "Error conectar con el Servidor \n "+err,
           		  icon: "error",
           		  button: "Aceptar",
           		});
   	        }
   	 })
   	
   	/*parametros.forEach((value,key) => {
         console.log(key+" "+value)
   	});*/
   	
   	e.preventDefault();
   	
   })

 
 
  $( "#id_genero_participes" ).focus(function() {
	  $("#mensaje_id_genero_participes").fadeOut("slow");
   });
	
	$( "#id_estado_civil_participes" ).focus(function() {
		$("#mensaje_id_estado_civil_participes").fadeOut("slow");
	});
	
	
	 $( "#numero_cedula_conyuge" ).focus(function() {
	  $("#mensaje_numero_cedula_conyuge").fadeOut("slow");
   });
	
	$( "#apellidos_conyuge" ).focus(function() {
		$("#mensaje_apellidos_conyuge").fadeOut("slow");
	});
	
	 $( "#nombres_conyuge" ).focus(function() {
	  $("#mensaje_nombres_conyuge").fadeOut("slow");
   });
	
	$( "#id_entidad_patronal" ).focus(function() {
		$("#mensaje_id_entidad_patronal").fadeOut("slow");
	});
	
	$( "#id_entidad_patronal_coordinaciones" ).focus(function() {
		$("#mensaje_id_entidad_patronal_coordinaciones").fadeOut("slow");
	});
	
	$( "#nombre_otra_coordinacion" ).focus(function() {
		$("#mensaje_nombre_otra_coordinacion").fadeOut("slow");
	});
	
	