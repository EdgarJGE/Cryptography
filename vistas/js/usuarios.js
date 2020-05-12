/*==========================================
=            SUBIR FOTO USUARIO            =
==========================================*/

$(".nuevaFoto").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFoto").val("");

  		 Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaFoto").val("");

  		 Swal.fire({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      icon: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=====  End of SUBIR FOTO USUARIO  ======*/

/*======================================
=            EDITAR USUARIO            =
======================================*/

$(document).on("click", ".btnEditarUsuario", function(){

	var idUsuario = $(this).attr("idUsuario");
	
	var datos = new FormData();
	datos.append("idUsuario", idUsuario);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuestaDec){
			
			$("#editarNombre").val(respuestaDec["nombre"]);
			$("#editarUsuario").val(respuestaDec["usuario"]);
			$("#editarPerfil").html(respuestaDec["perfil"]);
			$("#editarPerfil").val(respuestaDec["perfil"]);
			$("#editarTelefono").val(respuestaDec["telefono"]);
			$("#editarDireccion").val(respuestaDec["direccion"]);
			$("#fotoActual").val(respuestaDec["foto"]);

			$("#passwordActual").val(respuestaDec["password"]);

			if(respuestaDec["foto"] != ""){

				$(".previsualizar").attr("src", respuestaDec["foto"]);

			}	

		}

	});

})

/*=====  End of EDITAR USUARIO  ======*/

/*=======================================
=            ACTIVAR USUARIO            =
=======================================*/

$(document).on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
 	datos.append("activarId", idUsuario);
  	datos.append("activarUsuario", estadoUsuario);

  	$.ajax({

	  url:"ajax/usuarios.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      	if(window.matchMedia("(max-width:767px)").matches){
		
      		 Swal.fire({
		      	title: "El usuario ha sido actualizado",
		      	icon: "success",
		      	confirmButtonText: "¡Cerrar!"
		    	}).then(function(result) {
		        
		        	if (result.value) {

		        	window.location = "usuarios";

		        }

		      });

		}
      }

  	})

  	if(estadoUsuario == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoUsuario',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoUsuario',0);

  	}

})

/*=====  End of ACTIVAR USUARIO  ======*/

/*================================================================
=            REVISAR SI EL USUARIO YA ESTÁ REGISTRADO            =
================================================================*/

$("#nuevoUsuario").change(function(){

	$(".alert").remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	 $.ajax({
	    url:"ajax/usuarios.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		$("#nuevoUsuario").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

	    		$("#nuevoUsuario").val("");

	    	}

	    }

	})

})

/*=====  End of REVISAR SI EL USUARIO YA ESTÁ REGISTRADO  ======*/

/*========================================
=            ELIMINAR USUARIO            =
========================================*/

$(document).on("click", ".btnEliminarUsuario", function(){

  var idUsuario = $(this).attr("idUsuario");
  var fotoUsuario = $(this).attr("fotoUsuario");
  var usuario = $(this).attr("usuario");

  Swal.fire({
    title: '¿Está seguro de borrar el usuario?',
    text: "¡Si no lo está puede cancelar la accíón!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar usuario!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;

    }

  })

})

/*=====  End of ELIMINAR USUARIO  ======*/




