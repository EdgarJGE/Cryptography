/*========================================
=            EDITAR HISTORIAL            =
========================================*/

$(".tablas").on("click", ".btnEditarHistorial", function(){

  var idHistorial = $(this).attr("idHistorial");

  var datos = new FormData();
  datos.append("idHistorial", idHistorial);

    $.ajax({

		url:"ajax/historial.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDes){

			$("#idEditarHistorial").val(respuestaDes["idhistorial"]);
			$("#editarTitulo").val(respuestaDes["titulo"]);
			$("#editarDescripcionHistorial").val(respuestaDes["descripcion"]);
          
    	}

    })

})

/*=====  End of EDITAR HISTORIAL  ======*/

/*==========================================
=            ELIMINAR HISTORIAL            =
==========================================*/

$(".tablas").on("click", ".btnEliminarHistorial", function(){

  var idHistorial = $(this).attr("idHistorial");
  var idPaciente = $(this).attr("idPaciente");
  

  Swal.fire({

    title: '¿Está seguro de borrar el historial?',
    text: "¡Si no lo está puede cancelar la accíón!",
    icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar historial!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=historial&idPaciente="+idPaciente+"&idHistorial="+idHistorial;

        }

  })  

})

/*=====  End of ELIMINAR HISTORIAL  ======*/

