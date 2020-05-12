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

    <!-- Default box -->
    <div class="card">

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
              <th>Fecha</th>
              <th>Titulo</th>
              <th>Descripción</th>
              <th>Acciones</th>
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
                        <td>'.$value["fecha"].'</td>
                        <td>'.$value["titulo"].'</td>
                        <td>'.$value["descripcion"].'</td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger"><i class="fas fa-times"></i></button>
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

<!--=============================================
=            MODAL AGREGAR HISTORIAL            =
==============================================-->

<div class="modal fade" id="modalAgregarHistorial">

  <div class="modal-dialog">

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
            
            <!-- ENTRADA PARA LA FECHA  -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-calendar"></i></span>

              </div>

              <input type="text" class="form-control" id="nuevaFechaHistorial" name="nuevaFechaHistorial" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask>

            </div>

            <!-- ENTRADA PARA EL TITULO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevoTitulo" placeholder="Ingresar titulo" required>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevaDescripcionHistorial" placeholder="Ingresar descripción" required>

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



