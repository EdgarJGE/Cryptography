/*==============================================
=            VARIABLE LOCAL STORAGE            =
==============================================*/

if(localStorage.getItem("capturarRango") != null){

	$("#daterange-btn span").html(localStorage.getItem("capturarRango"));

}else{

	$("#daterange-btn span").html('<i class="fa fa-calendar"></i> Rango de fecha');

}

/*=====  End of VARIABLE LOCAL STORAGE  ======*/

/*=============================================================
=            CARGAR LA TABLA DINAMICA DE SERVICIOS            =
=============================================================*/

// $.ajax({

// 	url: "ajax/datatable-ventas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

/*=====  End of CARGAR LA TABLA DINAMICA DE SERVICIOS  ======*/

$('.tablaVentas').DataTable( {
    "ajax": "ajax/datatable-ventas.ajax.php",
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

/*=====================================================================
=            AGREGAR SERVICIOS A LA VENTANA DESDE LA TABLA            =
=====================================================================*/

$(".tablaVentas tbody").on("click", "button.agregarServicio", function(){

	var idServicio = $(this).attr("idServicio");

	/*====================================================================
	=            DESACTIVAMOS BOTON PARA NO REPETIR SERVICIOS            =
	====================================================================*/
	
	$(this).removeClass("btn-primary agregarServicio");

	$(this).addClass("btn-default");
	
	/*=====  End of DESACTIVAMOS BOTON PARA NO REPETIR SERVICIOS  ======*/
	
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

      	    var descripcion = respuesta["descripcion"];
          	var precio = respuesta["precio"];
        	
        	$(".nuevoServicio").append(

          	'<div class="row" style="padding:6px">'+
          	  '<!-- Descripcion del servicio -->'+
              '<div class="col-6">'+
            
                '<div class="input-group">'+

                  '<div class="input-group-prepend">'+
                    '<button type="button" class="btn btn-danger quitarServicio" idServicio="'+idServicio+'"><i class="fas fa-times"></i></button>'+
                  '</div>'+
                  
                  '<input type="text" class="form-control nuevaDescripcionServicio" idServicio="'+idServicio+'" name="agregarServicio" value="'+descripcion+'" readonly required>'+

                '</div>'+

              '</div>'+

              '<!-- Cantidad -->'+
              '<div class="col-3">'+
                
                  '<input type="number" class="form-control nuevaCantidadServicio" name="nuevaCantidadServicio" min="1" value="1" required>'+
                
              '</div>'+

              '<!-- Precio del servicio -->'+
              '<div class="col-3 ingresoPrecio">'+
                '<div class="input-group">'+
                  '<div class="input-group-prepend">'+
                    '<span class="input-group-text"><i class="ion ion-social-usd"></i></span>'+
                  '</div>'+
                  '<input type="text" class="form-control nuevoPrecioServicio" precioReal="'+precio+'" name="nuevoPrecioServicio" value="'+precio+'" required readonly>'+
                '</div>'+
                
              '</div>'+

            '</div>') 

        	// SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios()

            // AGRUPAR PRODUCTOS EN FORMATO JSON
            listarServicios()

            // PONER FORMATO AL PRECIO DE LOS SERVICIOS
            $(".nuevoPrecioServicio").number(true, 2);

      	}

	})

});

/*=====  End of AGREGAR SERVICIOS A LA VENTANA DESDE LA TABLA  ======*/

/*===========================================================================
=            CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA            =
===========================================================================*/

$(".tablaVentas").on("draw.dt", function(){

	if(localStorage.getItem("quitarServicio") != null){

		var listaIdServicios = JSON.parse(localStorage.getItem("quitarServicio"));

		for(var i = 0; i < listaIdServicios.length; i++){

			$("button.recuperarBoton[idServicio='"+listaIdServicios[i]["idServicio"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idServicio='"+listaIdServicios[i]["idServicio"]+"']").addClass('btn-primary agregarServicio');

		}

	}

})

/*=====  End of CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA  ======*/

/*======================================================================
=            QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTON            =
======================================================================*/

var idQuitarServicio = [];

localStorage.removeItem("quitarServicio");

$(".formularioVenta").on("click", "button.quitarServicio", function(){

	$(this).parent().parent().parent().parent().remove();

	var idServicio = $(this).attr("idServicio");

	/*================================================================================
	=            ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR            =
	================================================================================*/
	
	if(localStorage.getItem("quitarServicio") == null){

		idQuitarServicio = [];
	
	}else{

		idQuitarServicio.concat(localStorage.getItem("quitarServicio"))

	}

	idQuitarServicio.push({"idServicio":idServicio});

	localStorage.setItem("quitarServicio", JSON.stringify(idQuitarServicio));
	
	/*=====  End of ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR  ======*/
	
	$("button.recuperarBoton[idServicio='"+idServicio+"']").removeClass('btn-default');

	$("button.recuperarBoton[idServicio='"+idServicio+"']").addClass('btn-primary agregarServicio');

	if($(".nuevoServicio").children().length == 0){

		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);

	}else{

		// SUMAR TOTAL DE PRECIOS
    	sumarTotalPrecios()

    	// AGRUPAR PRODUCTOS EN FORMATO JSON
        listarServicios()

	}

})

