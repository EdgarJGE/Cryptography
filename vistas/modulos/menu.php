<!--=========================================
=            BARRA DE NAVEGACIÓN            =
==========================================-->

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!--==============================
    =            LOGOTIPO            =
    ===============================-->
    
    <a href="inicio" class="brand-link">
      <img src="vistas/img/plantilla/logo.png"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Hospital Files</span>
    </a>
    
    <!--====  End of LOGOTIPO  ====-->
    
    <!--==========================
    =            MENU            =
    ===========================-->
    
    <!-- Sidebar -->
    <div class="sidebar">
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <?php 

          if($_SESSION["perfil"] == "Administrador"){

            echo'<li class="nav-item">
              <a href="inicio" class="nav-link">
                <i class="nav-icon far fa-hospital"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="usuarios" class="nav-link">
                <i class="nav-icon fas fa-user-md"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>';

          }

          if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Médico" || $_SESSION["perfil"] == "Recepcionista"){

          echo '<li class="nav-item">
            <a href="pacientes" class="nav-link">
              <i class="nav-icon fas fa-user-injured"></i>
              <p>
                Pacientes
              </p>
            </a>
          </li>';
        }

          echo'<li class="nav-item">
            <a href="servicios" class="nav-link">
              <i class="nav-icon fas fa-stethoscope"></i>
              <p>
                Servicios
              </p>
            </a>
          </li>';

          if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Cajero"){

          echo'<li class="nav-item has-treeview">
            <a href="pagos" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="ventas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Administrar ventas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="crear-venta" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear venta</p>
                </a>
              </li>
            </ul>
          </li>';

          }

          ?>

        </ul>
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    
    
    <!--====  End of MENU  ====-->

<!--====  End of BARRA DE NAVEGACIÓN  ====-->
