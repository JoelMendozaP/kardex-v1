<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/estudiantes.controlador.php";
require_once "controladores/materia.controlador.php";
require_once "controladores/historial.controlador.php";
require_once "controladores/corespexterna.controlador.php";
require_once "controladores/corespinterna.controlador.php";
require_once "controladores/plandeestudio.controlador.php";



require_once "modelos/usuarios.modelo.php";
require_once "modelos/estudiantes.modelo.php";
require_once "modelos/materia.modelo.php";
require_once "modelos/historial.modelo.php";
require_once "modelos/corespexterna.modelo.php";
require_once "modelos/corespinterna.modelo.php";
require_once "modelos/mensajero.php";
require_once "modelos/plandeestudio.modelo.php";



$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();