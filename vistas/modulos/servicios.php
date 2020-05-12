<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Administrar servicios</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

            <li class="breadcrumb-item active">Administrar servicios</li>

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

        if($_SESSION["perfil"] == "Administrador"){

          echo '<div class="card-header">

                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarServicio">

                    Agregar servicio

                  </button>

                </div>';}
                
      ?>

      <div class="card-body">
        
        <table class="table table-bordered table-striped dt-responsive tablaServicios" width="100%">

          <thead>

             <tr>
              <th style="width: 10px">#</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Agregado</th>
              <?php 
              if($_SESSION["perfil"] == "Administrador"){
              echo '<th>Acciones</th>';
              }?>
            </tr>

          </thead>

        </table>

        <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
         
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--===========================================
=            MODAL AGREGAR SERVICIO            =
============================================-->

<div class="modal fade" id="modalAgregarServicio">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header" style="background: #343a40; color: white">

          <h4 class="modal-title">Agregar servicio</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <div class="card-body">

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>

              </div>

              <input type="text" class="form-control" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

            </div>

            <!-- ENTRADA PARA PRECIO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

              </div>

              <input type="number" class="form-control" id="nuevoPrecio" name="nuevoPrecio" min="0" step="any" placeholder="Precio" required>

            </div>

          </div>
          
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar servicio</button>

        </div>

      </form>

      <?php

        $crearServicio = new ControladorServicios();
        $crearServicio -> ctrCrearServicio();

      ?>  

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--====  End of MODAL AGREGAR SERVICIO  ====-->

<!--===========================================
=            MODAL EDITAR SERVICIO            =
============================================-->

<div class="modal fade" role="dialog" id="modalEditarServicio">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <div class="modal-header" style="background: #343a40; color: white">

          <h4 class="modal-title">Editar servicio</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          <div class="card-body">

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>

              </div>

              <input type="text" class="form-control" id="editarDescripcion" name="editarDescripcion" required>

              <input type="hidden" id="idServicio" name="idServicio">

            </div>

            <!-- ENTRADA PARA PRECIO -->
            <div class="input-group mb-3">

              <div class="input-group-prepend">

                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>

              </div>

              <input type="number" class="form-control" id="editarPrecio" name="editarPrecio" min="0" step="any" required>

            </div>

          </div>
          
        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar servicio</button>

        </div>

      </form>

      <?php

        $editarServicio = new ControladorServicios();
        $editarServicio -> ctrEditarServicio();

      ?>  

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!--====  End of MODAL EDITAR SERVICIO  ====-->

<?php

  $eliminarServicio = new ControladorServicios();
  $eliminarServicio -> ctrEliminarServicio();

?>  





