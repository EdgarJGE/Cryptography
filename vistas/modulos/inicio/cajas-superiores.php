<?php

$itemMedicos = "perfil";
$valorMedicos = "Médico";

$item = null;
$valor = null;

$ventas = ControladorVentas::ctrSumaTotalVentas();

$medicos = ControladorUsuarios::ctrMostrarUsuarios($itemMedicos, $valorMedicos);
$totalMedicos = count($medicos);

$pacientes = ControladorPacientes::ctrMostrarPacientes($item, $valor);
$totalPacientes = count($pacientes);

$servicios = ControladorServicios::ctrMostrarServicios($item, $valor);
$totalServicios = count($servicios);

?>


<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-info">
    <div class="inner">
      <h3><?php echo number_format($totalMedicos); ?></h3>

      <p>Médicos</p>
    </div>
    <div class="icon">
      <i class="fas fa-user-md"></i>
    </div>
    <a href="usuarios" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-warning">
    <div class="inner">
      <h3><?php echo number_format($totalPacientes); ?></h3>

      <p>Pacientes</p>
    </div>
    <div class="icon">
      <i class="fas fa-user-injured"></i>
    </div>
    <a href="pacientes" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3>$ <?php echo number_format($ventas["total"], 2); ?></h3>

      <p>Ventas</p>
    </div>
    <div class="icon">
      <i class="ion ion-social-usd"></i>
    </div>
    <a href="ventas" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>

<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-danger">
    <div class="inner">
      <h3><?php echo number_format($totalServicios); ?></h3>

      <p>Servicios</p>
    </div>
    <div class="icon">
      <i class="fas fa-stethoscope"></i>
    </div>
    <a href="servicios" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
  </div>
</div>