/*=====  End of QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTON  ======*/

/*============================================================
=            AGREGANDO BOTON DISPOSITIVOS MOVILES            =
============================================================*/

var numServicio = 0;

$(".btnAgregarServicio").click(function(){

	numServicio ++;

	var datos = new FormData();
	datos.append("traerServicios", "ok");

	$.ajax({

		url:"ajax/servicios.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      		$(".nuevoServicio").append(

          	'<div class="row" style="padding:6px">'+
          	  '<!-- Descripcion del servicio -->'+
              '<div class="col-6">'+
            
                '<div class="input-group">'+

                  '<div class="input-group-prepend">'+
                    '<button type="button" class="btn btn-danger quitarServicio" idServicio><i class="fas fa-times"></i></button>'+
                  '</div>'+
                  
                  '<select class="form-control nuevaDescripcionServicio" id="servicio'+numServicio+'" idServicio name="nuevaDescripcionServicio" required>'+
                  '<option>Seleccione el servicio</option>'+

                  '</select>'+

                '</div>'+

              '</div>'+

              '<!-- Cantidad -->'+
              '<div class="col-3 ingresoCantidad">'+
                
                  '<input type="number" class="form-control nuevaCantidadServicio" name="nuevaCantidadServicio" min="1" value="1" required>'+
                
              '</div>'+

              '<!-- Precio del servicio -->'+
              '<div class="col-3 ingresoPrecio">'+
                '<div class="input-group">'+
                  '<div class="input-group-prepend">'+
                    '<span class="input-group-text"><i class="ion ion-social-usd"></i></span>'+
                  '</div>'+
                  '<input type="text" class="form-control nuevoPrecioServicio" precioReal="" name="nuevoPrecioServicio" required readonly>'+
                '</div>'+
                
              '</div>'+

            '</div>');

            // AGREGAR LOS SERVICIOS AL SELECT

  			respuesta.forEach(funcionForEach);

         	function funcionForEach(item, index){

	     		$("#servicio"+numServicio).append(

					'<option idServicio="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
	     		)

         	}

         	// SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios()

            // PONER FORMATO AL PRECIO DE LOS SERVICIOS
            $(".nuevoPrecioServicio").number(true, 2);
      			
      	}

    })

})

/*=====  End of AGREGANDO BOTON DISPOSITIVOS MOVILES  ======*/

/*===============================================================
=            SELECCIONAR PRODUCTO DESDE DISP MOVILES            =
===============================================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionServicio", function(){

	var nombreServicio = $(this).val();

	var nuevoPrecioServicio = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioServicio");

	var datos = new FormData();
    datos.append("nombreServicio", nombreServicio);

	  $.ajax({

     	url:"ajax/servicios.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      		
      		$(nuevoPrecioServicio).val(respuesta["precio"]);
      		$(nuevoPrecioServicio).attr("precioReal", respuesta["precio"]);

      		// SUMAR TOTAL DE PRECIOS
            sumarTotalPrecios()

            // AGRUPAR PRODUCTOS EN FORMATO JSON
            listarServicios()

      	}
      	    
    })

})

/*=====  End of SELECCIONAR PRODUCTO DESDE DISP MOVILES  ======*/

/*=============================================
=            MODIFICAR LA CANTIDAD            =
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadServicio", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioServicio");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	// SUMAR TOTAL DE PRECIOS
    sumarTotalPrecios()

    // AGRUPAR PRODUCTOS EN FORMATO JSON
    listarServicios()

})

/*=====  End of MODIFICAR LA CANTIDAD  ======*/

/*===============================================
=            SUMAR TODOS LOS PRECIOS            =
===============================================*/

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioServicio");
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	
}

/*=====  End of SUMAR TODOS LOS PRECIOS  ======*/

/*===============================================
=            FORMATO AL PRECIO FINAL            =
===============================================*/

$("#nuevoTotalVenta").number(true, 2);

/*=====  End of FORMATO AL PRECIO FINAL  ======*/

