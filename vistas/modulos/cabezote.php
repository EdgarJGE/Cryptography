<!--=========================================
=            BARRA DE NAVEGACIÓN            =
==========================================-->

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown user-menu">

      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">

        <?php

          if($_SESSION["foto"] != ""){

            echo '<img src="'.$_SESSION["foto"].'" class="user-image img-circle elevation-2">';

          }else{

            echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image img-circle elevation-2">';

          }

        ?>

        <span class="d-none d-md-inline"><?php echo $_SESSION["nombre"]; ?></span>
      </a>

      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        <!-- Menu Body -->
        <li class="user-body">
          
          <a href="salir" class="btn btn-default btn-flat float-right">Salir</a>

        </li>

      </ul>

    </li>
    
  </ul>

</nav>
  <!-- /.navbar -->

<!--====  End of BARRA DE NAVEGACIÓN  ====-->


