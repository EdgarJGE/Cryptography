<?php 

  if($_SESSION["perfil"] == "Médico" || $_SESSION["perfil"] == "Recepcionista" || $_SESSION["perfil"] == "Cajero"){

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

          <h1>Administrar usuarios</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

            <li class="breadcrumb-item active">Administrar usuarios</li>

          </ol>

        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">

      <div class="card-header">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar usuario

        </button>

      </div>

      <div class="card-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Teléfono</th>
              <th>Dirección</th>
              <th>Estado</th>
              <th>Último login</th>
              <th style="width: 80px">Acciones</th>
            </tr>
          </thead>

          <tbody>

            <?php

              $item = null;
              $valor = null;

              $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

              foreach ($usuarios as $key => $value) {

                $nombre=Cifrar::decrypt($value["nombre"]);
                $telefono=Cifrar::decrypt($value["telefono"]);
                $direccion=Cifrar::decrypt($value["direccion"]);
                
                echo '<tr>
                  <td>'.($key+1).'</td>
                  <td>'.$nombre.'</td>
                  <td>'.$value["usuario"].'</td>';

                  if($value["foto"] != ""){

                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

                  }else{

                    echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                  }
                  
                  echo '<td>'.$value["perfil"].'</td>
                  <td>'.$telefono.'</td>
                  <td>'.$direccion.'</td>';

                  if($value["estado"] != 0){

                    echo'<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["idusuario"].'" estadoUsuario="0">Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["idusuario"].'" estadoUsuario="1">Desactivado</button></td>';

                  }

                  echo '<td>'.$value["ultimo_login"].'</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["idusuario"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fas fa-edit"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["idusuario"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'"><i class="fas fa-times"></i></button>
                    </div>
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
=            MODAL AGREGAR USUARIO            =
============================================-->

<div class="modal fade" id="modalAgregarUsuario">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background: #343a40; color: white">

          <h4 class="modal-title">Agregar usuario</h4>

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

              <input type="text" class="form-control form-control-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-key"></i></span>

              </div>

              <input type="text" class="form-control form-control-lg" id="nuevoUsuario" name="nuevoUsuario" placeholder="Ingresar usuario" required>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-lock"></i></span>

              </div>

              <input type="password" class="form-control form-control-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-phone"></i></span>

              </div>

              <input type="text" class="form-control form-control-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>

              </div>

              <input type="text" class="form-control form-control-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PERFIL -->

            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-users"></i></span>

              </div>

              <select class="form-control form-control-lg" name="nuevoPerfil" required>
                <option value="">Seleccionar perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Médico">Médico</option>
                <option value="Recepcionista">Recepcionista</option>
                <option value="Cajero">Cajero</option>
              </select>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group mb-3">
              <label>Subir foto</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input nuevaFoto" name="nuevaFoto">
                <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                <p class="help-block">Peso máximo de la foto 2 MB</p>
                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              </div>
            </div>

          </div>
          
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

        <?php

          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();

        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--====  End of MODAL AGREGAR USUARIO  ====-->

<!--==========================================
=            MODAL EDITAR USUARIO            =
===========================================-->

<div class="modal fade" id="modalEditarUsuario">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background: #343a40; color: white">

          <h4 class="modal-title">Editar usuario</h4>

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

              <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-key"></i></span>

              </div>

              <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" value="" readonly>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-lock"></i></span>

              </div>

              <input type="password" class="form-control" name="editarPassword" placeholder="Escriba la nueva contraseña">

              <input type="hidden" id="passwordActual" name="passwordActual">

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-phone"></i></span>

              </div>

              <input type="text" class="form-control" id="editarTelefono" name="editarTelefono" value="" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>

              </div>

              <input type="text" class="form-control" id="editarDireccion" name="editarDireccion" value="" required>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PERFIL -->

            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-users"></i></span>

              </div>

              <select class="form-control" name="editarPerfil">
                <option value="" id="editarPerfil"></option>
                <option value="Administrador">Administrador</option>
                <option value="Médico">Médico</option>
                <option value="Recepcionista">Recepcionista</option>
                <option value="Cajero">Cajero</option>
              </select>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group mb-3">
              <label>Subir foto</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input nuevaFoto" name="editarFoto">
                <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                <p class="help-block">Peso máximo de la foto 2 MB</p>
                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActual">
              </div>
            </div>

          </div>
          
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

        <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();

        ?> 

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--====  End of MODAL EDITAR USUARIO  ====-->

<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

?> 