/*==================================================
=            SELECCIONAR METODO DE PAGO            =
==================================================*/

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if(metodo == "Efectivo"){

		$(this).parent().parent().removeClass("col-6");

		$(this).parent().parent().addClass("col-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").removeClass("col-6")

		$(this).parent().parent().parent().children(".cajasMetodoPago").addClass("col-4")

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			// CAJA DINERO PAGADO
            '<div class="input-group">'+
              '<div class="input-group-prepend">'+
                '<span class="input-group-text"><i class="ion ion-social-usd"></i></span>'+
              '</div>'+
              '<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="00000" required>'+
            '</div>');

		$(this).parent().parent().parent().children(".cajasMetodoPago2").html(

	        // CAJA DINERO CAMBIO
            '<div class="input-group">'+
              '<div class="input-group-prepend">'+
                '<span class="input-group-text"><i class="ion ion-social-usd"></i></span>'+
              '</div>'+
              '<input type="text" class="form-control" id="nuevoCambioEfectivo" placeholder="00000" required readonly>'+
            '</div>');


		// AGREGAR FORMATO AL PRECIO
		$('#nuevoValorEfectivo').number( true, 2);
    	$('#nuevoCambioEfectivo').number( true, 2);

    	// LISTAR METODO DE PAGO EN LA ENTRADA
    	listarMetodos()

	}else{

		$(this).parent().parent().removeClass("col-4");

		$(this).parent().parent().addClass("col-6");

		$(this).parent().parent().parent().children(".cajasMetodoPago").removeClass("col-4")

		$(this).parent().parent().parent().children(".cajasMetodoPago").addClass("col-6")

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			'<div class="input-group">'+

              '<div class="input-group-prepend">'+
                '<span class="input-group-text"><i class="fas fa-lock"></i></span>'+
              '</div>'+
              '<input type="text" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción" required>'+

            '</div>');

		$(this).parent().parent().parent().children(".cajasMetodoPago2").children().remove();

	}

})

/*=====  End of SELECCIONAR METODO DE PAGO  ======*/

/*==========================================
=            CAMBIO EN EFECTIVO            =
==========================================*/

$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('.cajasMetodoPago2').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})

/*=====  End of CAMBIO EN EFECTIVO  ======*/

/*==========================================
=            CAMBIO TRANSACCIÓN            =
==========================================*/

$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){

	// LISTAR METODO EN LA ENTRADA
    listarMetodos()
	
})

/*=====  End of CAMBIO TRANSACCIÓN  ======*/

/*===================================================
=            AGRUPAR TODOS LOS SERVICIOS            =
===================================================*/

function listarServicios(){

	var listaServicios = [];

	var descripcion = $(".nuevaDescripcionServicio");

	var cantidad = $(".nuevaCantidadServicio");

	var precio = $(".nuevoPrecioServicio");

	for(var i = 0; i < descripcion.length; i++){

		listaServicios.push({ "id" : $(descripcion[i]).attr("idServicio"), 
		
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()})

	}
	
	$("#listaServicios").val(JSON.stringify(listaServicios));
	
}

/*=====  End of AGRUPAR TODOS LOS SERVICIOS  ======*/

/*=============================================
=            LISTAR METODO DE PAGO            =
=============================================*/

function listarMetodos(){

	var listarMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo"){

		$("#listaMetodoPago").val("Efectivo");

	}else{

		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());

	}

}

/*=====  End of LISTAR METODO DE PAGO  ======*/

/*==========================================
=            BOTON EDITAR VENTA            =
==========================================*/

$(".tablas").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;

})

/*=====  End of BOTON EDITAR VENTA  ======*/

/*===============================================================================================================================
=            FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA            =
===============================================================================================================================*/

function quitarAgregarServicio(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idServicios = $(".quitarServicio");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarServicio");

	//Recorremos en un ciclo para obtener los diferentes idServicios que fueron agregados a la venta
	for(var i = 0; i < idServicios.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idServicios[i]).attr("idServicio");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idServicio") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarServicio");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=====  End of FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA  ======*/

/*==================================================================================================
=            CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:            =
==================================================================================================*/

$('.tablaVentas').on( 'draw.dt', function(){

	quitarAgregarServicio();

})

/*=====  End of CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:  ======*/

/*====================================
=            BORRAR VENTA            =
====================================*/

$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  Swal.fire({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }

  })

})

/*=====  End of BORRAR VENTA  ======*/

/*========================================
=            IMPRIMIR FACTURA            =
========================================*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

	var codigoVenta = $(this).attr("codigoVenta");

	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");

})

/*=====  End of IMPRIMIR FACTURA  ======*/

/*=======================================
=            RANGO DE FECHAS            =
=======================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=====  End of RANGO DE FECHAS  ======*/

/*================================================
=            CANCELAR RANGO DE FECHAS            =
================================================*/

$(".daterangepicker .drp-buttons .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*=====  End of CANCELAR RANGO DE FECHAS  ======*/

/*====================================
=            CAPTURAR HOY            =
====================================*/

$(".daterangepicker .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){
 
    var d = new Date();
		
    var dia = d.getDate();
    var mes = d.getMonth()+1;
    var año = d.getFullYear();
 
    dia = ("0"+dia).slice(-2);
    mes = ("0"+mes).slice(-2);
 
    var fechaInicial = año+"-"+mes+"-"+dia;
    var fechaFinal = año+"-"+mes+"-"+dia;	
 
    localStorage.setItem("capturarRango", "Hoy");
 
    window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
 
}

})

/*=====  End of CAPTURAR HOY  ======*/









