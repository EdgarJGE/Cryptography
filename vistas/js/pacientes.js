/*===========================================
=            SUBIR FOTO PACIENTE            =
===========================================*/

$(".nuevaImagen").change(function(){

  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

      $(".nuevaImagen").val("");

       Swal.fire({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          icon: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){

      $(".nuevaImagen").val("");

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

/*=====  End of SUBIR FOTO PACIENTE  ======*/

/*=======================================
=            EDITAR PACIENTE            =
=======================================*/

$(".tablas").on("click", ".btnEditarPaciente", function(){

  var idPaciente = $(this).attr("idPaciente");

  var datos = new FormData();
    datos.append("idPaciente", idPaciente);

    $.ajax({

      url:"ajax/pacientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuestaDes){
        
        $("#idPaciente").val(respuestaDes["idpaciente"]);
        $("#editarPaciente").val(respuestaDes["nombre"]);
        $("#editarCurp").val(respuestaDes["curp"]);
        $("#editarGenero").val(respuestaDes["genero"]);
        $("#editarGenero").html(respuestaDes["genero"]);
        $("#editarTelefonoPaciente").val(respuestaDes["telefono"]);
        $("#editarDireccionPaciente").val(respuestaDes["direccion"]);
        $("#editarFechaNacimiento").val(respuestaDes["fecha_nacimiento"]);
        $("#editarSangre").val(respuestaDes["sangre"]);
        $("#editarSangre").html(respuestaDes["sangre"]);

        if(respuestaDes["foto"] != ""){

          $("#imagenActual").val(respuestaDes["foto"]);
          $(".previsualizar").attr("src", respuestaDes["foto"]);

        } 

          
    }

    })

})

/*=====  End of EDITAR PACIENTE  ======*/

/*=================================================================
=            REVISAR SI EL PACIENTE YA ESTA REGISTRADO            =
=================================================================*/

$("#nuevoCurp").change(function(){

  $(".alert").remove();

  var curp = $(this).val();

  var datos = new FormData();
  datos.append("validarCurp", curp);

   $.ajax({
      url:"ajax/pacientes.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){
        
        if(respuesta[0]){

          $("#nuevoCurp").parent().after('<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>');

          $("#nuevoCurp").val("");

        }

      }

  })

})

/*=====  End of REVISAR SI EL PACIENTE YA ESTA REGISTRADO  ======*/

/*=========================================
=            ELIMINAR PACIENTE            =
=========================================*/

$(".tablas").on("click", ".btnEliminarPaciente", function(){

  var idPaciente = $(this).attr("idPaciente");
  var curp = $(this).attr("curp");
  var foto = $(this).attr("foto");

  Swal.fire({

    title: '¿Está seguro de borrar el paciente?',
    text: "¡Si no lo está puede cancelar la accíón!",
    icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar paciente!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?ruta=pacientes&idPaciente="+idPaciente+"&foto="+foto+"&curp="+curp;

        }

  })  

})

/*=====  End of ELIMINAR PACIENTE  ======*/

/*==========================================
=            HISTORIAL PACIENTE            =
==========================================*/

$(".tablas").on("click", ".btnHistorialPaciente", function(){

  var idPaciente = $(this).attr("idPaciente");

          window.location = "index.php?ruta=historial&idPaciente="+idPaciente;

})

/*=====  End of HISTORIAL PACIENTE  ======*/








