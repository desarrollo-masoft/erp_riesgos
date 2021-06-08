$(document).ready(function(){

	load_solicitudes();
	
	init();
	
	
}); 
	

	

//variable de vista creditos
var view	= view || {};
view.txt_busqueda	= $("#tbl_listado_solicitudes");
//variable para dataTable
var viewTable = viewTable || {};

viewTable.tabla  = $("#tbl_listado_solicitudes");
viewTable.nombre = 'tbl_listado_solicitudes';
//viewTable.params = { 'input_search': view.txt_busqueda.val() };
viewTable.contenedor = $("#div_listado_solicitudes");


function init(){
	
	
try {
	
	
	iniciar_eventos();
	
		
	} catch (e) {
		// TODO: handle exception
		console.log("ERROR AL cargar dataTable");
	}
	
	
	
}



var iniciar_eventos = function(){
	
	viewTable.contenedor.tooltip({
	    selector: 'a.showpdf',
	    trigger: 'hover',
	    html: true,
        delay: {"show": 500, "hide": 0},
        placement:"left"
	});
		
}

/********************************************************** EMPIEZA PROCEOSOS CON DATATABLE *************************************************/

var idioma_espanol = {
	    "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla &#128543; ",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }
}

var load_solicitudes	= function(){
	
	var dataSend = { 'input_search': view.txt_busqueda.val()};
	
	viewTable.tabla	=  $( '#'+viewTable.nombre ).DataTable({
	    'processing': true,
	    'serverSide': true,
	    'serverMethod': 'post',
	    'destroy' : true,
	    'ajax': {
	        'url':'index.php?controller=Iniciar&action=dtCargarSolicitudes',
	        'data': function ( d ) {
	            return $.extend( {}, d, dataSend );
	            },
            'dataSrc': function ( json ) {                
                return json.data;
              }
	    },	
	    'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
	    'order': [[ 7, "asc" ]],
	    'columns': [	    	    
	    	{ data: 'cedula', orderable: true },
    		{ data: 'apellidos', orderable: true},
    		{ data: 'nombres', orderable: true },
    		{ data: 'celular', orderable: false },
    		{ data: 'correo', orderable: false },
    		{ data: 'direccion', orderable: false },
    		{ data: 'coordinacion', orderable: false },
    		{ data: 'fecha_registro', orderable: true },
    		{ data: 'opciones', orderable: false }
    		    		
	    ],
	    'columnDefs': [
	        {className: "dt-center", targets:[0] },
	        {sortable: true, targets: [ 0,1,2,7 ] }
	      ],
		'scrollY': "50vh",
        'scrollCollapse':true,
        'fixedHeader': {
            header: true,
            footer: true
        },
        //dom: "<'row'<'col-sm-6'<'box-tools pull-right'B>>><'row'<'col-sm-6'l><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'<'#colvis'>p>>",
        dom: '<"html5buttons">lfrtipB',
        buttons: [
        //	{ "extend": 'excelHtml5',  "titleAttr": 'Excel', "text":'<span class="fa fa-file-excel-o fa-2x fa-fw"></span>',"className": 'no-padding btn btn-default btn-sm' }
        
        	 { extend: 'copy'},
             {extend: 'csv'},
             {extend: 'excel', title: 'Solicitudes Nueva Afiliación'},
             {extend: 'pdf', title: 'Solicitudes Nueva Afiliación'},

             {extend: 'print',
              customize: function (win){
                     $(win.document.body).addClass('white-bg');
                     $(win.document.body).css('font-size', '10px');

                     $(win.document.body).find('table')
                             .addClass('compact')
                             .css('font-size', 'inherit');
             }
             }
       ],
        
       
        
        'language':idioma_espanol
	 });
		
}


