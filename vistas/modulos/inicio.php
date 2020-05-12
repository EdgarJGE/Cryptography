<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Tablero</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

              <li class="breadcrumb-item active">Tablero</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        
        <div class="row">

          <?php

            if($_SESSION["perfil"] == "Administrador"){

              include "inicio/cajas-superiores.php";

            }

          ?>
          
          
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="col-lg-12">

            <?php

              if($_SESSION["perfil"] == "Administrador"){

                include "inicio/grafico-ventas.php";
              }

          ?>
          
          </div>
          
          
        </div>

        <?php

          if($_SESSION["perfil"] == "Médico" || $_SESSION["perfil"] == "Recepcionista" || $_SESSION["perfil"] == "Cajero"){

            echo '<div class="card card-primary card-outline">
                    <div class="card-body">
                      <h1>Bienvenid@ '.$_SESSION["nombre"].'</h1>
                    </div>
                  </div>';

          }

        ?>

      </div>

    </section>
    
  </div>
  <!-- /.content-wrapper -->