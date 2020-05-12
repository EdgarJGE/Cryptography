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

    <!-- Default box -->
    <div class="card">

      <div class="card-header">

        <a href="crear-venta">

          <button type="button" class="btn btn-primary">

            Agregar venta

          </button>
          
        </a>

        <button type="button" class="btn btn-default float-right" id="daterange-btn">
          <span>
            <i class="fas fa-calendar"></i> Rango de fecha
          </span>
          <i class="fas fa-caret-down"></i>
        </button>

      </div>

      <div class="card-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Código factura</th>
              <th>Paciente</th>
              <th>Vendedor</th>
              <th>Forma de pago</th>
              <th>Total</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody>

            <?php

              if(isset($_GET["fechaInicial"])){

                $fechaInicial = $_GET["fechaInicial"];
                $fechaFinal = $_GET["fechaFinal"];

              }else{

                $fechaInicial = null;
                $fechaFinal = null;

              }

              $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

              foreach ($respuesta as $key => $value) {
                echo '<tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["codigo"].'</td>';

                        $itemPaciente = "idpaciente";
                        $valorPaciente = $value["id_paciente"];

                        $respuestaPaciente = ControladorPacientes::ctrMostrarPacientes($itemPaciente, $valorPaciente);

                        echo '<td>'.Cifrar::decrypt($respuestaPaciente[0]["nombre"]).'</td>';

                        $itemUsuario = "idusuario";
                        $valorUsuario = $value["id_vendedor"];

                        $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
                        

                        echo '<td>'.Cifrar::decrypt($respuestaUsuario["nombre"]).'</td>
                        <td>'.Cifrar::decrypt($value["metodo_pago"]).'</td>
                        <td>$ '.number_format($value["total"], 2).'</td>
                        <td>'.$value["fecha"].'</td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'"><i class="fas fa-print"></i></button>';
                            if($_SESSION["perfil"] == "Administrador"){
                            echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["idventa"].'"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["idventa"].'"><i class="fas fa-times"></i></button>';}
                          echo'</div>
                        </td>
                      </tr>';
              }

            ?>   
          
          </tbody>

        </table>

         <?php 

          $eliminarVenta = new ControladorVentas();
          $eliminarVenta -> ctrEliminarVenta();

        ?>
         
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->






