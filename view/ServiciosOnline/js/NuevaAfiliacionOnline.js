$(document).ready(function(){

	  $('[data-mask]').inputmask();
	   
	   
	   $('#fecha_nacimiento_afiliados').inputmask(
			   'yyyy/mm/dd', { 
				   'placeholder': 'yyyy/mm/dd',				   
				   'clearIncomplete': true,
				   'oncomplete': function () {
					   //console.log($(this).val())
				        if($(this).val() >= $('[data-fechaactual]').data('fechaactual')){
				        	$('#mensaje_fecha_nacimiento_afiliados').text('Fecha no valida')
				        	$('#mensaje_fecha_nacimiento_afiliados').fadeIn()
				        	$(this).val('')
				        }else{
				        	$('#mensaje_fecha_nacimiento_afiliados').fadeOut()
				        }
				    }
			   })
	
}); 
	
	
	
  
   $('#frm_afiliacion').on('submit',function(e){
   	
   	
   	
   	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
   	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;
   	
	var cedula_afiliados                       = $("#cedula_afiliados").val();
	var nombre_afiliados                       = $("#nombre_afiliados").val();
	var apellidos_afiliados        		     = $("#apellidos_afiliados").val();
   	var correo_afiliados  						= $("#correo_afiliados").val();
	var celular_afiliados  						= $("#celular_afiliados").val();
	var telefono_afiliados                       = $("#telefono_afiliados").val();
	var fecha_nacimiento_afiliados                       = $("#fecha_nacimiento_afiliados").val();
	var id_entidad_patronal                       = $("#id_entidad_patronal").val();
	var id_entidad_patronal_coordinaciones                       = $("#id_entidad_patronal_coordinaciones").val();
	var nombre_otra_coordinacion        		     = $("#nombre_otra_coordinacion").val();
   	var id_bancos 									 = $("#id_bancos").val();
	var tipo_cuenta_afiliados  						= $("#tipo_cuenta_afiliados").val();
	var numero_cuenta_afiliados  					= $("#numero_cuenta_afiliados").val();
	
	var combo = document.getElementById("id_entidad_patronal_coordinaciones");
	var selected = combo.options[combo.selectedIndex].text;
	
   	if (cedula_afiliados  == "")
   	{    	
   		$("#mensaje_cedula_afiliados").text("Introduzca Cedula");
   		$("#mensaje_cedula_afiliados").fadeIn("slow"); //Muestra mensaje de error
           return false
    }  else 
	{

	if(isNaN(cedula_afiliados)){

			$("#mensaje_cedula_afiliados").text("Ingrese Solo Números");
			$("#mensaje_cedula_afiliados").fadeIn("slow"); //Muestra mensaje de error
			return false;

		}
		
		if(cedula_afiliados.length==10){

			$("#mensaje_cedula_afiliados").fadeOut("slow"); //Muestra mensaje de error
		}else{
			
			$("#mensaje_cedula_afiliados").text("Ingrese 10 dígitos");
			$("#mensaje_cedula_afiliados").fadeIn("slow"); //Muestra mensaje de error
			return false;
		}
	}  
   	
	
   	if (nombre_afiliados == "")
   	{
       	
   		$("#mensaje_nombre_afiliados").text("Introduzca Nombres");
   		$("#mensaje_nombre_afiliados").fadeIn("slow"); //Muestra mensaje de error
           return false
       }
   	

   	if (apellidos_afiliados == "")
   	{
       	
   		$("#mensaje_apellidos_afiliados").text("Introduzca Apellidos");
   		$("#mensaje_apellidos_afiliados").fadeIn("slow"); //Muestra mensaje de error
           return false
    }
   	
	
    if (correo_afiliados == "")
	{
		$("#mensaje_correo_afiliados").text("Introduzca un correo");
		$("#mensaje_correo_afiliados").fadeIn("slow"); //Muestra mensaje de error
		return false;
	}
	else if (regex.test($('#correo_afiliados').val().trim()))
	{
		$("#mensaje_correo_afiliados").fadeOut("slow"); //Muestra mensaje de error
	}
	else 
	{
		$("#mensaje_correo_afiliados").text("Introduzca un correo Valido");
		$("#mensaje_correo_afiliados").fadeIn("slow"); //Muestra mensaje de error
		return false;	
	}
	
	
	if (celular_afiliados  == "")
   	{    	
   		$("#mensaje_celular_afiliados").text("Introduzca # Celular");
   		$("#mensaje_celular_afiliados").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }  else 
	{

	   
			$("#mensaje_celular_afiliados").fadeOut("slow"); //Muestra mensaje de error
		
	}  
	
	
   	if ($("#fecha_nacimiento_afiliados").val() == "")
   	{
       	
   		$("#mensaje_fecha_nacimiento_afiliados").text("Introduzca fecha Nacimiento");
   		$("#mensaje_fecha_nacimiento_afiliados").fadeIn("slow"); //Muestra mensaje de error
           return false;
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
   	
	
	
	if (id_bancos == 0 )
   	{
       	
   		$("#mensaje_id_bancos").text("Seleccione");
   		$("#mensaje_id_bancos").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
   if (tipo_cuenta_afiliados == 0 )
   	{
       	
   		$("#mensaje_tipo_cuenta_afiliados").text("Seleccione");
   		$("#mensaje_tipo_cuenta_afiliados").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
	if (numero_cuenta_afiliados == "" )
   	{
       	
   		$("#mensaje_numero_cuenta_afiliados").text("Ingrese");
   		$("#mensaje_numero_cuenta_afiliados").fadeIn("slow"); //Muestra mensaje de error
           return false;
    }
	
	
	
   	//var parametros = $(this).serialize();
   	
   	var parametros = new FormData(this)
   	
   	parametros.append('action','ajax')
   	
   		
   	 $.ajax({
   		 beforeSend:function(){},
   		 url:'index.php?controller=Iniciar&action=NuevaAfiliacion',
   		 type:'POST',
   		 data:parametros,
   		 dataType: 'json',
   		 contentType: false, //importante enviar este parametro en false
            processData: false,  //importante enviar este parametro en false
            
   		 success: function(respuesta){
   			 //$("#frm_act_usuario")[0].reset();
   			 //console.log(respuesta);
   			 if(respuesta.success==1){
   					    				
    				swal({title:"Nueva Afiliación",text:respuesta.mensaje,icon:"success"})
    	    		.then((value) => {
    	    			//window.location.href= 'index.php?controller=Iniciar&action=print&id='+respuesta.id;
						window.open("index.php?controller=Iniciar&action=print&id="+respuesta.id,"_self")
    	    		});
               		
   	          }
   			 
   			 if(respuesta.success==0){
   	                	
   	                	swal({
   	              		  title: "Nueva Afiliación",
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

 	
 
  $( "#cedula_afiliados" ).focus(function() {
	  $("#mensaje_cedula_afiliados").fadeOut("slow");
   });
	
	$( "#nombre_afiliados" ).focus(function() {
		$("#mensaje_nombre_afiliados").fadeOut("slow");
	});
	
	
	 $( "#apellidos_afiliados" ).focus(function() {
	  $("#mensaje_apellidos_afiliados").fadeOut("slow");
   });
	
	$( "#correo_afiliados" ).focus(function() {
		$("#mensaje_correo_afiliados").fadeOut("slow");
	});
	
	 $( "#celular_afiliados" ).focus(function() {
	  $("#mensaje_celular_afiliados").fadeOut("slow");
   });
	
	$( "#telefono_afiliados" ).focus(function() {
		$("#mensaje_telefono_afiliados").fadeOut("slow");
	});
	
	$( "#fecha_nacimiento_afiliados" ).focus(function() {
		$("#mensaje_fecha_nacimiento_afiliados").fadeOut("slow");
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
	
	$( "#id_bancos" ).focus(function() {
		$("#mensaje_id_bancos").fadeOut("slow");
	});
	
	$( "#tipo_cuenta_afiliados" ).focus(function() {
		$("#mensaje_tipo_cuenta_afiliados").fadeOut("slow");
	});
	
	$( "#numero_cuenta_afiliados" ).focus(function() {
		$("#mensaje_numero_cuenta_afiliados").fadeOut("slow");
	});
	
	

			$("#id_entidad_patronal").change(function(){
			
	            // obtenemos el combo de resultado combo 2
	           var $id_entidad_patronal_coordinaciones = $("#id_entidad_patronal_coordinaciones");
	       	

	            // lo vaciamos
	           var id_entidad_patronal = $(this).val();

	          
	          
	            if(id_entidad_patronal != 0)
	            {
	            	 $id_entidad_patronal_coordinaciones.empty();
	            	
	            	 var datos = {
	                   	   
	            			 id_entidad_patronal:$(this).val()
	                  };
	             
	            	
	         	   $.post("index.php?controller=ServiciosOnline&action=devuelveCordinacion", datos, function(resultado) {

	          		  if(resultado.length==0)
	          		   {
	          				$id_entidad_patronal_coordinaciones.append("<option value='0' >--Seleccione--</option>");	
	             	   }else{
	             		    $id_entidad_patronal_coordinaciones.append("<option value='0' >--Seleccione--</option>");
	          		 		$.each(resultado, function(index, value) {
	          		 			$id_entidad_patronal_coordinaciones.append("<option value= " +value.id_entidad_patronal_coordinaciones +" >" + value.nombre_entidad_patronal_coordinaciones  + "</option>");	
	                     		 });
	             	   }	
	            	      
	         		  }, 'json');


	            }else{

	            	var id_entidad_patronal_coordinaciones=$("#id_entidad_patronal_coordinaciones");
	            	id_entidad_patronal_coordinaciones.find('option').remove().end().append("<option value='0' >--Seleccione--</option>").val('0');
	            	
	            	
	            	
	            }
	            

			});
		
		
		
		function seleccion()
		{
		
		var combo = document.getElementById("id_entidad_patronal_coordinaciones");
		var selected = combo.options[combo.selectedIndex].text;
		
		
              if(selected == 'OTRA')
              {
           	   $("#div_otra").fadeIn("slow");
              }
           	  else
              {

				    if(selected=='--Seleccione--'){

						   $("#div_otra").fadeOut("slow");
					}else{
						   $("#nombre_otra_coordinacion").val("");
			               $("#div_otra").fadeOut("slow");
					}

              }
		
		}
