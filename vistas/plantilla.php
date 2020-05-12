<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Hospital Files</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="vistas/img/plantilla/logo.png">

  <!--====================================
  =            PLUGINS DE CSS            =
  =====================================-->
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">
  
  <!--====  End of PLUGINS DE CSS  ====-->

  <!--===========================================
  =            PLUGINS DE JAVASCRIPT            =
  ============================================-->
  
  <!-- jQuery -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="vistas/plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
  <!-- DataTables -->
  <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <!-- InputMask -->
  <script src="vistas/plugins/moment/moment.min.js"></script>
  <script src="vistas/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- Summernote -->
  <script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquery.number.js"></script>
  <!-- Daterange picker -->
  <script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/chart.js/Chart.js"></script>
   

  <!--====  End of PLUGINS DE JAVASCRIPT  ====-->
  
</head>

  <?php

    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

      echo '<body class="hold-transition sidebar-mini sidebar-collapse">
            <div class="wrapper">';

      /*================================
      =            CABEZOTE            =
      ================================*/
      
      include "modulos/cabezote.php";
      
      /*=====  End of CABEZOTE  ======*/
      
      /*============================
      =            MENU            =
      ============================*/
      
      include "modulos/menu.php";
      
      /*=====  End of MENU  ======*/

      if(isset($_GET["ruta"])){

          if($_GET["ruta"] == "inicio" ||
             $_GET["ruta"] == "usuarios" ||
             $_GET["ruta"] == "pacientes" ||
             $_GET["ruta"] == "servicios" ||
             $_GET["ruta"] == "pagos" ||
             $_GET["ruta"] == "historial" ||
             $_GET["ruta"] == "ventas" ||
             $_GET["ruta"] == "crear-venta" ||
             $_GET["ruta"] == "editar-venta" ||
             $_GET["ruta"] == "salir"){
      
            include "modulos/".$_GET["ruta"].".php";

          }else{

            include "modulos/404.php";

          }

      }else{

        include "modulos/inicio.php";

      }
        
        /*=====  End of CONTENIDO  ======*/

        /*==============================
        =            FOOTER            =
        ==============================*/
        
        include "modulos/footer.php";
        
        /*=====  End of FOOTER  ======*/

        echo '</div>
             </body>';

    }else{

    include "modulos/login.php";

    }

  ?>
  
<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/servicios.js"></script>
<script src="vistas/js/pacientes.js"></script>
<script src="vistas/js/historial.js"></script>
<script src="vistas/js/ventas.js"></script>

</html>
