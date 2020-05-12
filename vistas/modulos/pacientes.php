<?php 

  if($_SESSION["perfil"] == "Cajero"){

    echo '<script>

      window.location = "inicio";

    </script>';

    return;

  }

?>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Administrar pacientes</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

            <li class="breadcrumb-item active">Administrar pacientes</li>

          </ol>

        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">

      <?php

        if($_SESSION["perfil"] == "Recepcionista"){

          echo '<div class="card-header">

                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPaciente">

                    Agregar paciente

                  </button>

                </div>';

        }

      ?>

      <div class="card-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>
              <th style="width: 10px">#</th>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Género</th>
              <th>Teléfono</th>
              <th width="200px">Acciones</th>
            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $pacientes = ControladorPacientes::ctrMostrarPacientes($item, $valor);

            foreach ($pacientes as $key => $value) {
              
              echo '<tr>
                    <td>'.($key+1).'</td>
                    <td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>
                    <td>'.Cifrar::decrypt($value["nombre"]).'</td>
                    <td>'.Cifrar::decrypt($value["genero"]).'</td>
                    <td>'.Cifrar::decrypt($value["telefono"]).'</td>
                    <td>
                      <div class="btn-group">';

                      if($_SESSION["perfil"] == "Médico"){

                        echo'<button class="btn btn-warning btn-lg btnEditarPaciente" data-toggle="modal" data-target="#modalEditarPaciente" idPaciente="'.$value["idpaciente"].'"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-primary btn-lg btnHistorialPaciente" idPaciente="'.$value["idpaciente"].'"><i class="fas fa-file-medical-alt"></i></button>';}

                      if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Recepcionista"){

                        echo '<button class="btn btn-danger btn-lg btnEliminarPaciente" idPaciente="'.$value["idpaciente"].'" foto="'.$value["foto"].'" curp="'.$value["curp"].'"><i class="fas fa-times"></i></button>';}

                      echo '</div>
                    </td>
                  </tr>';

            }

            ?>

          </tbody>

        </table>
         
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--===========================================
=            MODAL AGREGAR PACIENTE            =
============================================-->

<div class="modal fade" id="modalAgregarPaciente">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background: #343a40; color: white">

          <h4 class="modal-title">Agregar paciente</h4>

          <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <div class="card-body">
            
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-user"></i></span>

              </div>

              <input type="text" class="form-control input-lg" name="nuevoPaciente" placeholder="Ingresar nombre" required>

            </div>

            <!-- ENTRADA PARA EL CURP -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-id-card"></i></span>

              </div>

              <input type="text" class="form-control input-lg" id="nuevoCurp" name="nuevoCurp" placeholder="Ingresar CURP" required>

            </div>

            <!-- ENTRADA PARA SELECCIONAR GENERO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>

              </div>

              <select class="form-control" name="nuevoGenero" required>
                <option value="">Seleccionar genero</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-phone"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevoTelefonoPaciente" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevaDireccionPaciente" placeholder="Ingresar dirección" required>

            </div>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-calendar"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask required>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SANGRE -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-tint"></i></span>

              </div>

              <select class="form-control" name="nuevaSangre" required>
                <option value="">Seleccionar tipo de sangre</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
              </select>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group mb-3">
              <label>Subir foto</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input nuevaImagen" name="nuevaImagen">
                <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                <p class="help-block">Peso máximo de la foto 2 MB</p>
                <img src="vistas/img/pacientes/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              </div>
            </div>

          </div>
          
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar paciente</button>

        </div>

        <?php

          $crearPaciente = new ControladorPacientes();
          $crearPaciente -> ctrCrearPaciente();

        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--====  End of MODAL AGREGAR PACIENTE  ====-->

<!--===========================================
=            MODAL EDITAR PACIENTE            =
============================================-->

<div class="modal fade" id="modalEditarPaciente">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background: #343a40; color: white">

          <h4 class="modal-title">Editar paciente</h4>

          <button type="button" style="color: white" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <div class="card-body">
            
            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-user"></i></span>

              </div>

              <input type="text" class="form-control input-lg" id="editarPaciente" name="editarPaciente" required>

              <input type="hidden" id="idPaciente" name="idPaciente">

            </div>

            <!-- ENTRADA PARA EL CURP -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-id-card"></i></span>

              </div>

              <input type="text" class="form-control input-lg" id="editarCurp" name="editarCurp" readonly>

            </div>

            <!-- ENTRADA PARA SELECCIONAR GENERO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>

              </div>

              <select class="form-control" name="editarGenero" required>
                <option value="" id="editarGenero">Seleccionar genero</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
              </select>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-phone"></i></span>

              </div>

              <input type="text" class="form-control" id="editarTelefonoPaciente" name="editarTelefonoPaciente" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>

              </div>

              <input type="text" class="form-control" id="editarDireccionPaciente" name="editarDireccionPaciente" required>

            </div>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-calendar"></i></span>

              </div>

              <input type="text" class="form-control" id="editarFechaNacimiento" name="editarFechaNacimiento" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask required>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SANGRE -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-tint"></i></span>

              </div>

              <select class="form-control" name="editarSangre" required>
                <option value="" id="editarSangre">Seleccionar tipo de sangre</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
              </select>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group mb-3">
              <label>Subir foto</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input nuevaImagen" name="editarImagen">
                <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                <p class="help-block">Peso máximo de la foto 2 MB</p>
                <img src="vistas/img/pacientes/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                <input type="hidden" name="imagenActual" id="imagenActual">
              </div>
            </div>

          </div>
          
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php

          $editarPaciente = new ControladorPacientes();
          $editarPaciente -> ctrEditarPaciente();

        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--====  End of MODAL EDITAR PACIENTE  ====-->

<?php
  
  $eliminarPaciente = new ControladorPacientes();
  $eliminarPaciente -> ctrEliminarPaciente();
  
?>





