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
        
        <table class="table table-bordered table-striped dt-responsive tablas">

          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Telefono</th>
              <th>Dirección</th>
              <th>Estado</th>
              <th>Último login</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>1</td>
              <td>Usuario administrador</td>
              <td>admin</td>
              <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
              <td>Administrador</td>
              <td>5556987412</td>
              <td>Calle #20</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2020-05-03 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                </div>
              </td>
            </tr>

            <tr>
              <td>1</td>
              <td>Usuario administrador</td>
              <td>admin</td>
              <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
              <td>Administrador</td>
              <td>5556987412</td>
              <td>Calle #20</td>
              <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
              <td>2020-05-03 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                </div>
              </td>
            </tr>

            <tr>
              <td>1</td>
              <td>Usuario administrador</td>
              <td>admin</td>
              <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>
              <td>Administrador</td>
              <td>5556987412</td>
              <td>Calle #20</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2020-05-03 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger"><i class="fas fa-times"></i></button>
                </div>
              </td>
            </tr>
          
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

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

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

              <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-key"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevoUsuario" placeholder="Ingresar usuario" required>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-lock"></i></span>

              </div>

              <input type="password" class="form-control" name="nuevoPassword" placeholder="Ingresar contraseña" required>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-phone"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevoTelefono" placeholder="Ingresar teléfono" required>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevaDireccion" placeholder="Ingresar dirección" required>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PERFIL -->

            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-users"></i></span>

              </div>

              <select class="form-control" name="nuevoPerfil">
                <option value="">Seleccionar perfil</option>
                <option value="Administrador">Administrador</option>
                <option value="Medico">Medico</option>
                <option value="Recepcionista">Recepcionista</option>
              </select>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->
            <div class="form-group mb-3">
              <label>Subir foto</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="nuevaFoto" name="nuevaFoto">
                <label class="custom-file-label" for="customFile">Seleccionar archivo</label>
                <p class="help-block">Peso máximo de la foto 5 MB</p>
                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px">
              </div>
            </div>

          </div>
          
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--====  End of MODAL AGREGAR USUARIO  ====-->




