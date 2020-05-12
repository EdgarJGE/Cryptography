/*=============================================================
=            CARGAR LA TABLA DINAMICA DE SERVICIOS            =
=============================================================*/

// $.ajax({

// 	url: "ajax/datatable-servicios.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

/*=====  End of CARGAR LA TABLA DINAMICA DE SERVICIOS  ======*/

var perfilOculto = $("#perfilOculto").val();

$('.tablaServicios').DataTable( {
    "ajax": "ajax/datatable-servicios.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
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
			}

	}

} );

/*=======================================
=            EDITAR SERVICIO            =
=======================================*/

$(".tablaServicios tbody").on("click", "button.btnEditarServicio", function(){

	var idServicio = $(this).attr("idServicio");
	
	var datos = new FormData();
    datos.append("idServicio", idServicio);

	$.ajax({
	
		url:"ajax/servicios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			$("#idServicio").val(respuesta["idservicio"]);
			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#editarPrecio").val(respuesta["precio"]);

	  	}
	
	})
	
})

/*=====  End of EDITAR SERVICIO  ======*/

/*=======================================
=            BORRAR SERVICIO            =
=======================================*/

$(".tablaServicios tbody").on("click", "button.btnEliminarServicio", function(){

	var idServicio = $(this).attr("idServicio")

	Swal.fire({

		title: '¿Está seguro de borrar el servicio?',
		text: "¡Si no lo está puede cancelar la accíón!",
		icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result){
        if (result.value) {

        	window.location = "index.php?ruta=servicios&idServicio="+idServicio;

        }


	})


})

/*=====  End of BORRAR SERVICIO  ======*/




