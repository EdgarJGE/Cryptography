<?php 

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/pacientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/servicios.controlador.php";
require_once "controladores/historial.controlador.php";
require_once "controladores/cifrar.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/pacientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/servicios.modelo.php";
require_once "modelos/historial.modelo.php";

$plantilla = new ControladorPlantilla(); //Invoca la clase ControladorPlantilla
$plantilla -> ctrPlantilla(); //ejecuta los metodos en esa clase