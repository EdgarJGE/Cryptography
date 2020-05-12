<?php 


if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Recepcionista" || $_SESSION["perfil"] == "Cajero"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

  if(isset($_GET["idPaciente"])==null){

    echo '<script>

        window.location = "404";

      </script>';

    return;

  }

}

?>
<a href=""></a>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Historial médico</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

            <li class="breadcrumb-item active">Historial médico</li>

          </ol>

        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">

        <!--============================
        =            PERFIL            =
        =============================-->
        
        <div class="col-md-3">

          <div class="card card-primary card-outline">
            
            <div class="card-body box-profile">

              <?php

                $item = "idpaciente";
                $valor= $_GET["idPaciente"];

                $pacientes = ControladorPacientes::ctrMostrarPacientes($item, $valor);

                foreach ($pacientes as $key => $value) {
                  
                  echo '<div class="text-center">

                          <img class="profile-user-img img-fluid img-circle"
                               src="'.$value["foto"].'"
                               alt="User profile picture">

                        </div>

                        <h3 class="profile-username text-center">'.Cifrar::decrypt($value["nombre"]).'</h3>

                        <p class="text-muted text-center">'.$value["curp"].'</p>

                        <strong><i class="fas fa-book mr-1"></i> Fecha de registro</strong>

                        <p class="text-muted">
                          '.substr($value["fecha"],0,10).'
                        </p>

                        <hr>

                        <strong><i class="fas fa-venus-mars mr-1"></i> Genero</strong>

                        <p class="text-muted">'.Cifrar::decrypt($value["genero"]).'</p>

                        <hr>

                        <strong><i class="fas fa-phone mr-1"></i> Teléfono</strong>

                        <p class="text-muted">'.Cifrar::decrypt($value["telefono"]).'</p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección</strong>

                        <p class="text-muted">'.Cifrar::decrypt($value["direccion"]).'</p>

                        <hr>

                        <strong><i class="fas fa-calendar mr-1"></i> Fecha de nacimiento</strong>

                        <p class="text-muted">'.Cifrar::decrypt($value["fecha_nacimiento"]).'</p>

                        <hr>

                        <strong><i class="fas fa-tint mr-1"></i> Tipo de sangre</strong>

                        <p class="text-muted">'.Cifrar::decrypt($value["sangre"]).'</p>';

                }
                
              ?>

            </div>
            
          </div>
          
        </div>
        
        <!--====  End of PERFIL  ====-->
        
        <!--===============================
        =            HISTORIAL            =
        ================================-->
        
        <div class="col-md-9">

          <div class="card card-info card-outline">

            <div class="card-header">

              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarHistorial">

                Agregar historial

              </button>

            </div>

            <div class="card-body">
              
              <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                <thead>
                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 100px">Fecha</th>
                    <th style="width: 190px">Titulo</th>
                    <th>Descripción</th>
                    <th style="width: 80px">Acciones</th>
                  </tr>

                </thead>

                <tbody>

                  <?php

                    $item = "idpaciente";
                    $valor= $_GET["idPaciente"];

                    $historial = ControladorHistorial::ctrMostrarHistorial($item, $valor);

                    foreach ($historial as $key => $value) {
                      echo '<tr>
                              <td>'.($key+1).'</td>
                              <td>'.substr($value["fecha"],0,10).'</td>
                              <td>'.Cifrar::decrypt($value["titulo"]).'</td>
                              <td>'.str_replace("\r\n", "<br>",Cifrar::decrypt($value["descripcion"])).'</td>
                              <td>
                                <div class="btn-group">
                                  <button class="btn btn-warning btnEditarHistorial" data-toggle="modal" data-target="#modalEditarHistorial" idHistorial="'.$value["idhistorial"].'"><i class="fas fa-edit"></i></button>
                                  <button class="btn btn-danger btnEliminarHistorial" idHistorial="'.$value["idhistorial"].'" idPaciente="'.$value["idpaciente"].'"><i class="fas fa-times"></i></button>
                                </div>
                              </td>
                            </tr>';

                    }

                  ?>

                </tbody>

              </table>
               
            </div>
            
          </div>
          
        </div>
        
        <!--====  End of HISTORIAL  ====-->

      </div>
      
    </div>

  </section>
  
</div>

<!--=============================================
=            MODAL AGREGAR HISTORIAL            =
==============================================-->

<div class="modal fade" id="modalAgregarHistorial">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background: #343a40; color: white">

          <h4 class="modal-title">Agregar historial</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <div class="card-body">
            
            <!-- ENTRADA PARA EL TITULO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevoTitulo" placeholder="Ingresar titulo" required>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-notes-medical"></i></span>

              </div>

              <!-- <input type="text" class="form-control" name="nuevaDescripcionHistorial" placeholder="Ingresar descripción" required> -->

              <textarea class="form-control" rows="6" name="nuevaDescripcionHistorial" placeholder="Ingresar descripción" required></textarea>

            </div>

          </div>
          
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar historial</button>

        </div>

        <?php

          $crearHistorial = new ControladorHistorial();
          $crearHistorial -> ctrCrearHistorial();

        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--====  End of MODAL AGREGAR HISTORIAL  ====-->

<!--============================================
=            MODAL EDITAR HISTORIAL            =
=============================================-->

<div class="modal fade" id="modalEditarHistorial">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background: #343a40; color: white">

          <h4 class="modal-title">Editar historial</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <div class="card-body">
            
            <!-- ENTRADA PARA EL TITULO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>

              </div>

              <input type="text" class="form-control" id="editarTitulo" name="editarTitulo" required>

              <input type="hidden" id="idEditarHistorial" name="idEditarHistorial">


            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-notes-medical"></i></span>

              </div>

              <!-- <input type="text" class="form-control" name="nuevaDescripcionHistorial" placeholder="Ingresar descripción" required> -->

              <textarea class="form-control" rows="6" id="editarDescripcionHistorial" name="editarDescripcionHistorial" required></textarea>

            </div>

          </div>
          
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php

          $editarHistorial = new ControladorHistorial();
          $editarHistorial -> ctrEditarHistorial();

        ?>

      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--====  End of MODAL EDITAR HISTORIAL  ====-->

<?php

  $eliminarHistorial = new ControladorHistorial();
  $eliminarHistorial -> ctrEliminarHistorial();

?>




