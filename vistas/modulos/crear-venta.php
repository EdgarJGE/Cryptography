<?php 

  if($_SESSION["perfil"] == "Médico" || $_SESSION["perfil"] == "Recepcionista"){

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

          <h1>Administrar ventas</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

            <li class="breadcrumb-item active">Administrar ventas</li>

          </ol>

        </div>

      </div>

    </div><!-- /.container-fluid -->

  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">

      <div class="row">

        <!--================================
        =            FORMULARIO            =
        =================================-->
        
        <div class="col-lg-5 col-xs-12">

          <div class="card card-primary card-outline">

            <div class="card-header">
                <h3 class="card-title"><strong>Venta</strong></h3>
            </div>

            <form role="form" method="post" class="formularioVenta">

              <div class="card-body box-success">

                <!--==============================
                =            VENDEDOR            =
                ===============================-->
                
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                  <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                </div>
                
                <!--====  End of VENDEDOR  ====-->

                <!--==================================
                =            CODIGO VENTA            =
                ===================================-->
                
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <?php

                    $item = null;
                    $valor = null;

                    $ventas = ControladorVentas::ctrMostrarVentas($item,$valor);

                    if(!$ventas){

                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';


                    }else{

                      foreach ($ventas as $key => $value) {
                        
                      }

                      $codigo = ($value["codigo"]+1);

                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';

                    }

                  ?>  

                </div>
                
                <!--====  End of CODIGO VENTA  ====-->

                <!--======================================
                =            ENTRADA PACIENTE            =
                =======================================-->
                
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                  </div>
                  <select class="form-control" id="seleccionarPaciente" name="seleccionarPaciente" required>
                    <option value="">Seleccionar paciente</option>

                    <?php

                      $item = null;
                      $valor = null;

                      $pacientes = ControladorPacientes::ctrMostrarPacientes($item, $valor);

                      foreach ($pacientes as $key => $value) {
                        echo '<option value="'.$value["idpaciente"].'">'.Cifrar::decrypt($value["nombre"]).'</option>';
                      }

                    ?>
                    
                  </select>

                </div>
                
                <!--====  End of ENTRADA PACIENTE  ====-->

                <!--====================================================
                =            ENTRADA PARA AGREGAR SERVICIOS            =
                =====================================================-->
                
                <div class="form-group row nuevoServicio">

                  

                </div>

                <input type="hidden" id="listaServicios" name="listaServicios">

                <!--====  End of ENTRADA PARA AGREGAR SERVICIOS  ====-->

                <!--============================================
                =            BOTON AGREGAR SERVICIO            =
                =============================================-->
                
                <button type="button" class="btn btn-default d-lg-none btnAgregarServicio">Agregar servicio</button>
                
                <!--====  End of BOTON AGREGAR SERVICIO  ====-->
                
                <div class="row">
                  <div class="col-9"></div>
                  <div class="col-3">
                    <label>Total</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
                      </div>
                      <input type="text" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" required readonly>
                      <input type="hidden" name="totalVenta" id="totalVenta">
                    </div>
                  </div>
                </div>
                <hr>

                <!--====================================
                =            METODO DE PAGO            =
                =====================================-->

                <br>

                <div class="form-group row">

                  <div class="col-6">

                    <div class="input-group">

                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>
                      </select>

                    </div>
              
                  </div>

                  <div class="cajasMetodoPago col-6"></div>

                  <div class="cajasMetodoPago2"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
                
                <!--====  End of METODO DE PAGO  ====-->
                
              </div>

              <div class="card-footer">
                
                  <button type="submit" class="btn btn-primary float-right">Guardar venta</button>
                  
              </div>

            </form>

            <?php

              $guardarVenta = new ControladorVentas();
              $guardarVenta -> ctrCrearVenta();

            ?>
          
          </div>

        </div>
        
        <!--====  End of FORMULARIO  ====-->
        
        <!--========================================
        =            TABLA DE SERVICIOS            =
        =========================================-->
        
        <div class="col-lg-7 d-none d-lg-block">

          <div class="card card-warning card-outline">

            <div class="card-header">
                <h3 class="card-title"><strong>Servicios</strong></h3>
            </div>

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive tablaVentas">

                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th style="width: 200px">Acciones</th>
                  </tr>
                </thead>

              </table>
  
            </div>
 
          </div>
          
        </div>
        
        <!--====  End of TABLA DE SERVICIOS  ====-->
        
      </div>
      
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->






