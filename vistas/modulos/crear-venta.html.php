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
                <h3 class="card-title">Input Addon</h3>
            </div>

            <form role="form" method="post">

              <div class="card-body box-success">

                <!--==============================
                =            VENDEDOR            =
                ===============================-->
                
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="Usuario administrador" readonly>
                </div>
                
                <!--====  End of VENDEDOR  ====-->

                <!--==================================
                =            CODIGO VENTA            =
                ===================================-->
                
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>
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
                    <option value="Administrador">Administrador</option>
                    <option value="Médico">Médico</option>
                    <option value="Recepcionista">Recepcionista</option>
                  </select>

                </div>
                
                <!--====  End of ENTRADA PACIENTE  ====-->

                <!--====================================================
                =            ENTRADA PARA AGREGAR SERVICIOS            =
                =====================================================-->
                
                <div class="form-group row nuevoProducto">

                  <!-- Descripcion del servicio -->
                  <div class="col-6">
                
                    <div class="input-group mb-3">

                      <div class="input-group-prepend">
                        <button type="button" class="btn btn-danger"><i class="fas fa-times"></i></button>
                      </div>
                      <!-- /btn-group -->
                      <input type="text" class="form-control" id="agregarServicio" name="agregarServicio" placeholder="Descripción del servicio" required>

                    </div>

                  </div>

                  <!-- Cantidad -->
                  <div class="col-3">
                    
                      <input type="number" class="form-control" id="nuevaCantidadServicio" name="nuevaCantidadServicio" min="1" placeholder="0" required>
                    
                  </div>

                  <!-- Precio del servicio -->
                  <div class="col-3">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
                      </div>
                      <input type="number" class="form-control" id="nuevoPrecioServicio" name="nuevoPrecioServicio" min="1" placeholder="00001" required readonly>
                    </div>
                    <!-- /input-group -->
                  </div>

                </div>

                <!--====  End of ENTRADA PARA AGREGAR SERVICIOS  ====-->

                <!--============================================
                =            BOTON AGREGAR SERVICIO            =
                =============================================-->
                
                <button type="button" class="btn btn-default d-lg-none">Agregar servicio</button>
                
                <!--====  End of BOTON AGREGAR SERVICIO  ====-->
                
                <div class="row">
                  <div class="col-9"></div>
                  <div class="col-3">
                    <label for="exampleInputEmail1">Total</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
                      </div>
                      <input type="number" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" min="1" placeholder="00000" required readonly>
                    </div>
                    <!-- /input-group -->
                  </div>
                  <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
                <hr>

                <!--====================================
                =            METODO DE PAGO            =
                =====================================-->

                <div class="form-group row">

                  <div class="col-5">

                    <div class="input-group">

                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>
                      </select>

                    </div>
              
                  </div>

                  <div class="col-7">

                    <div class="input-group">

                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      </div>
                      <input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción" required>
                    
                  
                    </div> 

                  </div>

                </div>

                <br>
                
                <!--====  End of METODO DE PAGO  ====-->
                
              </div>

              <div class="card-footer">
                
                  <button type="submit" class="btn btn-primary float-right">Guardar venta</button>
                  
              </div>

            </form> 
          
          </div>

        </div>
        
        <!--====  End of FORMULARIO  ====-->
        
        <!--========================================
        =            TABLA DE SERVICIOS            =
        =========================================-->
        
        <div class="col-lg-7 d-none d-lg-block">

          <div class="card card-warning card-outline">

            <div class="card-header">
                <h3 class="card-title">Input Addon</h3>
            </div>

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive tablas">

                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th style="width: 200px">Acciones</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Consulta general</td>
                    <td>$ 100</td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary">Agregar</button>
                      </div>
                    </td>
                  </tr>
                </tbody>
                
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






