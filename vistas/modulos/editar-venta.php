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

                <?php

                  $item = "idventa";
                  $valor = $_GET["idVenta"];

                  $venta = ControladorVentas::ctrMostrarVentas($item,$valor);

                  $itemUsuario = "idusuario";
                  $valorUsuario = $venta["id_vendedor"];

                  $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);

                  $itemPaciente = "idpaciente";
                  $valorPaciente = $venta["id_paciente"];

                  $paciente = ControladorPacientes::ctrMostrarPacientes($itemPaciente,$valorPaciente);

                ?>

                <!--==============================
                =            VENDEDOR            =
                ===============================-->
                
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo Cifrar::decrypt($vendedor["nombre"]); ?>" readonly>
                  <input type="hidden" name="idVendedor" value="<?php echo $vendedor["idusuario"]; ?>">
                </div>
                
                <!--====  End of VENDEDOR  ====-->

                <!--==================================
                =            CODIGO VENTA            =
                ===================================-->
                
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>'

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
                    <option value="<?php echo $paciente[0]["idpaciente"]; ?>"><?php echo Cifrar::decrypt($paciente[0]["nombre"]); ?></option>

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

                  <?php

                    $listaServicio = json_decode(Cifrar::decrypt($venta["servicios"]), true);

                    foreach ($listaServicio as $key => $value) {

                      $item = "idservicio";
                      $valor = $value["id"];

                      $respuesta = ControladorServicios::ctrMostrarServicios($item, $valor);

                      echo '<div class="row" style="padding:6px">
             
                            <div class="col-6">
                          
                              <div class="input-group">

                                <div class="input-group-prepend">
                                  <button type="button" class="btn btn-danger quitarServicio" idServicio="'.$value["id"].'"><i class="fas fa-times"></i></button>
                                </div>
                                
                                <input type="text" class="form-control nuevaDescripcionServicio" idServicio="'.$value["id"].'" name="agregarServicio" value="'.$value["descripcion"].'" readonly required>

                              </div>

                            </div>

                            <!-- Cantidad -->
                            <div class="col-3">
                              
                                <input type="number" class="form-control nuevaCantidadServicio" name="nuevaCantidadServicio" min="1" value="'.$value["cantidad"].'" required>
                              
                            </div>

                            <!-- Precio del servicio -->
                            <div class="col-3 ingresoPrecio">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
                                </div>
                                <input type="text" class="form-control nuevoPrecioServicio" precioReal="'.$respuesta["precio"].'" name="nuevoPrecioServicio" value="'.$value["total"].'" required readonly>
                              </div>
                             
                            </div>

                          </div>';
                    }


                  ?>

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
                      <input type="text" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" value="<?php echo $venta["total"]; ?>" required readonly>
                      <input type="hidden" name="totalVenta" value="<?php echo $venta["total"]; ?>" id="totalVenta">
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
                
                  <button type="submit" class="btn btn-primary float-right">Guardar cambios</button>
                  
              </div>

            </form>

            <?php

              $editarVenta = new ControladorVentas();
              $editarVenta -> ctrEditarVenta();

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






